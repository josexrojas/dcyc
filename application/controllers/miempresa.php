<?php

class MiEmpresa extends LoginController
{
	public function __construct($params = array())
	{
		parent::__construct($params);
		$this->load->model('configuracion');
		$this->load->library('form_validation');
	}

	public function index()
	{
		return $this->edit();
	}
		
	public function edit()
	{
		$id = 1;
		
		$this->configuracion->load_by_id($id);
		
		if ($this->input->post('id') !== false)
		{
			$this->configuracion->parse_from_post();
		}
		
		$this->configuracion->set('id', 1);
		$data 					= array();
		$data['configuracion'] 	= $this->configuracion;
		
		$this->load_view('miempresa_show', $data);
	}
	
	public function save()
	{
		$id = 1;
		
		$this->configuracion->load_by_id($id);
		
		/* reglas de validacion */
		$this->form_validation->set_rules('razon_social', 'Razón Social', 'required');
		$this->form_validation->set_rules('cuit', 'CUIT', 'required');
		$this->form_validation->set_rules('iibb', 'IIBB', 'required');
		
		/* validamos */
		if (!$this->form_validation->run()) 
		{
			$this->show_message(LoginController::ERROR, 'Error validación ');
			return $this->edit();
		}
		
		$this->configuracion->parse_from_post();
		$this->configuracion->set('id', 1);
		
		/* guarda los cambios */
		if (!$this->configuracion->save())
		{
			$this->show_message(LoginController::ERROR, 'No se pudo guardar ');
			return $this->edit();
		}
		
		$this->show_message(LoginController::SUCCESS, 'Guardado ');
		$this->index();
	}
	
	
	

}