<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load library form validasi
        $this->load->library('form_validation','image_lib');
        $this->load->helper('url','form','file', 'custom');
        //load model mdl_login
        $this->load->model('mdl_login');
        $this->load->model('mdl_pelamar');
        $this->load->model('mdl_admin');
        $this->load->library('session');		
		$this->load->library('email');
    }
    
	public function index()
	{
		if($this->mdl_login->logged_id()){//jika memang session sudah terdaftar
				redirect("home");
			}else{//jika session belum terdaftar
				//set form validation
	            $this->form_validation->set_rules('username', 'Username', 'required');
	            $this->form_validation->set_rules('password', 'Password', 'required');

	            //set message form validation
	            $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px"><div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

				if ($this->form_validation->run() == TRUE) {//cek validasi
				//get data dari FORM
	            $username = $this->input->post("username", TRUE);
	            $password = MD5($this->input->post('password', TRUE));	            
	            //checking data via model
	            $checking = $this->mdl_login->check_login('login', array('username' => $username), array('password' => $password));
	            
	            // jika ditmukan, maka create session
	            if ($checking != FALSE) {
	            	//cari data pengguna untuk set session
		            $caridata1 = $this->db->query("SELECT * from login where username = '$username'");
		            $data1 = $caridata1->row();
		          	$caridata2 = $this->db->query("SELECT * from lowongan where id_karyawan = '$data1->id_karyawan'");
		        	$data2 = $caridata2->result();
		        	$caridata3 = $this->db->query("SELECT * from karyawan where id_karyawan = '$data1->id_karyawan'");
		        	$data3 = $caridata3->row();
		        	//set session
	                foreach ($checking as $apps) {
	                    $session_data = array(
	                        'myId'   => $apps->id_karyawan,
	                        'myName' => $apps->username,
	                        'myLongName' => $data3->nama,
	                        'myEmail' => $data3->email,
	                        'myPass' => $apps->password,
	                        'myLevel'=> $apps->level,
	                        'myAktif' => $apps->aktif,
	                        'myStatus' => $data3->id_status,
	                        'myProfesi' => $data3->id_profesi,
	                        'myFinalisasi' => (count($data2) > 0 ? $data2[0]->finalisasi : '')
	                    );
	                    $this->session->set_userdata($session_data);

	                   	foreach ($checking as $key) {
	                   		//jika pelamar yang belum memilih profesi/loker
		                   	if ($key->level == "Pelamar" && $data3->id_profesi == "Belum"){redirect('pelamar');}
		                   	//jika admin
		                   	elseif ($key->level == "admin" || $key->level == "Super Admin"){redirect("home");}
		                   	//jika pelamar yang/akan seleksi
		                    else{redirect("Home/bukanAdmin");}
	                   }
	                }
	            }else{
	            	$data['loker']=$this->mdl_login->getLoker();
	            	$data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
	                	<div class="header"><b><i class="fa fa-exclamation-circle"></i> ERROR</b> username atau password salah!</div></div>';
	            	$this->load->view('login', $data);
	            }
	        }else{
	        	$data['loker']=$this->mdl_login->getLoker();
	            $this->load->view('login',$data);
	        }
		}
	}

	public function loker(){
		$data['loker']=$this->mdl_admin->getLoker2();
	    $this->load->view('loker',$data);
	}


	public function daftar(){				
		$this->form_validation->set_rules('no_ktp','Nomor KTP','required|min_length[16]');
		$this->form_validation->set_rules('nama','Nama Lengkap','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('no_telp','Nomor Telepon','required|min_length[10]');
		$this->form_validation->set_rules('username','User name','required|min_length[6]|max_length[50]|is_unique[login.username]');
		$this->form_validation->set_rules('password','Password','required|min_length[8]');
		
		if($this->form_validation->run()==FALSE){
			$data['last'] = $this->mdl_login->getlast();
			$this->load->view('pelamar/daftar',$data);
		}else{
		    $nama = $this->input->post('nama');
		    $no_ktp = $this->input->post('no_ktp');
		    $email = $this->input->post('email');
		    $no_telp = $this->input->post('no_telp');
		    $jurusan = $this->input->post('jurusan');
		    $id_karyawan = $this->input->post('id_karyawan');
			$username = $this->input->post('username');
		    $password = md5($this->input->post('password'));
		    //cek email yang sudah ada
		    $cariemail = $this->db->query("SELECT count(email) as ada from karyawan where email = '$email'");
		    $adaemail = $cariemail->row();
          	if($adaemail->ada != 0){ //jika ada
          		$error = ("<b>Error!</b> terdapat email yang telah terdaftar");
                $this->session->set_flashdata('msg_error', $error);
                redirect('login/daftar');
          	}else {
			    //DATA KARYAWAN	
			    $data1 = array(
		    		'id_karyawan'=>$id_karyawan,
		            'nama'=>$nama,
		            'no_ktp'=>$no_ktp,
		            'email'=>$email,
		            'no_telp'=>$no_telp,
		            'id_status'=>'Pelamar',
		            'id_profesi' => 'Belum',
		            'id_golongan' => 'Tidak Ada', 
		            'jabatan'  =>1,
		            'foto' => 'profile.png'
		        );				    
			    // DATA LOWONGAN
			    $data2 = array(
		            'pend_akhir'=>'-',
		            'nilai_akhir'=>'-',
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
			}
			//configurasi untuk kirim email
			// $encrypted_id = $id_karyawan;	
			// $config = array();
			// $config['charset'] = 'utf-8';
			// $config['useragent'] = 'CodeIgniter';
			// $config['protocol']= "smtp";
			// $config['mailtype']= "html";
			// $config['smtp_host']= "ssl://smtp.gmail.com";
			// $config['smtp_port']= "465";
			// $config['smtp_timeout']= "400";
			// $config['smtp_user']= "sdi.rsiaisyiyah@gmail.com";
			// $config['smtp_pass']= "SUBHANALLAH";
			// $config['crlf']="\r\n"; 
			// $config['newline']="\r\n"; 
			// $config['wordwrap'] = TRUE;
			
			// $this->email->initialize($config);
			// //konfigurasi pengiriman
			// $this->email->from($config['smtp_user']);
			// $this->email->to($email);
			// $this->email->subject("Verifikasi Akun");
			$pesan =
				"Kepada<br>Yth. Sdr. <b>".$nama."</b><br> Ditempat,<br><br><br> Terima kasih sudah mendaftar pada Sistem Kepegawaian Rumah Sakit Islam Aisyiyah Malang. Untuk proses berikutnya, silahkan masukkan data-data lamaran anda. <br><br><br>Demikian kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih. <br> Untuk memverifikasi silahkan klik tautan dibawah ini <br><br>".
				"<a href='".site_url("login/verification/$encrypted_id")."'>klik disini</a>"
			;
			
			send_email(array($email), 'Verifikasi Akun', $pesan);
				$insert1 = $this->mdl_login->daftar('karyawan',$data1);
			    $insert2 = $this->mdl_login->daftar('lowongan',$data2);
		   		$insert5 = $this->mdl_login->daftar('login',$data5);
				
		}
	}

	public function ubahpass(){
		$this->form_validation->set_rules('pw_baru','Kata Sandi Baru','required');
        
		if ($this->form_validation->run()==FALSE) {
			$this->load->view('ubahpassword');
		}else {
			$id=$this->session->userdata('myId');
			$a = $this->input->post('pw_baru'); //password baru 1
			$b = $this->input->post('cpw_baru'); //password baru 2
			if($b != $a) {//jika password 1 dan 2 tidak sesai
                $error = ("<b>Error!</b> Konfirmasi kata sandi baru tidak sesuai");
                $this->session->set_flashdata('msg_error', $error);
                redirect('login/ubahpass');
            } else {
                $password = $this->input->post('pw_baru');
            }
		
		    $data = array('password' => md5($password));
		    $where = array( 'id_karyawan' => $id );
			$this->mdl_admin->updatelogin($data,$id);
			redirect('home');
		}
	}
	//fungsi ketika verifikasi lewat email di klik
	public function verification($key)
	{
		$this->load->helper('url');
		$this->load->model('mdl_login');
		$this->mdl_login->changeActiveState($key);
		echo "<script>alert('Selamat Kamu telah memverifikasi akun kamu! Login untuk masuk kedalam sistem.'); document.location.href = '" . site_url('login') . "';</script>";
	}

}
