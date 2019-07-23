<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_user extends CI_Model
{
	//fungsi cek session
    function logged_id(){
        return $this->session->userdata('myId');
    }

    function getUser(){ // semua data pengguna yang adapada sistem
        $query= $this->db->query("SELECT * FROM karyawan as k inner join login as l on k.id_karyawan = l.id_karyawan where level = 'admin' OR level = 'Super Admin' order by k.id_karyawan  ");
        return $query->result();
    }
    function editdata($id_login){
        $query= $this->db->query("SELECT * FROM karyawan as k inner join login as l on k.id_karyawan = l.id_karyawan where id_login = '$id_login' ");
        return $query->row();
    }
}