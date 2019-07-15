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
		$this->load->helper('url','form','file', 'custom');
		$this->load->library('form_validation','image_lib');
		$this->load->library('session');
		$this->load->library('pdf');
		if($this->mdl_admin->logged_id() == null){ redirect("login");}
	}
	//awal pertama kali login
	public function index(){
		if($this->mdl_admin->logged_id()){
			$this->load->view("homee");
		}else{redirect("login");}
	}
	//log out
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
	//untuk aktivasi akun dengan mengirimkan email verifikasi
	public function aktivasi(){
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('pelamar/aktivasi');
		}else {
			$id=$this->session->userdata('myId');
			$email = $this->input->post('email');
			$data = array( 'email'=>$email );
	        $where = array( 'id_karyawan' => $id );				

			// $encrypted_id = $id;			
			// $this->load->library('email');
			// $config = array();
			// $config['charset'] = 'utf-8';
			// $config['useragent'] = 'CodeIgniter';
			// $config['protocol']= "smtp";
			// $config['mailtype']= "html";
			// $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
			// $config['smtp_port']= "465";
			// $config['smtp_timeout']= "400";
			// $config['smtp_user']= "sdi.rsiaisyiyah@gmail.com"; // isi dengan email kamu
   //          $config['smtp_pass']= "SUBHANALLAH"; // isi dengan password kamu                
			// $config['crlf']="\r\n"; 
			// $config['newline']="\r\n"; 
			// $config['wordwrap'] = TRUE;
			// //memanggil library email dan set konfigurasi untuk pengiriman email					
			// $this->email->initialize($config);
			// //konfigurasi pengiriman
			// $this->email->from($config['smtp_user']);
			// $this->email->to($email);
			// $this->email->subject("Verifikasi Akun");
			// $this->email->message(
			$pesan =
				"untuk memverifikasi akun Sistem Informasi Kepegawaian RSIA silahkan klik tautan dibawah ini<br><br>".
				"<a href='".site_url("login/verification/$encrypted_id")."'>klik disini</a>"
			;
			
			send_email(array($email), 'Verifikasi Akun', $pesan);
				$this->mdl_pelamar->updatedata($where,$data,'karyawan');
				
		}	
 	}
	//melihat dan edit data pribadi
	public function datasaya() {
		$id=$this->session->userdata('myId');
		$paket['datasaya'] = $this->mdl_pelamar->getPelamarlagi($id);
		$this->load->view('pelamar/datapelamar',$paket);
	}
	//lihat dan upload CV
	public function updatecv(){
		$config['upload_path']		= './Assets/dokumen/';
		$config['allowed_types']	= 'pdf';
		$config['max_size']			= 2000;
	    $this->load->library('upload', $config);

		$id=$this->session->userdata('myId');
		//jika tidak ada data yang diupload / jika data tidak ssuai konfigurasi
		if(!$this->upload->do_upload('cvsaya')) {
		    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran kurang dari 2mb");
	        $this->session->set_flashdata('msg_error', $error);
		    redirect('pelamar/datasaya');
		} else {
		    $cvsaya = $this->upload->data('file_name');
		}
	    $data2 = array( 'cv' => $cvsaya );
		$where = array( 'id_karyawan' => $id );
		$this->mdl_pelamar->updatedata($where,$data2,'lowongan');
		redirect('pelamar/datasaya');
	}

	public function updatedatasaya(){
		$config['upload_path']		= './Assets/gambar/';
		$config['allowed_types']	= 'jpg|png';
		$config['max_size']			= 2000;
		$config['max_width']		= 400;
		$config['max_height']		= 400;
		$this->load->library('upload', $config);

		$id=$this->session->userdata('myId');
		$no_ktp = $this->input->post('no_ktp');
		$no_bpjs = $this->input->post('no_bpjs');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$no_telp = $this->input->post('no_telp');
		$email = $this->input->post('email');
		$ttl = $this->input->post('ttl');
		$jenkel = $this->input->post('jenkel');
		$status = $this->input->post('status');
		
		if($_FILES['fotosaya']['name'] != '') {
	        if(!$this->upload->do_upload('fotosaya')) {
	           echo "<script>alert('<b>Error!</b> foto profil harus berbentuk jpg/png dan berukuran 300x400'); </script>";  
	        } else {
	            $fotosaya = $this->upload->data('file_name');
	        }
	    } else {
	        $fotosaya = $this->input->post('gambar_old');
	    }
		$data = array(
			'no_ktp' => $no_ktp,
			'no_bpjs' => $no_bpjs,
			'nama' => $nama,
			'alamat' => $alamat,
			'no_telp' => $no_telp,
			'email' => $email,
			'ttl' => $ttl,
			'jenkel' => $jenkel,
			'status' => $status,
			'foto' => $fotosaya
		);
		$where = array( 'id_karyawan' => $id );
		$pend_akhir = $this->input->post('pend_akhir');
	    $nilai_akhir = $this->input->post('nilai_akhir');
	   
	    $data2 = array(
            'pend_akhir'=>$pend_akhir,
            'nilai_akhir'=>$nilai_akhir,
            'id_karyawan' => $id,
        );

	 	$this->mdl_pelamar->updatedata($where,$data2,'lowongan');
		$this->mdl_pelamar->updatedata($where,$data,'karyawan');
		redirect('pelamar/datasaya');
	}
	//melihat semua data pendidikan
	public function datapend(){
		$id=$this->session->userdata('myId');
		$paket['array']=$this->mdl_pelamar->getPend($id);
		$this->load->view('pelamar/datapendidikan',$paket);		
	}
	//menambah data pendidikan
	public function addpend(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('pelamar/addpendidikan');
		}else{
			$config['upload_path']		= './Assets/dokumen/';
			$config['allowed_types']	= 'pdf';
			$config['max_size']			= 2000;
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
                redirect('pelamar/addpend');
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
		    $this->mdl_pelamar->tambahdata('pendidikan',$data3);
		    $this->session->set_flashdata('msg','Data Sukses di tambahkan');
		    redirect(site_url('pelamar/datapend'));
		}
	}
	//edit data pendidikan
	public function editpend($id){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$paket['array']=$this->mdl_pelamar->getDetailpend($id);
			$this->load->view('pelamar/editpendidikan', $paket);
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

            if(!$this->upload->do_upload('file')) {
                $file = $this->input->post('file_old');
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
	            'file'=>$file,
	            'verifikasi'=> 0,
	        );
		    $where = array('id' => $id);
			$this->mdl_pelamar->updatedata($where,$data3,'pendidikan');
		    $this->session->set_flashdata('msg','Data Sukses di Update');
		    redirect(site_url('pelamar/datapend'));
		}
	}
	//menghapus data pendidikan
	public function hapuspend($id){
		$where = array('id' => $id);
		$this->mdl_pelamar->hapusdata('pendidikan',$where);
		$this->session->set_flashdata('msg','Data Sukses di Hapus');
		redirect(site_url('pelamar/datapend'));
	}
	//ke form keterangan finalisasi
	public function finalisasi(){ $this->load->view('pelamar/finalisasi');}
	//melakukan finalisasi agar data jadi paten
	public function finalisasi2(){
		$data = array('finalisasi' => 1 );
		$id=$this->session->userdata('myId');
	    $where = array('id_karyawan' => $id);
	    //update data lowongan, finalisasi jadi 1
	 	$update = $this->mdl_pelamar->updatedata($where,$data,'lowongan');
	 	//cari semua data untuk session
	 	$a = $this->db->query("SELECT * from login where id_karyawan = '$id'"); $dLogin=$a->row();
	 	$b = $this->db->query("SELECT * from lowongan where id_karyawan = '$id'"); $dLowongan=$b->row();
	 	$c = $this->db->query("SELECT * from karyawan where id_karyawan = '$id'"); $dKaryawan=$c->row();
	 	//unset session sebelum final diupdate tadi
	    unset($session_data);
	    //seting session baru
		$session_data = array(
            'myId'   => $id,
            'myName' => $dLogin->username,
            'myLongName' => $dKaryawan->nama,
            'myEmail' => $dKaryawan->email,
            'myPass' => $dLogin->password,
            'myLevel'=> $dLogin->level,
            'myAktif' => $dLogin->aktif,
            'myStatus' => $dKaryawan->id_status,
            'myProfesi' => $dKaryawan->id_profesi,
            'myFinalisasi' => $dLowongan->finalisasi,
        );  

        $this->session->set_userdata($session_data);
        redirect("pelamar/home/$id");
	}	
	//memilih loker yang sesuai dengan pelamar
	public function home($id){
		$data['loker']=$this->mdl_pelamar->getLoker($id);//cari loker yang sesuai
		$this->load->view("pelamar/home",$data);
	}
	//fungsi ketika loker dipilih
	public function lamar($id,$id_profesi){
		$data = array( 'id_profesi'=>$id_profesi );
		$where = array( 'id_karyawan' => $id );
		$this->mdl_pelamar->updatedata($where,$data,'karyawan');
		//cari semua data untuk session
	 	$a = $this->db->query("SELECT * from login where id_karyawan = '$id'"); $dLogin=$a->row();
	 	$b = $this->db->query("SELECT * from lowongan where id_karyawan = '$id'"); $dLowongan=$b->row();
	 	$c = $this->db->query("SELECT * from karyawan where id_karyawan = '$id'"); $dKaryawan=$c->row();
	 	//unset session sebelum final diupdate tadi
	    unset($session_data);
	    //seting session baru
		$session_data = array(
            'myId'   => $id,
            'myName' => $dLogin->username,
            'myLongName' => $dKaryawan->nama,
            'myEmail' => $dKaryawan->email,
            'myPass' => $dLogin->password,
            'myLevel'=> $dLogin->level,
            'myAktif' => $dLogin->aktif,
            'myStatus' => $dKaryawan->id_status,
            'myProfesi' => $dKaryawan->id_profesi,
            'myFinalisasi' => $dLowongan->finalisasi,
        );  
        $this->session->set_userdata($session_data);
        redirect("pelamar/prosesLamar/$id");
	}
	//untuk melihat data surat yang ada
	public function datasurat(){
		$id=$this->session->userdata('myId');
		$paket['array']=$this->mdl_pelamar->getSurat($id);
		$this->load->view('pelamar/datasurat',$paket);
	}
	//menambah data surat
	public function addsurat(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('no_surat', 'Nomor Surat', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('pelamar/addsuratsipstr');
		}else{
			$config['upload_path']		= './Assets/dokumen/';
			$config['allowed_types']	= 'pdf';
			$config['max_size']			= 2000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload', $config);

		    $id=$this->session->userdata('myId');
		    $nama_surat = $this->input->post('nama_surat');
		    //cari id surat sesuai dengan nama surat
	 		$a = $this->db->query("SELECT * from jenis_surat where nama_surat = '$nama_surat'"); $dSurat=$a->row();
		    $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
		    $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
		    $no_surat = $this->input->post('no_surat');
		    if(!$this->upload->do_upload('file')) {
                $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");
                $this->session->set_flashdata('msg_error', $error);
                redirect('pelamar/addsurat');
            } else {
                $file = $this->upload->data('file_name');
            }
		    $data4 = array(
		    	'id_karyawan' => $id,
		        'id_surat'=>$dSurat->id_surat,
		        'tgl_mulai'=>$tgl_mulai,
		        'tgl_akhir'=>$tgl_akhir, 
		        'no_surat'=>$no_surat,  
		        'file'=>$file,
		        'aktif'=> 0,
	        );
			
			$this->mdl_pelamar->tambahdata('sip_str',$data4);
		    $this->session->set_flashdata('msg','Data Sukses di tambahkan');
		    redirect(site_url('pelamar/datasurat'));
		}		
	}
	// menambah data surat
	public function editsurat($id){
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('no_surat', 'Nomor Surat', 'trim|required' );

		if ($this->form_validation->run()==FALSE) {
			$paket['array']=$this->mdl_pelamar->getDetailsurat($id);
			$this->load->view('pelamar/editsurat', $paket);;
		}
		else{
			$config['upload_path']		= './Assets/dokumen/';
			$config['allowed_types']	= 'pdf';
			$config['max_size']			= 2000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;
			$this->load->library('upload', $config);

			$nama_surat = $this->input->post('nama_surat');
		    //cari id surat sesuai dengan nama surat
 			$a = $this->db->query("SELECT * from jenis_surat where nama_surat = '$nama_surat'"); $dSurat=$a->row();
		    $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
		    $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
		    $no_surat = $this->input->post('no_surat');
            if(!$this->upload->do_upload('file')) {
            	$file = $this->input->post('file_old');
		    } else {
		        $file = $this->upload->data('file_name');
		    }
		    $data = array(
		        'id_surat'=>$dSurat->id_surat,
		        'tgl_mulai'=>$tgl_mulai,
		        'tgl_akhir'=>$tgl_akhir, 
		        'no_surat'=>$no_surat,  
		        'file'=>$file,
		        'aktif'=> 0,
	        );
		    $where = array( 'id_sipstr' => $id );
			$this->mdl_pelamar->updatedata($where,$data,'sip_str');
		    $this->session->set_flashdata('msg','Data Sukses di Update');
		    redirect(site_url('pelamar/datasurat'));
		}
	}
	//menghapus data surat
	public function hapussurat($id){
		$where = array('id_sipstr' => $id);
		$this->mdl_pelamar->hapusdata('sip_str',$where);
		$this->session->set_flashdata('msg','Data Sukses di Hapus');
		redirect(site_url('pelamar/datasurat'));		
	}


	public function prosesLamar($id){
		$where = array( 'id_karyawan' => $id ); 
		$paket['datDir']=$this->mdl_admin->getData('karyawan',$where);
		if ($paket['lengkap']=$this->mdl_pelamar->getSeleksi($id)) {
			$this->load->view('pelamar/prosesLamaran', $paket);
		}
		else{
			$this->load->view('pelamar/prosesLamaran', $paket);
		}
	}

	

	public function cetak(){
		$id=$this->session->userdata('myId');
		$paket['datasaya']=$this->mdl_pelamar->getPelamar($id);
		$paket['datsel']=$this->mdl_pelamar->getCetak($id);
		$this->load->view('pelamar/cetak', $paket);
	}

	public function Laporan($id){
        $this->load->library('Mypdf');
        $where = array('id_karyawan'=>$id);
        $paket['datasaya']=$this->mdl_pelamar->getPelamar($id);
		$paket['datsel']=$this->mdl_pelamar->getCetak($id);
        $this->mypdf->generate('Laporan/seleksi', $paket, 'cetak-kartu-seleksi', 'A6', 'landscape');
    }

}

/* End of file pelamar.php */
/* Location: ./application/controllers/pelamar.php */