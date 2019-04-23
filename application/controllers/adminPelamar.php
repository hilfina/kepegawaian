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
	}

    //MENAMPILKAN DATA TABEL BERISI DATA PELAMAR
	public function index(){
		if($this->mdl_admin->logged_id()){            
			$paket['array']=$this->mdl_admin->getPelamar();
            $this->load->view('admin/pelamar/allPelamar',$paket);
		}else{redirect("login");}
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
                $id_status=$this->input->post('id_status');
                $id_profesi=$this->input->post('id_profesi');
                $pendidikan=$this->input->post('pendidikan');
             
                $dataKaryawan = array(
                'nik' => "-",
                'no_ktp' => $no_ktp,
                'no_bpjs' => '-',
                'nama' => $nama,
                'alamat' => $alamat,
                'no_telp' => $no_telp,
                'email' => $email,
                'foto' => 'profile.png',
                'id_status' => 'Pelamar',
                'id_profesi' => $id_profesi,
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
                'file' => '-',
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
                $config['smtp_user']= "hilfinaamaris09@gmail.com"; // isi dengan email kamu
                $config['smtp_pass']= "hilfano090798"; // isi dengan password kamu
                $config['crlf']="\r\n"; 
                $config['newline']="\r\n"; 
                $config['wordwrap'] = TRUE;
                $this->email->initialize($config);
                $this->email->from($config['smtp_user']);
                $this->email->to($email);
                $this->email->subject("Notifikasi");
                $this->email->message("Mohon lengkapi data lamaran anda di RSI Aisyiyah Malang, karena penseleksian akan segera dilakukan.<br>
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
        $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select email from karyawan where id_karyawan ='$id'")); 

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
        $this->email->message("Selamat, anda mendapat panggilan untuk melakukan seleksi di RSIA tahap ");
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
        $dataa=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select email from karyawan where id_karyawan ='$id'")); 

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
        $this->email->message("Maaf, anda gagal dalam seleksi di RSIA, silahkan mencoba pada peluang karir selanjutnya");
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
            $paket['datDir']=$this->mdl_admin->getData('karyawan',$where);
            $paket['datPen']=$this->mdl_admin->getData('pendidikan',$where);
            $paket['datSel']=$this->mdl_admin->detSeleksi($id);
            $paket['datSur']=$this->mdl_admin->cariJenisSurat($id);
            $paket['datLo']=$this->mdl_admin->getData('Lowongan',$where);
            if ($this->mdl_admin->detSeleksi($id)) {
                $s=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select * from seleksi where id_karyawan = $id"));
                $paket['wawa']=$this->mdl_pelamar->carii('Wawancara',$s['id_seleksi']);
                $paket['psiko']=$this->mdl_pelamar->carii('Tes Psikologi',$s['id_seleksi']);
                $paket['agam']=$this->mdl_pelamar->carii('Tes Agama',$s['id_seleksi']);
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
            $id_profesi=$this->input->post('id_profesi');

             $dataKaryawan = array(
                'no_ktp' => $no_ktp,
                'nama' => $nama,
                'alamat' => $alamat,
                'no_telp' => $no_telp,
                'email' => $email,
                'id_profesi' => $id_profesi
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
            $config['allowed_types']    = 'jpg|png';
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
                $config['allowed_types']    = 'jpg|png';
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
                $config['allowed_types']    = 'gif|jpg|png|pdf|docx';
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
            $config['allowed_types']    = 'jpg|png';
            $config['max_size']         = 2000;
            $config['max_width']        = 10240;
            $config['max_height']       = 7680;
            
            $this->load->library('upload', $config);
            $s=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select * from seleksi where id_karyawan = $idk"));
            if ($this->upload->do_upload('file')) {
                $a = $this->upload->data('file_name');
            }else {
                $a = $s['tes_ppa'];
            }   
            $tp_sel = $a;   
            $id_sel = $this->input->post('idSel');     
            $tgl_sel = $this->input->post('tglSel');
            if ($this->input->post('nwSel') == "-- Pilihan --") {
                $nw_sel = "-";
            }else{
                $nw_sel = $this->input->post('nwSel');
            }if ($this->input->post('nkSel') == "-- Pilihan --") {
                $nk_sel = "-";
            }else{
                $nk_sel = $this->input->post('nkSel');
            }if ($this->input->post('naSel') == "-- Pilihan --") {
                $na_sel = "-";
            }else{
                $na_sel = $this->input->post('naSel');
            }if ($this->input->post('tpsSel') == "-- Pilihan --") {
                $tps_sel = "-";
            }else{
                $tps_sel = $this->input->post('tpsSel');
            }if ($this->input->post('tkSel') == "-- Pilihan --") {
                $tk_sel = "-";
            }else{
                $tk_sel = $this->input->post('tkSel');
            }
            $dataSel = array(
            'id_karyawan' => $idk,
            'tgl_seleksi' => $tgl_sel,
            'nilai_agama' => $na_sel,
            'nilai_kompetensi' => $nk_sel,
            'tes_ppa' => $tp_sel,
            'tes_psikologi' => $tps_sel,
            'tes_kesehatan' => $tk_sel,
            'nilai_wawancara' => $nw_sel
            );

            // jika tanggal sudah di isi untuk tanggal tes tulis & wawancara
            if ($this->mdl_pelamar->caricari('Tes Tulis',$id_sel)) {
                $this->mdl_admin->editRSel($id_sel,'Tes Tulis', $nk_sel);
            }
            elseif ($tgl_sel != "-" && $nk_sel == "-") {
                //data Riwayat Seleksi
                $dataRSel = array(
                    'id_seleksi' => $id_sel,
                    'nama_tes' => 'Tes Tulis',
                    'hasil' => $nk_sel,
                    'tanggal' => $tgl_sel
                );
                $this->mdl_admin->addData('riwayat_seleksi',$dataRSel);
            }elseif ($tgl_sel != "-" && $nk_sel != "-") {
                $this->mdl_admin->editRSel($id_sel,'Tes Tulis', $nk_sel);
            }

            if ($this->mdl_pelamar->caricari('Wawancara',$id_sel)) {
                $this->mdl_admin->editRSel($id_sel,'Wawancara', $nw_sel);
            }
            elseif ($tgl_sel != "-" && $nw_sel == "-") {
                //data Riwayat Seleksi
                $dataRSel = array(
                    'id_seleksi' => $id_sel,
                    'nama_tes' => 'Wawancara',
                    'hasil' => $nw_sel,
                    'tanggal' => $tgl_sel
                );
                $this->mdl_admin->addData('riwayat_seleksi',$dataRSel);
            }elseif ($tgl_sel != "-" && $nw_sel != "-") {
                $this->mdl_admin->editRSel($id_sel,'Wawancara', $nw_sel);
            }
            $konek = mysqli_connect("localhost","root","","kepegawaian");
            $b = mysqli_fetch_array(mysqli_query($konek,"select * from riwayat_seleksi where id_seleksi = $id_sel && nama_tes = 'Wawancara'")); 

            if ($this->mdl_pelamar->caricari('Tes Psikologi',$id_sel)) {
                $this->mdl_admin->editRSel($id_sel,'Tes Psikologi', $tps_sel);
            }
            elseif ($tgl_sel != $b['tanggal'] && $b['hasil'] == "Lulus" && $tps_sel == "-") {
                //data Riwayat Seleksi
                $dataRSel = array(
                    'id_seleksi' => $id_sel,
                    'nama_tes' => 'Tes Psikologi',
                    'hasil' => $tps_sel,
                    'tanggal' => $tgl_sel
                );
                $this->mdl_admin->addData('riwayat_seleksi',$dataRSel);
            }elseif ($tps_sel != "-") {
                $this->mdl_admin->editRSel($id_sel,'Tes Psikologi', $tps_sel);
            }
            $c = mysqli_fetch_array(mysqli_query($konek,"select * from riwayat_seleksi where id_seleksi = $id_sel && nama_tes = 'Tes Psikologi'"));

            if ($this->mdl_pelamar->caricari('Tes Agama',$id_sel)) {
                $this->mdl_admin->editRSel($id_sel,'Tes Agama', $na_sel);
            }
            elseif ($tgl_sel != $c['tanggal'] && $c['hasil'] == "Lulus" && $na_sel == "-") {
                //data Riwayat Seleksi
                $dataRSel = array(
                    'id_seleksi' => $id_sel,
                    'nama_tes' => 'Tes Agama',
                    'hasil' => $na_sel,
                    'tanggal' => $tgl_sel
                );
                $this->mdl_admin->addData('riwayat_seleksi',$dataRSel);
            }elseif ($na_sel != "-") {
                $this->mdl_admin->editRSel($id_sel,'Tes Agama', $na_sel);
            } 

            if ($this->mdl_pelamar->caricari('Tes Kesehatan',$id_sel)) {
                $this->mdl_admin->editRSel($id_sel,'Tes Kesehatan', $tk_sel);
            }
            elseif ($tgl_sel != $c['tanggal'] && $c['hasil'] == "Lulus" && $tk_sel == "-") {
                //data Riwayat Seleksi
                $dataRSel = array(
                    'id_seleksi' => $id_sel,
                    'nama_tes' => 'Tes Kesehatan',
                    'hasil' => $tk_sel,
                    'tanggal' => $tgl_sel
                );
                $this->mdl_admin->addData('riwayat_seleksi',$dataRSel);
            }elseif ($tk != "-") {
                $this->mdl_admin->editRSel($id_sel,'Tes Kesehatan', $tk_sel);
            } 

            $where = array( 'id_karyawan' => $idk);
            $this->mdl_admin->updateData($where,$dataSel,'seleksi');
            redirect("adminPelamar/pelamarDetail/$idk");
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

             $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');
             $this->mdl_admin->addData('riwayat',$dataRiwayat);
             $this->mdl_admin->addData('Status',$dataStatus);
             $this->mdl_admin->updateData($where,$datalogin,'login');
             redirect("adminKaryawan/karyawanDetail/$id");
        }

        else{ redirect("login"); } 
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */