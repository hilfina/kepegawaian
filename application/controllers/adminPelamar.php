<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminPelamar extends CI_Controller {
	private $filename = "import_data";
	public function __construct()
	{
		parent::__construct();
        $this->load->model('mdl_login');
        $this->load->model('mdl_pelamar');
		$this->load->model('mdl_admin');
		$this->load->model('mdl_home');
		$this->load->helper('url','form','file');
		$this->load->library('form_validation','image_lib');
        $this->load->helper(array('url','download'));
        $this->load->library('email');
        if($this->mdl_admin->logged_id() == null){ redirect("login");}
	}

    //MENAMPILKAN DATA TABEL BERISI DATA PELAMAR
	public function index(){
		if($this->mdl_admin->logged_id()){            
			$paket['array']=$this->mdl_admin->getPelamar();
            $this->load->view('admin/pelamar/allPelamar',$paket);
		}else{redirect("login");}
	}
    public function datapelamar(){
        $paket['array']=$this->mdl_admin->getPelamar2();
        $this->load->view('admin/pelamar/allPelamar2',$paket);
    }
    public function dataCakar(){
        $paket['array']=$this->mdl_admin->getCakar();
        $this->load->view('admin/pelamar/allCakar',$paket);
    }

    //TAMBAH PELAMAR
    public function addPelamar(){
       if($this->mdl_admin->logged_id()){
            $this->form_validation->set_rules('no_ktp','Nomor Kartu Penduduk','trim|required');
            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getProfesi();
                $this->load->view('admin/pelamar/addPelamar',$data);
            }else{
                $no_ktp=$this->input->post('no_ktp');
                $nama=$this->input->post('nama');
                $alamat=$this->input->post('alamat');
                $no_telp=$this->input->post('no_telp');
                $email=$this->input->post('email');
                $ttl=$this->input->post('ttl');
                $jenkel=$this->input->post('jenkel');
                $nama_profesi=$this->input->post('id_profesi');
                $npr=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "SELECT id_profesi from jenis_profesi where nama_profesi = '$nama_profesi'"));
                $pendidikan=$this->input->post('pendidikan');
             
                $dataKaryawan = array(
                'nik' => "-",
                'no_ktp' => $no_ktp,
                'no_bpjs' => '-',
                'nama' => $nama,
                'alamat' => $alamat,
                'no_telp' => $no_telp,
                'email' => $email,
                'ttl' => $ttl,
                'jenkel ' => $jenkel ,
                'foto' => 'profile.png',
                'id_status' => 'Pelamar',
                'id_profesi' => $npr['id_profesi'],
                'id_golongan' => 'Tidak Ada'
                );

                $this->mdl_admin->addData('karyawan',$dataKaryawan);
                $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select * from karyawan where no_ktp = $no_ktp"));

                $dataLowongan = array(
                'id_karyawan' => $data['id_karyawan'],
                'pend_akhir' => '-',
                'nilai_akhir' => '-'
                );

                $dataLogin = array(
                'id_karyawan' => $data['id_karyawan'],
                'username' => $data['no_ktp'],
                'password' => md5($data['no_ktp']),
                'level' => 'Pelamar',
                'aktif' => 0
                );

                $dataPend = array(
                'id_karyawan' => $data['id_karyawan'],
                'pendidikan' => $pendidikan,
                'mulai' => 0,
                'akhir' => 0,
                'nomor_ijazah' => '-',
                'verifikasi' => 0
                );

                $this->mdl_admin->addData('lowongan',$dataLowongan);
                $this->mdl_admin->addData('login',$dataLogin);
                $this->mdl_admin->addData('pendidikan',$dataPend);

                $this->session->set_flashdata('msg','Success');
                $encrypted_id = $data['id_karyawan'];

                $config = array();
                $config['charset'] = 'utf-8';
                $config['useragent'] = 'CodeIgniter';
                $config['protocol']= "smtp";
                $config['mailtype']= "html";
                $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
                $config['smtp_port']= "465";
                $config['smtp_timeout']= "400";
                $config['smtp_user']= "sdirsiamalang@gmail.com"; // isi dengan email kamu
                $config['smtp_pass']= "bismillah1!"; // isi dengan password kamu
                $config['crlf']="\r\n"; 
                $config['newline']="\r\n"; 
                $config['wordwrap'] = TRUE;
                $this->email->initialize($config);
                $this->email->from($config['smtp_user']);
                $this->email->to($email);
                $this->email->subject("Notifikasi");
                $this->email->message("Kepada<br>Yth. Sdr. <b>".$nama."</b><br> Ditempat,<br><br><br> Mohon lengkapi data lamaran anda di RSI Aisyiyah Malang, karena penseleksian akan segera dilakukan.<br>
                Klik tombol dibawah ini untuk aktifikasi akun anda.<br>
                Masukkan username dan password dengan nomor KTP sesuai data lamaran yang telah anda kirim.<br><br>".
                "<a href='".site_url("login/verification/$encrypted_id")."'><button>verifikasi</button</a>");
                $this->email->send();
                redirect("adminPelamar");
            }
        }else{ redirect("login"); } 
    }

    public function pelamarDiterima($id){
        if($this->mdl_admin->logged_id()) {
        $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select * from karyawan where id_karyawan ='$id'")); 

        $this->load->library('email');
        $config = array();
        $config['charset'] = 'utf-8';
        $config['useragent'] = 'CodeIgniter';
        $config['protocol']= "smtp";
        $config['mailtype']= "html";
        $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
        $config['smtp_port']= "465";
        $config['smtp_timeout']= "400";
        $config['smtp_user']= "hilfinaamaris09@gmail.com"; // isi dengan email kamu
                $config['smtp_pass']= "hilfano090798"; // isi dengan password kamu
        $config['crlf']="\r\n"; 
        $config['newline']="\r\n"; 
        $config['wordwrap'] = TRUE;
        //memanggil library email dan set konfigurasi untuk pengiriman email
            
        $this->email->initialize($config);
        //konfigurasi pengiriman
        $this->email->from($config['smtp_user']);
        $this->email->to($data['email']);
        $this->email->subject("Notifikasi");

        $this->email->message("Kepada<br>Yth. Sdr. <b>".$data['nama']."</b><br> Ditempat,<br><br><br> Selamat, anda mendapat panggilan untuk melakukan seleksi diRumah Sakit Islam Kota Malang. untuk informasi tanggal seleksi, silakan untuk cek website RSIA ");
        $this->email->send();
        
        $where = array( 'id_karyawan' => $id ); 
        $data = array( 'id_status' => 'Calon Karyawan' ); 
        $this->mdl_admin->updateData($where,$data,'karyawan');

        $dataSel = array(
            'id_karyawan' => $id,
            'tgl_seleksi' => "-",
            'nilai_agama' => "-",
            'nilai_kompetensi' => "-",
            'tes_ppa' => "-",
            'tes_psikologi' => "-",
            'tes_kesehatan' => "-",
            'nilai_wawancara' => "-"
        );
        $this->mdl_admin->addData('seleksi',$dataSel);
        redirect("adminPelamar");
        } else{ redirect("login"); } 
    }

    public function pelamarDitolak($id){
        if($this->mdl_admin->logged_id()) {
        $dataa=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select * from karyawan where id_karyawan ='$id'")); 

        $this->load->library('email');
        $config = array();
        $config['charset'] = 'utf-8';
        $config['useragent'] = 'CodeIgniter';
        $config['protocol']= "smtp";
        $config['mailtype']= "html";
        $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
        $config['smtp_port']= "465";
        $config['smtp_timeout']= "400";
        $config['smtp_user']= "hilfinaamaris09@gmail.com"; // isi dengan email kamu
                $config['smtp_pass']= "hilfano090798"; // isi dengan password kamu
        $config['crlf']="\r\n"; 
        $config['newline']="\r\n"; 
        $config['wordwrap'] = TRUE;
        //memanggil library email dan set konfigurasi untuk pengiriman email
            
        $this->email->initialize($config);
        //konfigurasi pengiriman
        $this->email->from($config['smtp_user']);
        $this->email->to($dataa['email']);
        $this->email->subject("Notifikasi");
        $this->email->message("Kepada<br>Yth. Sdr. <b>".$dataa['nama']."</b><br> Ditempat,<br><br><br>
            Berdasarkan hasil Seleksi Administrasi, anda dinyatakan TIDAK LULUS pada tahap seleksi Administrasidi RSI Aisyiyah Malang. <br><br>Demikian kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih. ");
        $this->email->send();
        
        $where = array( 'id_karyawan' => $id ); 
        $data = array( 'id_status' => 'Pelamar', 'id_profesi' => 'Belum' ); 
        $this->mdl_admin->updateData($where,$data,'karyawan');
        redirect("adminPelamar");
        }else{ redirect("login"); } 
    }
    //DATA DETAIL PELAMAR
    public function pelamarDetail($id){
        if($this->mdl_admin->logged_id()){
            $where = array( 'id_karyawan' => $id ); 
            $paket['array']=$this->mdl_admin->getProfesi(); 
            $paket['prof']=$this->mdl_admin->getProfesi2($id); 
            $paket['datDir']=$this->mdl_admin->getData('karyawan',$where);
            $paket['datPen']=$this->mdl_admin->getData('pendidikan',$where);
            $paket['datSel']=$this->mdl_admin->detSeleksi($id);

            $paket['datSur']=$this->mdl_admin->cariJenisSurat($id);
            $paket['datLo']=$this->mdl_admin->getData('Lowongan',$where);
            if ($this->mdl_admin->detSeleksi($id)) {
                $s=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select * from seleksi where id_karyawan = $id"));
                
                //DATA SELEKSI YANG ADA DI RIWAYAT SELEKSI
                $paket['wawa']=$this->mdl_pelamar->carii('Wawancara',$s['id_seleksi']);
                $paket['psiko']=$this->mdl_pelamar->carii('Tes Psikologi',$s['id_seleksi']);
                $paket['tulis']=$this->mdl_pelamar->carii('Tes Tulis',$s['id_seleksi']);
                $paket['sehat']=$this->mdl_pelamar->carii('Tes Kesehatan',$s['id_seleksi']);
                $paket['shalat']=$this->mdl_pelamar->carii('Tes Toharoh dan Shalat',$s['id_seleksi']);
                $paket['doa']=$this->mdl_pelamar->carii('Doa Sehari-hari',$s['id_seleksi']);
                $paket['bimbing']=$this->mdl_pelamar->carii('Tes Ibadah Praktis',$s['id_seleksi']);
                $paket['baca']=$this->mdl_pelamar->carii('Baca Al-Quran',$s['id_seleksi']);
                $paket['semua']=$this->mdl_pelamar->semuaSeleksi($s['id_seleksi']);

            }else{}
            
            $this->load->view('admin/Pelamar/detailPelamar',$paket);
        }else{ redirect("login"); }         
    }
    public function editData($id){
         if($this->mdl_admin->logged_id())
        {
            $nik=$this->input->post('nik');
            $no_ktp=$this->input->post('no_ktp');
            $nama=$this->input->post('nama');
            $alamat=$this->input->post('alamat');
            $no_telp=$this->input->post('no_telp');
            $email=$this->input->post('email');
            $jenkel=$this->input->post('jenkel');
            $ttl=$this->input->post('ttl');
            $nama_profesi=$this->input->post('nama_profesi');
            $s=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select id_profesi from jenis_profesi where nama_profesi = '$nama_profesi'"));

             $dataKaryawan = array(
                'no_ktp' => $no_ktp,
                'nama' => $nama,
                'alamat' => $alamat,
                'no_telp' => $no_telp,
                'email' => $email,
                'ttl' => $ttl,
                'jenkel' => $jenkel,
                'id_profesi' => $s['id_profesi']
                );
             $where = array('id_karyawan' => $id);
             $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');
             redirect("adminPelamar/pelamarDetail/$id");
        }

        else{ redirect("login"); } 
    }
    // MENAMPILKAN FORM TAMBAH PENDIDIKAN MELALUI HALAMAN DETAIL
   public function addpend($id){
    if($this->mdl_admin->logged_id()){
        $this->load->helper('url','form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required' );

        if ($this->form_validation->run()==FALSE) {
            $idl['id']=$id;
            $this->load->view('admin/pelamar/pendidikan/addpendidikan',$idl);
        }
        else{
            $config['upload_path']      = './Assets/dokumen/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = 2000;
            $config['max_width']        = 10240;
            $config['max_height']       = 7680;
            $this->load->library('upload', $config);
 
            $pendidikan = $this->input->post('pendidikan');
            $id_karyawan  = $this->input->post('id_karyawan');
            $jurusan  = $this->input->post('jurusan');
            $nilai = $this->input->post('nilai');
            $mulai = $this->input->post('mulai');
            $akhir = $this->input->post('akhir');
            $nomor_ijazah = $this->input->post('nomor_ijazah');
            
            $this->upload->do_upload('file');
            $a = $this->upload->data('file_name');
            $data3 = array(
                    'pendidikan'=>$pendidikan,
                    'jurusan' => $jurusan,
                    'nilai' => $nilai,
                    'mulai'=>$mulai,
                    'akhir'=>$akhir,
                    'nomor_ijazah'=>$nomor_ijazah,
                    'id_karyawan' => $id_karyawan,
                    'file'=>$a,
                    'verifikasi'=> 1,
                );
            $insert3 = $this->mdl_pelamar->tambahdata('pendidikan',$data3);

            $this->session->set_flashdata('msg','Data Sukses di tambahkan');
            redirect("adminPelamar/pelamarDetail/$id_karyawan");
        }        
    }else{ redirect("login"); }
    }

    public function editpend($id){
        if($this->mdl_admin->logged_id()){
            $this->load->helper('url','form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required' );
            $this->load->model('mdl_pelamar');

            if ($this->form_validation->run()==FALSE) {
                $paket['array']=$this->mdl_pelamar->getDetailpend($id);
                $this->load->view('admin/Pelamar/pendidikan/editpendidikan', $paket);
            }
            else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                $pendidikan = $this->input->post('pendidikan');
                $jurusan  = $this->input->post('jurusan');
                $id_karyawan = $this->input->post('id_karyawan');
                $nilai = $this->input->post('nilai');
                $mulai = $this->input->post('mulai');
                $akhir = $this->input->post('akhir');
                $nomor_ijazah = $this->input->post('nomor_ijazah');

                $s=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select * from pendidikan where id = $id"));
                
                if ($this->upload->do_upload('file')) {
                    $file = $this->upload->data('file_name');
                }else {
                    $file = $s['file'];
                }
                $data3 = array(
                        'pendidikan'=>$pendidikan,
                        'jurusan' => $jurusan,
                        'nilai' => $nilai,
                        'id_karyawan' => $id_karyawan,
                        'mulai'=>$mulai,
                        'akhir'=>$akhir,
                        'nomor_ijazah'=>$nomor_ijazah,
                        'file'=>$file
                    );
                $where = array('id' => $id);

                $update = $this->mdl_pelamar->updatedata($where,$data3,'pendidikan');
                $this->session->set_flashdata('msg','Data Sukses di Update');
                redirect("adminPelamar/pelamarDetail/$id_karyawan");
            }
        }else{ redirect("login"); }         
    }
    
    public function delPend($id,$idk){
       if($this->mdl_admin->logged_id()){
            $this->mdl_admin->delPend($id);
            redirect("adminPelamar/pelamarDetail/$idk");
        }        
        else{ redirect("login"); } 
    }

  //VERIFIKASI IJASAH
    public function verPend($id,$idk){
       if($this->mdl_admin->logged_id()){
            $where = array( 'id' => $id ); 
            $data = array( 'verifikasi' => 1 ); 
            $this->mdl_admin->updateData($where,$data,'pendidikan');
            redirect("adminPelamar/pelamarDetail/$idk");
            }
        else{ redirect("login"); } 
    }

    public function addSurat($id){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('id_karyawan','Id Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['id']=$id;
                $data['surat']=$this->mdl_admin->getJenSur();
                $this->load->view('admin/pelamar/addSurat',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);

                $id=$this->input->post('id_karyawan');
                $nama_surat = $this->input->post('nama_surat');
                $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select id_surat from jenis_surat where nama_surat = '$nama_surat'"));
                $id_surat = $data['id_surat'];
                $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
                $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
                $no_surat = $this->input->post('no_surat');
                $this->upload->do_upload('file');
                $b = $this->upload->data('file_name');
                $data4 = array(
                    'id_karyawan' => $id,
                    'id_surat'=>$id_surat,
                    'tgl_mulai'=>$tgl_mulai,
                    'tgl_akhir'=>$tgl_akhir, 
                    'no_surat'=>$no_surat,  
                    'file'=>$b,
                    'aktif'=> 0,
                );

                $this->mdl_admin->addData('sip_str',$data4);
                redirect("adminPelamar/pelamarDetail/$id");
                
                }
        }
        
        else{ redirect("login"); } 
    }

    //EDIT DATA SELEKSI
    public function editDataSel(){
        if($this->mdl_admin->logged_id()) { 
            $idk=$this->input->post('idKSel');
            $config['upload_path']      = './Assets/dokumen/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = 2000;

            
            $this->load->library('upload', $config);
            $s=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select * from seleksi where id_karyawan = $idk"));

            if ($this->upload->do_upload('file')) {
                $a = $this->upload->data('file_name');
            }else {
                $a = $s['tes_ppa'];
            }   

            $tp_sel = $a;   
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
            $b = mysqli_fetch_array(mysqli_query($konek,"select * from riwayat_seleksi where id_seleksi = $idSel && nama_tes = 'Wawancara'")); 

            if ($this->mdl_pelamar->caricari('Tes Psikologi',$idSel)) {
                $this->mdl_admin->editRSel($idSel,'Tes Psikologi', $psikologi);
            }
            elseif ($tgl != $b['tanggal'] && $wawancara >= 10 && $psikologi == "-") {
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
            redirect("adminPelamar/pelamarDetail/$idk");

        }else{ redirect("login"); } 
    }

    public function lanjutt($jenisTes,$ket,$hasil,$idSel){
        if($this->mdl_admin->logged_id()){ 
                $semua = $this->mdl_pelamar->semuaSeleksi($idSel);
                $dataku=  $this->mdl_pelamar->semuadata( $semua->id_karyawan);

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
                $dataPel = array('id_profesi' => "Belum", id_status => "Pelamar");
                $where2 = array( 'id_karyawan' => $semua->id_karyawan);
                $this->mdl_admin->updateData($where2,$dataPel,'karyawan');
                $where = array('id_seleksi' => $idSel);
                $this->mdl_pelamar->hapusdata('riwayat_seleksi',$where);
                $this->mdl_pelamar->hapusdata('seleksi',$where);
                $this->db->update('lowongan', array('finalisasi' => 0), array('id_karyawan' => $semua->id_karyawan));

                $this->load->library('email');
                $config = array();
                $config['charset'] = 'utf-8';
                $config['useragent'] = 'CodeIgniter';
                $config['protocol']= "smtp";
                $config['mailtype']= "html";
                $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
                $config['smtp_port']= "465";
                $config['smtp_timeout']= "400";
                $config['smtp_user']= "hilfinaamaris09@gmail.com"; // isi dengan email kamu
                $config['smtp_pass']= "hilfano090798"; // isi dengan password kamu
                $config['crlf']="\r\n"; 
                $config['newline']="\r\n"; 
                $config['wordwrap'] = TRUE;
                //memanggil library email dan set konfigurasi untuk pengiriman email
                    
                $this->email->initialize($config);
                //konfigurasi pengiriman
                $this->email->from($config['smtp_user']);
                $this->email->to($dataku->email);
                $this->email->subject("Notifikasi");
                $this->email->message("Kepada<br>Yth. Sdr. <b>".$dataku->nama."</b><br> Ditempat,<br><br><br>Maaf, anda gagal dalam seleksi tahap $jenisTes di RSIA, silahkan mencoba pada peluang karir selanjutnya");
                $this->email->send();
            }

            redirect("adminPelamar/pelamarDetail/$semua->id_karyawan");
        }else{ redirect("login"); } 
    }
    public function editMagang($id){
         if($this->mdl_admin->logged_id())
        {
            $where = array('id_karyawan' => $id);
            $dataKaryawan = array(
                'id_status' => 'Magang'
                );
            
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
                'mulai' => date('d-m-y'),
                'akhir' => '-',
                'nomor_sk' => '-',
                'alamat_sk' => '-',
                'aktif' => 1
            );

            $datalogin = array(
                'level' => 'Karyawan',
            );

            $this->load->library('email');
            $config = array();
            $config['charset'] = 'utf-8';
            $config['useragent'] = 'CodeIgniter';
            $config['protocol']= "smtp";
            $config['mailtype']= "html";
            $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
            $config['smtp_port']= "465";
            $config['smtp_timeout']= "400";
            $config['smtp_user']= "hilfinaamaris09@gmail.com"; // isi dengan email kamu
            $config['smtp_pass']= "hilfano090798"; // isi dengan password kamu
            $config['crlf']="\r\n"; 
            $config['newline']="\r\n"; 
            $config['wordwrap'] = TRUE;
            //memanggil library email dan set konfigurasi untuk pengiriman email
                
            $this->email->initialize($config);
            //konfigurasi pengiriman
            $this->email->from($config['smtp_user']);
            $this->email->to($data['email']);
            $this->email->subject("Notifikasi");
            $this->email->message("Kepada<br>Yth. Sdr. <b>".$data['nama']."</b><br> Ditempat,<br><br><br>Selamat, anda Telah Diterima di RSIA, silahkan melengkapi data diri anda kembali pada sistem. Informasi selanjutnya akan kami sampaikan melalui telfon.<br><br>Demikian kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih.");
            $this->email->send();

             $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');
             $this->mdl_admin->addData('riwayat',$dataRiwayat);
             $this->mdl_admin->addData('Status',$dataStatus);
             $this->mdl_admin->updateData($where,$datalogin,'login');
             redirect("adminKaryawan/karyawanDetail/$id");
        }

        else{ redirect("login"); } 
    }

    public function loadimpor(){
        if($this->mdl_admin->logged_id()){
        $this->load->view('admin/Pelamar/impor');
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
                    $no_ktp= $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $nama= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $alamat = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $no_telp = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $email= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $jenkel= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $ttl= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $tgl_lahir = substr($ttl, 0,4)."-".substr($ttl, 5,2)."-".substr($ttl, 8,4);
                    $id_profesi= $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $konek =mysqli_connect("localhost","root","","kepegawaian");
                    $cip=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select id_profesi from jenis_profesi where nama_profesi ='$id_profesi'"));
                    
                    $data1[]= array(
                        'nik' => "-",
                        'no_ktp' => $no_ktp,
                        'no_bpjs' => '-',
                        'nama' => $nama,
                        'alamat' => $alamat,
                        'no_telp' => $no_telp,
                        'email' => $email,
                        'ttl' => $tgl_lahir,
                        'jenkel ' => $jenkel,
                        'foto' => 'profile.png',
                        'id_status' => 'Pelamar',
                        'id_profesi' => $cip['id_profesi'],
                        'id_golongan' => 'Tidak Ada'
                    );

                    $this->mdl_admin->impor('karyawan',$data1);
                    $xxx=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select * from karyawan where no_ktp = $no_ktp"));

                    $Lowongan[] = array(
                    'id_karyawan' => $xxx['id_karyawan'],
                    'pend_akhir' => '-',
                    'nilai_akhir' => '-'
                    );

                    $Login[] = array(
                    'id_karyawan' => $xxx['id_karyawan'],
                    'username' => $xxx['no_ktp'],
                    'password' => md5($xxx['no_ktp']),
                    'level' => 'Pelamar',
                    'aktif' => 0
                    );

                    $Pend[] = array(
                    'id_karyawan' => $xxx['id_karyawan'],
                    'pendidikan' => '-',
                    'mulai' => 0,
                    'akhir' => 0,
                    'nomor_ijazah' => '-',
                    'verifikasi' => 0
                    );

                    $config = array();
                    $config['charset'] = 'utf-8';
                    $config['useragent'] = 'CodeIgniter';
                    $config['protocol']= "smtp";
                    $config['mailtype']= "html";
                    $config['smtp_host']= "ssl://smtp.gmail.com";
                    $config['smtp_port']= "465";
                    $config['smtp_timeout']= "400";
                    $config['smtp_user']= "hilfinaamaris09@gmail.com"; // isi dengan email kamu
                $config['smtp_pass']= "hilfano090798"; // isi dengan password kamu
                    $config['crlf']="\r\n"; 
                    $config['newline']="\r\n"; 
                    $config['wordwrap'] = TRUE;
                    $this->email->initialize($config);
                    $encrypted_id = $cariId['id_karyawan'];
                    $this->email->from($config['smtp_user']);
                    $this->email->to($email);
                    $this->email->subject("Verifikasi Akun");
                    $this->email->message(
                        "Kepada<br>Yth. Sdr. <b>".$nama."</b><br> Ditempat,<br><br><br>Mohon lengkapi data lamaran anda di RSI Aisyiyah Malang, karena penseleksian akan segera dilakukan.<br>
                        Klik tombol dibawah ini untuk aktifikasi akun anda.<br>
                        Masukkan username dan password dengan nomor KTP sesuai data lamaran yang telah anda kirim.<br><br>".
                        "<a href='".site_url("login/verification/$encrypted_id")."'><button>verifikasi</button</a>"
                    );
                    if($this->email->send()){
                        $this->mdl_admin->impor('lowongan',$Lowongan);
                        $this->mdl_admin->impor('login',$Login);
                        $this->mdl_admin->impor('pendidikan',$Pend);
                    }else{

                    }
                }
            }

            
            echo "<script>alert('Berhasil Menambahkan data'); document.location.href = '" . site_url('AdminPelamar') . "';</script>";
        }        
    }

    public function report(){
        $this->load->library('Mypdf');
        $data['array']=$this->mdl_admin->getreport();
        $this->mypdf->generate('Laporan/pelamar', $data, 'laporan-hasil-seleksi', 'A4', 'portrait');
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */