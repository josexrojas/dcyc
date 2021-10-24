<?php
require_once(dirname(__FILE__)."/facturacomprabase.php");
	
class Facturacompra extends Facturacomprabase
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
			$sql = "SELECT t.*, COUNT(o.certificado_retencion) AS certificado_retencion FROM facturas_compras t";
			$sql.= " LEFT JOIN ordenes_pagos_facturas f ON t.id = f.factura_id";
			$sql.= " LEFT JOIN ordenes_pagos o ON f.pago_id = o.id";
			$sql.= " WHERE 1=1";
				
			if (isset($filter['empresa_id']))
				$sql.= " AND proveedor_id = '".$this->db->escape_str($filter['empresa_id'])."'";
			
			if (isset($filter['pago_id']))
				$sql.= " AND f.pago_id = '".$this->db->escape_str($filter['pago_id'])."'";
			
			$sql.= " GROUP BY 1, 2, 3, 4, 5, 6, 7, 8";
			$sql.= " ORDER BY t.importe_neto - t.importe_pagado DESC, t.proveedor_id, t.letra_comprobante, t.numero_comprobante";
			$arr = array();
			$query = $this->db->query($sql);
		
			foreach ($query->result_array() as $oRow)
   			{
				$obj = new Facturacompra();
				
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

	public function get_all_by_proveedor_month($empresa_id)
	{
		try 
		{
			//ARMAR EL SELECT NECESARIO
			$sql= " SELECT SUM(importe_neto) FROM facturas_compras";
			$sql.= " WHERE proveedor_id = " . $empresa_id;
			$sql.= " GROUP BY proveedor_id";

			$arr = array();
			$query = $this->db->query($sql);
		
			foreach ($query->result_array() as $oRow)
   			{
				$obj = new Facturacompra();
				
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

	public function get_proveedor()
	{
		$obj = new Empresa();
		if(!$obj->load_by_id($this->get('proveedor_id')))
			return false;
		return $obj;
	}
	
	public function get_saldo()
	{
		return $this->get('importe_neto') - $this->get('importe_pagado');
	}

	public function get_ordenespago()
	{
		$this->load->model('ordenpago');
		return $this->ordenpago->get_all(array('factura_id' => $this->get('id')));		
	}
	
	public function delete_ordenespago()
	{
		try 
		{
			$sql = "DELETE FROM ordenes_pagos WHERE id IN (SELECT pago_id FROM ordenes_pagos_facturas WHERE factura_id = ".$this->db->escape_str($this->get('id')).")";

			$this->db->query($sql);

			echo "HOAL".$this->db->_error_message();
			exit;
			
			return true;
		}
		catch (Exception $ex) 
		{
			die($this->db->_error_message());
			return false;
		}
	}
	
	public function has_ordenespago()
	{
		return count($this->get_ordenespago()) > 0;
	}
	
	
	public function delete()
	{
		try {
			foreach ($this->get_ordenespago() as $ordenpago)
				$ordenpago->delete();
			
			return parent::delete();
		} catch (Exception $ex) {
			return false;
		}
	}	
}
	
?>
