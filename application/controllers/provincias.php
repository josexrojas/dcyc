<?php

class Provincias extends LoginController
{
	public function __construct($params = array())
	{
		parent::__construct($params);
		$this->load->model('provincia');
		$this->load->model('pais');
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
  		$data['provincias']	= $this->provincia->get_all();
  		$this->load_view('provincias_show',$data);	
	}

	public function edit($id)
	{
		$id = $this->uri->rsegment('$id', $id);
		
		if (!$this->provincia->load_by_id($id))
		{
			$this->show_message(LoginController::ERROR, 'No se pudo cargar ');
			return false;
		}
		
		if ($this->input->post('id') !== false)
		{
			$this->provincia->parse_from_post();
		}
		
		$data 					= array();
		$data['provincia'] 		= $this->provincia;
		$data['paises']			= $this->pais->get_all();
		
		$this->load_view('provincias_edit', $data);
	}
	
	public function create()
	{
		$this->provincia->parse_from_post();
			
		$data 					= array();
		$data['provincia'] 		= $this->provincia;
		$data['paises']			= $this->pais->get_all();
				
		$this->load_view('provincias_edit', $data);
	}
	
	public function save()
	{
		$id = $this->input->post('id');
		
		if ($id)
		{
			/* si está editando, verifica que exista */
			if (!$this->provincia->load_by_id($id))
			{
				$this->show_message(LoginController::ERROR, 'No se pudo guardar ');
	
				return $this->edit($id);
			}	
		}
		
		/* reglas de validacion */
		$this->form_validation->set_rules('descripcion', 'Nombre', 'required');
		$this->form_validation->set_rules('pais_id', 'País', 'required');
		
		/* validamos */
		if (!$this->form_validation->run()) 
		{
			$this->show_message(LoginController::ERROR, 'Error validación ');
			if ($id)
				return $this->edit($id);
			else
				return $this->create();
		}
		
		$this->provincia->parse_from_post();
		
		/* guarda los cambios */
		if (!$this->provincia->save())
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
			if (!$this->provincia->load_by_id($id))
			{
				$this->show_message(LoginController::ERROR, 'No se pudo eliminar ');
	
				return  $this->show();
			}		
			
			/* elimina */
			if (!$this->provincia->delete())
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