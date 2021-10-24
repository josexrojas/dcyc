<?php
require_once(dirname(__FILE__)."/provinciabase.php");
	
class Provincia extends Provinciabase
{
	public function parse_from_post()
	{
		$this->parse_from_array($_POST);
	}
	
	public function get_all($filter = array()) {
		try 
		{
			$sql = "SELECT t.* FROM provincias t ";
			$sql .= "WHERE 1 = 1 "; 
			
			if (isset($filter['pais_id']) && $filter['pais_id'] != 0)
				$sql .= "AND pais_id = ".$filter['pais_id'];
				
			if (isset($filter['descripcion']) && $filter['descripcion'])
				$sql .= "AND descripcion = '".$filter['descripcion']."'";
			
			$sql.= " ORDER BY t.descripcion ASC";
			
			$arr = array();
			$query = $this->db->query($sql);
			

			foreach ($query->result_array() as $oRow)
   			{
				$province = new Provincia();
				
				$province->parse_from_array($oRow);
				
			    array_push($arr, $province);
			
			}
				
			return $arr;
		}
		catch (Exception $ex) 
		{
			return false;
		}
	}	
	
	public function get_pais()
	{
		$region = new Pais();
		if(!$region->load_by_id($this->get('pais_id')))
			return false;
		return $region;		
	}
	
	/* retorna la clave para el combobox*/
	function get_key()
	{
		return $this->get('id');
	}
			
	/* retorna el valor para el combo box*/
	function get_value($lang = 'es')
	{
		return $this->get('descripcion');
	}	
	
	
}
	
?>
