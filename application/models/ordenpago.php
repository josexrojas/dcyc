<?php
require_once(dirname(__FILE__)."/ordenpagobase.php");
	
class Ordenpago extends Ordenpagobase
{
	public $facturas;
	
	public function __construct() 
	{
		$this->facturas = array();
		parent::__construct();	
	}
	
	public function parse_from_post()
	{
		$this->parse_from_array($_POST);
	}
	
	public function get_all($filter = array()) {
		try 
		{
			$sql = "SELECT t.id FROM ordenes_pagos t";
			$sql.= " INNER JOIN ordenes_pagos_facturas f ON t.id = f.pago_id";
			$sql.= " WHERE 1=1";
			if (isset($filter['factura_id']))
				$sql.= " AND f.factura_id = ".$this->db->escape_str($filter['factura_id']);
			if (isset($filter['solo_retencion1']))
				$sql.= " AND t.importe_retencion1 > 0";
			if (isset($filter['mes']) && isset($filter['anio']))
				$sql.= " AND MONTH(t.fecha) = ".$this->db->escape_str($filter['mes'])." AND YEAR(t.fecha) = ".$this->db->escape_str($filter['anio']);
			
			$sql.= " GROUP BY t.id";
			if (isset($filter['solo_retencion1']))
				$sql.= " ORDER BY t.certificado_retencion DESC";
			else
				$sql.= " ORDER BY t.fecha DESC";
			$arr = array();
			$query = $this->db->query($sql);
		
			foreach ($query->result_array() as $oRow)
   			{
				$obj = new Ordenpago();
				
				$obj->load_by_id($oRow['id']);
				
			    array_push($arr, $obj);
			
			}
			return $arr;
		}
		catch (Exception $ex) 
		{
			return false;
		}
	}	
	
	
	/* retorna la clave para el combobox*/
	function get_key()
	{
		return $this->get('id');
	}
			
	/* retorna el valor para el combo box*/
	function get_value($lang = 'es')
	{
		return $this->get('fecha');
	}	
	
	
	public function add_factura(Facturacompra $f)
	{
		if ($this->get('id'))
			return false;
		
		if (count($this->facturas) > 0 && $f->get('proveedor_id') != $this->facturas[0]->get('proveedor_id'))
			return false;

		if ($f->get_saldo() <= 0)
			return false;
		
		$this->facturas[] = $f;
		return true;
	}
	

	public function get_proveedor()
	{
		if (!$this->get('id') && !isset($this->facturas[0]))
			return false;

		// precarga las facturas si aún no se hizo
		if ($this->get('id') && !isset($this->facturas[0]))
		{
			$this->facturas = $this->facturacompra->get_all(
					array(
							'pago_id' => $this->get('id')
					)
			);
		}
			
		$obj = new Empresa();
		if(!$obj->load_by_id($this->facturas[0]->get('proveedor_id')))
			return false;
		return $obj;
	}
		
	public function calcular_retenciones($importe_neto)
	{
		if ($this->get('id'))
			return false;
		
		$importe = 0;
		foreach ($this->facturas as $f)
			$importe += $f->get_saldo();
		
		if ($importe_neto > $importe)
			$importe_neto = $importe;
		
		if (!$proveedor = $this->get_proveedor())
			return false;
		
		$alicuota_retencion = 0;
		if ($padronarba = $proveedor->get_padronarba())
			$alicuota_retencion = $padronarba->get('alicuota_retencion'); 
		
		$this->set('importe_neto', $importe_neto);
		$this->set('alicuota1', $alicuota_retencion);
		$this->set('importe_retencion1', $importe_neto * $alicuota_retencion / 100);	// retencion IIBB ARBA
		$this->set('alicuota2', 0);
		$this->set('importe_retencion2', 0);
		$this->set('alicuota3', 0);
		$this->set('importe_retencion3', 0);
		$this->set('alicuota4', 0);
		$this->set('importe_retencion4', 0);

		if ($this->get('importe_retencion1') > 0)
			$this->set('certificado_retencion', $this->get_max_certificado_retencion() + 1);
		
		return true;
	}
	
	public function get_max_certificado_retencion()
	{
		try
		{
			$sql = "SELECT MAX(certificado_retencion) AS max FROM ordenes_pagos";
			$query = $this->db->query($sql);
		
			$data = $query->result_array();
			if (!$data || !isset($data[0]) || !isset($data[0]['max']))
				return 0;
			
			return $data[0]['max'];
		}
		catch (Exception $ex)
		{
			return 0;
		}
	}
	
	public function get_facturas()
	{
		if (!$this->get('id'))
			return $this->facturas;

		return $this->facturacompra->get_all(array('pago_id' => $this->get('id')));
	}
	
	public function save()
	{
		$importe_neto = $this->get('importe_neto');
				
		foreach ($this->facturas as $f)
		{
			if ($f->get_saldo() > $importe_neto)
				$importe_pagado = $importe_neto;
			else
				$importe_pagado = $f->get_saldo();
			
			$f->set('importe_pagado', $f->get('importe_pagado') + $importe_pagado);

			$importe_neto = $importe_neto - $importe_pagado;
			
			$f->save();
		}
		
		parent::save();
		
		foreach ($this->facturas as $f)
		{
			$this->db->insert(
					'ordenes_pagos_facturas',
					array(
							'pago_id' => $this->get('id'),
							'factura_id' => $f->get('id')
					)
			);
		}
		
		return true;
	}
	
	public function delete()
	{
		foreach ($this->get_facturas() as $f)
		{
			$this->db->delete('ordenes_pagos_facturas', 
					array(
							'pago_id' => $this->get('id'),
							'factura_id' => $f->get('id')
					)
			);
		}
		
		return parent::delete();
	}
	
}
	
?>
