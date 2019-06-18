<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminNotifikasi extends CI_Controller {
	private $filename = "import_data";
	public function __construct()
	{
		parent::__construct();
        $this->load->model('mdl_login');
        $this->load->model('mdl_pelamar');
		$this->load->model('mdl_admin');
		$this->load->model('mdl_home');
		$this->load->helper('url','form','file');
		$this->load->library('form_validation','image_lib');
        $this->load->helper(array('url','download'));

        if($this->mdl_admin->logged_id() == null){ redirect("login"); }
	}

//=============aksi jika notifikasi ditekan===========//
    public function Nsurat($id)
    {
        $where = array('id_sipstr' => $id);
        $data = array('mail' => 1 );
        $this->mdl_pelamar->updatedata($where,$data,'sip_str');
        //data surat
        $dataS = $this->mdl_admin->getData2('sip_str',$where);
        //data karyawan
        $where2 = array('id_karyawan' => $dataS->id_karyawan);
        $dataK = $this->mdl_admin->getData2('karyawan',$where2);

        $this->load->library('email');
        $config = array();
        $config['charset'] = 'utf-8';
        $config['useragent'] = 'CodeIgniter';
        $config['protocol']= "smtp";
        $config['mailtype']= "html";
        $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
        $config['smtp_port']= "465";
        $config['smtp_timeout']= "400";
        $config['smtp_user']= "hilfina090798@gmail.com"; // isi dengan email kamu
        $config['smtp_pass']= "hilfano090798"; // isi dengan password kamu
        $config['crlf']="\r\n"; 
        $config['newline']="\r\n"; 
        $config['wordwrap'] = TRUE;
        //memanggil library email dan set konfigurasi untuk pengiriman email
            
        $this->email->initialize($config);
        //konfigurasi pengiriman
        $this->email->from($config['smtp_user']);
        $this->email->to($dataK->email);
        $this->email->subject("Notifikasi");
        $this->email->message("Kepada<br>Yth. Sdr. <b>".$dataK->nama."</b><br> Ditempat,<br><br><br>Kemi memberitahukan bahwa data kepegawaian anda akan segera habis masa berlaku. Dimohon untuk segera mengurus data tersebut.<br><br><br>Demikian kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih.");
        $this->email->message("Surat anda akan segera berakhir dalam jangka waktu 6 bulan.");
        $this->email->send();

        redirect("adminKaryawan/editsurat/$id");
    }
     public function NIns($id)
    {
        $where = array('id' => $id);
        $data = array('notif' => 1 );
        $this->mdl_pelamar->updatedata($where,$data,'mou_instansi');
        redirect("adminInstansi/edit/$id");
    }
    public function Nkontrak($id)
    {
        $where = array('id' => $id);
        $data = array('notif' => 1 );
        $this->mdl_pelamar->updatedata($where,$data,'mou_kontrak');
        redirect("adminKontrak/edit/$id");
    }
    public function Nsekolah($id)
    {
        $where = array('id' => $id);
        $data = array('notif' => 1 );
        $this->mdl_pelamar->updatedata($where,$data,'mou_sekolah');
        redirect("adminSekolah/edit/$id");
    }
    public function Nklinis($id)
    {
        $where = array('id' => $id);
        $data = array('notif' => 1 );
        $this->mdl_pelamar->updatedata($where,$data,'mou_klinis');
        redirect("adminKlinis/edit/$id");
    }
    public function Nhutang($id)
    {
        $where = array('id' => $id);
        $data = array('notif' => 1 );
        $this->mdl_pelamar->updatedata($where,$data,'mou_hutang');
        redirect("adminHutang/edit/$id");
    }
    public function Nkew($id)
    {
        $where = array('id_kewenangan' => $id);
        $data = array('notif' => 1 );
        $this->mdl_pelamar->updatedata($where,$data,'kewenangan_klinis');
        redirect("adminKew/edit/$id");
    }
    public function NStatus($id,$idk)
    {
        $where = array('id' => $id);
        $data = array('notif' => 1 );
        $this->mdl_pelamar->updatedata($where,$data,'status');
        redirect("adminKaryawan/karyawanDetail/$idk");
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */