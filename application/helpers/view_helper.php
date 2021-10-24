<?php


if ( ! function_exists('include_partial'))
{

	function include_partial($view, $vars = array(), $return_output = false)
	{
		if ($return_output)
			ob_start();
		
		$data = get_file_info(APPPATH."views/_$view.php");
		if (!$data)
			throw new Exception("Vista $view no existe");
		
		{
			foreach ($vars as $key => $value)
				$$key = $value;

			include($data['server_path']);
		}
		
		if ($return_output)
		{
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
		
}

define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);

function get_charset($texto)
{
	 $c = 0;
	 $ascii = true;
	 
	 for ($i = 0;$i<strlen($texto);$i++)
	 {
	  $byte = ord($texto[$i]);
	  if ($c>0) {
	   if (($byte>>6) != 0x2)
	   {
		return ISO_8859_1;
	   } else {
		$c--;
	   }
	  } elseif ($byte&0x80) {
	   $ascii = false;
	   if (($byte>>5) == 0x6) {
		$c = 1;
	   } elseif (($byte>>4) == 0xE) {
		$c = 2;
	   } elseif (($byte>>3) == 0x1E) {
		$c = 3; 
	   } else {
		return ISO_8859_1;
	   }
	  }
 }
 
 return ($ascii) ? ASCII : UTF_8;
}
 
if ( ! function_exists('auto_utf8'))
{
	function auto_utf8($texto)
	{
		 switch (get_charset($texto))
		 {
			 case UTF_8:
			  return $texto;
			 case ASCII:
			  return utf8_encode($texto);
			 case ISO_8859_1:
			  return utf8_encode($texto);
		 }
	}
		
}