<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_admin extends CI_Model
{
    //fungsi cek session
    function logged_id()
    {
        return $this->session->userdata('myId');
    }

    //SEMUA DATA PELAMAR DAN CALON KARYAWAN
    public function getPelamar($id){
       // $cariL = $this->db->query("select count(k.id_karyawan) as hsl from karyawan as k inner join lowongan as l on k.id_karyawan = l.id_karyawan where id_status = 'Pelamar' || id_status = 'Pelamar Ditolak' || id_status = 'Calon Karyawan' || id_profesi = 'Belum'");
       //  $cariLimit = $cariL->row();
       
        // $query = $this->db->query("SELECT * from karyawan as k inner join lowongan as l on k.id_karyawan = l.id_karyawan inner join pendidikan as p on l.id_karyawan = p.id_karyawan inner join jenis_profesi as jp on k.id_profesi = jp.id_profesi where id_status = 'Pelamar' || id_status = 'Pelamar Ditolak' || id_status = 'Calon Karyawan' group by k.id_karyawan order by mulai desc limit $cariLimit->hsl");
        $query = $this->db->query("SELECT k.id_karyawan, k.nama, k.jenkel, k.ttl, p.pendidikan, l.pend_akhir, p.jurusan, l.nilai_akhir, p.akhir from karyawan as k inner join lowongan as l on k.id_karyawan = l.id_karyawan inner join pendidikan as p on l.id_karyawan = p.id_karyawan inner join jenis_profesi as jp on k.id_profesi = jp.id_profesi where k.id_status = 'Pelamar' && k.id_profesi = '$id' group by k.id_karyawan ");
        return $query->result();
    }
    //SEMUA DATA PELAMAR SAJA
    public function getPelamar2(){
        $cariL = $this->db->query("select count(k.id_karyawan) as hsl from karyawan as k inner join lowongan as l on k.id_karyawan = l.id_karyawan where id_status = 'Pelamar' || id_status = 'Pelamar Ditolak' || id_status = 'Calon Karyawan' || id_profesi = 'Belum'");
        $cariLimit = $cariL->row();
        $query = $this->db->query("SELECT * from karyawan as k inner join lowongan as l on k.id_karyawan = l.id_karyawan inner join pendidikan as p on l.id_karyawan = p.id_karyawan inner join jenis_profesi as jp on k.id_profesi = jp.id_profesi where id_status = 'Pelamar' and k.id_profesi != 'Belum' group by k.id_karyawan order by mulai desc limit $cariLimit->hsl");
        return $query->result();
    }
    //SEMUA DATA CALON KARYAWAN SAJA
    public function getCakar(){
       $cariL = $this->db->query("select count(k.id_karyawan) as hsl from karyawan as k inner join lowongan as l on k.id_karyawan = l.id_karyawan where id_status = 'Pelamar' || id_status = 'Pelamar Ditolak' || id_status = 'Calon Karyawan' || id_profesi = 'Belum'");
        $cariLimit = $cariL->row();
        $query = $this->db->query("SELECT * from karyawan as k inner join lowongan as l on k.id_karyawan = l.id_karyawan inner join pendidikan as p on l.id_karyawan = p.id_karyawan where id_status = 'Calon Karyawan' group by k.id_karyawan order by mulai desc limit $cariLimit->hsl");
        return $query->result();
    }


    //DATA PELAMAR SESUAI PROFESI
    public function getLamar(){
        $query = $this->db->query("SELECT l.id_profesi, p.nama_profesi, l.akhir, count(k.id_karyawan) as jmlh from karyawan as k inner join loker as l on k.id_profesi=l.id_profesi inner join jenis_profesi as p on p.id_profesi=l.id_profesi WHERE k.id_status = 'Pelamar' group by l.id_profesi
            "); 
        return $query->result();
    }

    public function cariprofesi($id){
        $query = $this->db->query("SELECT nama_profesi FROM jenis_profesi where id_profesi='$id';");
        return $query->row();
    }

    function resumeDiklat(){
         $query = $this->db->query("SELECT * FROM karyawan as k INNER JOIN diklat as p on k.id_karyawan=p.id_karyawan");
        return $query->result();
    }
    function updateData($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    function updateDataS($id,$mulai){
        $query = $this->db->query("UPDATE status SET mulai='$mulai',aktif = 0 where id_karyawan = $id AND aktif = 1");
    }
    //edit tabel riwayat untuk detai riwayat dari admin (cntrlr=adminKaryawan,fgc=editData)
    //
    function updateProf($ruangan,$id_profesi, $id){
        $query = $this->db->query("UPDATE riwayat SET ruangan='$ruangan', id_profesi = '$id_profesi' where id_riwayat = $id");
    }
    function updateStat($id_status,$id_karyawan){
        $query = $this->db->query("UPDATE status SET id_status = '$id_status' where id_karyawan = $id_karyawan AND aktif = 1 ");
    }
    function updateGol($id_golongan,$id_karyawan){
        $query = $this->db->query("UPDATE golongan SET id_golongan = '$id_golongan' where id_karyawan = $id_karyawan AND aktif = 1 ");
    }
    function getData($table,$where){
        $this->db->SELECT("*");
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
     function getData2($table,$where){
        $this->db->SELECT("*");
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    function getAlldata($table){
        $this->db->SELECT("*");
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
    function getSurat2(){
        $tanggal = date('Y-m-d');
        $query = $this->db->query("SELECT * FROM karyawan as k INNER JOIN sip_str as p on k.id_karyawan=p.id_karyawan inner join jenis_surat as s ON p.id_surat=s.id_surat where tgl_akhir < '$tanggal' ORDER by p.tgl_akhir asc ");
        return $query->result();
    }

    function delLoker($id){
        $query = $this->db->query("DELETE FROM loker where id_loker = $id");
    }
    function delPend($id){
        $query = $this->db->query("DELETE FROM pendidikan where id = $id");
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
        $query = $this->db->query("SELECT k.id_karyawan as id_karyawan, r.id_seleksi, nama, nama_tes, tgl_seleksi, hasil, nilai_agama, nilai_kompetensi, nilai_wawancara, tes_psikologi, tes_kesehatan from karyawan as k inner join seleksi as s on k.id_karyawan = s.id_karyawan inner join riwayat_seleksi as r on s.id_seleksi = r.id_seleksi where (id_status='Pelamar' OR id_status ='Calon Karyawan') AND tanggal = tgl_seleksi group by nama");
        return $query->result();
    }
    public function detSeleksi($id){
         $query = $this->db->query("SELECT k.id_karyawan as id_karyawan, k.foto as foto, k.id_status as id_status, k.id_profesi as id_profesi, k.id_golongan as id_golongan, x.id_seleksi as id_seleksi, x.tgl_seleksi as tgl_seleksi, x.nilai_agama as nilai_agama, x.nilai_kompetensi as nilai_kompetensi, x.tes_ppa as tes_ppa, x.tes_psikologi as tes_psikologi, x.tes_kesehatan as tes_kesehatan, x.nilai_wawancara as nilai_wawancara from seleksi as x inner join karyawan as k on x.id_karyawan = k.id_karyawan where k.id_karyawan = '$id'");
        return $query->result();
    }
    public function getProfesi2($id){
        $query = $this->db->query("SELECT j.nama_profesi as nama_profesi from karyawan as k inner join jenis_profesi as j on k.id_profesi = j.id_profesi where id_karyawan = '$id'");
        return $query->row();
    }
    public function getProfesi(){
        $query = $this->db->query("SELECT * from jenis_profesi as j where id_profesi != 'Belum'");
        return $query->result();
    }
    public function getRiwayat($id){
        $query = $this->db->query("SELECT * from karyawan as k inner join riwayat as r on k.id_karyawan = r.id_karyawan where r.id_karyawan = '$id'");
        return $query->result();
    }
    public function getKaryawan(){
        $query = $this->db->query("SELECT * from karyawan as k inner join login as l on k.id_karyawan=l.id_karyawan inner join jenis_profesi as j on k.id_profesi = j.id_profesi where k.id_status != 'Pelamar' AND k.id_status !='Calon Karyawan' AND k.id_status != 'Pelamar Ditolak' AND l.level != 'admin' AND l.level != 'Super Admin' AND k.id_status != 'Pensiun'  AND k.id_status != 'Keluar'  order by k.nama asc");
        return $query->result();
    }

    public function getLoker(){
        $query = $this->db->query("SELECT * from loker as l inner join jenis_profesi as j on l.id_profesi = j.id_profesi order by akhir desc");
        return $query->result();
    }
    public function getLoker2(){
        $tdy = date('Y-m-d');
        $query = $this->db->query("SELECT * from loker as l inner join jenis_profesi as j on l.id_profesi = j.id_profesi where akhir >= '$tdy' AND mulai <= '$tdy' order by akhir desc");
        return $query->result();
    }
    public function getJenSur(){
        $query = $this->db->query("SELECT nama_surat from jenis_Surat");
        return $query->result();
    }
    public function getTempat($id){
        $query = $this->db->query("SELECT * from karyawan as k inner join riwayat as r on k.id_karyawan = r.id_karyawan inner join jenis_profesi as j on k.id_profesi = j.id_profesi inner join jabatan as jb on k.jabatan = jb.id where k.id_karyawan = $id order by r.mulai desc limit 1");
        return $query->result();
    }
    public function getEditRi($id){
        $query = $this->db->query("SELECT * from karyawan as k inner join riwayat as r on k.id_karyawan = r.id_karyawan where r.id_riwayat = $id");
        return $query->result();
    }
    public function getAllStatus($id){
        $query = $this->db->query("SELECT s.id, j.id_status, s.mulai, s.akhir, s.nomor_sk, s.alamat_sk, s.id_karyawan from status as s inner join karyawan as k on k.id_karyawan = s.id_karyawan inner join jenis_status as j on s.id_status = j.id_status where s.id_karyawan = '$id'");
        return $query->result();
    }

    public function getStatus($id){
        $query = $this->db->query("SELECT r.id_status, k.nik, k.nama, r.id_karyawan, r.mulai, r.akhir, r.alamat_sk, r.nomor_sk, r.id from karyawan as k inner join status as r on k.id_karyawan = r.id_karyawan inner join jenis_status as j on r.id_status = j.id_status where r.id = $id");
        return $query->result();
    }

    public function getJenStatus(){
        $query = $this->db->query("SELECT * from jenis_status where id_status != 'Admin' AND id_status != 'Calon Karyawan' AND id_status != 'Pelamar' AND id_status != 'Pelamar Ditolak'");
        return $query->result();
    }

    public function getGol($id){
        $query = $this->db->query("SELECT s.id_karyawan, k.nik, k.nama, k.id_profesi, s.id_golongan, s.nomor_sk, s.alamat_sk, s.mulai, s.akhir, s.id from golongan as s inner join karyawan as k on k.id_karyawan = s.id_karyawan where s.id_golongan != 'Tidak Ada' && s.id_karyawan = '$id'");
        return $query->result();
    }
    public function getJab($id){
        $query = $this->db->query("SELECT j.jabatan as jabatan from jabatan as j inner join karyawan as k on k.jabatan = j.id where k.id_karyawan = '$id'");
        return $query->row();
    }

    public function getGoledit($id){
        $query = $this->db->query("SELECT s.id_karyawan, k.nik, k.nama, s.id, s.nomor_sk, s.id_golongan, s.mulai, s.akhir, s.alamat_sk from golongan as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id = $id");
        return $query->result();
    }

    public function getBerkala($id){
        $query = $this->db->query("SELECT * from berkala as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id_karyawan = '$id'");
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
        $query = $this->db->query("SELECT * from orientasi as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id_orientasi = $id");
        return $query->result();
    }

    public function getDiklat(){
        $query = $this->db->query("SELECT d.id_diklat, k.id_karyawan, k.nik, k.nama, k.id_status, k.id_profesi, k.id_golongan, sum(d.jam) as jam from diklat as d INNER JOIN karyawan as k on k.id_karyawan=d.id_karyawan GROUP by d.id_karyawan");
        return $query->result();
    }

    public function getGolongan(){
        $query = $this->db->query("SELECT * from jenis_golongan");
        return $query->result();
    }

    public function getKew(){
        $query = $this->db->query("SELECT * from kewenangan_klinis as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getKewedit($id){
        $query = $this->db->query("SELECT * from kewenangan_klinis as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id_kewenangan = $id");
        return $query->result();
    }

    public function editRSel($idS,$nama,$hasil){
        $this->db->query("UPDATE riwayat_seleksi SET hasil='$hasil' where id_seleksi = $idS AND nama_tes = '$nama'");
    }

    public function getKlinis(){
        $query = $this->db->query("SELECT * from mou_klinis as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getKlinisedit($id){
        $query = $this->db->query("SELECT * from mou_klinis as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id = $id");
        return $query->result();
    }

    public function getPelatihan(){
        $query = $this->db->query("SELECT * from mou_pelatihan as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getPelatihanedit($id){
        $query = $this->db->query("SELECT * from mou_pelatihan as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id = $id");
        return $query->result();
    }

    public function getinstansiedit($id){
        $query = $this->db->query("SELECT * from mou_instansi as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id = $id");
        return $query->result();
    }

    public function getUrgas(){
        $query = $this->db->query("SELECT * from uraian_tugas as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getUrgasedit($id){
        $query = $this->db->query("SELECT s.id_uraian, s.file_urgas, s.id_karyawan, k.nik, k.nama from uraian_tugas as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id_uraian = $id");
        return $query->result();
    }

    public function getaBerkala(){
        $query = $this->db->query("SELECT k.id_karyawan, k.nik, k.nama, k.id_status, k.id_profesi from berkala as s inner join karyawan as k on s.id_karyawan = k.id_karyawan");
        return $query->result();
    }

    public function getPenilaian($id){
        $query = $this->db->query("SELECT * from penilaian_karyawan as s inner join karyawan as k on s.id_karyawan = k.id_karyawan where s.id_karyawan = $id");
        return $query->result();
    }

    public function getPenilaianedit($id){
        $query = $this->db->query("SELECT * from penilaian_karyawan as s inner join karyawan as k on s.id_penilai = k.id_karyawan where s.id = $id");
        return $query->row();
    }

    public function karir($id){
        $query = $this->db->query("SELECT mulai, ruangan from riwayat where id_karyawan = $id;
        SELECT mulai, id_status from status where id_karyawan = $id;
        SELECT mulai, id_golongan from golongan where id_karyawan = $id;
        SELECT mulai, berkala from berkala where id_karyawan = $id;
        GROUP BY mulai order by mulai");
        return $query->result();
    }
    public function getAgama($id){
        $query = $this->db->query("SELECT * from riwayat_seleksi as r inner join seleksi as s on r.id_seleksi = s.id_seleksi where s.id_karyawan = $id AND nama_tes != 'Tes Psikologi' AND nama_tes != 'Tes Tulis' and nama_tes != 'Wawancara' and nama_tes != 'Tes Kesehatan' ORDER BY tanggal DESC ");
        return $query->result();
    }
    public function getAgamaa($id){
        $query = $this->db->query("SELECT * from riwayat_seleksi as r inner join seleksi as s on r.id_seleksi = s.id_seleksi where id = $id");
        return $query->row();
    }
    public function getKC($id){ //Kuota cuti
        $query = $this->db->query("SELECT kuota_cuti from jenis_status as r inner join karyawan as s on r.id_status = s.id_status where id_karyawan = $id");
        return $query->row();
    }
    public function getTC($id,$thn){ //Total cuti
        $query = $this->db->query("SELECT sum(datediff(tgl_awal, tgl_akhir)) as selisih from data_cuti where id_karyawan = $id AND ket Like 'Cuti%' AND tgl_awal Like '$thn%'");
        return $query->row();
    }
    public function getDC($id){ //Data cuti
        $query = $this->db->query("SELECT datediff(tgl_awal, tgl_akhir) as selisih, tgl_awal, tgl_akhir, id, id_karyawan,file,ket from data_cuti where id_karyawan = $id ORDER BY tgl_awal DESC");
        return $query->result();
    }
    public function getEC($id){ //Edit cuti
        $query = $this->db->query("SELECT * from data_cuti where id = $id ");
        return $query->result();
    }
    public function dataDiri($id){
        $query = $this->db->query("SELECT * from karyawan as k inner join riwayat as r on k.id_karyawan = r.id_karyawan inner join jenis_profesi as j on r.id_profesi = j.id_profesi inner join login as l on k.id_karyawan=l.id_karyawan where k.id_karyawan = $id order by r.mulai desc ");
        return $query->row();
    }

    public function impor($table, $data)
    {
        $this->db->insert_batch($table, $data);
        return $this->db->insert_id();
    }

    public function getreport(){ //cetak pelamar yang fix 
        $query = $this->db->query("SELECT k.nama, j.nama_profesi, s.nilai_wawancara, s.nilai_kompetensi, s.tes_kesehatan, s.tes_psikologi, s.nilai_agama from seleksi as s inner join karyawan as k on s.id_karyawan = k.id_karyawan inner join jenis_profesi as j on k.id_profesi=j.id_profesi where k.id_status = 'Calon Karyawan' ");
        return $query->result();
    }

    public function aKon($id){ //tanggal awal karyawan menjadi kontrak
        $query = $this->db->query("SELECT MIN(mulai) as tgl FROM status WHERE id_karyawan = '$id' AND id_status = 'Kontrak'");
        return $query->row();
    }
    public function updatelogin($array, $id)
    {
        $this->db->where('id_karyawan', $id);
        $this->db->where('level', 'Karyawan');
        $query = $this->db->update('login',$array);

    }

}
 