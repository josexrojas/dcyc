<?php
require_once(dirname(__FILE__)."/empresabase.php");
require_once(dirname(__FILE__)."/padronarba.php");

class Empresa extends Empresabase
{
	public function parse_from_post()
	{
		$this->parse_from_array($_POST);
	}
	
	public function get_all($filter = array()) {
		try 
		{
			$sql = "SELECT t.* FROM empresas t ";
			$sql.= " ORDER BY t.razon_social ASC";
			$arr = array();
			$query = $this->db->query($sql);
		
			 foreach ($query->result_array() as $oRow)
   			{
				$obj = new Empresa();
				
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
		return $this->get('nombre_fantasia');
	}	

	public function get_condicion()
	{
		$obj = new Condicion();
		if(!$obj->load_by_id($this->get('condicion_id')))
			return false;
		return $obj;
	}

	public function get_pais()
	{
		$obj = new Pais();
		if(!$obj->load_by_id($this->get('pais_id')))
			return false;
		return $obj;
	}

	public function get_provincia()
	{
		$obj = new Provincia();
		if(!$obj->load_by_id($this->get('condicion_id')))
			return false;
		return $obj;
	}

	public function get_padronarba()
	{
		$obj = new Padronarba();
		if(!$obj->load_last_by_cuit($this->get('cuit')))
			return false;
		return $obj;
	}
	
}
	
?>
