<?php

class Empresas extends LoginController
{
	public function __construct($params = array())
	{
		parent::__construct($params);
		$this->load->model('empresa');
		$this->load->model('pais');
		$this->load->model('provincia');
		$this->load->model('condicion');
		$this->load->library('dropdown');
		$this->load->library('form_validation');
	}

	public function index()
	{
		return $this->show();
	}
		
	public function show()
	{
		$data    		 	= array();
  		$data['empresas']	= $this->empresa->get_all();
  		$this->load_view('empresas_show',$data);	
	}

	public function edit($id)
	{
		$id = $this->uri->rsegment('$id', $id);
		
		if (!$this->empresa->load_by_id($id))
		{
			$this->show_message(LoginController::ERROR, 'No se pudo cargar ');
			return false;
		}
		
		if ($this->input->post('id') !== false)
		{
			$this->empresa->parse_from_post();
		}
		
		$data 					= array();
		$data['empresa'] 		= $this->empresa;
		$data['provincias']	 	= $this->provincia->get_all();
		$data['paises']		 	= $this->pais->get_all();
		$data['condiciones'] 	= $this->condicion->get_all();
		
		$this->load_view('empresas_edit', $data);
	}
	
	public function create()
	{
		$this->empresa->parse_from_post();
			
		$data 					= array();
		$data['empresa']	 	= $this->empresa;
		$data['provincias']	 	= $this->provincia->get_all();
		$data['paises']		 	= $this->pais->get_all();
		$data['condiciones'] 	= $this->condicion->get_all();
		
		$this->load_view('empresas_edit', $data);
	}
	
	public function save()
	{
		$id = $this->input->post('id');
		
		if ($id)
		{
			/* si está editando, verifica que exista */
			if (!$this->empresa->load_by_id($id))
			{
				$this->show_message(LoginController::ERROR, 'No se pudo guardar ');
	
				return $this->edit($id);
			}	
			
			/*if ($this->empresa->get('cuit') != $this->input->post('cuit'))
				$this->form_validation->set_rules('cuit', 'CUIT', 'required|is_unique[empresas.cuit]');
			else*/
				$this->form_validation->set_rules('cuit', 'CUIT', 'required');
		}
		else
			$this->form_validation->set_rules('cuit', 'CUIT', 'required');
		//$this->form_validation->set_rules('cuit', 'CUIT', 'required|is_unique[empresas.cuit]');
				
		/* reglas de validacion */
		$this->form_validation->set_rules('iibb', 'IIBB', 'required');
		$this->form_validation->set_rules('condicion_id', 'Condición IVA', 'required');
		$this->form_validation->set_rules('razon_social', 'Razón social', 'required');
		$this->form_validation->set_rules('nombre_fantasia', 'Nombre fantasía', 'required');
//		$this->form_validation->set_rules('pais_id', 'Pais', 'required');
//		$this->form_validation->set_rules('provincia_id', 'Provincia', 'required');
//		$this->form_validation->set_rules('domicilio', 'Domicilio', 'required');
		$this->form_validation->set_rules('telefono', 'Teléfono', 'required');
//		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');
		
		/* validamos */
		if (!$this->form_validation->run()) 
		{			
			$this->show_message(LoginController::ERROR, 'Error validación ');
			if ($id)
				return $this->edit($id);
			else
				return $this->create();
		}
		
		$this->empresa->parse_from_post();
		
		if (!$this->empresa->get('usuario_alta_id'))
		{
			$this->empresa->set('usuario_alta_id', $this->current_user->get('id'));
			$this->empresa->set('fecha_alta', date('Y-m-d H:i:s'));
		}
		
		/* guarda los cambios */
		if (!$this->empresa->save())
		{
			$this->show_message(LoginController::ERROR, 'No se pudo guardar ');

			if ($id)
				return $this->edit($id);
			else
				return $this->create();
		}
		
		$this->show_message(LoginController::SUCCESS, 'Guardado ');
	    
		$this->show();
	}
	
	public function delete($id)
	{
		try {
			$id = $this->uri->rsegment('id', $id);
			
			/* verifica que exista */
			if (!$this->empresa->load_by_id($id))
			{
				$this->show_message(LoginController::ERROR, 'No se pudo eliminar ');
	
				return  $this->show();
			}		
			
			/* elimina */
			if (!$this->empresa->delete())
			{
				$this->show_message(LoginController::ERROR, 'No se pudo eliminar ');
	
				return  $this->show();
			}
			
			$this->show_message(LoginController::SUCCESS, 'Eliminado');
		}
		catch (Exception $ex)
		{
			$this->show_message(LoginController::ERROR, $ex->getMessage());
		}
		
		$this->show();
	}
	

}