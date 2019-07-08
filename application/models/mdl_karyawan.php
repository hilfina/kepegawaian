<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_karyawan extends CI_Model
{
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
    public function getGol($id){
        $query = $this->db->query("SELECT * FROM golongan where id_golongan != 'Tidak Ada' && id_karyawan = '$id'  ");
        return $query->result();
    }
    //menampilkan seluruh sipstr hanya 1 karyawan
    function getSurat($id){
        $query = $this->db->query("SELECT * FROM karyawan as k INNER JOIN sip_str as p on k.id_karyawan=p.id_karyawan inner join jenis_surat as s ON p.id_surat=s.id_surat where k.id_karyawan = '$id' ORDER by p.tgl_akhir asc ");
        return $query->result();
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    
    function delSurat($id){
        $this->db->query("DELETE FROM sip_str where id_sipstr = '$id'");
    }

    function getDetailSur($id){
        $query = $this->db->query("SELECT * FROM karyawan as k inner join sip_str as s on k.id_karyawan = s.id_karyawan inner join jenis_surat as j on s.id_surat = j.id_surat where id_sipstr = '$id'");
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
    public function getaDiklat(){//untuk menampilkan data diklat di admin
        $tdy = date('Y-m-d');
        $query = $this->db->query("SELECT k.id_karyawan, k.nik, k.nama, k.id_profesi, r.ruangan, k.id_status, sum(d.jam) as jam from diklat as d INNER JOIN karyawan as k on k.id_karyawan=d.id_karyawan inner join riwayat as r on k.id_karyawan=r.id_karyawan where akhir >= '$tdy' AND mulai <= '$tdy' GROUP by d.id_karyawan");
        return $query->result();
    }
    public function detDiklat($id){//untuk menampilkan data detail diklat di admin
        $query = $this->db->query("SELECT * from diklat as d INNER JOIN karyawan as k on k.id_karyawan=d.id_karyawan WHERE id_diklat = '$id'");
        return $query->result();
    }
    public function lastStatus($id){
        $last = $this->db->query("SELECT id FROM status order by mulai desc limit 1");
        $getlast = $last->row();
        $tdy = date('Y-m-d');
        $this->db->query("UPDATE status SET notif = 1 , akhir = '$tdy' where id = '$getlast->id'");
    }
}