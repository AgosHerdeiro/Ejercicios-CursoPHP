<?php

function posted()
{
	return array("si" => "Si", "no" => "No");
}

function clean_name($name)
{
	return url_title($name, '-', TRUE);
}

function all_images()
{
	$CI =& get_instance();
	$CI->load->helper('directory');

	$dir = "uploads/post";
	$files = directory_map($dir);

	return $files; // Arreglo de archivos
}
