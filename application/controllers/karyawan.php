<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {
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
		if($this->admin_model->logged_id())
		{
			$this->load->view("homee");
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	public function home(){
		$this->load->view("pelamar/home");
	}

	////////////////DATA PROFIL/////////////////////// 
    public function datasaya(){
        $id=$this->session->userdata('myId');
        $where = array('id_karyawan'=> $id);
		$paket['array']=$this->mdl_karyawan->getKaryawan($id);
		$paket['array']=$this->mdl_admin->getProfesi();
        $paket['datDir']=$this->mdl_admin->getTempat($id);
        $paket['datRi']=$this->mdl_karyawan->getRiwayat($id);
        $paket['stat']=$this->mdl_karyawan->getStatus($id);
        $paket['gol']=$this->mdl_karyawan->getGol($id);
        $paket['ber']=$this->mdl_karyawan->getBerkala($id);
        $paket['mous']=$this->mdl_karyawan->getMous($id);
        $paket['mouk']=$this->mdl_karyawan->getMouk($id);
        $paket['mouh']=$this->mdl_karyawan->getMouh($id);
        $paket['moui']=$this->mdl_karyawan->getData('mou_klinis', $where);
        $paket['moup']=$this->mdl_karyawan->getData('mou_pelatihan', $where);
        $paket['urai']=$this->mdl_karyawan->getData('uraian_tugas',$where);

		$this->load->view('karyawan/profil',$paket);
        
    }

    public function updatedatasaya(){
	$config['upload_path']		= './Assets/gambar/';
	$config['allowed_types']	= 'jpg|png';
	$config['max_size']			= 2000;
	$config['max_width']		= 400;
	$config['max_height']		= 400;

	$this->load->library('upload', $config);

	$id=$this->session->userdata('myId');
	$nik = $this->input->post('nik');
	$no_ktp = $this->input->post('no_ktp');
	$no_bpjs = $this->input->post('no_bpjs');
	$nama = $this->input->post('nama');
	$alamat = $this->input->post('alamat');
	$no_telp = $this->input->post('no_telp');
	$email = $this->input->post('email');
	$status = $this->input->post('status');
	$anak = $this->input->post('anak');
	$jenkel = $this->input->post('jenkel');
	$ttl = $this->input->post('ttl');

	if($_FILES['fotosaya']['name'] != '') {
        if(!$this->upload->do_upload('fotosaya')) {
            $error = ("<b>Error!</b> foto profil harus berbentuk jpg/png dan berukuran 300x400");
		    redirect("karyawan/datasaya");
        } else {
            $fotosaya = $this->upload->data('file_name');
        }
    } else {
        $fotosaya = $this->input->post('gambar_old');
    }


	
	$data = array(
		'nik' => $nik,
		'no_ktp' => $no_ktp,
		'no_bpjs' => $no_bpjs,
		'nama' => $nama,
		'alamat' => $alamat,
		'no_telp' => $no_telp,
		'email' => $email,
		'ttl' => $ttl,
		'jenkel' => $jenkel,
		'foto' => $fotosaya,
		'status' => $status,
		'anak' => $anak
	);
 
	$where = array(
		'id_karyawan' => $id
	);

	$update = $this->mdl_pelamar->updatedata($where,$data,'karyawan');
	redirect('karyawan/datasaya');
	}

	//////////////DATA PENDIDIKAN/////////////////////////
    public function datapend(){
		$id=$this->session->userdata('myId');
		$paket['array']=$this->mdl_pelamar->getPend($id);
		$this->load->view('karyawan/datapendidikan',$paket);
	}

	public function addpend(){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required' );
		$this->load->model('mdl_pelamar');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('karyawan/addpendidikan');
		}
		else{
			$config['upload_path']		= './Assets/dokumen/';
			$config['allowed_types']	= 'pdf';
			$config['max_size']			= 2000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload', $config);

		    $id=$this->session->userdata('myId');
			$pendidikan = $this->input->post('pendidikan');
			$jurusan  = $this->input->post('jurusan');
			$nilai = $this->input->post('nilai');
		    $mulai = $this->input->post('mulai');
		    $akhir = $this->input->post('akhir');
		    $nomor_ijazah = $this->input->post('nomor_ijazah');
		    if(!$this->upload->do_upload('file')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect('karyawan/addpend');
                } else {
                    $file = $this->upload->data('file_name');
                }

		    $data3 = array(
		            'pendidikan'=>$pendidikan,
		            'jurusan' => $jurusan,
		            'nilai' => $nilai,
		            'mulai'=>$mulai,
			        'akhir'=>$akhir,
			        'nomor_ijazah'=>$nomor_ijazah,
		            'id_karyawan' => $id,
		            'file'=>$file,
		            'verifikasi'=> 0,
		        );
		    $insert3 = $this->mdl_pelamar->tambahdata('pendidikan',$data3);

		    $this->session->set_flashdata('msg','Data Sukses di tambahkan');
		    redirect(site_url('karyawan/datapend'));
		}
	}

	public function detailpend($id){
		$paket['array']=$this->mdl_pelamar->getDetailpend($id);
		$this->load->view('karyawan/detailpend', $paket);
	}

	public function editpend($id){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required' );
		$this->load->model('mdl_pelamar');

		if ($this->form_validation->run()==FALSE) {
			$paket['array']=$this->mdl_pelamar->getDetailpend($id);
			$this->load->view('karyawan/editpendidikan', $paket);
		}
		else{
			$config['upload_path']		= './Assets/dokumen/';
			$config['allowed_types']	= 'pdf';
			$config['max_size']			= 2000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload', $config);
			$pendidikan = $this->input->post('pendidikan');
			$jurusan  = $this->input->post('jurusan');
			$nilai = $this->input->post('nilai');
		    $mulai = $this->input->post('mulai');
		    $akhir = $this->input->post('akhir');
		    $nomor_ijazah = $this->input->post('nomor_ijazah');
		    if($_FILES['file']['name'] != '') {
                if(!$this->upload->do_upload('file')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");
                    $this->session->set_flashdata('msg_error', $error);

                    redirect("karyawan/editpend/$id");
                } else {
                    $file = $this->upload->data('file_name');
                }
            } else {
                $file = $this->input->post('file_old');
            }

		    $data3 = array(
		            'pendidikan'=>$pendidikan,
		            'jurusan' => $jurusan,
		            'nilai' => $nilai,
		            'mulai'=>$mulai,
			        'akhir'=>$akhir,
			        'nomor_ijazah'=>$nomor_ijazah,
		            'file'=>$file,
		        );
		    $where = array(
				'id' => $id
			);

		    $update = $this->mdl_pelamar->updatedata($where,$data3,'pendidikan');
		    $this->session->set_flashdata('msg','Data Sukses di Update');
		    redirect(site_url('karyawan/datapend'));
		}
			
	}

	public function hapuspend($id)
	{
		$where = array('id' => $id);
		$this->mdl_pelamar->hapusdata('pendidikan',$where);
		$this->session->set_flashdata('msg','Data Sukses di Hapus');
		redirect(site_url('karyawan/datapend'));
	}


	///////////////// DATA SURAT //////////////////////////
	public function datasurat(){
		$id=$this->session->userdata('myId');
		$paket['array']=$this->mdl_pelamar->getSurat($id);
		$this->load->view('karyawan/datasurat',$paket);
	}

	public function addsurat(){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('no_surat', 'Nomor Surat', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('karyawan/addsuratsipstr');
		}
		else{
			$config['upload_path']		= './Assets/dokumen/';
			$config['allowed_types']	= 'pdf';
			$config['max_size']			= 2000;

			$this->load->library('upload', $config);

		    $id=$this->session->userdata('myId');
		    $nama_surat = $this->input->post('nama_surat');
		    $konek = mysqli_connect("localhost","root","","kepegawaian");
			$query = "select id_surat from jenis_surat where nama_surat = '$nama_surat'";
			$data=mysqli_fetch_array(mysqli_query($konek, $query));
		    $xxx = $data['id_surat'];
			$id_surat = $xxx;
		    $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
			$tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
		    $no_surat = $this->input->post('no_surat');
		    if(!$this->upload->do_upload('file')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect('karyawan/addsurat');
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

		    $insert = $this->mdl_pelamar->tambahdata('sip_str',$data4);
		    $this->session->set_flashdata('msg','Data Sukses di tambahkan');
		    redirect(site_url('karyawan/datasurat'));
		}
	}

	public function detailsurat($id){
		$paket['array']=$this->mdl_pelamar->getDetailsurat($id);
		$this->load->view('karyawan/detailsurat', $paket);
	}

	public function editsurat($id){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('no_surat', 'Nomor Surat', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$paket['array']=$this->mdl_pelamar->getDetailsurat($id);
			$this->load->view('karyawan/editsurat', $paket);;
		}
		else{
			$config['upload_path']		= './Assets/dokumen/';
			$config['allowed_types']	= 'pdf';
			$config['max_size']			= 2000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload', $config);
			$nama_surat = $this->input->post('nama_surat');
		    $konek = mysqli_connect("localhost","root","","kepegawaian");
			$query = "select id_surat from jenis_surat where nama_surat = '$nama_surat'";
			$data=mysqli_fetch_array(mysqli_query($konek, $query));
		    $xxx = $data['id_surat'];
			$id_surat = $xxx;
		    $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
			$tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
		    $no_surat = $this->input->post('no_surat');
		    if($_FILES['file']['name'] != '') {
                if(!$this->upload->do_upload('file')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");
                    $this->session->set_flashdata('msg_error', $error);

                    redirect("karyawan/editsurat/$id");
                } else {
                    $file = $this->upload->data('file_name');
                }
            } else {
                $file = $this->input->post('file_old');
            }
		    $data = array(
			        'id_surat'=>$id_surat,
			        'tgl_mulai'=>$tgl_mulai,
			        'tgl_akhir'=>$tgl_akhir, 
			        'no_surat'=>$no_surat,  
			        'file'=>$file,
			        'aktif'=> 0,
		        );
		    $where = array(
				'id_sipstr' => $id
			);

		    $update = $this->mdl_pelamar->updatedata($where,$data,'sip_str');
		    $this->session->set_flashdata('msg','Data Sukses di Update');
		    redirect(site_url('karyawan/datasurat'));
		}
			
	}

	public function hapussurat($id)
	{
		$where = array('id_sipstr' => $id);
		$this->mdl_pelamar->hapusdata('sip_str',$where);
		$this->session->set_flashdata('msg','Data Sukses di Hapus');
		redirect(site_url('karyawan/datasurat'));
	}

	///////////// DATA ORIENTASI ///////////////

	public function dataori(){
		$id=$this->session->userdata('myId');
		$paket['array']=$this->mdl_karyawan->getOri($id);
		$this->load->view('karyawan/dataorientasi',$paket);
	}

	public function addori(){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tgl_mulai', 'Tanggal Orientasi', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('karyawan/addori');
		}
		else{
			$config['upload_path']		= './Assets/gambar/';
			$config['allowed_types']	= 'jpg|pdf';
			$config['max_size']			= 2000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload', $config);

		    $id=$this->session->userdata('myId');
		    
		    $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
			$tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
		    $no_surat = $this->input->post('no_surat');
		    if(!$this->upload->do_upload('doku_hadir')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect('karyawan/addori');
                } else {
                    $doku_hadir = $this->upload->data('file_name');
                }

		    $data = array(
			    	'id_karyawan' => $id,
			        'tgl_mulai'=>$tgl_mulai,
			        'tgl_akhir'=>$tgl_akhir,  
			        'doku_hadir'=>$doku_hadir,
		        );

		    $insert = $this->mdl_pelamar->tambahdata('orientasi',$data);
		    $this->session->set_flashdata('msg','Data Sukses di tambahkan');
		    redirect(site_url('karyawan/dataori'));
		}
	}

	public function editori($id){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('doku_hadir', 'Dokumen Kehadiran', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$where = array('id_orientasi'=>$id);
			$paket['dato']=$this->mdl_admin->getData('orientasi',$where);
			$this->load->view('karyawan/editori', $paket);
		}
		else{
			$config['upload_path']		= './Assets/dokumen/';
			$config['allowed_types']	= 'jpg|pdf';
			$config['max_size']			= 2000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload', $config);
		    
		    $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
			$tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
		    $no_surat = $this->input->post('no_surat');
		    if($_FILES['doku_hadir']['name'] != '') {
                if(!$this->upload->do_upload('doku_hadir')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");
                    $this->session->set_flashdata('msg_error', $error);

                    redirect("karyawan/editori/$id");
                } else {
                    $doku_hadir = $this->upload->data('file_name');
                }
            } else {
                $doku_hadir = $this->input->post('file_old');
            }
		    $data = array(
			        'tgl_mulai'=>$tgl_mulai,
			        'tgl_akhir'=>$tgl_akhir,  
			        'doku_hadir'=>$doku_hadir,
		        );
		    $where = array('id_orientasi'=>$id);

		    $update = $this->mdl_pelamar->updatedata($where,$data,'orientasi');
		    $this->session->set_flashdata('msg','Data Sukses di tambahkan');
		    redirect(site_url('karyawan/dataori'));
		}
	}

	public function hapusori($id)
	{
		$where = array('id_orientasi' => $id);
		$this->mdl_pelamar->hapusdata('orientasi',$where);
		$this->session->set_flashdata('msg','Data Sukses di Hapus');
		redirect(site_url('karyawan/dataorientasi'));
	}

	////////////  DATA DIKLAT /////////////////

	public function datadiklat(){
		$id=$this->session->userdata('myId');
		$paket['array']=$this->mdl_karyawan->getDiklat($id);
		$this->load->view('karyawan/datadiklat',$paket);
	}

	public function adddiklat(){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nomor_sertif', 'Nomor Sertifikat', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('karyawan/adddiklat');
		}
		else{
			$config['upload_path']		= './Assets/dokumen/';
			$config['allowed_types']	= 'pdf';
			$config['max_size']			= 2000;

			$this->load->library('upload', $config);

		    $id=$this->session->userdata('myId');
		    
		    $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
			$tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
		    $nomor_sertif = $this->input->post('nomor_sertif');
		    $nama_diklat = $this->input->post('nama_diklat');
		    $jenis_diklat = $this->input->post('jenis_diklat');
		    $jam = $this->input->post('jam');
		    $tahun = $this->input->post('tahun');
		    if(!$this->upload->do_upload('file')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect('karyawan/adddiklat');
                } else {
                    $file = $this->upload->data('file_name');
                }

		    $data = array(
			    	'id_karyawan' => $id,
			    	'nomor_sertif'=>$nomor_sertif,
			    	'nama_diklat'=>$nama_diklat,
			    	'jenis_diklat'=>$jenis_diklat,
			        'tgl_mulai'=>$tgl_mulai,
			        'tgl_akhir'=>$tgl_akhir, 
			        'jam'=>$jam, 
			        'tahun'=>$tahun,
			        'file'=>$file,
		        );

		    $insert = $this->mdl_pelamar->tambahdata('diklat',$data);
		    $this->session->set_flashdata('msg','Data Sukses di tambahkan');
		    redirect(site_url('karyawan/datadiklat'));
		}
	}

	public function editdiklat($id){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nomor_sertif', 'Nomor Sertifikat', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$where = array('id_diklat'=> $id);
			$paket['array']=$this->mdl_admin->getData('diklat',$where);
			$this->load->view('karyawan/editdiklat', $paket);
		}
		else{
			$config['upload_path']		= './Assets/dokumen/';
			$config['allowed_types']	= 'pdf';
			$config['max_size']			= 2000;

			$this->load->library('upload', $config);
		    
		    $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
			$tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
		    $nomor_sertif = $this->input->post('nomor_sertif');
		    $nama_diklat = $this->input->post('nama_diklat');
		    $jenis_diklat = $this->input->post('jenis_diklat');
		    $jam = $this->input->post('jam');
		    $tahun = $this->input->post('tahun');
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');
            }else {
                $file = $this->input->post('file_old');
            }
		    $data = array(
			    	'nomor_sertif'=>$nomor_sertif,
			    	'nama_diklat'=>$nama_diklat,
			    	'jenis_diklat'=>$jenis_diklat,
			        'tgl_mulai'=>$tgl_mulai,
			        'tgl_akhir'=>$tgl_akhir, 
			        'jam'=>$jam, 
			        'tahun'=>$tahun,
			        'file'=>$file
		        );
		    $where = array('id_diklat'=>$id);
		 $update = $this->mdl_pelamar->updatedata($where,$data,'diklat');   
		    $this->session->set_flashdata('msg','Data Sukses di Update');
		    redirect(site_url('karyawan/datadiklat'));
		}
	}

	public function hapusdiklat($id)
	{
		$where = array('id_diklat' => $id);
		$this->mdl_pelamar->hapusdata('diklat',$where);
		$this->session->set_flashdata('msg','Data Sukses di Hapus');
		redirect(site_url('karyawan/datadiklat'));
	}

	////////////   DATA KEWENANGAN KLINIS DOKTER  /////////////////////

	public function datakew(){
		$id=$this->session->userdata('myId');
		$paket['array']=$this->mdl_karyawan->getKew($id);
		$this->load->view('karyawan/dataklinis',$paket);
	}

	public function addkew(){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tgl_pengajuan', 'Tanggal Pengajuan Kewenangan Klinis', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('karyawan/addkew');
		}
		else{
			$config['upload_path']		= './Assets/dokumen/';
			$config['allowed_types']	= 'pdf';

			$this->load->library('upload', $config);

		    $id=$this->session->userdata('myId');
		    
		    $tgl_pengajuan = date('Y-m-d',strtotime($this->input->post('tgl_pengajuan')));
		    if(!$this->upload->do_upload('doku_pengajuan')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect('karyawan/addkew');
                } else {
                    $doku_pengajuan = $this->upload->data('file_name');
                }

		    $data = array(
			    	'id_karyawan' => $id,
			    	'tgl_pengajuan'=>$tgl_pengajuan,
			    	'doku_pengajuan'=>$doku_pengajuan,
		        );

		    $insert = $this->mdl_pelamar->tambahdata('kewenangan_klinis',$data);
		    $this->session->set_flashdata('msg','Data Sukses di tambahkan');
		    redirect(site_url('karyawan/datakew'));
		}
	}

	public function editkew($id){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tgl_pengajuan', 'Tanggal Pengajuan Kewenangan Klinis', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$where = array('id_kewenangan'=> $id);
			$paket['array']=$this->mdl_admin->getData('kewenangan_klinis',$where);
			$this->load->view('karyawan/editkew', $paket);
		}
		else{
			$config['upload_path']		= './Assets/dokumen/';
			$config['allowed_types']	= 'pdf';
			$config['max_size']			= 2000;

			$this->load->library('upload', $config);
		    
		    $tgl_pengajuan = date('Y-m-d',strtotime($this->input->post('tgl_pengajuan')));
            if(!$this->upload->do_upload('doku_pengajuan')) {
                $doku_pengajuan = $this->input->post('file_old');
            } else {
                $doku_pengajuan = $this->upload->data('file_name');
            }
            
		    $data = array(
			    	'tgl_pengajuan'=>$tgl_pengajuan,
			    	'doku_pengajuan'=>$doku_pengajuan
		        );

		    $where = array('id_kewenangan'=> $id);

		    $update = $this->mdl_pelamar->updatedata($where,$data,'kewenangan_klinis');
		    $this->session->set_flashdata('msg','Data Sukses di tambahkan');
		    redirect(site_url('karyawan/datakew'));
		}
	}

	public function hapuskew($id)
	{
		$where = array('id_kewenangan' => $id);
		$this->mdl_pelamar->hapusdata('kewenangan_klinis',$where);
		$this->session->set_flashdata('msg','Data Sukses di Hapus');
		redirect(site_url('karyawan/datakew'));
	}

	//=============aksi jika notifikasi ditekan===========//
	public function Nsurat($id)
	{
		$where = array('id_sipstr' => $id);
		$data = array('notif_k' => 1 );
		$this->mdl_pelamar->updatedata($where,$data,'sip_str');
		redirect("karyawan/editsurat/$id");
	}
	public function Nkontrak($id)
	{
		$where = array('id' => $id);
		$data = array('notif_k' => 1 );
		$this->mdl_pelamar->updatedata($where,$data,'mou_kontrak');
		redirect("karyawan/Dmou_k/$id");
	}
	public function Nsekolah($id)
	{
		$where = array('id' => $id);
		$data = array('notif_k' => 1 );
		$this->mdl_pelamar->updatedata($where,$data,'mou_sekolah');
		redirect("karyawan/Dmou_s/$id");
	}
	public function Nklinis($id)
	{
		$where = array('id' => $id);
		$data = array('notif_k' => 1 );
		$this->mdl_pelamar->updatedata($where,$data,'mou_klinis');
		redirect("karyawan/Dmou_kl/$id");
	}
	public function Nhutang($id)
	{
		$where = array('id' => $id);
		$data = array('notif_k' => 1 );
		$this->mdl_pelamar->updatedata($where,$data,'mou_hutang');
		redirect("karyawan/Dmou_h/$id");
	}

	//========cari detail data mou yang akan ditampilkan ketika klik notifikaso===========//
	public function Dmou_k($id)
	{
		$data['array'] = $this->mdl_home->Dmou_k($id);
		$this->load->view('karyawan/detailmou', $data);
	}
	public function Dmou_kl($id)
	{
		$data['array'] = $this->mdl_home->Dmou_kl($id);
		$this->load->view('karyawan/detailmou', $data);
	}
	public function Dmou_s($id)
	{
		$data['array'] = $this->mdl_home->Dmou_s($id);
		$this->load->view('karyawan/detailmou', $data);
	}
	public function Dmou_h($id)
	{
		$data['array'] = $this->mdl_home->Dmou_h($id);
		$this->load->view('karyawan/detailmou', $data);
	}
}