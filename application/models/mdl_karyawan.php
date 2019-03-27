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
    public function getKaryawan($id){
        $query = $this->db->query("SELECT * FROM karyawan");
        return $query->result();
    }

    public function getStatus($id){
        $query = $this->db->query("SELECT * FROM status");
        return $query->result();
    }

    public function getGol($id){
        $query = $this->db->query("SELECT * FROM golongan");
        return $query->result();
    }

    public function getBerkala($id){
        $query = $this->db->query("SELECT * FROM berkala");
        return $query->result();
    }
}