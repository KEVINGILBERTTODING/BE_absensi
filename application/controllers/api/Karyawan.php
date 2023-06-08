<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Karyawan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('absen_model');
	}


	public function getMyAbsenHistory()
	{
		$userId = $this->input->get('user_id');
		echo json_encode($this->absen_model->getAllAbsenByUserId($userId));
	}
}


/* End of file Karyawan.php */
/* Location: ./application/controllers/Karyawan.php */
