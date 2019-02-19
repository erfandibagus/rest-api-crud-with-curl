<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('curl_model','curl');
		$this->load->library('template');
	}

	// Method untuk Menampilkan Data dan Form HTML
	public function index()
	{
		// Hanya Pengalihan
		redirect(base_url('mahasiswa/data'), 'location', 301);
	}

	// Menampilkan data
	public function data()
	{
		$limit = 5; // Total data per halaman
		$offset = $this->input->get('offset', TRUE);
		if ($offset === NULL || $offset == 0) {
			// Jika offset NULL atau 0
			$data['result'] = json_decode($this->curl->getAllData($limit));
		} else {
			// Jika offset tidak NULL atau 0
			$data['result'] = json_decode($this->curl->getAllData($limit, $offset));
		}
		$this->template->load('data', $data);
	}

	// Menampilkan Form Penambahan Data
	public function insert()
	{
		$this->template->load('insert');
	}

	// Menampilkan Form Perbarui Data
	public function update($id = NULL)
	{
		if ($id != NULL) {
			// Jika ada ID
			$result = json_decode($this->curl->getData($id), TRUE);
			if ($result['status']) {
				// Jika data ditemukan
				$data = array(
					'id'		=> $result['data'][0]['id'],
					'nrp' 		=> $result['data'][0]['nrp'],
					'nama' 		=> $result['data'][0]['nama'],
					'email' 	=> $result['data'][0]['email'],
					'jurusan'	=> $result['data'][0]['jurusan'],
				);
				$this->template->load('update', $data);
			} else {
				// Jika data tidak ditemukan
				$this->session->set_flashdata('msg', $result['message']);
				redirect(base_url('mahasiswa/data'), 'location', 301);
			}
		} else {
			// Jika tidak ada ID
			redirect(base_url('mahasiswa/data'), 'location', 301);
		}
	}


	// Method untuk Menangani Form Input (Action)
	// Menambahkan Data
	public function post()
	{
		// Validasi Form
		$config = array(
			array(
				'field' => 'nrp',
				'label' => 'NRP',
				'rules' => 'required'
			),
			array(
				'field' => 'nama',
				'label' => 'Nama',
				'rules' => 'required'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email'
			),
			array(
				'field' => 'jurusan',
				'label' => 'Jurusan',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == TRUE) {
			// Jika Validasi Benar
			$data = array(
				'nrp' 		=> $this->input->post('nrp', TRUE),
				'nama' 		=> $this->input->post('nama', TRUE),
				'email' 	=> $this->input->post('email', TRUE),
				'jurusan' 	=> $this->input->post('jurusan', TRUE)
			);
			$exec = $this->curl->post($data);
			$data = json_decode($exec, TRUE);
			if ($data['message']) {
				$this->session->set_flashdata('msg', $data['message']);
				redirect(base_url('mahasiswa/data'), 'location', 301);
			}
		} else {
			// Jika Validasi Salah
			$this->session->set_flashdata('msg', 'Semua kolom harus diisi dengan benar');
			redirect(base_url('mahasiswa/insert'), 'location', 301);
		}
	}

	// Memperbarui Data
	public function put()
	{
		// Validasi Form
		$config = array(
			array(
				'field' => 'id',
				'label' => 'ID',
				'rules' => 'required'
			),
			array(
				'field' => 'nrp',
				'label' => 'NRP',
				'rules' => 'required'
			),
			array(
				'field' => 'nama',
				'label' => 'Nama',
				'rules' => 'required'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|valid_email'
			),
			array(
				'field' => 'jurusan',
				'label' => 'Jurusan',
				'rules' => 'required'
			)
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == TRUE) {
			// Jika Validasi Benar
			$data = array(
				'id'		=> $this->input->post('id', TRUE),
				'nrp' 		=> $this->input->post('nrp', TRUE),
				'nama' 		=> $this->input->post('nama', TRUE),
				'email' 	=> $this->input->post('email', TRUE),
				'jurusan' 	=> $this->input->post('jurusan', TRUE)
			);
			$exec = $this->curl->put($data);
			$data = json_decode($exec, TRUE);
			if ($data['message']) {
				$this->session->set_flashdata('msg', $data['message']);
				redirect(base_url('mahasiswa/data'), 'location', 301);
			}
		} else {
			// Jika Validasi Salah
			$this->session->set_flashdata('msg', 'Semua kolom harus diisi dengan benar');
			redirect(base_url('mahasiswa/update/'.$this->input->post('id', TRUE)), 'location', 301);
		}
	}

	// Menghapus Data
	public function delete($id = NULL)
	{
		if ($id != NULL) {
			// Jika ada ID
			$exec = $this->curl->delete($id);
			$data = json_decode($exec, TRUE);
			// Karena HTTP_NO_CONTENT tidak menampilkan/mengembalikan data jika berhasil dieksekusi, maka dibuatkan session flashdata manual untuk menampilkan message (pesan)
			if ($data['message']) {
				// Jika gagal
				$this->session->set_flashdata('msg', $data['message']);
				redirect(base_url('mahasiswa/data'), 'location', 301);
			} else {
				// Jika berhasil
				$this->session->set_flashdata('msg', 'Data berhasil dihapus');
				redirect(base_url('mahasiswa/data'), 'location', 301);
			}
		} else {
			// Jika tidak ada ID
			redirect(base_url('mahasiswa/data'), 'location', 301);
		}
	}
}