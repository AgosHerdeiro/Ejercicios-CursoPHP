<?php

class Post extends CI_Model
{
	public $table = "posts";
	public $table_id = "post_id";

	function get_pagination($offset = 0, $posted = 'si', $order = 'desc', $c_url_clean = null)
	{
		$this->db->select('p.*, c.url_clean as c_url_clean, c.name as category');
		$this->db->from("$this->table as p");
		$this->db->join("categories as c", "c.category_id = p.category_id");
		$this->db->where("posted", $posted);
		if (isset($c_url_clean)) {
			$this->db->where("c.url_clean", $c_url_clean);
		}
		$this->db->order_by("created_at", $order);
		$this->db->limit(PAGE_SIZE, $offset);
		$query = $this->db->get();

		return $query->result();
	}

	function getByUrlClean($url_clean, $posted = 'si')
	{
		$this->db->select('p.*, c.url_clean as c_url_clean, c.name as category');
		$this->db->from("$this->table as p");
		$this->db->join("categories as c", "c.category_id = p.category_id");
		$this->db->where("posted", $posted);
		$this->db->where("p.url_clean", $url_clean);
		$query = $this->db->get();

		return $query->row();
	}

	function countByUrlClean($c_url_clean, $posted = 'si')
	{
		$this->db->select('COUNT(p.post_id) as count');
		$this->db->from("$this->table as p");
		$this->db->join("categories as c", "c.category_id = p.category_id");
		$this->db->where("posted", $posted);
		$this->db->where("c.url_clean", $c_url_clean);
		$query = $this->db->get();

		return $query->row()->count;
	}
}
