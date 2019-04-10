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
        $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select count(k.id_karyawan) as hsl from karyawan as k inner join lowongan as l on k.id_karyawan = l.id_karyawan where id_status = 'Pelamar' || id_status = 'Pelamar Ditolak' || id_status = 'Calon Karyawan' || id_profesi = 'Belum'"));
        $hasil=$data['hsl'];
        $query = $this->db->query("select * from karyawan as k inner join lowongan as l on k.id_karyawan = l.id_karyawan inner join pendidikan as p on l.id_karyawan = p.id_karyawan where id_status = 'Pelamar' || id_status = 'Pelamar Ditolak' || id_status = 'Calon Karyawan' group by k.id_karyawan order by mulai desc limit $hasil");
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

    function getAlldata($table){
        $this->db->select("*");
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result();
    }

    function getPendidikan(){
        $query = $this->db->query("SELECT * FROM pendidikan as p INNER JOIN karyawan as k on k.id_karyawan=p.id_karyawan ORDER by verifikasi  ASC ");
        return $query->result();
    }

    function getSurat(){
        $query = $this->db->query("SELECT * FROM karyawan as k INNER JOIN sip_str as p on k.id_karyawan=p.id_karyawan inner join jenis_surat as s ON p.id_surat=s.id_surat ORDER by p.tgl_akhir asc ");
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
        $query = $this->db->query("SELECT * from karyawan as k inner join login as l on k.id_karyawan=l.id_karyawan where k.id_status != 'Pelamar' AND k.id_status!='Calon Karyawan' AND k.id_status != 'Pelamar Ditolak' AND l.level != 'admin'");
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
    public function getAllStatus(){
        $query = $this->db->query("SELECT * from status as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getStatus($id){
        $query = $this->db->query("SELECT * from karyawan as k inner join status as r on k.id_karyawan = r.id_karyawan inner join jenis_status as j on r.id_status = j.id_status where r.id = $id");
        return $query->result();
    }

    public function getJenStatus(){
        $query = $this->db->query("SELECT * from jenis_status where id_status != 'Admin' AND id_status != 'Calon Karyawan' AND id_status != 'Pelamar' AND id_status != 'Pelamar Ditolak'");
        return $query->result();
    }

    public function getGol(){
        $query = $this->db->query("SELECT * from golongan as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getGoledit($id){
        $query = $this->db->query("SELECT * from golongan as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id = $id");
        return $query->result();
    }

    public function getBerkala(){
        $query = $this->db->query("SELECT * from berkala as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getBerkalaedit($id){
        $query = $this->db->query("SELECT * from berkala as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id = $id");
        return $query->result();
    }

    public function getHutang(){
        $query = $this->db->query("SELECT * from mou_hutang as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getHutangedit($id){
        $query = $this->db->query("SELECT * from mou_hutang as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id = $id");
        return $query->result();
    }

    public function getKontrak(){
        $query = $this->db->query("SELECT * from mou_kontrak as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getKontrakedit($id){
        $query = $this->db->query("SELECT * from mou_kontrak as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id = $id");
        return $query->result();
    }

    public function getSekolah(){
        $query = $this->db->query("SELECT * from mou_sekolah as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getSekolahedit($id){
        $query = $this->db->query("SELECT * from mou_sekolah as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id = $id");
        return $query->result();
    }

    public function getOri(){
        $query = $this->db->query("SELECT * from orientasi as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getOriedit($id){
        $query = $this->db->query("SELECT * from orientasi as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id = $id");
        return $query->result();
    }

    public function getKew(){
        $query = $this->db->query("SELECT * from kewenangan_klinis as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getKewedit($id){
        $query = $this->db->query("SELECT * from kewenangan_klinis as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id = $id");
        return $query->result();
    }

}
 