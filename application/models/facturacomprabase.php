<?php
// CLASE AUTOGENERADA - NO MODIFICAR - EXTENDER
abstract class Facturacomprabase extends CI_Model {


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
		if (isset($data['tipo_facturacion']))
			$this->set('tipo_facturacion', $data['tipo_facturacion']);
		if (isset($data['numero_comprobante']))
			$this->set('numero_comprobante', $data['numero_comprobante']);
		if (isset($data['proveedor_id']))
			$this->set('proveedor_id', $data['proveedor_id']);
		if (isset($data['fecha_comprobante']))
			$this->set('fecha_comprobante', $data['fecha_comprobante']);
		if (isset($data['descripcion']))
			$this->set('descripcion', $data['descripcion']);
		if (isset($data['importe_neto']))
			$this->set('importe_neto', $data['importe_neto']);
		if (isset($data['importe_pagado']))
			$this->set('importe_pagado', $data['importe_pagado']);
		if (isset($data['certificado_retencion']))
			$this->set('certificado_retencion', $data['certificado_retencion']);
	}
	
	/**
	 * Devuelve si el objeto es nuevo o no
	 * @access public
	 * @return void
	 */
	public function isNew() {
		$isNew = true;
		if (is_numeric($this->get('id'))) {
			$query = $this->db->get_where('facturas_compras', array('id' => $this->get('id')));
			if (count($query->result()) != 1) {
				unset($this->data['id']);
				return true;
			}
			$isNew = false;
		} else {
			unset($this->data['id']);
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
			
			$sql = "SELECT t.* FROM facturas_compras t";
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
				if (!$this->db->insert('facturas_compras', $this->data))
					return false;
				$this->set('id', $this->db->insert_id());
				return true;
			} else {
				// update
				$this->db->where('id', $this->data['id']);
				return $this->db->update('facturas_compras', $this->data);
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
				return $this->db->delete('facturas_compras');
			}
			return true;
		} catch (Exception $ex) {
			return false;
		}
	}
}