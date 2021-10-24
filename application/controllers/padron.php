<?php
class Padron extends LoginController
{
	public function __construct($params = array())
	{
		parent::__construct($params);
		$this->load->model('padronarba');
		$this->load->model('configuracion');
		$this->load->library('dropdown');
		$this->load->library('form_validation');
	}

	public function index()
	{
		return $this->upload();
	}

	public function upload()
	{
		if (!$this->configuracion->load_by_id(1))
		{
			$this->show_message(LoginController::ERROR, 'Empresa aún no configurada');
		}
		
		if (time() - $this->configuracion->get('last_activity_padron_arba') > 100)
		{
			$progress = 0;
			$in_progress = false;
		}
		else
		{ 
			$progress = ($this->configuracion->get('per_curpos_padron_arba') + $this->configuracion->get('ret_curpos_padron_arba')) / ($this->configuracion->get('per_filesize_padron_arba') + $this->configuracion->get('ret_filesize_padron_arba')) * 100;
			$in_progress = true;
			$this->show_message(LoginController::SUCCESS, 'Actualmente está procesando un archivo de importación. Recuerde que este proceso puede demorar un tiempo prolongado.');
		}
		
		$data    		 		= array();
		$data['progress']		= $progress;
		$data['in_progress']	= $in_progress;
		$this->load_view('padron_upload', $data);
	}

	public function do_upload()
	{
		if (!$this->configuracion->load_by_id(1))
		{
			$this->show_message(LoginController::ERROR, 'Empresa aún no configurada');
			return $this->upload();
		}
				
		if(!isset($_FILES['file']) || $_FILES['file']['error'] != 0)
		{
			$this->show_message(LoginController::ERROR, 'Debe seleccionar un archivo..');
			return $this->upload();
		}

		/* upload files from post*/
		$this->load->library('upload');
		
		
		/*configuro archivo para uploads*/
		$config 					= array();
		$config['upload_path'] 		= 'upload/';
		$config['allowed_types'] 	= 'zip';
		$config['encrypt_name'] 	= TRUE;
		$config['ignoremime']	 	= TRUE;
		
		$this->upload->initialize($config);
				
		/* obtengo la info del archivo subido */
		if (!$this->upload->do_upload('file'))
		{
			$this->show_message(LoginController::ERROR, 'No se pudo subir el archivo');
			return $this->upload();
		}
				
		$filedata 			   = $this->upload->data();

		if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
			putenv("FILE=".$filedata['full_path']);
			pclose(popen('start "" c:\wamp\bin\php\php5.5.12\php.exe -q process_padronarba.php', "r"));
		} else {
			putenv("SHELL=/bin/bash");
			putenv("FILE=".$filedata['full_path']);
			print `echo /usr/bin/php -q process_padronarba.php | at now 2>&1`;
		}
		
		$this->show_message(LoginController::SUCCESS, 'El padrón ha comenzado a actualizarse');
		
		$data    		 	= array();
		$data['progress']		= 0;
		$data['in_progress']	= true;
		$this->load_view('padron_upload', $data);
	}
	
	 

}