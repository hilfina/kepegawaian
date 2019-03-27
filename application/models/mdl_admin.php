<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_admin extends CI_Model
{
    //fungsi cek session
    function logged_id()
    {
        return $this->session->userdata('myId');
    }

    //SEMUA DATA PELAMAR
    public function getPelamar(){
        $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select count(k.id_karyawan) as hsl from karyawan as k inner join lowongan as l on k.id_karyawan = l.id_karyawan where id_status = 'Pelamar' || id_status = 'Pelamar Ditolak' || id_status = 'Calon Karyawan'"));
        $hasil=$data['hsl'];
        $query = $this->db->query("select * from karyawan as k inner join lowongan as l on k.id_karyawan = l.id_karyawan inner join pendidikan as p on l.id_karyawan = p.id_karyawan where id_status = 'Pelamar' || id_status = 'Pelamar Ditolak' || id_status = 'Calon Karyawan'  group by k.id_karyawan order by mulai desc limit $hasil");
        return $query->result();
    }

    function updateData($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    function updateDataS($id,$mulai){
        $query = $this->db->query("UPDATE status SET mulai='$mulai',aktif = 0 where id_karyawan = $id AND aktif = 1");
    }
    function getData($table,$where){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    function delLoker($id){
        $query = $this->db->query("DELETE FROM loker where id_loker = $id");
    }
    function delRiwayat($id){
        $query = $this->db->query("DELETE FROM riwayat where id_riwayat = $id");
    }
    function delStatus($id){
        $query = $this->db->query("DELETE FROM status where id = $id");
    }
    function delProfesi($id){
        $query = $this->db->query("DELETE FROM jenis_profesi where id_profesi = $id");
    }
    function addData($table,$data)
    {
        $query = $this->db->insert($table, $data);
    }
    // data detail pelamar
    public function cariJenisSurat($id)
    {
        $query = $this->db->query("SELECT * from sip_str as s inner join jenis_surat as j on s.id_surat = j.id_surat where s.id_karyawan = $id");
        return $query->result();
    }

    public function getSeleksi(){
         $query = $this->db->query("SELECT * from seleksi as x inner join karyawan on x.id_karyawan = karyawan.id_karyawan where id_status = 'Pelamar' || id_status = 'Calon Karyawan'");
        return $query->result();
    }

    public function getProfesi(){
        $query = $this->db->query("SELECT * from jenis_profesi");
        return $query->result();
    }
    public function getRiwayat(){
        $query = $this->db->query("SELECT * from riwayat as r inner join karyawan as k on r.id_karyawan = k.id_karyawan");
        return $query->result();
    }
    public function getKaryawan(){
        $query = $this->db->query("SELECT * from karyawan where id_status != 'Pelamar' AND id_status!='Calon Karyawan' AND id_status != 'Pelamar Ditolak'");
        return $query->result();
    }
    public function getLoker(){
        $query = $this->db->query("SELECT * from loker as l inner join jenis_profesi as j on l.id_profesi = j.id_profesi");
        return $query->result();
    }
    public function getJenSur(){
        $query = $this->db->query("SELECT nama_surat from jenis_Surat");
        return $query->result();
    }
    public function getTempat($id){
        $query = $this->db->query("SELECT * from karyawan as k inner join riwayat as r on k.id_karyawan = r.id_karyawan where k.id_karyawan = $id order by r.mulai desc limit 1");
        return $query->result();
    }
    public function getEditRi($id){
        $query = $this->db->query("SELECT * from karyawan as k inner join riwayat as r on k.id_karyawan = r.id_karyawan inner join jenis_profesi as j on r.id_profesi = j.id_profesi where r.id_riwayat = $id");
        return $query->result();
    }

    public function getStatus(){
        $query = $this->db->query("SELECT * from status as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getAllStatus(){
        $query = $this->db->query("SELECT * from jenis_status where id_status != 'Admin' AND id_status != 'Calon Karyawan' AND id_status != 'Pelamar' AND id_status != 'Pelamar Ditolak'");
        return $query->result();
    }
}
 