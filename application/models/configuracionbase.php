<?php
// CLASE AUTOGENERADA - NO MODIFICAR - EXTENDER
abstract class Configuracionbase extends CI_Model {


	// Datos del modelo
	public $data = array();
    
	/**
	 * Obtiene datos del modelo
	 * @access public
	 * @param $name Nombre de la propiedad
	 * @return mixed
	 */		
	public function get($name) {
		if (!isset($this->data[$name]))
			return '';
		return $this->data[$name];
	}

	/**
	 * Cambia datos del modelo
	 * @access public
	 * @param $name Nombre de la propiedad
	 * @param $value Valor de la propiedad
	 * @return void
	 */
	public function set($name, $value) {
		$this->data[$name] = $value;
        return true;
	}

	/**
	 * Llena el objeto con los datos ingresados en el array
	 * @access public
	 * @param $data Array de datos a llenar
	 * @return void
	 */
	public function parse_from_array($data)
	{
		if (isset($data['id']))
			$this->set('id', $data['id']);
		if (isset($data['razon_social']))
			$this->set('razon_social', $data['razon_social']);
		if (isset($data['cuit']))
			$this->set('cuit', $data['cuit']);
		if (isset($data['iibb']))
			$this->set('iibb', $data['iibb']);
		if (isset($data['ultimo_padron_arba']))
			$this->set('ultimo_padron_arba', $data['ultimo_padron_arba']);
		if (isset($data['per_filesize_padron_arba']))
			$this->set('per_filesize_padron_arba', $data['per_filesize_padron_arba']);
		if (isset($data['per_curpos_padron_arba']))
			$this->set('per_curpos_padron_arba', $data['per_curpos_padron_arba']);
		if (isset($data['ret_filesize_padron_arba']))
			$this->set('ret_filesize_padron_arba', $data['ret_filesize_padron_arba']);
		if (isset($data['ret_curpos_padron_arba']))
			$this->set('ret_curpos_padron_arba', $data['ret_curpos_padron_arba']);
		if (isset($data['last_activity_padron_arba']))
			$this->set('last_activity_padron_arba', $data['last_activity_padron_arba']);
	}
	
	/**
	 * Devuelve si el objeto es nuevo o no
	 * @access public
	 * @return void
	 */
	public function isNew() {
		$isNew = true;
		if (is_numeric($this->get('id'))) {
			$query = $this->db->get_where('configuracion', array('id' => $this->get('id')));
			if (count($query->result()) != 1) {
				//unset($this->data['id']);
				return true;
			}
			$isNew = false;
		}
		return $isNew;
	}


	
	

	/**
	 * Carga el objeto por clave primaria
	 * @access public
	 * @param $id Clave primaria
	 * @return bool
	 */	
	public function load_by_id($id) {
		try {
			
			$sql = "SELECT t.* FROM configuracion t";
			$sql.= "  WHERE t.id = ?";
			
			
			$query = $this->db->query($sql, array($id));
			
			$data = $query->result();
			
			
			if (count($data) != 1)
				return false;
			$obj = $data[0];
			
			if (!$obj || $obj->id != $id)
				return false;
			foreach($obj as $key=>$val) {
				$this->data[$key] = $val;
			}
			return true;
		}
		catch (Exception $ex) 
		{
			return false;
		}
	}
	/**
	 * Graba los datos en la base de datos
	 * @access public
	 * @return bool
	 */		
	public function save()
	{
		try {
			if ($this->isNew()) {
				// insert
				if (!$this->db->insert('configuracion', $this->data))
					return false;
				$this->set('id', $this->db->insert_id());
				return true;
			} else {
				// update
				$this->db->where('id', $this->data['id']);
				return $this->db->update('configuracion', $this->data);
			exit;
			}
			return true;
		} catch (Exception $ex) {
			return false;
		}		
		
	}

	/**
	 * Borra los datos en la base de datos
	 * @access public
	 * @return bool
	 */		
	public function delete()
	{
		try {
			if (!$this->isNew()) {
				// delete
				$this->db->where('id', $this->data['id']);
				return $this->db->delete('configuracion');
			}
			return true;
		} catch (Exception $ex) {
			return false;
		}
	}
}