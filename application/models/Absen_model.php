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

	function rekapAbsen($dateStart, $dateEnd)
	{
		$this->db->select('tb_absen.*, tb_karyawan.jabatan');
		$this->db->from('tb_absen');
		$this->db->join('tb_karyawan', 'tb_karyawan.id_karyawan = tb_absen. id_karyawan', 'left');
		$this->db->where('Date(created_at) >=', $dateStart);
		$this->db->where('Date(created_at) <=', $dateEnd);
		return $this->db->get()->result();
	}

	function checkStatusAbsent($id)
	{
		$this->db->select('*');
		$this->db->from('tb_absen');
		$this->db->where('Date(created_at)', date('Y-m-d'));
		$this->db->where('id_karyawan', $id);
		return $this->db->get()->row_array();
	}
}

/* End of file Absen_model.php */
/* Location: ./application/models/Absen_model.php */
