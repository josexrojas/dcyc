<?php
require_once(dirname(__FILE__)."/paisbase.php");
	
class Pais extends Paisbase
{
	public function parse_from_post()
	{
		$this->parse_from_array($_POST);
	}
	
	public function get_all($filter = array()) {
		try 
		{
			$sql = "SELECT t.* FROM paises t ";
			$sql.= " ORDER BY t.descripcion ASC";
			$arr = array();
			$query = $this->db->query($sql);
		
			 foreach ($query->result_array() as $oRow)
   			{
				$region = new Pais();
				
				$region->parse_from_array($oRow);
				
			    array_push($arr, $region);
			
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
		return $this->get('descripcion');
	}	
	
	
}
	
?>
