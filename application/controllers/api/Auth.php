<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('karyawan_model');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function auth()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$validateKaryawan = $this->karyawan_model->auth($username, 'tb_karyawan');
		if ($validateKaryawan != null) {
			if (md5($password) == $validateKaryawan['password']) {
				$response = [
					'status' => 200,
					'nama' => $validateKaryawan['nama'],
					'user_id' => $validateKaryawan['id_karyawan'],
					'role' => 2,
					'jabatan' => $validateKaryawan['jabatan']
				];
				echo json_encode($response);
			} else {
				$response = [
					'status' => 404,
					'message' => 'Password salah'
				];
				echo json_encode($response);
			}
		} else {
			$response = [
				'status' => 404,
				'message' => 'Username berlum terdaftar'
			];
			echo json_encode($response);
		}
	}
}


/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
