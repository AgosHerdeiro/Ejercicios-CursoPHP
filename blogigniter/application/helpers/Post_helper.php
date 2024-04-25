<?php

function posted()
{
	return array("si" => "Si", "no" => "No");
}

function clean_name($name)
{
	return url_title($name, '-', TRUE);
}
