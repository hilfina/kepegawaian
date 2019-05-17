<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminKaryawan extends CI_Controller {
	private $filename = "import_data";
	public function __construct()
	{
		parent::__construct();
        $this->load->model('mdl_login');
        $this->load->model('mdl_pelamar');
        $this->load->model('mdl_karyawan');
		$this->load->model('mdl_admin');
		$this->load->model('mdl_home');
		$this->load->helper('url','form','file');
		$this->load->library('form_validation','image_lib');
        $this->load->helper(array('url','download'));
        $this->load->library('email');

        if($this->mdl_admin->logged_id() == null)
        {
            redirect("login");
        }
	}
    
	public function index(){//MENAMPILKAN DATA TABEL BERISI DATA KARYAWAN
		if($this->mdl_admin->logged_id()){            
			$paket['array']=$this->mdl_admin->getKaryawan();
            $this->load->view('admin/Karyawan/allKaryawan',$paket);
		}else{redirect("login");}
	}
    
    public function addKaryawan(){//MENAMPILKAN FORM TAMBAH KARYAWAN DAN PROSES PENYIMPANANNYA
        if($this->mdl_admin->logged_id()){
            $this->form_validation->set_rules('nik','Nomor Induk Karyawan','trim|required');
            $this->form_validation->set_rules('nama','Nama Karyawan','trim|required');
            $this->form_validation->set_rules('no_ktp','Nomor KTP','trim|required');
            $this->form_validation->set_rules('no_telp','Nomor Telepon','trim|required');
            $this->form_validation->set_rules('email','Alamat Email','trim|required');
            $this->form_validation->set_rules('alamat','Alamat','trim|required');
            if($this->form_validation->run()==FALSE){

                $data['status']=$this->mdl_admin->getJenStatus();
                $data['profesi']=$this->mdl_admin->getProfesi();
                $data['golongan']=$this->mdl_admin->getGolongan();
                $this->load->view('admin/Karyawan/addKaryawan',$data);
            }else{

                $id_profesi=$this->input->post('id_profesi');
                $id_golongan=$this->input->post('id_golongan');
                $id_status=$this->input->post('id_status');
                $nik=$this->input->post('nik');
                $nama=$this->input->post('nama');
                $no_ktp=$this->input->post('no_ktp');
                $no_telp=$this->input->post('no_telp');
                $email=$this->input->post('email');
                $alamat=$this->input->post('alamat');   
                $tgl = date('d/m/Y');
                $cip=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select id_profesi from jenis_profesi where nama_profesi ='$id_profesi'"));
                $dataKaryawan= array(
                'id_profesi' => $cip['id_profesi'],
                'id_status' => $id_status,
                'id_golongan' => $id_golongan,
                'nik' => $nik,
                'nama' => $nama,
                'no_ktp' => $no_ktp,
                'no_telp' => $no_telp,
                'foto' => 'profile.png',
                'email' => $email,
                'alamat' => $alamat
                );

                $this->mdl_admin->addData('karyawan',$dataKaryawan);
                $cariId=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select * from karyawan where no_ktp = '$no_ktp'"));
                $dataLogin=array('username'=>$nik, 'password'=>md5($no_ktp), 'level'=>'Karyawan', 'aktif'=>0, 'id_karyawan'=>$cariId['id_karyawan']);
                $dataRiwayat=array('id_karyawan'=>$cariId['id_karyawan'], 'id_profesi'=>$cip['id_profesi'], 'mulai' => $tgl);
                $dataStatus=array('id_karyawan'=>$cariId['id_karyawan'], 'id_status'=>$id_status, 'mulai' => $tgl);
                $dataGolongan=array('id_karyawan'=>$cariId['id_karyawan'], 'id_golongan'=>$id_golongan, 'mulai' => $tgl);
                
                $config = array();
                $config['charset'] = 'utf-8';
                $config['useragent'] = 'CodeIgniter';
                $config['protocol']= "smtp";
                $config['mailtype']= "html";
                $config['smtp_host']= "ssl://smtp.gmail.com";
                $config['smtp_port']= "465";
                $config['smtp_timeout']= "400";
                $config['smtp_user']= "hilfinaamaris09@gmail.com";
                $config['smtp_pass']= "hilfano090798";
                $config['crlf']="\r\n"; 
                $config['newline']="\r\n"; 
                $config['wordwrap'] = TRUE;
                $this->email->initialize($config);
                $encrypted_id = $cariId['id_karyawan'];
                $this->email->from($config['smtp_user']);
                $this->email->to($email);
                $this->email->subject("Verifikasi Akun");
                $this->email->message(

                    "Kepada<br>Yth. Sdr. <b>".$nama."</b><br> Ditempat,<br><br><br> Anda telah didaftarkan di Rumah Sakit islam Aisyiyah Kota Malang. <br><br><br>Demikian kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih. <br> Untuk memverifikasi silahkan klik tautan dibawah ini menggunakan <br><br>
	                    username: nomor induk karyawan. <br>
	                    password: nomor ktp anda.<br>".
                    "<a href='".site_url("login/verification/$encrypted_id")."'>klik disini</a>"

                );
                
                if($this->email->send())
                {
                    $this->mdl_admin->addData('login',$dataLogin);
                    $this->mdl_admin->addData('status',$dataStatus);
                    $this->mdl_admin->addData('golongan',$dataGolongan);
                    $this->mdl_admin->addData('riwayat',$dataRiwayat);
                    echo "<script>alert('Email berhasil terkirim'); document.location.href = '" . site_url('login') . "';</script>";
                }else{}
                redirect("adminKaryawan");
            }
        }else{ redirect("login"); } 
    }
    
    public function karyawanDetail($id){//LIHAT DETAIL KARYAWAN
        if($this->mdl_admin->logged_id()){
            $where = array( 'id_karyawan' => $id ); 
            $paket['rGolongan']=$this->mdl_admin->getData('golongan',$where);
            $paket['rPenempatan']=$this->mdl_admin->getData('riwayat',$where);
            $paket['rStatus']=$this->mdl_admin->getData('status',$where);

            $paket['array']=$this->mdl_admin->getProfesi();
            $paket['datSta']=$this->mdl_admin->getJenStatus();
            $paket['datGol']=$this->mdl_admin->getAlldata('jenis_golongan');
            $paket['datDir']=$this->mdl_admin->getTempat($id);
            $paket['datSta']=$this->mdl_admin->getJenStatus();
            $paket['datNil']=$this->mdl_admin->getPenilaian($id);
            if ($this->mdl_admin->getAgama($id)) { //jika sudah punya nilai agama
                $paket['agama']=$this->mdl_admin->getAgama($id);
            }else{
                $paket['agama'] = null;
            }
            $paket['cuti']=$this->mdl_admin->getKC($id); $thn = date('Y');
            if ($this->mdl_admin->getTC($id,$thn)) { //jika ada data cuti di tahun ini
                $beda = $this->mdl_admin->getTC($id,$thn);
                $paket['Dcuti'] = $this->mdl_admin->getDC($id);
                $paket['selisih']=abs($beda->selisih);
            }else{
                $paket['selisih']= 0;
            }
            $paket['id']=$id;
            $paket['log']=$this->mdl_admin->getData('login',$where);
            $this->load->view('admin/Karyawan/detailKaryawan',$paket);
        }else{ redirect("login"); } 
    }
    
    public function editData($id){// SIMPAN DATA YANG DIUBAH DI DETAIL KARYAWAN
        if($this->mdl_admin->logged_id()){

            $nik=$this->input->post('nik');
            $no_ktp=$this->input->post('no_ktp');
            $no_bpjs=$this->input->post('no_bpjs');
            $nama=$this->input->post('nama');
            $ttl=$this->input->post('ttl');
            $jenkel=$this->input->post('jenkel');
            $alamat=$this->input->post('alamat');
            $no_telp=$this->input->post('no_telp');
            $email=$this->input->post('email');
            $username=$this->input->post('username');
            $password=md5($this->input->post('password'));
            $id_status=$this->input->post('id_status');
            $jabatan=$this->input->post('jabatan');
            $id_profesi=$this->input->post('id_profesi');
            $id_golongan=$this->input->post('id_golongan');
            $ruangan=$this->input->post('ruangan');

            $where = array('id_karyawan' => $id);

            $tdy=date('Y-m-d');
           
            $xxx =mysqli_connect("localhost","root","","kepegawaian");
            $idPro=mysqli_fetch_array(mysqli_query($xxx,"select * from jenis_profesi where nama_profesi = '$id_profesi'"));

            $dataProfesi = array('id_karyawan' => $id, 'ruangan' => $ruangan, 'id_profesi' => $idPro['id_profesi'], 'mulai' => $tdy );
            $dataStatus = array('id_karyawan' => $id, 'id_status' => $id_status, 'mulai' => $tdy);
            $dataGolongan = array('id_karyawan' => $id, 'id_golongan' => $id_golongan, 'mulai' => $tdy);

            $dataKaryawan = array(
                'nik' => $nik,
                'no_ktp' => $no_ktp,
                'no_bpjs' => $no_bpjs,
                'nama' => $nama,
                'ttl' => date('Y-m-d',strtotime($ttl)),
                'jenkel' => $jenkel,
                'alamat' => $alamat,
                'no_telp' => $no_telp,
                'email' => $email,
                'id_status' => $id_status,
                'jabatan' => $jabatan,
                'id_profesi' => $idPro['id_profesi'],
                'id_golongan' => $id_golongan
            );
            $datalogin = array(
                'username' => $username,
                'password' => $password
            );

            //DATA KARYAWAN SEKARANG SEBELUM DI EDIT
            $dataSkg = $this->mdl_admin->dataDiri($id);

            if ($dataSkg->ruangan != $ruangan || $dataSkg->id_profesi != $idPro['id_profesi'] ) {
               $this->mdl_admin->addData('riwayat',$dataProfesi);
            }else{}
            if ($dataSkg->id_golongan != $id_golongan) {
                $this->mdl_admin->addData('golongan',$dataGolongan);
            }else{}
            if ($dataSkg->id_status != $id_status) {
                $this->mdl_admin->addData('status',$dataStatus);
            }else{}

            // update data karyawan
            $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');
            $this->mdl_admin->updateData($where,$datalogin,'login');
            redirect("adminKaryawan/karyawanDetail/$id");
        }else{ redirect("login");} 
    }
    
   public function addpend($id){// MENAMPILKAN FORM TAMBAH PENDIDIKAN MELALUI HALAMAN DETAIL
    if($this->mdl_admin->logged_id()){
        $this->form_validation->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required' );

        if ($this->form_validation->run()==FALSE) {
            $idl['id']=$id;
            $this->load->view('admin/karyawan/pendidikan/addpendidikan',$idl);
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
            redirect("adminKaryawan/karyawanDetail/$id_karyawan");
        }
      } else{ redirect("login"); }
    }

    public function editpend($id){//edit pendidikan dari detail karyawan
        if($this->mdl_admin->logged_id()){
            $this->form_validation->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required' );

            if ($this->form_validation->run()==FALSE) {
                $paket['array']=$this->mdl_pelamar->getDetailpend($id);
                $this->load->view('admin/Karyawan/pendidikan/editpendidikan', $paket);
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
                $nik = $this->input->post('nik');
                $nilai = $this->input->post('nilai');
                $mulai = $this->input->post('mulai');
                $akhir = $this->input->post('akhir');
                $nomor_ijazah = $this->input->post('nomor_ijazah');
                $konek=mysqli_connect("localhost","root","","kepegawaian");
                $s=mysqli_fetch_array(mysqli_query($konek, "select * from pendidikan where id = $id"));
                $datax=mysqli_fetch_array(mysqli_query($konek, "select id_karyawan from karyawan where nik = '$nik'"));
                $id_karyawan = $datax['id_karyawan'];
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
                $where = array(
                    'id' => $id
                );

                $update = $this->mdl_pelamar->updatedata($where,$data3,'pendidikan');
                $this->session->set_flashdata('msg','Data Sukses di Update');
                redirect("adminKaryawan/karyawanDetail/$id_karyawan");
            }
        }else{ redirect("login"); }         
    }
    
    public function delPend($id,$idk){
       if($this->mdl_admin->logged_id()){
            $this->mdl_admin->delPend($id);
            redirect("adminKaryawan/karyawanDetail/$idk");
        }
        
        else{ redirect("login"); } 
    }

    //VERIFIKASI IJASAH
    public function verPend($id,$idk){
       if($this->mdl_admin->logged_id())
        {
            $where = array( 'id' => $id ); 
            $data = array( 'verifikasi' => 1 ); 
            $this->mdl_admin->updateData($where,$data,'pendidikan');
            redirect("adminKaryawan/karyawanDetail/$idk");
            }

        else{ redirect("login"); } 
    }

    public function addSurat($id){//tambah data surat dari detail karyawan
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('id_karyawan','Id Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['id']=$id;
                $data['surat']=$this->mdl_admin->getJenSur();
                $this->load->view('admin/karyawan/surat/addSurat',$data);
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
                redirect("adminKaryawan/karyawanDetail/$id");
            }
        }else{ redirect("login"); } 
    }
     public function editsurat($id){//edit surat dari detail karyawan
        if($this->mdl_admin->logged_id()){
            $this->form_validation->set_rules('no_surat', 'Nomor Surat', 'trim|required' );

            if ($this->form_validation->run()==FALSE) {
                $paket['data']=$this->mdl_karyawan->getDetailSur($id);
                $this->load->view('admin/Karyawan/surat/editsurat', $paket);
            }
            else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'jpg|png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;
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

                if ($this->upload->do_upload('file')) {
                    $file = $this->upload->data('file_name');
                }else {
                    $file=$c['file'];
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
                redirect("adminKaryawan/karyawanDetail/$id_karyawan");
            }
        }else{ redirect("login"); }         
    }
    
    public function delsurat($id,$idk){
        $this->mdl_karyawan->delsurat($id);
        redirect("adminKaryawan/karyawanDetail/$idk");
    }

    public function addNilai($id){//tambah data surat dari detail karyawan
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('id_penilai','Id Penilai','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['id']=$id;
                $this->load->view('admin/karyawan/penilaian/addNilai', $data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'jpg|png|docx|pdf';
                $config['max_size']         = 2000;
                $this->load->library('upload', $config);

                $konek =mysqli_connect("localhost","root","","kepegawaian");
                $nik=$this->input->post('id_penilai');
                $id_karyawan=$this->input->post('id_karyawan');
                $b=mysqli_fetch_array(mysqli_query($konek, "select * from karyawan where nik = '$nik'"));
                $id_penilai = $b['id_karyawan'];
                $tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
                $hasil = $this->input->post('hasil');
                if(!$this->upload->do_upload('file')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect("adminKaryawan/addNilai/$id");
                } else {
                    $file = $this->upload->data('file_name');
                }
                $data4 = array(
                    'id_karyawan' => $id,
                    'id_penilai'=>$id_penilai,
                    'tanggal'=>$tanggal, 
                    'hasil'=>$hasil,  
                    'file'=>$file,
                );

                $this->mdl_admin->addData('penilaian_karyawan',$data4);
                redirect("adminKaryawan/karyawanDetail/$id");
            }
        }else{ redirect("login"); } 
    }

    public function editNilai($id, $idk){//tambah data surat dari detail karyawan
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('id_penilai','Id Penilai','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getPenilaianedit($id);
                $this->load->view('admin/karyawan/penilaian/editNilai', $data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'jpg|png|docx|pdf';
                $config['max_size']         = 2000;
                $this->load->library('upload', $config);

                $konek =mysqli_connect("localhost","root","","kepegawaian");
                $nik=$this->input->post('id_penilai');
                $b=mysqli_fetch_array(mysqli_query($konek, "select * from karyawan where nik = '$nik'"));
                $id_penilai = $b['id_karyawan'];
                $tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
                $hasil = $this->input->post('hasil');
                if($_FILES['file']['name'] != '') {
                    if(!$this->upload->do_upload('file')) {
                        $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                        $this->session->set_flashdata('msg_error', $error);

                        redirect("adminKaryawan/editNilai/$idk");
                    } else {
                        $file = $this->upload->data('file_name');
                    }
                } else {
                    $file = $this->input->post('file_old');
                }
                $data4 = array(
                    'id_penilai'=>$id_penilai,
                    'tanggal'=> $tanggal, 
                    'hasil'=> $hasil,  
                    'file'=> $file,
                );

                $where = array(
                    'id' => $id
                );

                $update = $this->mdl_pelamar->updatedata($where,$data4,'penilaian_karyawan');
                $this->session->set_flashdata('msg','Data Sukses di Update');
                redirect("adminKaryawan/karyawanDetail/$idk");
            }
        }else{ redirect("login"); } 
    }

    public function delNilai($id,$idk){
        $where = array('id' => $id);
        $this->mdl_pelamar->hapusdata($where);
        redirect("adminKaryawan/karyawanDetail/$idk");
    }
    public function editAgama($id,$idk){
        $this->form_validation->set_rules('id','Id Nilai','trim|required');

        if($this->form_validation->run()==FALSE){
            $data['array']=$this->mdl_admin->getAgamaa($id);
            $this->load->view('admin/karyawan/penilaian/editAgama', $data);
        }else{

            $tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
            $hasil = $this->input->post('hasil');
            $data4 = array(
                'tanggal'=> $tanggal, 
                'hasil'=> $hasil
            );

            $where = array(
                'id' => $id
            );

            $update = $this->mdl_pelamar->updatedata($where,$data4,'riwayat_seleksi');
            $this->session->set_flashdata('msg','Data Sukses di Update');
            redirect("adminKaryawan/karyawanDetail/$idk");
        }
    }
    public function addCuti($id_karyawan){
        $tgl_awal=$this->input->post('tgl_awal');
        $tgl_akhir=$this->input->post('tgl_akhir');

        $dataCuti = array(
            'id_karyawan'=> $id_karyawan, 
            'tgl_awal'=> $tgl_awal,
            'tgl_akhir'=> $tgl_akhir
        );
        $this->mdl_admin->addData('data_cuti',$dataCuti);
        redirect("adminKaryawan/karyawanDetail/$id_karyawan");
    }
    public function editCuti($id,$idk){
        $this->form_validation->set_rules('id','Id Data Cuti','trim|required');

        if($this->form_validation->run()==FALSE){
            $data['array']=$this->mdl_admin->getEC($id);
            $this->load->view('admin/karyawan/riwayat/Cuti/edit', $data);
        }else{

            $tgl_awal = date('Y-m-d',strtotime($this->input->post('tgl_awal')));
            $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));

            $dataCuti = array(
                'tgl_awal'=> $tgl_awal,
                'tgl_akhir'=> $tgl_akhir
            );

            $where = array(
                'id' => $id
            );

            $update = $this->mdl_pelamar->updatedata($where,$dataCuti,'data_cuti');
            $this->session->set_flashdata('msg','Data Sukses di Update');
            redirect("adminKaryawan/karyawanDetail/$idk");
        }
    }
    public function addAgama($id_karyawan){

        $seleksi = array(
            'id_karyawan' => $id_karyawan,
            'tgl_seleksi' => "-",
            'nilai_agama' => "-",
            'nilai_kompetensi' => "-",
            'tes_ppa' => "-",
            'tes_psikologi' => "-",
            'tes_kesehatan' => "-",
            'nilai_wawancara' => "-"
        );

        $this->mdl_admin->addData('seleksi',$seleksi);

        $konek =mysqli_connect("localhost","root","","kepegawaian");
        $b=mysqli_fetch_array(mysqli_query($konek, "select * from seleksi where id_karyawan = '$id_karyawan'"));
        $id_seleksi = $b['id_seleksi'];

        $tanggal_agama= date('Y-m-d', strtotime($this->input->post('tanggal_agama')));
        $hasil_agama=$this->input->post('hasil_agama');

        $tanggal_doa=date('Y-m-d', strtotime($this->input->post('tanggal_doa')));
        $hasil_doa=$this->input->post('hasil_doa');

        $tanggal_bimbing=date('Y-m-d', strtotime($this->input->post('tanggal_bimbing')));
        $hasil_bimbing=$this->input->post('hasil_bimbing');

        $tanggal_baca=date('Y-m-d', strtotime($this->input->post('tanggal_baca')));
        $hasil_baca=$this->input->post('hasil_baca');

        $agama = array(
            'id_seleksi' => $id_seleksi,
            'nama_tes' => "Tes Agama",
            'tanggal'=> $tanggal_agama,
            'hasil'=> $hasil_agama
        );
        $doa = array(
            'id_seleksi' => $id_seleksi,
            'nama_tes' => "Doa Sehari-hari",
            'tanggal'=> $tanggal_doa,
            'hasil'=> $hasil_doa
        );
        $bimbing = array(
            'id_seleksi' => $id_seleksi,
            'nama_tes' => "Tes Membimbing Pasien",
            'tanggal'=> $tanggal_bimbing,
            'hasil'=> $hasil_bimbing
        );
        $baca = array(
            'id_seleksi' => $id_seleksi,
            'nama_tes' => "Baca Al-Quran",
            'tanggal'=> $tanggal_baca,
            'hasil'=> $hasil_baca
        );

        $this->mdl_admin->addData('riwayat_seleksi',$agama);
        $this->mdl_admin->addData('riwayat_seleksi',$doa);
        $this->mdl_admin->addData('riwayat_seleksi',$bimbing);
        $this->mdl_admin->addData('riwayat_seleksi',$baca);
        redirect("adminKaryawan/karyawanDetail/$id_karyawan");
    }

    public function loadimpor(){
        if($this->mdl_admin->logged_id()){
        $this->load->view('admin/Karyawan/impor');
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
                    $no_ktp= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nama= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $alamat = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $no_telp = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $email= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $jenkel= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $id_status = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $jabatan = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $id_profesi= $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $id_golongan= $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $konek =mysqli_connect("localhost","root","","kepegawaian");
                    $cip=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select id_profesi from jenis_profesi where nama_profesi ='$id_profesi'"));
                    
                    $data1[]= array(
                        'id_profesi' => $cip['id_profesi'],
                        'id_status' => $id_status,
                        'id_golongan' => $id_golongan,
                        'nik' => $nik,
                        'nama' => $nama,
                        'no_ktp' => $no_ktp,
                        'no_telp' => $no_telp,
                        'foto' => 'profile.png',
                        'jenkel' => $jenkel,
                        'email' => $email,
                        'jabatan' => $jabatan,
                        'alamat' => $alamat
                    );

                    $this->mdl_admin->impor('karyawan',$data1);
                    $cariId=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select id_karyawan from karyawan where nik = '$nik'"));
                    $data2[]=array(
                        'username'=>$nik, 
                        'password'=>md5($no_ktp), 
                        'level'=>'Karyawan', 
                        'aktif'=>0, 
                        'id_karyawan'=>$cariId['id_karyawan']
                    );

                    $config = array();
                    $config['charset'] = 'utf-8';
                    $config['useragent'] = 'CodeIgniter';
                    $config['protocol']= "smtp";
                    $config['mailtype']= "html";
                    $config['smtp_host']= "ssl://smtp.gmail.com";
                    $config['smtp_port']= "465";
                    $config['smtp_timeout']= "400";
                    $config['smtp_user']= "hilfinaamaris09@gmail.com";
                    $config['smtp_pass']= "hilfano090798";
                    $config['crlf']="\r\n"; 
                    $config['newline']="\r\n"; 
                    $config['wordwrap'] = TRUE;
                    $this->email->initialize($config);
                    $encrypted_id = $cariId['id_karyawan'];
                    $this->email->from($config['smtp_user']);
                    $this->email->to($email);
                    $this->email->subject("Verifikasi Akun");
                    $this->email->message(
                        "Terimakasih telah melakukan registrasi pada Sistem Infromasi Kepegawaian RSIA,<br>
                        username: nomor induk karyawan. <br>
                        password: nomor ktp anda.<br>
                        untuk memverifikasi silahkan klik tombol dibawah ini<br><br>".
                        "<a href='".site_url("login/verification/$encrypted_id")."'><button>verifikasi</button</a>"
                    );
                    if($this->email->send()){
                        $this->mdl_admin->impor('login',$data2);
                    }else{

                    }
                }
            }

            
            echo "<script>alert('Berhasil Menambahkan Data'); document.location.href = '" . site_url('Adminkaryawan') . "';</script>";
        }        
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */