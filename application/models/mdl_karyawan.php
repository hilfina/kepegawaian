<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_karyawan extends CI_Model
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

    function updateData($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    function getData($table,$where){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function getAlldata($table){
        $this->db->select("*");
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();
    }


    public function getKaryawan($id){
        $query = $this->db->query("SELECT * FROM karyawan where id_karyawan = '$id'");
        return $query->result();
    }

    public function getRiwayat($id){
        $query = $this->db->query("SELECT * FROM riwayat where id_karyawan = '$id'");
        return $query->result();
    }

    public function getStatus($id){
        $query = $this->db->query("SELECT * FROM status where id_karyawan = '$id'");
        return $query->result();
    }

    public function getGol($id){
        $query = $this->db->query("SELECT * FROM golongan where id_karyawan = '$id'");
        return $query->result();
    }

    public function getBerkala($id){
        $query = $this->db->query("SELECT * FROM berkala where id_karyawan = '$id'");
        return $query->result();
    }

    public function getMous($id){
         $query = $this->db->query("SELECT * from mou_sekolah where id_karyawan = '$id'");
         return $query->result();
    }

    public function getMouk($id){
        $query = $this->db->query("SELECT * from  mou_kontrak where id_karyawan = '$id'");
        return $query->result();
    }

    public function getMouh($id){
        $query = $this->db->query("SELECT * from  mou_hutang where id_karyawan = '$id'");
        return $query->result();
    }

    public function getOri($id){
        $query = $this->db->query("SELECT * from  orientasi where id_karyawan = '$id'");
        return $query->result();
    }

    public function getDiklat($id){
        $query = $this->db->query("SELECT * from diklat where id_karyawan = '$id'");
        return $query->result();
    }

    public function getKew($id){
        $query = $this->db->query("SELECT * from kewenangan_klinis where id_karyawan = '$id'");
        return $query->result();
    }
}