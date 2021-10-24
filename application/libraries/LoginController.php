<?php
//require(dirname(__FILE__).'/../models/usuario.php');

class LoginController extends BaseController {
	
	public $current_user;
	
	public function __construct() {
		parent::__construct();
		$this->load->model('usuario');
			
		$this->current_user = $this->usuario->get_current_logged_in_user();

		if ($this->current_user === false) {
			header('Location: ' . site_url('login'));
			exit;
		}
		
		/* verifica que el usuario actual tenga acceso a esa acción */
		if ($this->current_user->has_access($this->router->fetch_class(), $this->router->fetch_method()))
			return true;
		
		/* */
		show_error('Acceso no autorizado', 401, 'Acceso no autorizado');
	}
	
	
	

}

