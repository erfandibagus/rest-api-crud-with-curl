<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api_model', 'mhs');
        // Limit
        $this->methods['index_get']['limit']    = 1000;
        $this->methods['index_delete']['limit'] = 1000;
        $this->methods['index_post']['limit']   = 1000;
        $this->methods['index_put']['limit']    = 1000;
    }

    // Menampilkan Data
    public function index_get()
    {
        $id = $this->get('id');
        if ($id === NULL) {
            $query = $this->mhs->getMahasiswa();
            if ($query) {
                $response = [
                    'status'    => TRUE,
                    'data'      => $query
                ];
                $this->response($response, REST_Controller::HTTP_OK);
            }
        } else {
            $query = $this->mhs->getMahasiswa($id);
            if ($query) {
                $response = [
                    'status'    => TRUE,
                    'data'      => $query
                ];
                $this->response($response, REST_Controller::HTTP_OK);
            } else {
                $response = [
                    'status'    => FALSE,
                    'message'   => 'Data tidak ditemukan'
                ];
                $this->response($response, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    // Menambahkan Data
    public function index_post()
    {
        $data = [
            'nrp'       => $this->post('nrp'),
            'nama'      => $this->post('nama'),
            'email'     => $this->post('email'),
            'jurusan'   => $this->post('jurusan')
        ];
        $query = $this->mhs->createMahasiswa($data);
        if ($query > 0) {
            $response = [
                'status'    => TRUE,
                'message'   => 'Data berhasil ditambahkan'
            ];
            $this->response($response, REST_Controller::HTTP_CREATED);
        } else {
            $response = [
                'status'    => FALSE,
                'message'   => 'Data gagal ditambahkan'
            ];
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    // Memperbarui Data
    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nrp'       => $this->put('nrp'),
            'nama'      => $this->put('nama'),
            'email'     => $this->put('email'),
            'jurusan'   => $this->put('jurusan')
        ];
        if ($id === NULL) {
            $response = [
                'status'    => FALSE,
                'message'   => 'Parameter id harus diisi'
            ];
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $query = $this->mhs->updateMahasiswa($id, $data);
            if ($query > 0) {
                $response = [
                    'status'    => TRUE,
                    'message'   => 'Data berhasil diperbarui'
                ];
                $this->response($response, REST_Controller::HTTP_CREATED);
            } else {
                $response = [
                    'status'    => FALSE,
                    'message'   => 'Data gagal diperbarui'
                ];
                $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    // Menghapus Data
    public function index_delete()
    {
        $id = $this->delete('id');
        if ($id === NULL) {
            $response = [
                'status'    => FALSE,
                'message'   => 'Parameter id harus diisi'
            ];
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            $query = $this->mhs->deleteMahasiswa($id);
            if ($query > 0) {
                $response = [
                    'status'    => TRUE,
                    'message'   => 'Data berhasil dihapus'
                ];
                $this->response($response, REST_Controller::HTTP_NO_CONTENT);
            } else {
                $response = [
                    'status'    => FALSE,
                    'message'   => 'Data tidak ditemukan'
                ];
                $this->response($response, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
}