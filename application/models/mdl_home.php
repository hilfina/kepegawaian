<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_home extends CI_Model
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

    function karyawan(){
        $query= $this->db->query("SELECT count(k.id_karyawan) as banyak from karyawan as k inner join login as l on k.id_karyawan = l.id_karyawan where id_status != 'Calon Karyawan' AND id_status != 'Pelamar' AND level != 'admin'");
        return $query->row();
    }
    function pelamar(){
        $query= $this->db->query("SELECT count(id_karyawan) as banyak from karyawan where id_status = 'Pelamar'");
        return $query->row();
    }
    function calon(){
        $query= $this->db->query("SELECT count(id_karyawan) as banyak from karyawan where id_status = 'Calon Karyawan'");
        return $query->row();
    }
    function loker($tanggal){
        $query= $this->db->query("SELECT count(id_loker) as banyak from loker where akhir > '$tanggal' AND mulai < '$tanggal'");
        return $query->row();
    }
    function seleksi(){
        $query= $this->db->query("select count(banyak) as banyak from (SELECT count(id_seleksi) as banyak from riwayat_seleksi where hasil = '-' group by id_seleksi) as jumblah");
        return $query->row();
    }
    function sipstr($tanggal){
        $query= $this->db->query("SELECT count(id_sipstr) as banyak from sip_str where tgl_akhir >= $tanggal");
        return $query->row();
    }
    function mou_h($tanggal){
        $query= $this->db->query("SELECT count(id) as banyak from mou_hutang where tgl_akhir >= $tanggal");
        return $query->row();
    }
    function mou_s($tanggal){
        $query= $this->db->query("SELECT count(id) as banyak from mou_sekolah where tgl_akhir >= $tanggal");
        return $query->row();
    }
    function mou_k($tanggal){
        $query= $this->db->query("SELECT count(id) as banyak from mou_kontrak where tgl_akhir >= $tanggal");
        return $query->row();
    }
}