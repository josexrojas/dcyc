<?php
class Home extends LoginController
{
	public function Index()
	{
		$this->load_view('home_dashboard');
	}
}