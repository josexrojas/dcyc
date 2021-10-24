<?php

class Compras extends LoginController
{
	public function __construct($params = array())
	{
		parent::__construct($params);
		$this->load->model('empresa');
		$this->load->model('facturacompra');
		$this->load->library('dropdown');
		$this->load->library('form_validation');
	}

	public function index()
	{
		return $this->show();
	}
		
	public function show()
	{
		$filter				= array();
		if ($this->input->get('empresa_id'))
			$filter['empresa_id']	= $this->input->get('empresa_id');
		
		$data    		 	= array();
		$data['compras']	= $this->facturacompra->get_all($filter);
  		$this->load_view('compras_show', $data);	
	}

	public function edit($id)
	{
		$id = $this->uri->rsegment('$id', $id);
	
		if (!$this->facturacompra->load_by_id($id))
		{
			$this->show_message(LoginController::ERROR, 'No se pudo cargar ');
			return false;
		}
	
		if ($this->input->post('id') !== false)
		{
			$this->facturacompra->parse_from_post();
		}
	
		$data 					= array();
		$data['compra'] 		= $this->facturacompra;
		$data['proveedores']	= $this->empresa->get_all();
	
		$this->load_view('compras_edit', $data);
	}


	public function view($id)
	{
		$id = $this->uri->rsegment('$id', $id);
	
		if (!$this->facturacompra->load_by_id($id))
		{
			$this->show_message(LoginController::ERROR, 'No se pudo cargar ');
			return false;
		}
	
		if ($this->input->post('id') !== false)
		{
			$this->facturacompra->parse_from_post();
		}
	
		$data 					= array();
		$data['compra'] 		= $this->facturacompra;

		$this->load_view('compras_view', $data);
	}
	
	
	public function retencion_factura($id)
	{
		$this->load->model('ordenpago');
		$this->load->model('configuracion');
	
		$id = $this->uri->rsegment('$id', $id);
	
		if (!$this->facturacompra->load_by_id($id))
		{
			$this->show_message(LoginController::ERROR, 'No se pudo cargar ');
			return $this->show();
		}
	
		if (!$this->configuracion->load_by_id(1))
		{
			$this->show_message(LoginController::ERROR, 'Aún no está configurada la empresa');
			return $this->show();
		}

		//Hacer un metodo en el modelo facturacompra que se llame get_all_by_proveedor_month(id de proveedor)
		//Llamar al metodo e imprimir el resultado.
		print_r($this->facturacompra->get_all_by_proveedor_month(22));
		

		$data = array();
		$data['miempresa']		= $this->configuracion;
		$data['ordenespagos']	= $this->ordenpago->get_all(array('factura_id' => $id));
		
		$this->load_view_as_pdf('compras_retencion', $data);
	}

	public function retencion($id)
	{
		$this->load->model('ordenpago');
		$this->load->model('configuracion');
		$this->load->library('html2fpdf');
	
		$id = $this->uri->rsegment('$id', $id);
	
		if (!$this->ordenpago->load_by_id($id))
		{
			$this->show_message(LoginController::ERROR, 'No se pudo cargar ');
			return $this->show();
		}
	
		if (!$this->configuracion->load_by_id(1))
		{
			$this->show_message(LoginController::ERROR, 'Aún no está configurada la empresa');
			return $this->show();
		}
	
		Header('Content-Type: text/html; charset=UTF8');
	
		$data = array();
		$data['miempresa']		= $this->configuracion;
		$data['ordenpago']		= $this->ordenpago;
	
		$this->load_view_as_pdf('_compras_retencion', $data);
	}
	
	public function create()
	{
		$this->facturacompra->parse_from_post();
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
		
		if (!$this->facturacompra->get('proveedor_id') && $this->input->get('empresa_id'))
			$this->facturacompra->set('proveedor_id', $this->input->get('empresa_id'));
		
		$data 					= array();
		$data['compra']	 		= $this->facturacompra;
		$data['proveedores']	= $this->empresa->get_all();
		
		$this->load_view('compras_edit', $data);
	}
	
	public function save()
	{
		$id = $this->input->post('id');
		
		if ($id)
		{
			/* si está editando, verifica que exista */
			if (!$this->facturacompra->load_by_id($id))
			{
				$this->show_message(LoginController::ERROR, 'No se pudo guardar ');
	
				return $this->edit($id);
			}	
		}
		
		/* reglas de validacion */
		$this->form_validation->set_rules('fecha_comprobante', 'Fecha', 'required');
		$this->form_validation->set_rules('letra_comprobante', 'Tipo de Comprobante', 'required');
		$this->form_validation->set_rules('numero_comprobante', 'Nº Comprobante', 'required');
		$this->form_validation->set_rules('proveedor_id', 'Proveedor', 'required');
		$this->form_validation->set_rules('importe_neto', 'Importe Neto', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'required');
		
		/* validamos */
		if (!$this->form_validation->run()) 
		{
			$this->show_message(LoginController::ERROR, 'Error validación ');
			if ($id)
				return $this->edit($id);
			else
				return $this->create();
		}
		
		$this->facturacompra->parse_from_post();

		/* guarda los cambios */
		if (!$this->facturacompra->save())
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
			if (!$this->facturacompra->load_by_id($id))
			{
				$this->show_message(LoginController::ERROR, 'No se pudo eliminar ');
	
				return  $this->show();
			}
				
			/* elimina */
			if (!$this->facturacompra->delete())
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


	public function show_pagar()
	{
		$this->load->model('ordenpago');
	
		if (!is_array($this->input->post('id')))
		{
			$this->show_message(LoginController::ERROR, 'Debe seleccionar al menos una factura');
			return  $this->show();
		}

		$importe = 0;
		foreach ($this->input->post('id') as $id)
		{
			$factura = new Facturacompra();
			if (!$factura->load_by_id($id))
			{
				$this->show_message(LoginController::ERROR, 'No existe la factura seleccionada');
				return  $this->show();
			}
	
			if (!$this->ordenpago->add_factura($factura))
			{
				$this->show_message(LoginController::ERROR, 'Todas las facturas deben pertenecer al mismo proveedor y no estar saldadas');
				return  $this->show();
			}
			
			$importe += $factura->get_saldo();
		}
	
		$this->ordenpago->calcular_retenciones($this->input->post('importe_pagado') ? $this->input->post('importe_pagado') : $importe);
	
		$data = array();
		$data['ordenpago']	= $this->ordenpago;
	
		$this->load_view('compras_pagar',$data);
	}


	public function pagar()
	{
		$this->load->model('ordenpago');

		if (!is_array($this->input->post('id')))
		{
			$this->show_message(LoginController::ERROR, 'Debe seleccionar al menos una factura');
			return  $this->show();
		}
		
		$importe = 0;
		foreach ($this->input->post('id') as $id)
		{
			$factura = new Facturacompra();
			if (!$factura->load_by_id($id))
			{
				$this->show_message(LoginController::ERROR, 'No existe la factura seleccionada');
				return  $this->show();
			}
	
			if (!$this->ordenpago->add_factura($factura))
			{
				$this->show_message(LoginController::ERROR, 'Todas las facturas deben pertenecer al mismo proveedor y no estar saldadas');
				return  $this->show();
			}
			
			$importe += $factura->get_saldo();
		}
	
		$this->ordenpago->calcular_retenciones($this->input->post('importe_pagado') ? $this->input->post('importe_pagado') : $importe);
		$this->ordenpago->set('fecha', date('Y-m-d'));
		$this->ordenpago->save();
		
		$this->show_message(LoginController::SUCCESS, 'Órden de pago generada satisfactoriamente');
		unset($_POST['id']);
		$this->show();
	}
	

	public function ver_retenciones_arba()
	{
		$this->load->model('ordenpago');
	
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
		$data['retenciones']	= $this->ordenpago->get_all(array('solo_retencion1' => true, 'anio' => $anio, 'mes' => $mes));
	
		$this->load_view('compras_retenciones', $data);
	}

	
	public function retenciones_arba()
	{
		$this->load_view('retenciones_arba');
	}
	
	
	public function download_retenciones_arba()
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
		
		$this->load->model('ordenpago');

		Header('Content-Type: text/plain; charset=UTF8');
		Header('Content-Disposition: attachment;filename="AR-'.$this->configuracion->get('cuit')."-".$anio.$mes."0-D1-LOTE1.txt");
				
		$retenciones = $this->ordenpago->get_all(array('solo_retencion1' => true, 'anio' => $anio, 'mes' => $mes));
		
		ob_clean();
		
		foreach ($retenciones as $retencion)
		{
			foreach ($retencion->get_facturas() as $factura)
			{
				$cuit = $retencion->get_proveedor() != null ? $retencion->get_proveedor()->get('cuit') : '00000000000';
				echo substr($cuit, 0, 2)."-".substr($cuit, 2, 8)."-".substr($cuit, 10, 1);
				echo substr($retencion->get('fecha'), 8, 2)."-".substr($retencion->get('fecha'), 5, 2)."-".substr($retencion->get('fecha'), 0, 4);
				echo "0001";
				echo str_pad($retencion->get('certificado_retencion'), 8 , '0', STR_PAD_LEFT);
				echo str_pad(number_format($retencion->get('importe_retencion1'), 2, ',', ''), 11 , '0', STR_PAD_LEFT);
				echo "A";
				echo "\r\n";
			}
		}
	}
}