<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Karyawan_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Karyawan_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	public function auth($email, $field)
	{
		$this->db->select('*');
		$this->db->from($field);
		$this->db->where('username', $email);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function edit($id, $data)
	{
		$this->db->where('id_karyawan', $id);
		$update = $this->db->update('tb_karyawan', $data);
		if ($update) {
			return true;
		} else {
			return false;
		}
	}

	public function getKaryawanByUserId($id)
	{
		$this->db->select('*');
		$this->db->from('tb_karyawan');
		$this->db->where('id_karyawan', $id);
		return $this->db->get()->row_array();
	}
}

/* End of file Karyawan_model.php */
/* Location: ./application/models/Karyawan_model.php */
