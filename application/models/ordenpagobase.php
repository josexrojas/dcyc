<?php
// CLASE AUTOGENERADA - NO MODIFICAR - EXTENDER
abstract class Ordenpagobase extends CI_Model {


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
		if (isset($data['importe_neto']))
			$this->set('importe_neto', $data['importe_neto']);
		if (isset($data['importe_retencion1']))
			$this->set('importe_retencion1', $data['importe_retencion1']);
		if (isset($data['importe_retencion2']))
			$this->set('importe_retencion2', $data['importe_retencion2']);
		if (isset($data['importe_retencion3']))
			$this->set('importe_retencion3', $data['importe_retencion3']);
		if (isset($data['importe_retencion4']))
			$this->set('importe_retencion4', $data['importe_retencion4']);
		if (isset($data['alicuota1']))
			$this->set('alicuota1', $data['alicuota1']);
		if (isset($data['alicuota2']))
			$this->set('alicuota2', $data['alicuota2']);
		if (isset($data['alicuota3']))
			$this->set('alicuota3', $data['alicuota3']);
		if (isset($data['alicuota4']))
			$this->set('alicuota4', $data['alicuota4']);
		if (isset($data['fecha']))
			$this->set('fecha', $data['fecha']);
	}
	
	/**
	 * Devuelve si el objeto es nuevo o no
	 * @access public
	 * @return void
	 */
	public function isNew() {
		$isNew = true;
		if (is_numeric($this->get('id'))) {
			$query = $this->db->get_where('ordenes_pagos', array('id' => $this->get('id')));
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
			
			$sql = "SELECT t.* FROM ordenes_pagos t";
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
				if (!$this->db->insert('ordenes_pagos', $this->data))
					return false;
				$this->set('id', $this->db->insert_id());
				return true;
			} else {
				// update
				$this->db->where('id', $this->data['id']);
				return $this->db->update('ordenes_pagos', $this->data);
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
				return $this->db->delete('ordenes_pagos');
			}
			return true;
		} catch (Exception $ex) {
			return false;
		}
	}
}