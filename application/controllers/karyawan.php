<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        $this->load->model('mdl_login');
		$this->load->model('mdl_karyawan');
		$this->load->model('mdl_pelamar');
		$this->load->model('mdl_home');
		$this->load->helper('url','form','file');
		$this->load->library('form_validation','image_lib');
	}
	public function index()
	{
		if($this->admin_model->logged_id())
		{
			$this->load->view("dashboard");
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

    public function datasaya(){
        $id=$this->session->userdata('myId');
		$paket['array']=$this->mdl_karyawan->getKaryawan($id);
		$paket['array']=$this->mdl_admin->getProfesi();
        $paket['datDir']=$this->mdl_admin->getTempat($id);
        $paket['array']=$this->mdl_admin->getRiwayat($id);
        $paket['stat']=$this->mdl_karyawan->getStatus($id);
        $paket['gol']=$this->mdl_karyawan->getGol($id);
        $paket['ber']=$this->mdl_karyawan->getBerkala($id);
		$this->load->view('karyawan/profil',$paket);
        
    }

    public function updatedatasaya(){
	$config['upload_path']		= './Assets/gambar/';
	$config['allowed_types']	= 'gif|jpg|png';
	$config['max_size']			= 2000000000;
	$config['max_width']		= 10240;
	$config['max_height']		= 7680;

	$this->load->library('upload', $config);

	$id=$this->session->userdata('myId');
	$nik = $this->input->post('nik');
	$no_ktp = $this->input->post('no_ktp');
	$no_bpjs = $this->input->post('no_bpjs');
	$nama = $this->input->post('nama');
	$alamat = $this->input->post('alamat');
	$no_telp = $this->input->post('no_telp');
	$email = $this->input->post('email');
	$this->upload->do_upload('fotosaya');
	$fotosaya = $this->upload->data('file_name');
 
	$data = array(
		'nik' => $nik,
		'no_ktp' => $no_ktp,
		'no_bpjs' => $no_bpjs,
		'nama' => $nama,
		'alamat' => $alamat,
		'no_telp' => $no_telp,
		'email' => $email,
		'foto' => $fotosaya
	);
 
	$where = array(
		'id_karyawan' => $id
	);

	$update = $this->mdl_pelamar->updatedata($where,$data,'karyawan');
	redirect('karyawan/datasaya');
	}

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
			$config['upload_path']		= './Assets/gambar/';
			$config['allowed_types']	= 'gif|jpg|png';
			$config['max_size']			= 2000000000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload', $config);

		    $id=$this->session->userdata('myId');
			$pendidikan = $this->input->post('pendidikan');
			$jurusan  = $this->input->post('jurusan');
		    $mulai = $this->input->post('mulai');
		    $akhir = $this->input->post('akhir');
		    $nomor_ijazah = $this->input->post('nomor_ijazah');
		    $this->upload->do_upload('file');
			$a = $this->upload->data('file_name');
		    $data3 = array(
		            'pendidikan'=>$pendidikan,
		            'jurusan' => $jurusan,
		            'mulai'=>$mulai,
			        'akhir'=>$akhir,
			        'nomor_ijazah'=>$nomor_ijazah,
		            'id_karyawan' => $id,
		            'file'=>$a,
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
			$config['upload_path']		= './Assets/gambar/';
			$config['allowed_types']	= 'gif|jpg|png';
			$config['max_size']			= 2000000000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload', $config);
			$pendidikan = $this->input->post('pendidikan');
			$jurusan  = $this->input->post('jurusan');
		    $mulai = $this->input->post('mulai');
		    $akhir = $this->input->post('akhir');
		    $nomor_ijazah = $this->input->post('nomor_ijazah');
		    $this->upload->do_upload('file');
			$a = $this->upload->data('file_name');
		    $data3 = array(
		            'pendidikan'=>$pendidikan,
		            'jurusan' => $jurusan,
		            'mulai'=>$mulai,
			        'akhir'=>$akhir,
			        'nomor_ijazah'=>$nomor_ijazah,
		            'file'=>$a,
		            'verifikasi'=> 0,
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
			$config['upload_path']		= './Assets/gambar/';
			$config['allowed_types']	= 'gif|jpg|png';
			$config['max_size']			= 2000000000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload', $config);

		    $id=$this->session->userdata('myId');
		    $nama_surat = $this->input->post('nama_surat');
		    $konek = mysqli_connect("localhost","root","","kepegawaian");
			$query = "select id_surat from jenis_surat where nama_surat = '$nama_surat'";
			$data=mysqli_fetch_array(mysqli_query($konek, $query));
		    $xxx = $data['id_surat'];
			$id_surat = $xxx;
		    $tgl_mulai = $this->input->post('tgl_mulai');
		    $tgl_akhir = $this->input->post('tgl_akhir');
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
			$config['upload_path']		= './Assets/gambar/';
			$config['allowed_types']	= 'gif|jpg|png';
			$config['max_size']			= 2000000000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload', $config);
			$nama_surat = $this->input->post('nama_surat');
		    $konek = mysqli_connect("localhost","root","","kepegawaian");
			$query = "select id_surat from jenis_surat where nama_surat = '$nama_surat'";
			$data=mysqli_fetch_array(mysqli_query($konek, $query));
		    $xxx = $data['id_surat'];
			$id_surat = $xxx;
		    $tgl_mulai = $this->input->post('tgl_mulai');
		    $tgl_akhir = $this->input->post('tgl_akhir');
		    $no_surat = $this->input->post('no_surat');
		    $this->upload->do_upload('file');
			$b = $this->upload->data('file_name');
		    $data = array(
			        'id_surat'=>$id_surat,
			        'tgl_mulai'=>$tgl_mulai,
			        'tgl_akhir'=>$tgl_akhir, 
			        'no_surat'=>$no_surat,  
			        'file'=>$b,
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

	public function nilai(){
		$id=$this->session->userdata('myId');
		$paket['array']=$this->mdl_pelamar->getNilai($id);
		$this->load->view('pelamar/nilai',$paket);
	}

}