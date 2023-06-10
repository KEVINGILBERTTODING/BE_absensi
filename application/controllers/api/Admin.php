<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Admin
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/jakarta');
		$this->load->model('karyawan_model');
		$this->load->model('jabatan_model');
		$this->load->model('absen_model');
		$this->load->model('keterangan_model');
	}

	public function getallkaryawan()
	{
		echo json_encode($this->karyawan_model->getAllKaryawan());
	}

	public function insertKaryawan()
	{


		$username = $this->input->post('username');
		$validateKaryawan = $this->karyawan_model->auth($username, 'tb_karyawan');


		if ($validateKaryawan == null) {
			$config['upload_path']          = './uploads/profile/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = 5000;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('foto')) {
				$response = [
					'code' => 404,
					'message' => 'Format file tidak sesuai'
				];
				echo json_encode($response);
			} else {

				$data = array('upload_data' => $this->upload->data());

				$file_name = $data['upload_data']['file_name'];
				$source_path = './uploads/profile/' . $data['upload_data']['file_name'];
				$dir_path = $_SERVER['DOCUMENT_ROOT'] . '/absensi/images/';
				if (!is_dir($dir_path)) {
					mkdir($dir_path, 0777, true);
				}

				$destination_path = $dir_path . $file_name;

				if (file_exists($source_path)) {
					if (copy($source_path, $destination_path)) {
					} else {
						$response = [
							'code' => 404,
							'message' => 'Terjadi kesalahan'
						];
						echo json_encode($response);
					}
				}

				$data = [
					'username' => $username,
					'id_karyawan' => $this->input->post('id'),
					'nama' => $this->input->post('nama'),
					'password' => md5($this->input->post('password')),
					'tmp_tgl_lahir' => $this->input->post('tmp_tgl_lahir'),
					'jenkel' => $this->input->post('jenkel'),
					'agama' => $this->input->post('agama'),
					'alamat' => $this->input->post('alamat'),
					'no_tel' => $this->input->post('no_tel'),
					'jabatan' => $this->input->post('jabatan'),
					'foto' => $file_name
				];



				$insert =  $this->karyawan_model->insert($data);
				if ($insert == true) {
					$response = [
						'status' => 200
					];
					echo json_encode($response);
				} else {
					$response = [
						'status' => 404,
						'message' => 'Terjadi kesalahan'
					];
					echo json_encode($response);
				}
			}
		} else {
			$response = [
				'status' => 404,
				'message' => 'Username telah terdaftar'
			];
			echo json_encode($response);
		}
	}

	public function deleteKarayawan()
	{
		$id = $this->input->post('id');
		$delete = $this->karyawan_model->delete($id);

		if ($delete == true) {
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

	public function getAllJabatan()
	{
		echo json_encode($this->jabatan_model->getAllJabatan());
	}

	public function insertJabatan()
	{
		$data = [
			'jabatan' => $this->input->post('jabatan')
		];

		$insert = $this->jabatan_model->insert($data);

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

	public function getAllAbsensi()
	{
		echo json_encode($this->absen_model->getAllAbsensi());
	}

	public function deleteAbsen()
	{
		$id = $this->input->post('id');
		$delete = $this->absen_model->delete($id);
		if ($delete == true) {
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

	public function deleteIzin()
	{
		$id = $this->input->post('id');
		$delete = $this->keterangan_model->delete($id);

		if ($delete == true) {
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
	public function getAllIzin()
	{
		echo json_encode($this->keterangan_model->getAllKeterangan());
	}
}


/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
