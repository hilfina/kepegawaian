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
        $this->load->model('mdl_admin');
        $this->load->library('session');
    }
     
	public function index()
	{
		if($this->mdl_login->logged_id())
			{
				//jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
				redirect("home");
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
	            $cariData2=mysqli_fetch_array(mysqli_query($konek, "select * from lowongan where id_karyawan = '$mid'"));
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
	                        'myStatus' => $cariData['id_status'],
	                        'myProfesi' => $cariData['id_profesi'],
	                        'myFinalisasi' => $cariData2['finalisasi'],
	                    );
	                    //set session userdata
	                    $this->session->set_userdata($session_data);
	                   foreach ($checking as $key) {
	                   	if ($key->level == "Pelamar" && $cariData['id_profesi'] == "Belum") {
	                    	redirect('pelamar/datasaya');
	                    }elseif ($key->level == "admin") {
	                    redirect("home");
	                    }else{
	                    redirect("home/bukanAdmin");}
	                   }
	                    
	                }
	            }else{
	            	$data['loker']=$this->mdl_admin->getLoker();
	            	$data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
	                	<div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';
	            	$this->load->view('login', $data);
	            }

	        }else{
	        	$data['loker']=$this->mdl_admin->getLoker();
	            $this->load->view('login',$data);
	        }

		}

	}

	public function ubahpass(){

		$this->form_validation->set_rules('pw_baru','Kata Sandi Baru','required');

        
		if ($this->form_validation->run()==FALSE) {
			$this->load->view('ubahpassword');
		}
		else {
			$id=$this->session->userdata('myId');

			$a = $this->input->post('pw_baru');
			$b = $this->input->post('cpw_baru');
			if($b != $a) {
                $error = ("<b>Error!</b> Konfirmasi kata sandi baru tidak sesuai");

                $this->session->set_flashdata('msg_error', $error);

                redirect('login/ubahpass');
            } else {
                $password = md5($this->input->post('pw_baru'));
            }

			
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
		$paket['array'] = $this->mdl_login->getLoker();
        $this->load->view('pelamar/pilihdaftar', $paket);
	}

	public function viewdaftar()
	{

		$this->load->model('mdl_login');
		$data['last'] = $this->mdl_login->getlast();
		$this->load->view('pelamar/daftar',$data);
	}

	public function daftar()
	{				
	    $nama = $this->input->post('nama');
	    $pend_akhir = $this->input->post('pend_akhir');
	    $no_ktp = $this->input->post('no_ktp');
	    $email = $this->input->post('email');
	    $jurusan = $this->input->post('jurusan');
	    $id_karyawan = $this->input->post('id_karyawan');
		$username = $this->input->post('username');
	    $password = md5($this->input->post('password'));
	    $ipk = $this->input->post('ipk');

	    //DATA KARYAWAN	
	    $data1 = array(
	    		'id_karyawan'=>$id_karyawan,
	            'nama'=>$nama,
	            'no_ktp'=>$no_ktp,
	            'email'=>$email,
	            'id_status'=>'Pelamar',
	            'id_profesi' => 'Belum',
	            'id_golongan' => 'Tidak Ada',   
	        );	

	    // DATA LOWONGAN
	    $data2 = array(
	            'pend_akhir'=>$pend_akhir,
	            'nilai_akhir'=>$ipk,
	            'id_karyawan' => $id_karyawan,
	        );

	    // DATA LOGIN		
	    $data5 = array(
	            'username'=>$username,
	            'password'=>$password,
	            'level'=>'Pelamar',
	            'aktif'=>0,
	            'id_karyawan' => $id_karyawan,
	        );

	    $insert1 = $this->mdl_login->daftar('karyawan',$data1);
	    $insert2 = $this->mdl_login->daftar('lowongan',$data2);
   		$insert5 = $this->mdl_login->daftar('login',$data5);

	    //enkripsi id
		$encrypted_id = $id_karyawan;
		
		$this->load->library('email');
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
		//konfigurasi pengiriman
		$this->email->from($config['smtp_user']);
		$this->email->to($email);
		$this->email->subject("Verifikasi Akun");
		$this->email->message(
			"Kepada<br>Yth. Sdr. <b>".$nama."</b><br> Ditempat,<br><br><br> Terima kasih sudah melamar di perusahaan kami. Untuk proses berikutnya, data-data anda akan kami verifikasi terlebih dahulu. Pengumuman selanjutnya akan kami informasikan pada akun dan email anda. <br><br><br>Demikian kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih. <br> Untuk memverifikasi silahkan klik tautan dibawah ini <br><br>".
			"<a href='".site_url("login/verification/$encrypted_id")."'>klik disini</a>"
		);
		
		if($this->email->send())
		{
			echo "<script>alert('Email berhasil terkirim. Cek email anda untuk verifikasi akun!'); document.location.href = '" . site_url('login') . "';</script>";
			
		}else
		{
			echo "<script>alert('Email gagal terkirim'); document.location.href = '" . site_url('login') . "';</script>";
			
		}
		

		
	}

	public function verification($key)
	{
		$this->load->helper('url');
		$this->load->model('mdl_login');
		$this->mdl_login->changeActiveState($key);
		echo "<script>alert('Selamat Kamu telah memverifikasi akun kamu! Login untuk masuk kedalam sistem.'); document.location.href = '" . site_url('login') . "';</script>";
	}

}
