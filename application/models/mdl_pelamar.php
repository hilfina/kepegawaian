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
    //buat detail profil di halaman pelamar
    public function getPelamarlagi($id)
    {
        
        $query = $this->db->query("SELECT k.nik, k.no_ktp, k.no_bpjs, k.nama, k.alamat, k.no_telp, k.email, k.status, k.ttl, k.jenkel, k.foto, j.nama_profesi, l.pend_akhir, l.nilai_akhir, l.cv from jenis_profesi as j inner join  karyawan as k on k.id_profesi=j.id_profesi inner join lowongan as l on l.id_karyawan=k.id_karyawan where k.id_karyawan='$id'");
        return $query->result();
    }
 //mencari pelamar yang sudah memilih loker
    public function getPelamar(){
        $query = $this->db->query("SELECT * from karyawan as k inner join jenis_profesi as jp on k.id_profesi = jp.id_profesi where id_status = 'Pelamar' group by k.id_karyawan");
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
    public function caricari($nama, $idsel){
        $query= $this->db->query("SELECT * from riwayat_seleksi where nama_tes = '$nama' && id_seleksi = $idsel");
        return $query->result();
    }
    public function carii($nama, $idsel){
        $query= $this->db->query("SELECT * from riwayat_seleksi where nama_tes = '$nama' && id_seleksi = $idsel");
        return $query->row();
    }
    public function getSeleksi($id){
        $query= $this->db->query("SELECT * from karyawan as k inner join seleksi as s on k.id_karyawan = s.id_karyawan where k.id_karyawan ='$id'");
        return $query->result();
    }
    public function getDetailpend($id){
       $query= $this->db->query("SELECT * from pendidikan as p inner join karyawan as k on p.id_karyawan = k.id_karyawan where p.id='$id'");
        return $query->result();
    }
    public function getSurat($id){
        $query= $this->db->query("SELECT s.id_sipstr, s.no_surat, j.jenis_surat, s.tgl_mulai, s.tgl_akhir, s.aktif, s.file from sip_str as s inner join jenis_surat as j on s.id_surat=j.id_surat where id_karyawan='$id'");
        return $query->result();
    }

    public function getDetailsurat($id){
        $query= $this->db->query("SELECT s.id_sipstr, j.nama_surat, j.jenis_surat, s.no_surat, s.tgl_mulai, s.tgl_akhir, s.file  from sip_str as s inner join jenis_surat as j on s.id_surat=j.id_surat where s.id_sipstr='$id'");
        return $query->result();
    }

    public function getNilai($id){
        $query= $this->db->query("SELECT * from seleksi  where id_karyawan='$id'");
        return $query->result();
    }
     public function getidKar($id){
        $query= $this->db->query("SELECT * from seleksi  where id_seleksi='$id'");
        return $query->row();
    }
    public function semuaSeleksi($id){
        $query= $this->db->query("SELECT * from seleksi  where id_seleksi='$id'");
        return $query->row();
    }
    public function semuadata($id){
        $query= $this->db->query("SELECT * from karyawan  where id_karyawan='$id'");
        return $query->row();
    }
    public function getCetak($id){
        $query= $this->db->query("SELECT * from seleksi  where id_karyawan='$id'");
        return $query->row();
    }
    public function getLoker($id){
        $tdy = date('Y-m-d');
        $year = date('Y');

        $c = $this->db->query("SELECT * from karyawan where id_karyawan = '$id'"); $dKaryawan=$c->row();
        $d = $this->db->query("SELECT * from Pendidikan where id_karyawan = '$id' order by akhir desc limit 1"); $dPen=$d->row();
        $lahir = substr($dKaryawan->ttl, 0, 4);
        $umur = $year - $lahir;

        $query = $this->db->query("SELECT * from loker as l inner join jenis_profesi as j on l.id_profesi = j.id_profesi where akhir >= '$tdy' AND mulai <= '$tdy' AND l.jenkel LIKE '%$dKaryawan->jenkel%' and ipkmin <= '$dPen->nilai' and usia >= '$umur' order by akhir desc ");
        return $query->result();
    }
}