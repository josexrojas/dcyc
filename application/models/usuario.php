<?php
require_once(dirname(__FILE__)."/usuariobase.php");

class Perfil
{
	
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

	public function get_all()
	{
		$arr = array();

		$perfil = new Perfil();
		$perfil->set('id', '1');
		$perfil->set('descripcion', 'Administrador');
		$arr[] = $perfil;
		
		$perfil = new Perfil();
		$perfil->set('id', '2');
		$perfil->set('descripcion', 'Usuario');
		$arr[] = $perfil;
		
		return $arr;
	}

	/* retorna la clave para el combobox*/
	function get_key()
	{
		return $this->get('id');
	}
		
	/* retorna el valor para el combo box*/
	function get_value($lang = 'es')
	{
		return $this->get('descripcion');
	}
	
}



class Usuario extends Usuariobase
{
	
	public function parse_from_post()
	{
		$this->parse_from_array($_POST);
	}
	
	/**
	 * Devuelve el usuario actual que esta logeado en el sistema
	 * @access public
	 * @return mixed
	 */
	public function get_current_logged_in_user()
	{
		
		$arr = $this->session->all_userdata();

		if (!isset($arr['loggedUser']))
			return false;
		
		//print $this->session->sess_read('loggedUser');exit;
		
		$us = new Usuario();
		if (!$us->load_by_id($arr['loggedUser']))
			return false;
	
		return $us;
	}


	/**
	 * Carga el usuario obteniendolo por nombre de usuario
	 * @access public
	 * @param $username Nombre de usuario
	 * @return bool
	 */	
	public function load_by_login($username)
	{
		try {
			$query = $this->db->get_where('usuarios', array('username' => $username), 1);
			$data = $query->result();
			if (count($data) == 0)
				return false;

			$obj = $data[0];
			
			return $this->load_by_id($obj->id);
		}
		catch (Exception $ex) 
		{
			return false;
		}
	}




	/**
	 * Logea un usuario en el sistema
	 * @access public
	 * @param $username Nombre de usuario
	 * @param $password Clave
	 * @return bool
	 */	
	public function login($username, $password)
	{
		$this->session->unset_userdata('loggedUser');
		
		if ($username=='')
			return false;

		if (!$this->load_by_login($username))
			return false;
			
		if ($this->get('password') != md5($password))
			return false;
	
		$this->session->set_userdata('loggedUser',$this->get('id'));
	
		return true;
	}
		
	/**
	 * Logea un usuario en el sistema (md5)
	 * @access public
	 * @param $username Nombre de usuario
	 * @param $password Clave
	 * @return bool
	 */	
	public function login_md5($username, $md5password)
	{
		$this->session->unset_userdata('loggedUser');
		
		if ($username=='')
			return false;

		if (!$this->load_by_login($username))
			return false;
	
		if ($this->get('password') != $md5password)
			return false;
	
		$this->session->set_userdata('loggedUser',$this->get('id'));
	
		return true;
	}
		



	/**
	 * Deslogea un usuario del sistema
	 * @access public
	 * @return void
	 */	
	public function logout() 
	{
		$this->session->sess_destroy();
	}
	
	
	/**
	 * Carga array de usuarios
	 * @access public
	 * @return array
	 */	
	public function get_all($filter = array()) {
		try 
		{
			$sql = "SELECT t.* FROM usuarios t ";
			$arr = array();
			$query = $this->db->query($sql);
			

			 foreach ($query->result_array() as $oRow)
   			{
				$usuario = new usuario();
				
				$usuario->parse_from_array($oRow);
				
			    array_push($arr, $usuario);
			
			}
				
			return $arr;
		}
		catch (Exception $ex) 
		{
			return false;
		}
	}	
	
	
	/* retorna la clave para el combobox*/
	function get_key()
	{
		return $this->get('id');
	}
			
	/* retorna el valor para el combo box*/
	function get_value($lang = 'es')
	{
		return $this->get('username');
	}	
	
	public function has_access($controller, $method = false)
	{
		return true;
	}

	public function get_perfil()
	{
		if ($this->get('perfil') == 1)
		 {
		 	$perfil = new Perfil();
		 	$perfil->set('id', '1');
		 	$perfil->set('descripcion', 'Administrador');
		 	return $perfil;
		 }
		 	
		 if ($this->get('perfil') == 2)
		 {
		 	$perfil = new Perfil();
		 	$perfil->set('id', '2');
		 	$perfil->set('descripcion', 'Usuario');
		 	return $perfil;
		 }	
		 
		 return false;
	}
}
	
?>
 