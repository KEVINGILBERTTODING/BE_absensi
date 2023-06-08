<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	public function getAllAbsenByUserId($id)
	{
		$this->db->select('*');
		$this->db->from('tb_absen');
		$this->db->where('id_karyawan', $id);
		$this->db->order_by('id', 'desc');
		return $this->db->get()->result();
	}
}

/* End of file Absen_model.php */
/* Location: ./application/models/Absen_model.php */
