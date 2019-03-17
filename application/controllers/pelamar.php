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

	public function home(){
		$this->load->view("pelamar/home");
	}


	public function aktivasi()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('pelamar/aktivasi');
		}else {
			$id=$this->session->userdata('myId');
			$email = $this->input->post('email');
			$data = array(
	            'email'=>$email,
	        );
	        $where = array(
				'id_karyawan' => $id,
			);
			$this->mdl_pelamar->updatedata($where,$data,'karyawan');

			$encrypted_id = $id;
		
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
			$config['smtp_pass']= "hilfina090798"; // isi dengan password kamu
			$config['crlf']="\r\n"; 
			$config['newline']="\r\n"; 
			$config['wordwrap'] = TRUE;
			//memanggil library email dan set konfigurasi untuk pengiriman email
				
			$this->email->initialize($config);
			//konfigurasi pengiriman
			$this->email->from($config['smtp_user']);
			$this->email->to($email);
			$this->email->subject("Verifikasi Akun");
			$this->email->message(
				"untuk memverifikasi silahkan klik tautan dibawah ini<br><br>".
				site_url("login/verification/$encrypted_id")
			);
			
			if($this->email->send())
			{
				echo '<script type="text/javascript">';
				echo 'alert("Link Aktivasi sudah terkirim! Silahkan cek email kamu~")';
				echo '</script>';
		
			}
			else

			{
				echo '<script type="text/javascript">';
				echo 'alert("Gagal mengirim link aktivasi!!!")';
				echo '</script>';		
			}

			redirect(site_url('pelamar/aktivasi'));
		}
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

 	$update2 = $this->mdl_pelamar->updatedata($where,$data2,'lowongan');
	$update = $this->mdl_pelamar->updatedata($where,$data,'karyawan');
	redirect('pelamar/datasaya');
	}

	public function datapend(){
		$id=$this->session->userdata('myId');
		$paket['array']=$this->mdl_pelamar->getPend($id);
		$this->load->view('pelamar/datapendidikan',$paket);
	}

	public function addpend(){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required' );
		$this->load->model('mdl_pelamar');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('pelamar/addpendidikan');
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
		    redirect(site_url('pelamar/datapend'));
		}
	}

	public function detailpend($id){
		$paket['array']=$this->mdl_pelamar->getDetailpend($id);
		$this->load->view('pelamar/detailpend', $paket);
	}

	public function editpend($id){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required' );
		$this->load->model('mdl_pelamar');

		if ($this->form_validation->run()==FALSE) {
			$paket['array']=$this->mdl_pelamar->getDetailpend($id);
			$this->load->view('pelamar/editpendidikan', $paket);
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
		    redirect(site_url('pelamar/datapend'));
		}
			
	}

	public function hapuspend($id)
	{
		$where = array('id' => $id);
		$this->mdl_pelamar->hapusdata('pendidikan',$where);
		$this->session->set_flashdata('msg','Data Sukses di Hapus');
		redirect(site_url('pelamar/datapend'));
	}

	public function datasurat(){
		$id=$this->session->userdata('myId');
		$paket['array']=$this->mdl_pelamar->getSurat($id);
		$this->load->view('pelamar/datasurat',$paket);
	}

	public function addsurat(){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('no_surat', 'Nomor Surat', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('pelamar/addsuratsipstr');
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
		    redirect(site_url('pelamar/datasurat'));
		}
	}

	public function detailsurat($id){
		$paket['array']=$this->mdl_pelamar->getDetailsurat($id);
		$this->load->view('pelamar/detailsurat', $paket);
	}

	public function editsurat($id){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('no_surat', 'Nomor Surat', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$paket['array']=$this->mdl_pelamar->getDetailsurat($id);
			$this->load->view('pelamar/editsurat', $paket);;
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
		    redirect(site_url('pelamar/datasurat'));
		}
			
	}

	public function hapussurat($id)
	{
		$where = array('id_sipstr' => $id);
		$this->mdl_pelamar->hapusdata('sip_str',$where);
		$this->session->set_flashdata('msg','Data Sukses di Hapus');
		redirect(site_url('pelamar/datasurat'));
	}

	public function nilai(){
		$id=$this->session->userdata('myId');
		$paket['array']=$this->mdl_pelamar->getNilai($id);
		$this->load->view('pelamar/nilai',$paket);
	}

}

/* End of file pelamar.php */
/* Location: ./application/controllers/pelamar.php */