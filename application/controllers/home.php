<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();
        //load model mdl_home
        $this->load->model('mdl_home');
    }

    public function cariKadaluarsa(){ 
    //fungsi untuk cari kadaluarsa surat tanpa notif email
		$tgl_sekarang = date('Y-m-d', time());	

		$semua_status = $this->db->get('status')->result();
		$semua_golongan = $this->db->get('golongan')->result();
		$semua_berkala = $this->db->get('berkala')->result();

		$semua_hutang = $this->db->get('mou_hutang')->result();
		$semua_kontrak = $this->db->get('mou_kontrak')->result();
		$semua_sekolah = $this->db->get('mou_sekolah')->result();
		$semua_klinis = $this->db->get('mou_klinis')->result();

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

		foreach($semua_klinis as $klinis) {
			$tgl_mulai = $klinis->tgl_mulai;
			$tgl_akhir = $klinis->tgl_akhir;

			if(($tgl_sekarang > $tgl_mulai) && ($tgl_sekarang < $tgl_akhir)) {
				$this->db->update('mou_klinis', array('aktif' => 1), array('id' => $klinis->id));
			} else {
				$this->db->update('mou_klinis', array('aktif' => 0), array('id' => $klinis->id));
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
		if($this->mdl_home->logged_id()){
			$tanggal = date('Y-m-d');
			$data['karyawan'] = $this->mdl_home->karyawan();
			$data['pelamar'] = $this->mdl_home->pelamar();
			$data['calon'] = $this->mdl_home->calon();
			$data['seleksi'] = $this->mdl_home->seleksi();
			$data['sipstr'] = $this->mdl_home->sipstr($tanggal);
			$data['mou_h'] = $this->mdl_home->mou_h($tanggal);
			$data['mou_s'] = $this->mdl_home->mou_s($tanggal);
			$data['mou_k'] = $this->mdl_home->mou_k($tanggal);
			$data['loker'] = $this->mdl_home->loker($tanggal);
			$this->load->view("home",$data);
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
				}
			}
		}else{redirect("login");}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}

/* End of file monitoring.php */
/* Location: ./application/controllers/home.php */