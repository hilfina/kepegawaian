<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load library form validasi
        $this->load->library('form_validation','image_lib');
        //load model mdl_login
        $this->load->model('mdl_login');
        $this->load->model('mdl_pelamar');
        $this->load->library('session');
    }
     
	public function index()
	{
		if($this->mdl_login->logged_id())
			{
				//jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
				redirect("home");
				// jejecoba

			}else{

				//jika session belum terdaftar

				//set form validation
	            $this->form_validation->set_rules('username', 'Username', 'required');
	            $this->form_validation->set_rules('password', 'Password', 'required');

	            //set message form validation
	            $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
	                <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

	            //cek validasi
				if ($this->form_validation->run() == TRUE) {

				//get data dari FORM
	            $username = $this->input->post("username", TRUE);
	            $password = MD5($this->input->post('password', TRUE));
	            
	            //checking data via model
	            $checking = $this->mdl_login->check_login('login', array('username' => $username), array('password' => $password));
	            $konek = mysqli_connect("localhost","root","","kepegawaian");
              	$idk=mysqli_fetch_array(mysqli_query($konek, "select id_karyawan from login where username = '$username'"));
              	$mid =$idk['id_karyawan'];
	            $cariData=mysqli_fetch_array(mysqli_query($konek, "select * from karyawan where id_karyawan = '$mid'"));
	            // jika ditemukan, maka create session
	            if ($checking != FALSE) {
	                foreach ($checking as $apps) {
	                    $session_data = array(
	                        'myId'   => $apps->id_karyawan,
	                        'myName' => $apps->username,
	                        'myLongName' => $cariData['nama'],
	                        'myEmail' => $cariData['email'],
	                        'myPass' => $apps->password,
	                        'myLevel'=> $apps->level,
	                        'myAktif' => $apps->aktif,
	                        'myStatus' => $apps->$cariData['id_status'],
	                    );
	                    //set session userdata
	                    $this->session->set_userdata($session_data);
	                    

	                    redirect("home");

	                }
	            }else{

	            	$data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
	                	<div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';
	            	$this->load->view('login', $data);
	            }

	        }else{

	            $this->load->view('login');
	        }

		}

	}

	public function ubahpass(){

		$this->form_validation->set_rules('pw_baru','Kata Sandi Baru','required');
        $this->form_validation->set_rules('cpw_baru','Konfirmasi Kata Sandi Baru','required|matches[pw_baru]');
        $this->form_validation->set_message('required','%s wajib diisi');

        
		if ($this->form_validation->run()==FALSE) {
			$this->load->view('ubahpassword');
		}
		else {
			$id=$this->session->userdata('myId');
			$password = md5($this->input->post('pw_baru'));
		    $data = array(
		        'password' => $password,

		    );
		    $where = array(
			'id_karyawan' => $id
			);

		    $update = $this->mdl_pelamar->updatedata($where,$data,'login');
			redirect('home');
		}
		
	}

	public function pilihdaftar()
	{
		$paket['array'] = $this->mdl_login->getProfesi()->result();
        $this->load->view('pelamar/pilihdaftar', $paket);
	}

	public function viewdaftar($id_profesi)
	{

		$this->load->model('mdl_login');
		$data['last'] = $this->mdl_login->getlast();
		$data['profesi'] = $id_profesi;
		$this->load->view('pelamar/daftar',$data);
	}

	public function daftar()
	{
		//kirim gambar
		$config['upload_path']		= './Assets/gambar/';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= 2000000000;
		$config['max_width']		= 10240;
		$config['max_height']		= 7680;

		$this->load->library('upload', $config);

		//DATA KARYAWAN	
	    $nama = $this->input->post('nama');
	    $alamat = $this->input->post('alamat');
	    $no_telp = $this->input->post('no_telp');
	    $email = $this->input->post('email');
	    $id_profesi = $this->input->post('id_profesi');
	    $data1 = array(
	            'nama'=>$nama,
	            'alamat'=>$alamat,
	            'no_telp'=>$no_telp,
	            'email'=>$email,
	            'id_status'=>'Pelamar',
	            'id_profesi' => $id_profesi,
	            'id_golongan' => 'Tidak Ada',   
	        );	

	    // DATA LOWONGAN
	    $id_karyawan = $this->input->post('id_karyawan');
	    $data2 = array(
	            'pend_akhir'=>'Pilihan:',
	            'nilai_akhir'=>0,
	            'id_karyawan' => $id_karyawan,
	        );

	    // DATA LOGIN		
	    $id_karyawan = $this->input->post('id_karyawan');
		$username = $this->input->post('username');
	    $password = md5($this->input->post('password'));
	    $data5 = array(
	            'username'=>$username,
	            'password'=>$password,
	            'level'=>'Pelamar',
	            'aktif'=>0,
	            'id_karyawan' => $id_karyawan,
	        );

	    //KUOTA
	    

	    $insert1 = $this->mdl_login->daftar('karyawan',$data1);
	    $insert2 = $this->mdl_login->daftar('lowongan',$data2);
   		$insert5 = $this->mdl_login->daftar('login',$data5);
   		$this->mdl_login->updateKuota($id_profesi);

	    //enkripsi id
		$encrypted_id = $id_karyawan;
		
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
			"terimakasih telah melakukan registrasi, untuk memverifikasi silahkan klik tombol dibawah ini<br><br>".
			"<a href='".site_url("login/verification/$encrypted_id")."'><button>verifikasi</button</a>"
		);
		
		if($this->email->send())
		{
			echo '<script type="text/javascript">';
			echo 'alert("Berhasil melakukan registrasi, silahkan cek email kamu")';
			echo '</script>';
			
		}else
		{
			echo '<script type="text/javascript">';
			echo 'alert("Berhasil melakukan registrasi, namun gagal mengirim verifikasi email")';
			echo '</script>';
			
		}
		
		redirect(site_url('Login/index'));
		
	}

	public function verification($key)
	{
		$this->load->helper('url');
		$this->load->model('mdl_login');
		$this->mdl_login->changeActiveState($key);
		echo '<script type="text/javascript">';
		echo 'alert("Selamat kamu telah memverifikasi akun kamu")';
		echo '</script>';
		redirect(site_url('Login/index'));
	}


}
