<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	private $filename = "import_data";

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_admin');
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
	//............................................PELAMAR............................................//

	//semua pelamar
	public function pelamar(){
		$this->load->model('mdl_login');
		$paket['array']=$this->mdl_admin->getPelamar();
		$this->load->view('admin/pelamar/allPelamar',$paket);
	}
	//seleksi pelamar
	public function pelamarSeleksi(){
		$this->load->model('mdl_login');
		$paket['array']=$this->mdl_admin->getPelamarSeleksi();
		$this->load->view('admin/Pelamar/Seleksi',$paket);
	}
	//tambah pelamar baru
	public function addPelamar(){
		$this->load->model('mdl_login');
		$paket['array']=$this->mdl_admin->getPelamarBaru();
		$this->load->view('admin/Pelamar/addPelamar',$paket);
	}

	public function pelamarDiterima($id_karyawan){
		$this->load->model('mdl_login');
        $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select email from karyawan where id_karyawan ='$id_karyawan'"));	

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
        $this->email->to($data['email']);
        $this->email->subject("Notifikasi");
        $this->email->message(
            "Anda telah lolos tahap 1, silakan ........<br><br>".
            site_url("login/verification/$id_karyawan"));
        $this->email->send();
        $this->mdl_admin->PelamarDiterima($id_karyawan);
        $paket['array']=$this->mdl_admin->getPelamar();
		$this->load->view('admin/pelamar/allPelamar',$paket);
    }

    public function pelamarDitolak($id_karyawan){
		$this->load->model('mdl_login');
        $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select email from karyawan where id_karyawan ='$id_karyawan'"));	

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
        $this->email->to($data['email']);
        $this->email->subject("Notifikasi");
        $this->email->message(
            "Mohon maaf,Anda tidak lolos tahap 1, silakan ........<br><br>".
            site_url("login/verification/$id_karyawan"));
        $this->email->send();
        $this->mdl_admin->PelamarDitolak($id_karyawan);
        $paket['array']=$this->mdl_admin->getPelamar();
		$this->load->view('admin/pelamar/allPelamar',$paket);
    }

    //data detail pelamar
	public function pelamarDetail($id_karyawan){
		$this->load->model('mdl_login');
		$paket['array']=$this->mdl_admin->getDetailPelamar($id_karyawan);
		$paket['seleksi']=$this->mdl_admin->getDataSeleksi($id_karyawan);
		$this->load->view('admin/Pelamar/detailPelamar',$paket);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */