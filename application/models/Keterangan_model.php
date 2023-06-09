<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Keterangan_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	public function insert($data)
	{
		$insert = $this->db->insert('tb_keterangan', $data);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}

	public function getAllKeteranganByUserId($id)
	{
		$this->db->select('*');
		$this->db->from('tb_keterangan');
		$this->db->where('id_karyawan', $id);
		return $this->db->get()->result();
	}
}

/* End of file Keterangan_model.php */
/* Location: ./application/models/Keterangan_model.php */
