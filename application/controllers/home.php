<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();
        //load model mdl_home
        $this->load->model('mdl_home');
    }

    public function cariKadaluarsa(){ //fungsi untuk cari kadaluarsa surat tanpa notif email
		$tgl_sekarang = date('m/d/Y', time());	

		$semua_status = $this->db->get('status')->result();
		$semua_golongan = $this->db->get('golongan')->result();
		$semua_berkala = $this->db->get('berkala')->result();

		$semua_hutang = $this->db->get('mou_hutang')->result();
		$semua_kontrak = $this->db->get('mou_kontrak')->result();
		$semua_sekolah = $this->db->get('mou_sekolah')->result();

		$semua_surat = $this->db->get('sip_str')->result();

		////////////////////////////SK///////////////////////////////////

		foreach($semua_status as $status) {
			$tgl_mulai = $status->mulai;
			$tgl_akhir = $status->akhir;

			if(($tgl_sekarang > $tgl_mulai) && ($tgl_sekarang < $tgl_akhir)) {
				$this->db->update('status', array('aktif' => 1), array('id' => $status->id));
			} else {
				$this->db->update('status', array('aktif' => 0), array('id' => $status->id));
			}
		}		

		foreach($semua_golongan as $golongan) {
			$tgl_mulai = $golongan->mulai;
			$tgl_akhir = $golongan->akhir;

			if(($tgl_sekarang > $tgl_mulai) && ($tgl_sekarang < $tgl_akhir)) {
				$this->db->update('golongan', array('aktif' => 1), array('id' => $golongan->id));
			} else {
				$this->db->update('golongan', array('aktif' => 0), array('id' => $golongan->id));
			}
		}

		foreach($semua_berkala as $berkala) {
			$tgl_mulai = $berkala->mulai;
			$tgl_akhir = $berkala->akhir;

			if(($tgl_sekarang > $tgl_mulai) && ($tgl_sekarang < $tgl_akhir)) {
				$this->db->update('berkala', array('aktif' => 1), array('id' => $berkala->id));
			} else {
				$this->db->update('berkala', array('aktif' => 0), array('id' => $berkala->id));
			}
		}

		///////////////////MOU////////////////////////

		foreach($semua_hutang as $hutang) {
			$tgl_mulai = $hutang->tgl_mulai;
			$tgl_akhir = $hutang->tgl_akhir;

			if(($tgl_sekarang > $tgl_mulai) && ($tgl_sekarang < $tgl_akhir)) {
				$this->db->update('mou_hutang', array('aktif' => 1), array('id' => $hutang->id));
			} else {
				$this->db->update('mou_hutang', array('aktif' => 0), array('id' => $hutang->id));
			}
		}		

		foreach($semua_kontrak as $kontrak) {
			$tgl_mulai = $kontrak->tgl_mulai;
			$tgl_akhir = $kontrak->tgl_akhir;

			if(($tgl_sekarang > $tgl_mulai) && ($tgl_sekarang < $tgl_akhir)) {
				$this->db->update('mou_kontrak', array('aktif' => 1), array('id' => $kontrak->id));
			} else {
				$this->db->update('mou_kontrak', array('aktif' => 0), array('id' => $kontrak->id));
			}
		}

		foreach($semua_sekolah as $sekolah) {
			$tgl_mulai = $sekolah->tgl_mulai;
			$tgl_akhir = $sekolah->tgl_akhir;

			if(($tgl_sekarang > $tgl_mulai) && ($tgl_sekarang < $tgl_akhir)) {
				$this->db->update('mou_sekolah', array('aktif' => 1), array('id' => $sekolah->id));
			} else {
				$this->db->update('mou_sekolah', array('aktif' => 0), array('id' => $sekolah->id));
			}
		}

		//////////////surat///////////////

		foreach($semua_surat as $surat) {
			$tgl_mulai = $surat->tgl_mulai;
			$tgl_akhir = $surat->tgl_akhir;

			if(($tgl_sekarang > $tgl_mulai) && ($tgl_sekarang < $tgl_akhir)) {
				$this->db->update('sip_str', array('aktif' => 1), array('id_sipstr' => $surat->id_sipstr));
			} else {
				$this->db->update('sip_str', array('aktif' => 0), array('id_sipstr' => $surat->id_sipstr));
			}
		}

	}

	public function index()
	{
		if($this->mdl_home->logged_id())
		{

			$this->load->view("home");

			$this->cariKadaluarsa();

			// Cek email
			$tgl_sekarang = date('m/d/Y', time());	

			$semua_sip = $this->db->get('sip_str')->result();

			////////////////////////////SK///////////////////////////////////

			foreach($semua_sip as $sip) {
				$tgl_mulai = $sip->tgl_mulai;
				$tgl_akhir = $sip->tgl_akhir;

				if(($tgl_sekarang > $tgl_mulai) && ($tgl_sekarang < $tgl_akhir)) {
					$this->db->update('sip_str', array('aktif' => 1), array('id_sipstr' => $sip->id_sipstr));
				} else {
					$this->db->update('sip_str', array('aktif' => 0), array('id_sipstr' => $sip->id_sipstr));


					// Kirim email
					// $this->load->library('email');
					// $config = array();
					// $config['charset'] = 'utf-8';
					// $config['useragent'] = 'CodeIgniter';
					// $config['protocol']= "smtp";
					// $config['mailtype']= "html";
					// $config['smtp_host']= "ssl://smtp.gmail.com";
					// $config['smtp_port']= "465";
					// $config['smtp_timeout']= "400";
					// $config['smtp_user']= "hilfinaamaris09@gmail.com";
					// $config['smtp_pass']= "hilfina090798";
					// $config['crlf']="\r\n"; 
					// $config['newline']="\r\n"; 
					// $config['wordwrap'] = TRUE;
					
					// $this->email->initialize($config);
					// //konfigurasi pengiriman
					// $this->email->from($config['smtp_user']);
					// $this->email->to("");
					// $this->email->subject("Kadaluarso");
					// $this->email->message(
					// 	"Bayar"
					// );
					
					// if($this->email->send())
					// {
					// 	echo "<script>alert('Email berhasil terkirim. Cek email anda untuk verifikasi akun!');</script>";
					// }else
					// {
					// 	echo "<script>alert('Email gagal terkirim');</script>";
						
					// }
				}
			}

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
}

/* End of file monitoring.php */
/* Location: ./application/controllers/home.php */