<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_login extends CI_Model
{
	//fungsi cek session
    function logged_id(){ return $this->session->userdata('myId'); }
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
    //menampilkan peluang karir di halaman login
    public function getLoker(){
        $tdy = date('Y-m-d');//tanggal sekarang
        $query = $this->db->query("SELECT * from loker as l inner join jenis_profesi as j on l.id_profesi = j.id_profesi where akhir >= '$tdy' AND mulai <= '$tdy' order by akhir desc");
        return $query->result();
    }
    //mencari id karyawan terakhir
    function getlast(){
        $query = $this->db->query('select max(id_karyawan) as id_karyawan from karyawan');
        return $query->result_array();
    }
    //menyimpan data pendaftar
    function daftar($table,$data){
        $query = $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function getProfesi(){
        return $this->db->get('jenis_profesi');
    }    

    function changeActiveState($key){
        $this->load->database();
        $data = array('aktif' => 1 );
        $this->db->where('id_karyawan', $key);
        $this->db->update('login', $data);
        return true;
    }
}