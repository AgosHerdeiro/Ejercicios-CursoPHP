<?php

class User extends CI_Model
{
	public $table = "users";
	public $table_id = "user_id";

	public function get_unused_id()
	{
		// Create a random user id between 1200 and 4294967295
		$random_unique_int = 2147483648 + mt_rand(-2147482448, 2147483647);

		// Make sure the random user_id isn't already in use
		$query = $this->db->where('user_id', $random_unique_int)
			->get($this->table); // Use $this->table to get the table name

		if ($query->num_rows() > 0) {
			$query->free_result();

			// If the random user_id is already in use, try again
			return $this->get_unused_id();
		}

		return $random_unique_int;
	}


}
