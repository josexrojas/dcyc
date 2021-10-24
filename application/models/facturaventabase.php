<?php
// CLASE AUTOGENERADA - NO MODIFICAR - EXTENDER
abstract class Facturaventabase extends CI_Model {


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
		if (isset($data['letra_comprobante']))
			$this->set('letra_comprobante', $data['letra_comprobante']);
		if (isset($data['numero_comprobante']))
			$this->set('numero_comprobante', $data['numero_comprobante']);
		if (isset($data['cliente_id']))
			$this->set('cliente_id', $data['cliente_id']);
		if (isset($data['fecha_comprobante']))
			$this->set('fecha_comprobante', $data['fecha_comprobante']);
		if (isset($data['descripcion']))
			$this->set('descripcion', $data['descripcion']);
		if (isset($data['importe_neto']))
			$this->set('importe_neto', $data['importe_neto']);
		if (isset($data['importe_iva10']))
			$this->set('importe_iva10', $data['importe_iva10']);
		if (isset($data['importe_iva21']))
			$this->set('importe_iva21', $data['importe_iva21']);
		if (isset($data['importe_iva27']))
			$this->set('importe_iva27', $data['importe_iva27']);
		if (isset($data['importe_nograv']))
			$this->set('importe_nograv', $data['importe_nograv']);
		if (isset($data['importe_percepcion1']))
			$this->set('importe_percepcion1', $data['importe_percepcion1']);
		if (isset($data['importe_percepcion2']))
			$this->set('importe_percepcion2', $data['importe_percepcion2']);
		if (isset($data['importe_percepcion3']))
			$this->set('importe_percepcion3', $data['importe_percepcion3']);
		if (isset($data['importe_percepcion4']))
			$this->set('importe_percepcion4', $data['importe_percepcion4']);
		if (isset($data['estado_id']))
			$this->set('estado_id', $data['estado_id']);
		if (isset($data['estado']))
			$this->set('estado', $data['estado']);
	}
	
	/**
	 * Devuelve si el objeto es nuevo o no
	 * @access public
	 * @return void
	 */
	public function isNew() {
		$isNew = true;
		if (is_numeric($this->get('id'))) {
			$query = $this->db->get_where('facturas_ventas', array('id' => $this->get('id')));
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
			
			$sql = "SELECT t.* FROM facturas_ventas t";
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
				if (!$this->db->insert('facturas_ventas', $this->data))
					return false;
				$this->set('id', $this->db->insert_id());
				return true;
			} else {
				// update
				$this->db->where('id', $this->data['id']);
				return $this->db->update('facturas_ventas', $this->data);
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
				return $this->db->delete('facturas_ventas');
			}
			return true;
		} catch (Exception $ex) {
			return false;
		}
	}
}