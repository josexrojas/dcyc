<?php

class Ventas extends LoginController
{
	public function __construct($params = array())
	{
		parent::__construct($params);
		$this->load->model('empresa');
		$this->load->model('facturaventa');
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
  		$data['ventas']		= $this->facturaventa->get_all();
  		$this->load_view('ventas_show',$data);	
	}

	public function edit($id)
	{
		$id = $this->uri->rsegment('$id', $id);
		
		if (!$this->facturaventa->load_by_id($id))
		{
			$this->show_message(LoginController::ERROR, 'No se pudo cargar ');
			return false;
		}
		
		if ($this->input->post('id') !== false)
		{
			$this->facturaventa->parse_from_post();
		}
		
		$data 					= array();
		$data['venta'] 			= $this->facturaventa;
		$data['clientes']		= $this->empresa->get_all();
				
		$this->load_view('ventas_edit', $data);
	}
	
	public function create()
	{
		$this->facturaventa->parse_from_post();
		$this->load->model('configuracion');
		
		if (!$this->configuracion->load_by_id(1))
		{
			$this->show_message(LoginController::ERROR, 'Aún no está configurada la empresa');
			return $this->show();
		}
		
		if (substr($this->configuracion->get('ultimo_padron_arba'), 0, 7) != date('Y-m'))
		{
			$this->show_message(LoginController::ERROR, 'No ha cargado la última versión del padrón de ARBA');
			return $this->show();
		}
					
		$data 					= array();
		$data['venta']	 		= $this->facturaventa;
		$data['clientes']		= $this->empresa->get_all();
		
		$this->load_view('ventas_edit', $data);
	}
	
	public function save()
	{
		$id = $this->input->post('id');
		
		if ($id)
		{
			/* si está editando, verifica que exista */
			if (!$this->facturaventa->load_by_id($id))
			{
				$this->show_message(LoginController::ERROR, 'No se pudo guardar ');
	
				return $this->edit($id);
			}	
		}
		
		/* reglas de validacion */
		$this->form_validation->set_rules('fecha_comprobante', 'Fecha', 'required');
		$this->form_validation->set_rules('letra_comprobante', 'Tipo de Comprobante', 'required');
		$this->form_validation->set_rules('numero_comprobante', 'Nº Comprobante', 'required');
		$this->form_validation->set_rules('cliente_id', 'Cliente', 'required');
		$this->form_validation->set_rules('importe_neto', 'Importe Neto', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'required');
		$this->form_validation->set_rules('estado_id', 'Estado', 'required');
		
		/* validamos */
		if (!$this->form_validation->run()) 
		{
			$this->show_message(LoginController::ERROR, 'Error validación ');
			if ($id)
				return $this->edit($id);
			else
				return $this->create();
		}
		
		$this->facturaventa->parse_from_post();

		$this->facturaventa->calcular_percepciones();
		
		/* guarda los cambios */
		if (!$this->facturaventa->save())
		{
			$this->show_message(LoginController::ERROR, 'No se pudo guardar ');

			if ($id)
				return $this->edit($id);
			else
				return $this->create();
		}
		
		$this->show_message(LoginController::SUCCESS, 'Guardado ');
		
		if ($id)
			return $this->edit($id);

		return  $this->show();
	}

	public function delete($id)
	{
		try {
			$id = $this->uri->rsegment('id', $id);
				
			/* verifica que exista */
			if (!$this->facturaventa->load_by_id($id))
			{
				$this->show_message(LoginController::ERROR, 'No se pudo eliminar ');
	
				return  $this->show();
			}
				
			/* elimina */
			if (!$this->facturaventa->delete())
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


	public function ver_percepciones_arba()
	{
		$anio = $this->input->post('anio');
		$mes = $this->input->post('mes');
		if (!$mes || !$anio)
		{
			$anio = date('Y');
			$mes = date('m');
		}
		
		$data					= array();
		$data['anio']			= $anio;
		$data['mes']			= $mes;
		$data['percepciones']	= $this->facturaventa->get_all(array('solo_percepcion1' => true, 'anio' => $anio, 'mes' => $mes));
	
		$this->load_view('ventas_percepciones', $data);
	}


	public function percepciones_arba()
	{
		$this->load_view('percepciones_arba');
	}


	public function download_percepciones_arba()
	{
		$this->load->model('configuracion');
		
		if (!$this->configuracion->load_by_id(1))
		{
			$this->show_message(LoginController::ERROR, 'Aún no está configurada la empresa');
			return $this->show();
		}
		
		$anio = $this->input->post('anio');
		$mes = $this->input->post('mes');
		if (!$mes || !$anio)
		{
			$this->show_message(LoginController::ERROR, 'Debe ingresar Mes y Año');
			return $this->show();
		}
		
		Header('Content-Type: text/plain; charset=UTF8');
		Header('Content-Disposition: attachment;filename="AR-'.$this->configuracion->get('cuit')."-".$anio.$mes."0-7-LOTE1.txt");
		
		$percepciones = $this->facturaventa->get_all(array('solo_percepcion1' => true, 'anio' => $anio, 'mes' => $mes));
	
		ob_clean();
	
	
		foreach ($percepciones as $percepcion)
		{
			$cuit = $percepcion->get_cliente() != null ? $percepcion->get_cliente()->get('cuit') : '00000000000';
			echo substr($cuit, 0, 2)."-".substr($cuit, 2, 8)."-".substr($cuit, 10, 1);
			echo substr($percepcion->get('fecha_comprobante'), 8, 2)."-".substr($percepcion->get('fecha_comprobante'), 5, 2)."-".substr($percepcion->get('fecha_comprobante'), 0, 4);
			echo str_pad($percepcion->get('letra_comprobante'), 2, 'F', STR_PAD_LEFT);
			echo str_pad(str_replace("-", "", $percepcion->get('numero_comprobante')), 11, 'F', STR_PAD_LEFT);
			//echo str_pad($percepcion->get('id'), 12, '0', STR_PAD_LEFT);
			
			echo str_pad(str_replace(".", ",", $percepcion->get('importe_neto')), 12, '0', STR_PAD_LEFT);
			echo str_pad(number_format($percepcion->get('importe_percepcion1'), 2, ',', ''), 11, '0', STR_PAD_LEFT);
			echo "A";
			echo "\r\n";
		}
		
		exit;
	}
	
	
}