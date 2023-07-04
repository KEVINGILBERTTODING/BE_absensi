<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Karyawan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('absen_model');
		$this->load->model('keterangan_model');
		$this->load->model('jabatan_model');
		$this->load->model('karyawan_model');
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
			'created_at' => date('Y-m-d H:i:s'),
			'jenis' => $this->input->post('jenis'),
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

	public function insertIzin()
	{
		$config['upload_path']          = './uploads/lampiran/';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 5000;


		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('lampiran')) {
			$response = [
				'code' => 404,
				'message' => 'Format file tidak sesuai'
			];
			echo json_encode($response);
		} else {

			$data = array('upload_data' => $this->upload->data());


			$file_name = $data['upload_data']['file_name'];
			$source_path = './uploads/lampiran/' . $data['upload_data']['file_name'];
			$dir_path = $_SERVER['DOCUMENT_ROOT'] . '/absensi/karyawan/modul/karyawan/images/';
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
				'id_karyawan' => $this->input->post('id_karyawan'),
				'nama' => $this->input->post('nama'),
				'keterangan' => $this->input->post('keterangan'),
				'alasan' => $this->input->post('alasan'),
				'waktu' => $this->input->post('waktu'),
				'created_at' => date('Y-m-d H:i:s'),
				'bukti' => $file_name
			];



			$insert =  $this->keterangan_model->insert($data);
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
	}

	public function getAllJabatan()
	{
		echo json_encode($this->jabatan_model->getAllJabatan());
	}
	public function editProfile()
	{
		$id = $this->input->post('id');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$validateUsername = $this->karyawan_model->auth($username, 'tb_karyawan');
		if ($validateUsername != null) {
			if ($validateUsername['id_karyawan'] == $id) {
				if ($password == '') {
					$data = [
						'username' => $username,
						'nama' => $this->input->post('nama'),
						'tmp_tgl_lahir' => $this->input->post('tmp_tgl_lahir'),
						'jenkel' => $this->input->post('jenkel'),
						'agama' => $this->input->post('agama'),
						'alamat' => $this->input->post('alamat'),
						'no_tel' => $this->input->post('no_tel'),
						'jabatan' => $this->input->post('jabatan')
					];

					$update = $this->karyawan_model->edit($id, $data);
					if ($update == true) {
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
				} else {
					$data = [
						'username' => $username,
						'nama' => $this->input->post('nama'),
						'tmp_tgl_lahir' => $this->input->post('tmp_tgl_lahir'),
						'jenkel' => $this->input->post('jenkel'),
						'agama' => $this->input->post('agama'),
						'alamat' => $this->input->post('alamat'),
						'no_tel' => $this->input->post('no_tel'),
						'jabatan' => $this->input->post('jabatan'),
						'password' => md5($password),
						'alamat' => $this->input->post('alamat'),
					];

					$update = $this->karyawan_model->edit($id, $data);
					if ($update == true) {
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
					'message' => 'Username telah digunakan'
				];
				echo json_encode($response);
			}
		} else {
			if ($password == '') {
				$data = [
					'username' => $username,
					'nama' => $this->input->post('nama'),
					'tmp_tgl_lahir' => $this->input->post('tmp_tgl_lahir'),
					'jenkel' => $this->input->post('jenkel'),
					'agama' => $this->input->post('agama'),
					'alamat' => $this->input->post('alamat'),
					'no_tel' => $this->input->post('no_tel'),
					'jabatan' => $this->input->post('jabatan'),
					'alamat' => $this->input->post('alamat'),
				];

				$update = $this->karyawan_model->edit($id, $data);
				if ($update == true) {
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
			} else {
				$data = [
					'username' => $username,
					'nama' => $this->input->post('nama'),
					'tmp_tgl_lahir' => $this->input->post('tmp_tgl_lahir'),
					'jenkel' => $this->input->post('jenkel'),
					'agama' => $this->input->post('agama'),
					'alamat' => $this->input->post('alamat'),
					'no_tel' => $this->input->post('no_tel'),
					'jabatan' => $this->input->post('jabatan'),
					'password' => md5($password),
					'alamat' => $this->input->post('alamat'),
				];

				$update = $this->karyawan_model->edit($id, $data);
				if ($update == true) {
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
		}
	}

	public function getProfile()
	{
		$id = $this->input->get('id');
		echo json_encode($this->karyawan_model->getKaryawanByUserId($id));
	}

	public function getAllKeterangan()
	{
		$id = $this->input->get('id');
		echo json_encode($this->keterangan_model->getAllKeteranganByUserId($id));
	}

	function checkAbsen()
	{
		echo json_encode($this->absen_model->checkStatusAbsent($this->input->get('id')));
	}
}


/* End of file Karyawan.php */
/* Location: ./application/controllers/Karyawan.php */
