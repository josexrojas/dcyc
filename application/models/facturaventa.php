<?php
require_once(dirname(__FILE__)."/facturaventabase.php");
	
class Facturaventa extends Facturaventabase
{
	public function parse_from_post()
	{
		$this->parse_from_array($_POST);
		if (isset($_POST['fecha_comprobante']))
			$this->set('fecha_comprobante', dates::DMYtoYMD($_POST['fecha_comprobante']));
	}
	
	public function get_all($filter = array()) {
		try 
		{
			$sql = "SELECT t.*, e.descripcion as estado";
			$sql.= " FROM facturas_ventas t";
			$sql.= " INNER JOIN facturas_ventas_estados e ON t.estado_id = e.id";
			$sql.= " WHERE 1 = 1";
			if (isset($filter['solo_percepcion1']))
				$sql.= " AND t.importe_percepcion1 > 0";
			if (isset($filter['mes']) && isset($filter['anio']))
				$sql.= " AND MONTH(t.fecha_comprobante) = ".$this->db->escape_str($filter['mes'])." AND YEAR(t.fecha_comprobante) = ".$this->db->escape_str($filter['anio']);
				
			if (isset($filter['solo_percepcion1']))
				$sql.= " ORDER BY t.id DESC";
			else
				$sql.= " ORDER BY t.estado_id, t.cliente_id, t.letra_comprobante, t.numero_comprobante";
			
			$arr = array();
			$query = $this->db->query($sql);
		
			 foreach ($query->result_array() as $oRow)
   			{
				$obj = new Facturaventa();
				
				$obj->parse_from_array($oRow);
				
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
		return $this->get('razon_social');
	}	

	public function get_cliente()
	{
		$obj = new Empresa();
		if(!$obj->load_by_id($this->get('cliente_id')))
			return false;
		return $obj;
	}
	
	public function get_saldo()
	{
		return $this->get('importe_neto');
	}
	
	public function calcular_percepciones()
	{
		if ($this->get('id'))
			return false;
		
		if (!$proveedor = $this->get_cliente())
			return false;
		
		$alicuota_percepcion = 0;
		if ($padronarba = $proveedor->get_padronarba())
			$alicuota_percepcion = $padronarba->get('alicuota_percepcion');
		
		$this->set('importe_percepcion1', (double)$this->get('importe_neto') * $alicuota_percepcion / 100);	// percepcion IIBB ARBA
		$this->set('importe_percepcion2', 0);
		$this->set('importe_percepcion3', 0);
		$this->set('importe_percepcion4', 0);
		
		return true;
	}
	
	public function get_total()
	{
		$importe = 0;
		$importe += $this->get('importe_neto');
		$importe += $this->get('importe_iva10');
		$importe += $this->get('importe_iva21');
		$importe += $this->get('importe_iva27');
		$importe += $this->get('importe_nograv');
		$importe += $this->get('importe_percepcion1');
		$importe += $this->get('importe_percepcion2');
		$importe += $this->get('importe_percepcion3');
		$importe += $this->get('importe_percepcion4');
		
		return $importe;
	}

}
	
?>
