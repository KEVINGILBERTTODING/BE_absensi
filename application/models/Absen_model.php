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

	public function insertAbsen($data)
	{
		$insert = $this->db->insert('tb_absen', $data);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}

	public function getAllAbsensi()
	{
		$this->db->select('*');
		$this->db->from('tb_absen');
		$this->db->order_by('id', 'desc');
		return $this->db->get()->result();
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('tb_absen');
		if ($delete) {
			return true;
		} else {
			return false;
		}
	}
}

/* End of file Absen_model.php */
/* Location: ./application/models/Absen_model.php */
