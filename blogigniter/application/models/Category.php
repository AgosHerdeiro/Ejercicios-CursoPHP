<?php

class Category extends CI_Model
{
	public $table = "categories";
	public $table_id = "category_id";

	function getByUrlClean($url_clean)
	{
		$this->db->select();
		$this->db->from("$this->table");
		$this->db->where("url_clean", $url_clean);
		$query = $this->db->get();

		return $query->row();
	}
}
