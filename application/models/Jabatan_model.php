<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Jabatan_model
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

class Jabatan_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	public function getAllJabatan()
	{
		$this->db->select('*');
		$this->db->from('tb_jabatan');
		return $this->db->get()->result();
	}

	public function insert($data)
	{
		$insert = $this->db->insert('tb_jabatan', $data);
		if ($insert) {
			return true;
		} else {
			return false;
		}
	}
}

/* End of file Jabatan_model.php */
/* Location: ./application/models/Jabatan_model.php */
