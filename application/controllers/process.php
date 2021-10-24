<?php
class Process extends CI_Controller
{
	public function __construct($params = array())
	{
		parent::__construct($params);
		$this->load->model('padronarba');
		$this->load->model('configuracion');		
	}

	private function set_progress_padronarba_ret($filesize, $curpos)
	{
		if (!$this->configuracion->load_by_id(1))
			return false;
	
		$this->configuracion->set('ret_filesize_padron_arba', $filesize);
		$this->configuracion->set('ret_curpos_padron_arba', $curpos);
		$this->configuracion->set('last_activity_padron_arba', time());
		$this->configuracion->save();
		
		print "$filesize $curpos\n";
		return true;
	}
	

	private function set_progress_padronarba_per($filesize, $curpos)
	{
		if (!$this->configuracion->load_by_id(1))
			return false;
		
		$this->configuracion->set('per_filesize_padron_arba', $filesize);
		$this->configuracion->set('per_curpos_padron_arba', $curpos);
		$this->configuracion->set('last_activity_padron_arba', time());
		$this->configuracion->save();
		
		print "$filesize $curpos\n";
		return true;
	} 
	
	
	public function padronarba()
	{
		$file = getenv("FILE");
		if (!$file)
			exit;
		
		$res = zip_open($file);
		if (!is_resource( $res))
			die('El formato del archivo no es válido');

		$this->db->cache_off();
		$this->db->save_queries = false;
		
		$this->set_progress_padronarba_ret(0, 0);
		$this->set_progress_padronarba_per(0, 0);
		
		$unknown_file = false;
		while($entry = zip_read($res))
		{
			$filename = zip_entry_name($entry);
			//print "<br>$filename<br>";
		
			$matches = array();
			if (!preg_match("/PadronRGS(?P<type>(Ret|Per))(?P<month>(\d\d))(?P<year>(20\d\d))\.txt/", $filename, $matches))
			{
					$unknown_file = true;
					continue;
			}
		
			
			$f = zip_entry_open($res, $entry);
			$filesize = zip_entry_filesize($entry);
			$curpos = 0;
			
			if ($matches['type'] == 'Ret')
			{  
				$this->set_progress_padronarba_ret($filesize, $curpos);
				
				while ($record = zip_entry_read($entry, 57))
				{
					$record = str_getcsv($record, ';', '"', '\\');
		
					$o = new Padronarba();
					$o->load_by_cuit_and_date($record[4], substr($record[2], 4, 4).'-'.substr($record[2], 2, 2).'-'.substr($record[2],  0, 2));
				
					$o->set('cuit', $record[4]);
					$o->set('fecha', substr($record[2], 4, 4).'-'.substr($record[2], 2, 2).'-'.substr($record[2],  0, 2));
					$o->set('alicuota_retencion', str_replace(',', '.', $record[8]));
					// $record[2] fecha desde
					// $record[3] fecha hasta
					// $record[4] cuit
					// $record[8] alicuota
		
					$o->save();
					$curpos += 57;

					if ($curpos % 57000 == 0)
					{
						$this->set_progress_padronarba_ret($filesize, $curpos);
						set_time_limit(0);	
					}
						
				}
						
			}
		
			if ($matches['type'] == 'Per')
			{
				$this->set_progress_padronarba_per($filesize, $curpos);
				
				while ($record = zip_entry_read($entry, 57))
				{
					$record = str_getcsv($record, ';', '"', '\\');
		
					$o = new Padronarba();
					$o->load_last_by_cuit($record[4]);
				
					$o->set('cuit', $record[4]);
					$o->set('fecha', substr($record[2], 4, 4).'-'.substr($record[2], 2, 2).'-'.substr($record[2],  0, 2));
					$o->set('alicuota_percepcion', str_replace(',', '.', $record[8]));
					// $record[2] fecha desde
					// $record[3] fecha hasta
					// $record[4] cuit
					// $record[8] alicuota
		
					$o->save();
					$curpos += 57;
					
					if ($curpos % 57000 == 0)
					{
						$this->set_progress_padronarba_per($filesize, $curpos);
						set_time_limit(0);
					}

				}
				
			}
		
		}
		
		zip_close($res);
		
		if ($unknown_file)
			die('Uno de los archivos contenido no es válido');
		
		$this->configuracion->set('ultimo_padron_arba', date('Y-m-d'));
		$this->configuracion->save();
		
		print 'Padrón actualizado satisfactoriamente';
		

		}	
	 

}