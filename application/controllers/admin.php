<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	private $filename = "import_data";
	public function __construct()
	{
		parent::__construct();
        $this->load->model('mdl_login');
        $this->load->model('mdl_pelamar');
        $this->load->model('mdl_karyawan');
        $this->load->model('mdl_admin');
        $this->load->model('mdl_home');
        $this->load->model('mdl_user');
        $this->load->helper('url','form','file','custom');
        $this->load->library('form_validation','image_lib');
        $this->load->helper(array('url','download', 'form', 'file','custom'));
        $this->load->library('email');
        if($this->mdl_admin->logged_id() == null) { redirect("login"); }
	}
	public function index()
	{
		if($this->mdl_admin->logged_id())
		{
			$paket['array']=$this->mdl_admin->getPelamar();
            $this->load->view('admin/pelamar/allPelamar',$paket);
		}else{redirect("login");}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

    public function verPend($id,$idk){      //vefifikasi ijasah
       if($this->mdl_admin->logged_id())
        {
            $where = array( 'id' => $id ); 
            $data = array( 'verifikasi' => 1 ); 
            $this->mdl_admin->updateData($where,$data,'pendidikan');
            redirect("adminPendidikan");
        }
        else{ redirect("login"); } 
    }

    public function dataSeleksi(){//data seleksi pelamar yang sedang dalam proses
       if($this->mdl_admin->logged_id())
        {
            $paket['array']= $this->mdl_admin->getSeleksi();
            $this->load->view('admin/pelamar/allSeleksi',$paket);
        }
        else{ redirect("login"); } 
    }
    
    public function detSeleksi($id_karyawan){ //detail dari data seleksi pelamat
       if($this->mdl_admin->logged_id())
        {       
            $where = array( 'id_karyawan' => $id_karyawan);
            $paket['datDir']=$this->mdl_admin->getData('karyawan',$where);//nama,id,profesi pelamar
            $paket['datSel']=$this->mdl_admin->detSeleksi($id_karyawan);

            if ($this->mdl_admin->detSeleksi($id_karyawan)) {
                $this->db->select('*');
                $this->db->from('seleksi');
                $this->db->where('id_karyawan', $id_karyawan);
                $s = $this->db->get()->row();

                //DATA SELEKSI YANG ADA DI RIWAYAT SELEKSI
                $paket['wawa']=$this->mdl_pelamar->carii('Wawancara',$s->id_seleksi);
                $paket['psiko']=$this->mdl_pelamar->carii('Tes Psikologi',$s->id_seleksi);
                $paket['tulis']=$this->mdl_pelamar->carii('Tes Tulis',$s->id_seleksi);
                $paket['sehat']=$this->mdl_pelamar->carii('Tes Kesehatan',$s->id_seleksi);
                $paket['shalat']=$this->mdl_pelamar->carii('Tes Toharoh dan Shalat',$s->id_seleksi);
                $paket['doa']=$this->mdl_pelamar->carii('Doa Sehari-hari',$s->id_seleksi);
                $paket['bimbing']=$this->mdl_pelamar->carii('Tes Ibadah Praktis',$s->id_seleksi);
                $paket['baca']=$this->mdl_pelamar->carii('Baca Al-Quran',$s->id_seleksi);
                $paket['semua']=$this->mdl_pelamar->semuaSeleksi($s->id_seleksi);

                $where2 = array( 'id_seleksi' => $s->id_seleksi);
            }else{$where2 = array( 'id_seleksi' => '0');}
            
            $paket['datSel']=$this->mdl_admin->getData('seleksi',$where);
            $paket['datRSel']=$this->mdl_admin->getData('riwayat_seleksi',$where2);
            $this->load->view('admin/pelamar/detailSeleksi',$paket);
        }else{ redirect("login"); } 
    } 

    //EDIT DATA SELEKSI
    public function editDataSel(){
        if($this->mdl_admin->logged_id()) {   
            $config['upload_path']      = './Assets/dokumen/';
            $config['allowed_types']    = 'jpg|png';
            $config['max_size']         = 2000;
            $config['max_width']        = 10240;
            $config['max_height']       = 7680;            
            $this->load->library('upload', $config);

            $id_karyawan=$this->input->post('idKSel');

            //cari data seleksi karyawan yang dipilih
            $this->db->select('tes_ppa');
            $this->db->from('seleksi');
            $this->db->where('id_karyawan', $id_karyawan);
            $s = $this->db->get()->row();

            if ($this->upload->do_upload('file')) { //jika upload file ppa
                $data_ppa = $this->upload->data('file_name'); 
            }else {//jika tidak
                $data_ppa = $s->tes_ppa;
            }   

            $tp_sel = $data_ppa;   
            $idSel = $this->input->post('idSel');     
            $tgl = $this->input->post('tgl');
            $wawancara = $this->input->post('wawancara');
            $tulis = $this->input->post('tulis');
            $psikologi = $this->input->post('psikologi');
            $kesehatan = $this->input->post('kesehatan');
            $doa = $this->input->post('doa');
            $shalat = $this->input->post('shalat');
            $bimbing = $this->input->post('bimbing');
            $baca = $this->input->post('baca');

            if ($this->mdl_pelamar->caricari('Tes Tulis',$idSel)) {//jika di riwayat sudah ada tes tulis
                $this->mdl_admin->editRSel($idSel,'Tes Tulis', $tulis);//maka edit hasil tes tulis
            }
            elseif ($tgl != "0000-00-00" && $tulis == "-") { //jika tanggal sudah diisi dan tes tulis masih kosong
                $dataRSel = array(
                    'id_seleksi' => $idSel,
                    'nama_tes' => 'Tes Tulis',
                    'hasil' => $tulis, //nilai masih -
                    'tanggal' => $tgl
                );
                $this->mdl_admin->addData('riwayat_seleksi',$dataRSel);//tambah data riwayat seleksi tes tulis 
            }elseif ($tgl != "0000-00-00" && $tulis != "-") { //jika tanggal dan nilai tulis sudah diisi
                $this->mdl_admin->editRSel($idSel,'Tes Tulis', $tulis); //edit hasil tes tulis di riwayat seleksi
            }

            if ($this->mdl_pelamar->caricari('Wawancara',$idSel)) {
                $this->mdl_admin->editRSel($idSel,'Wawancara', $wawancara);
            }
            elseif ($tgl != "0000-00-00" && $tulis != "-") {
                //data Riwayat Seleksi
                $dataRSel = array(
                    'id_seleksi' => $idSel,
                    'nama_tes' => 'Wawancara',
                    'hasil' => $wawancara,
                    'tanggal' => $tgl
                );
                $this->mdl_admin->addData('riwayat_seleksi',$dataRSel);
            }elseif ($tgl != "0000-00-00" && $wawancara != "-") {
                $this->mdl_admin->editRSel($idSel,'Wawancara',$wawancara);
            }

            $konek = mysqli_connect("localhost","root","","kepegawaian");
            //$b = mysqli_fetch_array(mysqli_query($konek,"select * from riwayat_seleksi where id_seleksi = $idSel && nama_tes = 'Wawancara'")); 

            $this->db->select('*');
            $this->db->from('riwayat_seleksi');
            $this->db->where('id_seleksi', $idSel);
            $this->db->where('nama_tes', 'wawancara');
            $b = $this->db->get()->row();

            if ($this->mdl_pelamar->caricari('Tes Psikologi',$idSel)) {
                $this->mdl_admin->editRSel($idSel,'Tes Psikologi', $psikologi);
            }
            elseif ($tgl != $b->tanggal && $wawancara >= 10 && $psikologi == "-") {
                //data Riwayat Seleksi
                $dataRSel = array(
                    'id_seleksi' => $idSel,
                    'nama_tes' => 'Tes Psikologi',
                    'hasil' => $psikologi,
                    'tanggal' => $tgl
                );
                $this->mdl_admin->addData('riwayat_seleksi',$dataRSel);
            }elseif ($psikologi != "-") {
                $this->mdl_admin->editRSel($idSel,'Tes Psikologi', $psikologi);
            }
            $c = mysqli_fetch_array(mysqli_query($konek,"select * from riwayat_seleksi where id_seleksi = $idSel && nama_tes = 'Tes Psikologi'"));

            if ($this->mdl_pelamar->caricari('Tes Toharoh dan Shalat',$idSel)) {
                $this->mdl_admin->editRSel($idSel,'Tes Toharoh dan Shalat', $shalat);
            }
            elseif ($tgl != $c['tanggal'] && $c['hasil'] == "Lulus" && $shalat == "-") {
                //data Riwayat Seleksi
                $dataRSel = array(
                    'id_seleksi' => $idSel,
                    'nama_tes' => 'Tes Toharoh dan Shalat',
                    'hasil' => $shalat,
                    'tanggal' => $tgl
                );
                $this->mdl_admin->addData('riwayat_seleksi',$dataRSel);
            }elseif ($shalat != "-") {
                $this->mdl_admin->editRSel($idSel,'Tes Toharoh dan Shalat', $shalat);
            } 

            if ($this->mdl_pelamar->caricari('Doa Sehari-hari',$idSel)) {
                $this->mdl_admin->editRSel($idSel,'Doa Sehari-hari', $doa);
            }
            elseif ($tgl != $c['tanggal'] && $c['hasil'] == "Lulus" && $doa == "-") {
                //data Riwayat Seleksi
                $dataRSel = array(
                    'id_seleksi' => $idSel,
                    'nama_tes' => 'Doa Sehari-hari',
                    'hasil' => $doa,
                    'tanggal' => $tgl
                );
                $this->mdl_admin->addData('riwayat_seleksi',$dataRSel);
            }elseif ($doa != "-") {
                $this->mdl_admin->editRSel($idSel,'Doa Sehari-hari', $doa);
            }

            if ($this->mdl_pelamar->caricari('Tes Ibadah Praktis',$idSel)) {
                $this->mdl_admin->editRSel($idSel,'Tes Ibadah Praktis', $bimbing);
            }
            elseif ($tgl != $c['tanggal'] && $c['hasil'] == "Lulus" && $bimbing == "-") {
                //data Riwayat Seleksi
                $dataRSel = array(
                    'id_seleksi' => $idSel,
                    'nama_tes' => 'Tes Ibadah Praktis',
                    'hasil' => $bimbing,
                    'tanggal' => $tgl
                );
                $this->mdl_admin->addData('riwayat_seleksi',$dataRSel);
            }elseif ($bimbing != "-") {
                $this->mdl_admin->editRSel($idSel,'Tes Ibadah Praktis', $bimbing);
            }

            if ($this->mdl_pelamar->caricari('Baca Al-Quran',$idSel)) {
                $this->mdl_admin->editRSel($idSel,'Baca Al-Quran', $shalat);
            }
            elseif ($tgl != $c['tanggal'] && $c['hasil'] == "Lulus" && $baca == "-") {
                //data Riwayat Seleksi
                $dataRSel = array(
                    'id_seleksi' => $idSel,
                    'nama_tes' => 'Baca Al-Quran',
                    'hasil' => $baca,
                    'tanggal' => $tgl
                );
                $this->mdl_admin->addData('riwayat_seleksi',$dataRSel);
            }elseif ($shalat != "-") {
                $this->mdl_admin->editRSel($idSel,'Baca Al-Quran', $shalat);
            }
            $d = mysqli_fetch_array(mysqli_query($konek,"select * from riwayat_seleksi where id_seleksi = $idSel && nama_tes = 'Baca Al-Quran'"));
            if ($this->mdl_pelamar->caricari('Tes Kesehatan',$idSel)) {
                $this->mdl_admin->editRSel($idSel,'Tes Kesehatan', $kesehatan);
            }
            elseif ($tgl != $d['tanggal'] && $d['hasil'] >= 10 && $kesehatan == "-") {
                //data Riwayat Seleksi
                $dataRSel = array(
                    'id_seleksi' => $idSel,
                    'nama_tes' => 'Tes Kesehatan',
                    'hasil' => $kesehatan,
                    'tanggal' => $tgl
                );
                $this->mdl_admin->addData('riwayat_seleksi',$dataRSel);
            }elseif ($kesehatan != "-") {
                $this->mdl_admin->editRSel($idSel,'Tes Kesehatan', $kesehatan);
            } 
            $dataSel = array('tgl_seleksi' => $tgl, 'tes_ppa' => $a);
            $where = array( 'id_seleksi' => $idSel);
            $this->mdl_admin->updateData($where,$dataSel,'seleksi');
            redirect("admin/detSeleksi/$id_karyawan");

        }else{ redirect("login"); } 
    }

    public function lanjutt($jenisTes,$ket,$hasil,$idSel){
        if($this->mdl_admin->logged_id()){ 
                $semua = $this->mdl_pelamar->semuaSeleksi($idSel);

            if ($ket =="lulus") {
                if($jenisTes == "Tulis") {
                    $dataSel = array('nilai_kompetensi' => $hasil);
                }elseif ($jenisTes == "Wawancara") {
                    $dataSel = array('nilai_wawancara' => $hasil);
                }elseif ($jenisTes == "Psikologi") {
                    $dataSel = array('tes_psikologi' => $hasil);
                }elseif ($jenisTes == "Kesehatan") {
                    $dataSel = array('tes_kesehatan' => $hasil);
                }elseif ($jenisTes == "Baca") {
                    $dataSel = array('nilai_agama' => $hasil);
                }
                $where = array('id_seleksi' => $idSel);
                $this->mdl_admin->updateData($where,$dataSel,'seleksi');
            }else{
                $dataPel = array('id_profesi' => "Belum", id_status => "Pelamar");
                $where2 = array( 'id_karyawan' => $semua->id_karyawan);
                $this->mdl_admin->updateData($where2,$dataPel,'karyawan');
                $where = array('id_seleksi' => $idSel);
                $this->mdl_pelamar->hapusdata('riwayat_seleksi',$where);
                $this->mdl_pelamar->hapusdata('seleksi',$where);

                $this->load->library('email');
                $pesan =  "Kepada<br>Yth. Sdr. <b>".$semua->nama."</b><br> Ditempat,<br><br><br>Berdasarkan hasil Seleksi ".$jenisTes.", anda dinyatakan TIDAK LULUS pada tahap seleksi ".$jenisTes." Rumah Sakit Islam Aisyiyah Kota Malang. <br><br><br>Demikian kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih.";

                send_email(array($email), 'Pemberitahuan', $pesan);
                $this->email->send();
                redirect("adminPelamar/pelamarDetail/$semua->id_karyawan");
            }

            redirect("admin/detSeleksi/$semua->id_karyawan");
        }else{ redirect("login"); } 
    }
    
    public function editMagang($id){
         if($this->mdl_admin->logged_id())
        {
            $where = array('id_karyawan' => $id);
            $dataKaryawan = array( 'id_status' => 'Magang' );
            
            $konek = mysqli_connect("localhost","root","","kepegawaian");
            $data=mysqli_fetch_array(mysqli_query($konek, "select * from karyawan where id_karyawan = $id"));
            $data1=mysqli_fetch_array(mysqli_query($konek,"select max(id_riwayat) as last from riwayat"));
            $dataRiwayat = array(
                'id_riwayat' => $data1['last']+1,
                'id_karyawan' => $id,
                'ruangan' => '-',
                'id_profesi' => $data['id_profesi'],
                'mulai' => date('d-m-y')
            );

            $dataStatus = array(
                'id_karyawan' => $id,
                'id_status' => 'Magang',
                'mulai' => '-',
                'akhir' => '-',
                'nomor_sk' => '-',
                'alamat_sk' => '-',
                'aktif' => 1
            );

            $datalogin = array( 'level' => 'Karyawan' );

             $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');
             $this->mdl_admin->addData('riwayat',$dataRiwayat);
             $this->mdl_admin->addData('Status',$dataStatus);
             $this->mdl_admin->updateData($where,$datalogin,'login');
             redirect("adminKaryawan/karyawanDetail/$id");
        }

        else{ redirect("login"); } 
    }
    //menampilkan data surat keseluruhan
    public function datasurat(){
        $paket['array']=$this->mdl_admin->getSurat();
        $this->load->view('admin/surat/allSurat',$paket);
    }
    //untuk menampilkan data surat sip str yg kadaluarsa dan belum diperbarui dari home
    public function dataSurat2(){
        $paket['array']=$this->mdl_admin->getSurat2();
        $this->load->view('admin/surat/allSurat2',$paket);
    }

    public function addSurat(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nik','Nomor Id Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['surat']=$this->mdl_admin->getJenSur();
                $this->load->view('admin/surat/addSurat',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $nik=$this->input->post('nik');
                $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$nik' "));

                $id=$data2['id_karyawan'];
                $nama_surat = $this->input->post('nama_surat');
                $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select id_surat from jenis_surat where nama_surat = '$nama_surat'"));
                $id_surat = $data['id_surat'];
                $tgl_mulai = $this->input->post('tgl_mulai');
                $tgl_akhir = $this->input->post('tgl_akhir');
                $no_surat = $this->input->post('no_surat');
                if(!$this->upload->do_upload('file')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect('admin/addSurat');
                } else {
                    $file = $this->upload->data('file_name');
                }

                $data4 = array(
                    'id_karyawan' => $id,
                    'id_surat'=>$id_surat,
                    'tgl_mulai'=>$tgl_mulai,
                    'tgl_akhir'=>$tgl_akhir, 
                    'no_surat'=>$no_surat,  
                    'file'=>$file,
                    'aktif'=> 0,
                );

                $this->mdl_admin->addData('sip_str',$data4);
                redirect("admin/datasurat");
                
                }
        }
        
        else{ redirect("login"); } 
    }

     public function editsurat($id){//edit surat dari detail karyawan
        if($this->mdl_admin->logged_id()){
            $this->form_validation->set_rules('no_surat', 'Nomor Surat', 'trim|required' );

            if ($this->form_validation->run()==FALSE) {
                $data['surat']=$this->mdl_admin->getJenSur();
                $data['data']=$this->mdl_karyawan->getDetailSur($id);
                $this->load->view('admin/surat/editsurat', $data);
            }
            else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;
                
                $this->load->library('upload', $config);

                $konek =mysqli_connect("localhost","root","","kepegawaian");

                $nama_surat = $this->input->post('nama_surat');
                $nik = $this->input->post('nik');

                $a=mysqli_fetch_array(mysqli_query($konek, "select * from jenis_surat where nama_surat = '$nama_surat'"));
                $b=mysqli_fetch_array(mysqli_query($konek, "select * from karyawan where nik = '$nik'"));
                $id_karyawan = $b['id_karyawan'];
                $id_sipstr = $this->input->post('id_sipstr');

                $c=mysqli_fetch_array(mysqli_query($konek, "select * from sip_str where id_sipstr = '$id_sipstr'"));

                $id_surat = $a['id_surat'];
                $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
                $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
                $no_surat = $this->input->post('no_surat');

                if($_FILES['file']['name'] != '') {
                    if(!$this->upload->do_upload('file')) {
                        $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                        $this->session->set_flashdata('msg_error', $error);

                        redirect("admin/editsurat/$id");
                    } else {
                        $file = $this->upload->data('file_name');
                    }
                } else {
                    $file = $this->input->post('file_old');
                }

                $data4 = array(
                    'id_surat'=>$id_surat,
                    'tgl_mulai'=>$tgl_mulai,
                    'tgl_akhir'=>$tgl_akhir, 
                    'no_surat'=>$no_surat,  
                    'file'=>$file
                );
                $where = array(
                    'id_sipstr' => $id
                );

                $update = $this->mdl_pelamar->updatedata($where,$data4,'sip_str');
                $this->session->set_flashdata('msg','Data Sukses di Update');
                redirect("admin/datasurat");
            }
        }else{ redirect("login"); }         
    }

    public function delsurat($id){
        $where = array('id_sipstr' => $id);
        $this->mdl_pelamar->hapusdata('sip_str',$where);
        redirect("admin/datasurat");
    }

    public function loadimpor(){
        if($this->mdl_admin->logged_id()){
        $this->load->view('admin/surat/impor');
        }else{ redirect("login"); }
    }
    public function impor()
    {
    include APPPATH."/libraries/PHPExcel.php";
    if(isset($_FILES["file"]["name"]))
        {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for($row=2; $row<=$highestRow; $row++)
                {   
                    $nik = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $konek = mysqli_connect("localhost","root","","kepegawaian");
                    $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$nik' "));
                    $id=$data2['id_karyawan'];
                    $surat = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $konek = mysqli_connect("localhost","root","","kepegawaian");
                    $data3=mysqli_fetch_array(mysqli_query($konek,"select id_surat from sip_str where jenis_surat = '$surat' "));
                    $id_surat=$data3['id_surat'];
                    $mulai= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $akhir = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $no_surat = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $file= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $tgl_mulai = substr($mulai, 0,4)."-".substr($mulai, 5,2)."-".substr($mulai, 8,4);
                    $tgl_akhir = substr($akhir, 0,4)."-".substr($akhir, 5,2)."-".substr($akhir, 8,4);
                    $data[] = array(
                        'id_karyawan'       =>    $id,
                        'id_surat'        =>    $id_surat,
                        'tgl_mulai'           =>    $tgl_mulai,
                        'tgl_akhir'             =>    $tgl_akhir,
                        'no_surat'             =>    $no_surat,
                        'file'              =>    $file,
                    );
                }
            }

            $this->mdl_admin->impor('sip_str',$data);
            redirect('Admin/datasurat');
        }        
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */