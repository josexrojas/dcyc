<?php
if ( ! function_exists('session_flashdata'))
{
	function session_flashdata($name)
	{
		$CI  =& get_instance();
		$arr = $CI->session->all_userdata();
		
		if (isset($arr['flash:new:'.$name]))
			return $arr['flash:new:'.$name];
		
		return false;
	}
}
 
if ( ! function_exists('current_user'))
{
	function current_user()
	{
		$CI =& get_instance();
		$CI->load->model('user');
		
		return $CI->user->get_current_logged_in_user();
	}
}

if ( ! function_exists('has_access'))
{
	function has_access($controller, $method = false)
	{
		$user = current_user();
		if (!$user)
			return false;
			
		return $user->has_access($controller, $method);
	}
}

if ( ! function_exists('has_rol')) 
{
	function has_rol($rol)
	{
		$user = current_user();
		if (!$user)
			return false;
		
		return $user->has_rol($rol);
	}
}

if ( ! function_exists('serverpath_to_app'))
{
	function serverpath_to_app($path)
	{
		return "/".str_replace(FCPATH, '', $path);
	}
}
 
if ( ! function_exists('print_menu'))
{ 
	function print_menu($url, $description,$param = false, $extra = false, $perm = Permiso::READ)
	{
		$url = rtrim($url, '/');
		$arr = (preg_split("/\//", $url));
		
		$method = false;
		if (isset($arr[0]))
			$controller = $arr[0];
		if (isset($arr[1]))
			$method = $arr[1];
		
		
		if ($method && !has_access($controller, $method))
			return '';
		elseif (!$method  && !has_access($controller))
			return '';
			
		if($param)
			$param = "/".$param;
		
		if ($controller == "files")
		{			
			$CI =& get_instance();
			$CI->load->model('file');
			array_shift($arr);
			array_shift($arr);

			$file = $CI->file->get_category_by_path($arr);

			if ($file && !$file->has_perm($perm))return '';
			
		}
		
		if ($controller == "cmses")
		{			
			$CI =& get_instance();
			$CI->load->model('cmscategory');
			$CI->load->model('cmscategoryrol');
			array_shift($arr);
			array_shift($arr);
			array_shift($arr);
				
			if ($arr && !$CI->cmscategory->load_by_name($arr[0]))
				return '';

			if ($CI->cmscategory && !$CI->cmscategory->has_perm($perm))return '';
			
		}
		
		return "<li><a href=\"".site_url($url)."$param \"$extra><span>$description</span></a></li>";
	}
}
