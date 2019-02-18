<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model{

    // Ambil Data
    public function getMahasiswa($id = NULL)
    {
        if ($id === NULL) {
            // Ambil Semua Data
            $this->db->order_by('id', 'DESC');
            return $this->db->get('mahasiswa')->result_array();
        } else {
            // Ambil Data Berdasarkan ID
            return $this->db->where('id', $id)->get('mahasiswa')->result_array();
        }
    }

    // Menambahkan Data
    public function createMahasiswa($data)
    {
        $this->db->insert('mahasiswa', $data);
        return $this->db->affected_rows();
    }

    // Memperbarui Data
    public function updateMahasiswa($id, $data)
    {
        $this->db->where('id', $id)->update('mahasiswa', $data);
        return $this->db->affected_rows();
    }

    // Menghapus Data
    public function deleteMahasiswa($id)
    {
        $this->db->where('id', $id)->delete('mahasiswa');
        return $this->db->affected_rows();
    }
}