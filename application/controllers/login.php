<?php
class Login extends BaseController
{
	public function __construct($params = array())
	{
		parent::__construct($params);
		$this->load->database();
		$this->load->model('usuario');	
		$this->load->helper('cookie');
		
	}

	public function index()
	{
		return $this->show_login();
	}
	
	
	public function show_login()
	{
		
		if (get_cookie("UserName") && get_cookie("Password") && $this->user->login_md5(get_cookie("UserName"),get_cookie("Password")))
		{
			redirect('/');	
			return;
		}

		$this->load->view('login');
	}
		

	public function loginuser()
	{ 
		if (!$this->usuario->login($this->input->post('user'),$this->input->post('password')))
		{
			$this->show_message(BaseController::ERROR, 'usuario y/o contraseña incorrecta');
			$this->load->view('login');
			return;
		}
		
		if($this->input->post('Remember-me'))
		{
			set_cookie("UserName", $this->input->post('user'), 60*60*24*30);
			set_cookie("Password", md5($this->input->post('password')), 60*60*24*30);
		}
		
		redirect('/home');
	}

	public function logout() 
	{
		$this->usuario->logout();
		delete_cookie('UserName');
		delete_cookie('Password');
		redirect('/login');	
	}
		
}