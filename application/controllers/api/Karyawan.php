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

	public function insertAbsen()
	{
		$data = [
			'id_karyawan' => $this->input->post('id_karyawan'),
			'nama' => $this->input->post('nama'),
			'waktu' => $this->input->post('waktu')
		];

		$insert = $this->absen_model->insertAbsen($data);
		if ($insert == true) {
			$response = [
				'status' => 200
			];
			echo json_encode($response);
		} else {
			$response = [
				'status' => 404
			];
			echo json_encode($response);
		}
	}
}


/* End of file Karyawan.php */
/* Location: ./application/controllers/Karyawan.php */
