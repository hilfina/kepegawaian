<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load library form validasi
        $this->load->library('form_validation');
        //load model mdl_login
        $this->load->model('mdl_login');
        $this->load->library('form_validation','image_lib');
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
	            
	            //jika ditemukan, maka create session
	            if ($checking != FALSE) {
	                foreach ($checking as $apps) {

	                    $session_data = array(
	                        'user_id'   => $apps->id_karyawan,
	                        'user_name' => $apps->username,
	                        'user_pass' => $apps->password,
	                        'user_level'=> $apps->level,
	                        'user_aktif' => $apps->aktif,
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
	public function pilihdaftar()
	{
		$this->load->model('mdl_login');
		$this->load->view('pilihdaftar');
	}

	public function viewdaftar($id_profesi)
	{

		$this->load->model('mdl_login');
		$data['last'] = $this->mdl_login->getlast();
		$data['profesi'] = $id_profesi;
		$this->load->view('daftar',$data);
	}

	public function viewdaftar2($id_profesi)
	{

		$this->load->model('mdl_login');
		$data['last'] = $this->mdl_login->getlast();
		$data['profesi'] = $id_profesi;
		$this->load->view('daftar2',$data);
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
		$no_ktp = $this->input->post('no_ktp');
	    $no_bpjs = $this->input->post('no_bpjs');
	    $nama = $this->input->post('nama');
	    $alamat = $this->input->post('alamat');
	    $no_telp = $this->input->post('no_telp');
	    $email = $this->input->post('email');
	    $id_profesi = $this->input->post('id_profesi');
	    $data1 = array(
	            'no_ktp'=>$no_ktp,
	            'no_bpjs'=>$no_bpjs,
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
		$pend_akhir = $this->input->post('pend_akhir');
	    $nilai_akhir = $this->input->post('nilai_akhir');
	    $data2 = array(
	            'pend_akhir'=>$pend_akhir,
	            'nilai_akhir'=>$nilai_akhir,
	            'id_karyawan' => $id_karyawan,
	        );

	    // DATA RIWAYAT PENDIDIKAN
	    $id_karyawan = $this->input->post('id_karyawan');
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
	            'id_karyawan' => $id_karyawan,
	            'file'=>$a,
	            'verifikasi'=> 'Belum Terverifikasi',
	        );

	    // DATA SIPSTR
	    $id_karyawan = $this->input->post('id_karyawan');
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
		    	'id_karyawan' => $id_karyawan,
		        'id_surat'=>$id_surat,
		        'tgl_mulai'=>$tgl_mulai,
		        'tgl_akhir'=>$tgl_akhir, 
		        'no_surat'=>$no_surat,  
		        'file'=>$b,
		        'aktif'=> 0,
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

	    $insert1 = $this->mdl_login->daftar('karyawan',$data1);
	    $insert2 = $this->mdl_login->daftar('lowongan',$data2);
	    $insert3 = $this->mdl_login->daftar('pendidikan',$data3);
	    $insert4 = $this->mdl_login->daftar('sip_str',$data4);
   		$insert5 = $this->mdl_login->daftar('login',$data5);

	    //enkripsi id
		$encrypted_id = md5($id_karyawan);
		
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
			"terimakasih telah melakukan registrasi, untuk memverifikasi silahkan klik tautan dibawah ini<br><br>".
			site_url("login/verification/$encrypted_id")
		);
		
		// if($this->email->send())
		// {
		// 	emailbisa();
		// }else
		// {
		// 	emailgabisa();
		// }
		
		redirect(site_url('Login/index'));
		
	}

	public function daftar2()
	{
		//kirim gambar
		$config['upload_path']		= './Assets/gambar/';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= 2000000000;
		$config['max_width']		= 10240;
		$config['max_height']		= 7680;

		$this->load->library('upload', $config);

		//DATA KARYAWAN	
		$no_ktp = $this->input->post('no_ktp');
	    $no_bpjs = $this->input->post('no_bpjs');
	    $nama = $this->input->post('nama');
	    $alamat = $this->input->post('alamat');
	    $no_telp = $this->input->post('no_telp');
	    $email = $this->input->post('email');
	    $id_profesi = $this->input->post('id_profesi');
	    $datah1 = array(
	            'no_ktp'=>$no_ktp,
	            'no_bpjs'=>$no_bpjs,
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
		$pend_akhir = $this->input->post('pend_akhir');
	    $nilai_akhir = $this->input->post('nilai_akhir');
	    $datah2 = array(
	            'pend_akhir'=>$pend_akhir,
	            'nilai_akhir'=>$nilai_akhir,
	            'id_karyawan' => $id_karyawan,
	        );

	    // DATA RIWAYAT PENDIDIKAN
	    $id_karyawan = $this->input->post('id_karyawan');
		$pendidikan = $this->input->post('pendidikan');
	    $mulai = $this->input->post('mulai');
	    $akhir = $this->input->post('akhir');
	    $nomor_ijazah = $this->input->post('nomor_ijazah');
	    $this->upload->do_upload('pendidikanfile');
		$a = $this->upload->data('file_name');
	    $datah3 = array(
	            'pendidikan'=>$pendidikan,
	            'mulai'=>$mulai,
		        'akhir'=>$akhir,
		        'nomor_ijazah'=>$nomor_ijazah,
	            'id_karyawan' => $id_karyawan,
	            'file'=>$a,
	            'verifikasi'=> 'Belum Terverifikasi',
	        );

	    // DATA LOGIN		
	    $id_karyawan = $this->input->post('id_karyawan');
		$username = $this->input->post('username');
	    $password = md5($this->input->post('password'));
	    $datah5 = array(
	            'username'=>$username,
	            'password'=>$password,
	            'level'=>'Pelamar',
	            'aktif'=>0,
	            'id_karyawan' => $id_karyawan,
	        );

	    $insertt1 = $this->mdl_login->daftar('karyawan',$datah1);
	    $insertt2 = $this->mdl_login->daftar('lowongan',$datah2);
	    $insertt3 = $this->mdl_login->daftar('pendidikan',$datah3);
   		$insertt5 = $this->mdl_login->daftar('login',$datah5);

   		//enkripsi id
		$encrypted_id = md5($id_karyawan);
		
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
			"terimakasih telah melakukan registrasi, untuk memverifikasi silahkan klik tautan dibawah ini<br><br>".
			site_url("login/verification/$encrypted_id")
		);
		
		// if($this->email->send())
		// {
		// 	emailbisa();
		// }else
		// {
		// 	emailgabisa();
		// }
   		
	    redirect(site_url('Login/index'));
		
	}

	public function verification($key)
	{
		$this->load->helper('url');
		$this->load->model('mdl_login');
		$this->mdl_login->changeActiveState($key);
		echo "Selamat kamu telah memverifikasi akun kamu";
		echo "<br><br><a href='".site_url("login/index")."'>Kembali ke Menu Login</a>";
	}


}
