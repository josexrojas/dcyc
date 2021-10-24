<?php
// CLASE AUTOGENERADA - NO MODIFICAR - EXTENDER
abstract class Empresabase extends CI_Model {


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
		if (isset($data['cuit']))
			$this->set('cuit', $data['cuit']);
		if (isset($data['iibb']))
			$this->set('iibb', $data['iibb']);
		if (isset($data['condicion_id']))
			$this->set('condicion_id', $data['condicion_id']);
		if (isset($data['razon_social']))
			$this->set('razon_social', $data['razon_social']);
		if (isset($data['nombre_fantasia']))
			$this->set('nombre_fantasia', $data['nombre_fantasia']);
		if (isset($data['pais_id']))
			$this->set('pais_id', $data['pais_id']);
		if (isset($data['provincia_id']))
			$this->set('provincia_id', $data['provincia_id']);
		if (isset($data['domicilio']))
			$this->set('domicilio', $data['domicilio']);
		if (isset($data['telefono']))
			$this->set('telefono', $data['telefono']);
		if (isset($data['email']))
			$this->set('email', $data['email']);
		if (isset($data['fecha_alta']))
			$this->set('fecha_alta', $data['fecha_alta']);
		if (isset($data['usuario_alta_id']))
			$this->set('usuario_alta_id', $data['usuario_alta_id']);
	}
	
	/**
	 * Devuelve si el objeto es nuevo o no
	 * @access public
	 * @return void
	 */
	public function isNew() {
		$isNew = true;
		if (is_numeric($this->get('id'))) {
			$query = $this->db->get_where('empresas', array('id' => $this->get('id')));
			if (count($query->result()) != 1) {
				unset($this->data['id']);
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
			
			$sql = "SELECT t.* FROM empresas t";
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
				if (!$this->db->insert('empresas', $this->data))
					return false;
				$this->set('id', $this->db->insert_id());
				return true;
			} else {
				// update
				$this->db->where('id', $this->data['id']);
				return $this->db->update('empresas', $this->data);
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
				return $this->db->delete('empresas');
			}
			return true;
		} catch (Exception $ex) {
			return false;
		}
	}
}