<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Admin_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function validateUsername($username)
	{
		$this->db->select('*');
		$this->db->from('tb_daftar');
		$this->db->where('username', $username);
		return $this->db->get()->row_array();
	}
}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */
