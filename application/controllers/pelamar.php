<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pelamar extends CI_Controller {
	private $filename = "import_data";

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
	
	public function datasaya(){
		$id=$this->session->userdata('myId');
		$paket['datasaya']=$this->mdl_pelamar->getPelamar($id);
		$this->load->view('pelamar/datapelamar',$paket);
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

	$pend_akhir = $this->input->post('pend_akhir');
    $nilai_akhir = $this->input->post('nilai_akhir');
    $data2 = array(
            'pend_akhir'=>$pend_akhir,
            'nilai_akhir'=>$nilai_akhir,
            'id_karyawan' => $id,
        );

 	$update2 = $this->mdl_pelamar->updatedatasaya($where,$data2,'lowongan');
	$update = $this->mdl_pelamar->updatedatasaya($where,$data,'karyawan');
	redirect('pelamar/datasaya');
	}

	public function datapend(){
		$id=$this->session->userdata('myId');
		$paket['array']=$this->mdl_pelamar->getPend($id);
		$this->load->view('pelamar/datapendidikan',$paket);
	}

	public function addpend(){
		$config['upload_path']		= './Assets/gambar/';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= 2000000000;
		$config['max_width']		= 10240;
		$config['max_height']		= 7680;

		$this->load->library('upload', $config);
	    $id=$this->session->userdata('myId');
		$pendidikan = $this->input->post('pendidikan');
	    $mulai = $this->input->post('mulai');
	    $akhir = $this->input->post('akhir');
	    $nomor_ijazah = $this->input->post('nomor_ijazah');
	    $this->upload->do_upload('pendidikanfile');
		$a = $this->upload->data('file_name');
	    $data3 = array(
	            'pendidikan'=>$pendidikan,
	            'mulai'=>$mulai,
		        'akhir'=>$akhir,
		        'nomor_ijazah'=>$nomor_ijazah,
	            'id_karyawan' => $id,
	            'file'=>$a,
	            'verifikasi'=> 'Belum Terverifikasi',
	        );
	    $insert3 = $this->mdl_login->daftar('pendidikan',$data3);
	}

	public function addsurat(){
		$config['upload_path']		= './Assets/gambar/';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= 2000000000;
		$config['max_width']		= 10240;
		$config['max_height']		= 7680;

		$this->load->library('upload', $config);
	    $id=$this->session->userdata('myId');
	    $xxx = $this->input->post('id_surat');
	    $konek = mysqli_connect("localhost","root","","kepegawaian");
              $query = "select id_surat from jenis_surat where nama_surat = '$xxx'";
              $data=mysqli_fetch_array(mysqli_query($konek, $query));

		$id_surat = $data['id_surat'];
	    $tgl_mulai = $this->input->post('tgl_mulai');
	    $tgl_akhir = $this->input->post('tgl_akhir');
	    $no_surat = $this->input->post('no_surat');
	    $this->upload->do_upload('suratfile');
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
	}
}

/* End of file pelamar.php */
/* Location: ./application/controllers/pelamar.php */