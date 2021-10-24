<?php
class Basecontroller extends CI_Controller 
{
	const SUCCESS = 1;
	const ERROR = 2;
	const NOTICE = 3;
	
	const ADMIN = 1;
	const USUARIO = 2;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function load_view($view, $arr = array())
	{
		if (isset($this->current_user))
			$arr['current_user'] = $this->current_user;
		
		$arr['content_view'] = $view;
		$this->load->view('layout', $arr);
	}
	
	public function load_view_as_print($view, $arr = array())
	{
		if (isset($this->current_user))
			$arr['current_user'] = $this->current_user;
		if (!isset($arr['title']))
			$arr['title'] = "Listado";
		
		$this->load->view('js-css-include');
		return $this->load->view($view, $arr);
	}
	
	public function load_view_as_xls($view, $arr = array())
	{
		if (isset($this->current_user))
			$arr['current_user'] = $this->current_user;
		if (!isset($arr['title']))
			$arr['title'] = "Listado";
		
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: attachment; filename=Pediatric Care - ".$arr['title'].".xls");
		
		
		$html = "<h1>".$arr['title']."</h1>".$this->load->view($view, $arr, TRUE);

		print utf8_decode($html);
		exit;
	}
	
	public function load_view_as_pdf($view, $arr = array())
	{
		if (isset($this->current_user))
			$arr['current_user'] = $this->current_user;
		if (!isset($arr['title']))
			$arr['title'] = "Listado";

		$this->load->library('tcpdf');
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		ob_end_clean();
		
		$pdf->AddPage();
		$pdf->writeHTML($this->load->view($view, $arr, TRUE));
		
		$pdf->Output("$view.pdf", 'I');
		
		return;
	}
	
	public function show_message($level, $message)
	{
		$this->session->set_flashdata(array('level' => $level, 'message' => $message));
	
	}
	
}