<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model{

    // Ambil Semua Data
    public function getAllMahasiswa($limit, $offset)
    {
        return $this->db->order_by('id', 'DESC')
                        ->limit($limit, $offset)
                        ->get('mahasiswa')->result_array();
    }

    // Ambil Data Mahasiswa Berdasarkan ID
    public function getMahasiswa($id)
    {
        return $this->db->where('id', $id)->get('mahasiswa')->result_array();
    }

    // Menghitung Total Data
    public function getTotalMhs()
    {
        return $this->db->get('mahasiswa')->num_rows();
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