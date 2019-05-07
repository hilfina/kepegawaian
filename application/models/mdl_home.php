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
    function maxStatus(){
         $query= $this->db->query("SELECT max(id) as max FROM jenis_status");
        return $query->row();
    }
    function getData(){
         $query= $this->db->query("SELECT * FROM jenis_status WHERE id_status != 'Pelamar' && id_status != 'Calon Karyawan'");
        return $query->result();
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
        $query= $this->db->query("SELECT count(id_loker) as banyak from loker where akhir >= '$tanggal' AND mulai <= '$tanggal'");
        return $query->row();
    }
    function seleksi(){
        $query= $this->db->query("select count(banyak) as banyak from (SELECT count(id_seleksi) as banyak from riwayat_seleksi where hasil = '-' group by id_seleksi) as jumblah");
        return $query->row();
    }
    function sipstr($tanggal){
        $query= $this->db->query("SELECT count(id_sipstr) as banyak from sip_str where tgl_akhir >= $tanggal and notif_k != 1 and mail != 1");
        return $query->row();
    }
    function mou_h($tanggal){
        $query= $this->db->query("SELECT count(id) as banyak from mou_hutang where tgl_akhir <= $tanggal and notif_k != 1 and notif != 1");
        return $query->row();
    }
    function mou_s($tanggal){
        $query= $this->db->query("SELECT count(id) as banyak from mou_sekolah where tgl_akhir <= $tanggal and notif_k != 1 and notif != 1");
        return $query->row();
    }
    function mou_k($tanggal){
        $query= $this->db->query("SELECT count(id) as banyak from mou_kontrak where tgl_akhir <= $tanggal and notif_k != 1 and notif != 1");
        return $query->row();
    }function mou_kl($tanggal){
        $query= $this->db->query("SELECT count(id) as banyak from mou_klinis where tgl_akhir <= $tanggal and notif_k != 1 and notif != 1");
        return $query->row();
    }
    function kreden($tanggal){
        $query= $this->db->query("SELECT count(id_kewenangan) as banyak from kewenangan_klinis where tgl_akhir <= $tanggal");
        return $query->row();
    }

    function surat($tanggal){
        $query= $this->db->query("SELECT * from sip_str as s inner join jenis_surat as j on s.id_surat  j.id_surat where tgl_akhir >= $tanggal");
        return $query->row();
    }
    function hutang($tanggal){
        $query= $this->db->query("SELECT * from mou_hutang where tgl_akhir <= $tanggal");
        return $query->row();
    }
    function sekolah($tanggal){
        $query= $this->db->query("SELECT * from mou_sekolah where tgl_akhir <= $tanggal");
        return $query->row();
    }
    function kontrak($tanggal){
        $query= $this->db->query("SELECT * from mou_kontrak where tgl_akhir <= $tanggal");
        return $query->row();
    }
    function sial($tanggal){
        $query= $this->db->query("SELECT * from kewenangan_klinis where tgl_akhir <= $tanggal");
        return $query->row();
    }
    //========== CARI DETAIL DATA MOU UNTUK DITAMPILKAN DI DETAIL MOU KARYAWAN PADA SAAT KLIK NOTIFIKASI======//
    function Dmou_kl($id){
        $query= $this->db->query("SELECT id, no_mou, tgl_mulai,tgl_akhir,ket, file from mou_klinis where id = $id");
        return $query->result();
    }
    function Dmou_k($id){
        $query= $this->db->query("SELECT id, no_mou, tgl_mulai,tgl_akhir,ket, gaji as jumlah, file from mou_kontrak where id = $id");
        return $query->result();
    }

    function Dmou_s($id){
        $query= $this->db->query("SELECT id, no_mou, tgl_mulai,tgl_akhir,ket, beasiswa as jumlah, file from mou_sekolah where id = $id");
        return $query->result();
    }

    function Dmou_h($id){
        $query= $this->db->query("SELECT id, no_mou, tgl_mulai,tgl_akhir,ket, nominal as jumlah, file from mou_hutang where id = $id");
        return $query->result();
    }
}