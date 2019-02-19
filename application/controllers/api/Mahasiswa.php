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
        // Limit untuk Akses API
        $this->methods['index_get']['limit']    = 1000;
        $this->methods['index_delete']['limit'] = 1000;
        $this->methods['index_post']['limit']   = 1000;
        $this->methods['index_put']['limit']    = 1000;
    }

    // Menampilkan Data
    public function index_get()
    {
        $id = $this->get('id');
        // Untuk pagination
        $limit = $this->get('limit');
        $offset = $this->get('offset');

        if ($id === NULL) {
            if ($limit === NULL || $limit == 0) { // Limit NULL atau 0
                if ($offset === NULL || $offset == 0) { // Offset NULL atau 0
                    // Jika limit dan offset NULL atau 0
                    $query = $this->mhs->getAllMahasiswa(5,0);
                    if ($query) {
                        $response = [
                            'status'    => TRUE,
                            'total'     => $this->mhs->getTotalMhs(),
                            'halaman'   => [
                                'limit'     => 5,
                                'offset'    => 0,
                            ],
                            'data'      => $query
                        ];
                    }
                } else {
                    // Jika limit NULL atau 0 dan offset tidak NULL atau 0
                    $query = $this->mhs->getAllMahasiswa(5,$offset);
                    if ($query) {
                        $response = [
                            'status'    => TRUE,
                            'total'     => $this->mhs->getTotalMhs(),
                            'halaman'   => [
                                'limit'     => 5,
                                'offset'    => intval($offset),
                            ],
                            'data'      => $query
                        ];
                    }
                }
            } else {
                if ($offset === NULL || $offset == 0) {
                    // Jika limit tidak NULL atau 0 dan offset NULL atau 0
                    $query = $this->mhs->getAllMahasiswa($limit,0);
                    if ($query) {
                        $response = [
                            'status'    => TRUE,
                            'total'     => $this->mhs->getTotalMhs(),
                            'halaman'   => [
                                'limit'     => intval($limit),
                                'offset'    => 0,
                            ],
                            'data'      => $query
                        ];
                    }
                } else {
                    // Jika limit dan offset tidak NULL atau 0
                    $query = $this->mhs->getAllMahasiswa($limit,$offset);
                    if ($query) {
                        $response = [
                            'status'    => TRUE,
                            'total'     => $this->mhs->getTotalMhs(),
                            'halaman'   => [
                                'limit'     => intval($limit),
                                'offset'    => intval($offset),
                            ],
                            'data'      => $query
                        ];
                    }
                }
            }
            $this->response($response, REST_Controller::HTTP_OK);
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