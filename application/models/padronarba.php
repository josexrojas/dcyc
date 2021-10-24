<?php
require_once(dirname(__FILE__)."/padronarbabase.php");
	
class Padronarba extends Padronarbabase
{
	public function parse_from_post()
	{
		$this->parse_from_array($_POST);
	}

	public function load_last_by_cuit($cuit)
	{
			$sql = "SELECT t.* FROM padron_arba t ";
			$sql.= " WHERE t.cuit = ?";
			$sql.= " ORDER BY t.fecha DESC";
			$query = $this->db->query($sql, array($cuit));
	
			$data = $query->result_array();
			if (!$data || !isset($data[0]))
				return false;
			
			$this->parse_from_array($data[0]);
			return true;
	}

	public function load_by_cuit_and_date($cuit, $date) {
		try
		{
			$sql = "SELECT t.* FROM padron_arba t ";
			$sql.= " WHERE t.cuit = ?";
			$sql.= " AND t.fecha = ?";
			$sql.= " ORDER BY t.fecha DESC";
			$arr = array();
			$query = $this->db->query($sql, array($cuit, $date));
	
			foreach ($query->result_array() as $oRow)
			{
				$this->parse_from_array($oRow);
	
				return true;
			}
			return false;
		}
		catch (Exception $ex)
		{
			return false;
		}
	}
	
	public function get_all($filter = array()) {
		try
		{
			$sql = "SELECT t.* FROM padron_arba t ";
			$sql.= " ORDER BY t.cuit ASC";
			$arr = array();
			$query = $this->db->query($sql);
	
			foreach ($query->result_array() as $oRow)
			{
				$o = new Padronarba();
	
				$o->parse_from_array($oRow);
	
				array_push($arr, $o);
					
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
		return $this->get('cuit');
	}	
	
	
}
	
?>
