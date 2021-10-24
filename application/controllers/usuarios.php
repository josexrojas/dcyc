<?php

class Usuarios extends LoginController
{
	public function __construct($params = array())
	{
		parent::__construct($params);
		$this->load->model('usuario');
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
		$data['usuarios']	= $this->usuario->get_all();
		$this->load_view('usuarios_show',$data);	
	}

	public function edit($id)
	{
		$id = $this->uri->rsegment('$id', $id);
		$perfil = new Perfil();
		
		if (!$this->usuario->load_by_id($id))
		{
			$this->show_message(LoginController::ERROR, 'No se pudo cargar ');
			return false;
		}
		
		if ($this->input->post('id') !== false)
		{
			$this->usuario->parse_from_post();
		}
		
		$data 					= array();
		$data['usuario'] 		= $this->usuario;
		$data['perfiles']		= $perfil->get_all();
		
		$this->load_view('usuarios_edit', $data);
	}
	
	public function create()
	{
		$perfil = new Perfil();
		$this->usuario->parse_from_post();
			
		$data 					= array();
		$data['usuario']	 	= $this->usuario;
		$data['perfiles']		= $perfil->get_all();
		
		$this->load_view('usuarios_edit', $data);
	}
	
	public function save()
	{
		$id = $this->input->post('id');
		
		if ($id)
		{
			/* si está editando, verifica que exista */
			if (!$this->usuario->load_by_id($id))
			{
				$this->show_message(LoginController::ERROR, 'No se pudo guardar ');
	
				return $this->edit($id);
			}	
		}
		
		/* reglas de validacion */
		$this->form_validation->set_rules('username', 'Nombre de usuario', 'required');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('perfil', 'Perfil', 'required'); 
		$this->form_validation->set_rules('password1', 'Contraseña', 'matches[password2]');
		$this->form_validation->set_rules('password2', 'Repita contraseña', '');
		
		/* validamos */
		if (!$this->form_validation->run()) 
		{
			$this->show_message(LoginController::ERROR, 'Error validación ');
			if ($id)
				return $this->edit($id);
			else
				return $this->create();
		}
		
		$this->usuario->parse_from_post();
		if ($this->input->post('password1') != '')
			$this->usuario->set('password', md5($this->input->post('password1')));
		
		/* guarda los cambios */
		if (!$this->usuario->save())
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
			if (!$this->usuario->load_by_id($id))
			{
				$this->show_message(LoginController::ERROR, 'No se pudo eliminar ');
	
				return  $this->show();
			}		
			
			/* elimina */
			if (!$this->usuario->delete())
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