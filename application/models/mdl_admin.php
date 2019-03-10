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


    function getData($table,$where){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
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

    public function getSeleksi($table){
         $query = $this->db->query("SELECT * from $table as x inner join karyawan where x.id_karyawan = karyawan.id_karyawan");
        return $query->result();
    }

    public function getProfesi(){
        $query = $this->db->query("SELECT * from jenis_profesi");
        return $query->result();
    }
    public function getJenSur(){
        $query = $this->db->query("SELECT nama_surat from jenis_Surat");
        return $query->result();
    }
}
