<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_admin extends CI_Model
{
    //fungsi cek session
    function logged_id()
    {
        return $this->session->userdata('myId');
    }

    //fungsi check login
    function check_login($table, $field1, $field2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field1);
        $this->db->where($field2);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    //........................................PELAMAR...........................................//

    //semua data pelamar

    public function getPelamar()
    {
        $query = $this->db->query("SELECT * from karyawan inner join pendidikan on karyawan.id_karyawan = pendidikan.id_karyawan inner join lowongan on pendidikan.id_karyawan = lowongan.id_karyawan where id_status = 'Pelamar' || id_status = 'Pelamar Ditolak' || id_status = 'Calon Karyawan'");
        return $query->result();
    }
    // data detail pelamar
    public function getDetailPelamar($id)
    {
        $query = $this->db->query("SELECT * from karyawan inner join pendidikan on karyawan.id_karyawan = pendidikan.id_karyawan inner join lowongan on pendidikan.id_karyawan = lowongan.id_karyawan where karyawan.id_karyawan = $id");
        return $query->result();
    }

    //pelamar masuk seleksi 

     public function getPelamarSeleksi()
    {
        $query = $this->db->query("SELECT * from karyawan where id_status = 'Calon Karyawan'");
        return $query->result();
    }
    //cari data pelamar berdasarkan ID
      public function getEmailPelamar($id)
    {
        $query = $this->db->query("SELECT email from karyawan where id_karyawan = $id");
        return $query->result();
    }
     public function pelamarDiterima($id)
    {
        $query = $this->db->query("UPDATE karyawan SET id_status = 'Calon Karyawan' where id_karyawan = $id");
    }
    public function pelamarDitolak($id)
    {
        $query = $this->db->query("UPDATE karyawan SET id_status = 'Pelamar Ditolak' where id_karyawan = $id");
    }
     public function getDataSeleksi($id)
    {
        $query = $this->db->query("SELECT * from seleksi where id_karyawan = $id");
        return $query->result();
    }
}
