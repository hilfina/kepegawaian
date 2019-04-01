<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_pelamar extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mdl_admin');
        $this->load->model('mdl_home');
        $this->load->model('mdl_login');
        $this->load->model('mdl_pelamar');
        $this->load->helper('url','form','file');
        $this->load->library('form_validation','image_lib');
        $this->load->library('session');
    }
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

    public function getPelamar($id)
    {
        
        $query = $this->db->query("SELECT k.nik, k.no_ktp, k.no_bpjs, k.nama, k.alamat, k.no_telp, k.email, k.foto, j.nama_profesi, l.pend_akhir, l.nilai_akhir from jenis_profesi as j inner join  karyawan as k on k.id_profesi=j.id_profesi inner join lowongan as l on l.id_karyawan=k.id_karyawan where k.id_karyawan='$id'");
        return $query->result();
    }

    function updatedata($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    function tambahdata($table,$data)
    {
        $query = $this->db->insert($table, $data);
        return $this->db->insert_id();// return last insert id
    }

    function hapusdata($table,$where){
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function getPend($id){
        $query= $this->db->query("SELECT * from pendidikan  where id_karyawan='$id'");
        return $query->result();
    }

    public function getSeleksi($id){
        $query= $this->db->query("SELECT * from karyawan as k inner join seleksi as s on k.id_karyawan = s.id_karyawan where k.id_karyawan ='$id'");
        return $query->result();
    }
    public function getDetailpend($id){
        $query= $this->db->query("SELECT * from pendidikan  where id='$id'");
        return $query->result();
    }
    public function getSurat($id){
        $query= $this->db->query("SELECT s.id_sipstr, s.no_surat, j.jenis_surat, s.tgl_mulai, s.tgl_akhir, s.aktif  from sip_str as s inner join jenis_surat as j on s.id_surat=j.id_surat where id_karyawan='$id'");
        return $query->result();
    }

    public function getDetailsurat($id){
        $query= $this->db->query("SELECT * from sip_str  where id_sipstr='$id'");
        return $query->result();
    }

    public function getNilai($id){
        $query= $this->db->query("SELECT * from seleksi  where id_karyawan='$id'");
        return $query->result();
    }

}