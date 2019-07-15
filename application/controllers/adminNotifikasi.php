<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminNotifikasi extends CI_Controller {
	private $filename = "import_data";
	public function __construct()
	{
		parent::__construct();
        $this->load->model('mdl_login');
        $this->load->model('mdl_pelamar');
        $this->load->model('mdl_karyawan');
		$this->load->model('mdl_admin');
		$this->load->model('mdl_home');
		$this->load->helper('url','form','file', 'custom');
		$this->load->library('form_validation','image_lib');
        $this->load->helper(array('url','download'));

        if($this->mdl_admin->logged_id() == null){ redirect("login"); }
	}

//=============aksi jika notifikasi ditekan===========//
    public function Nsurat($id){
        $where = array('id_sipstr' => $id);
        //data surat
        $dataS = $this->mdl_admin->getData2('sip_str',$where);
        //data karyawan
        $where2 = array('id_karyawan' => $dataS->id_karyawan);
        $dataK = $this->mdl_admin->getData2('karyawan',$where2);

        $this->load->library('email');
        $pesan = "Kepada<br>Yth. Sdr. <b>".$dataK->nama."</b><br> Ditempat,<br><br><br>Kemi memberitahukan bahwa data kepegawaian anda akan segera habis masa berlaku. Dimohon untuk segera mengurus data tersebut.<br><br><br>Demikian kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih.";
        
        send_email(array($dataK->email), 'Notifikasi', $pesan);

        redirect("AdminNotifikasi/editsurat/$id");
    }
    public function editsurat($id){
        $paket['data']=$this->mdl_karyawan->getDetailSur($id);
        $this->load->view('admin/Karyawan/surat/editsurat2', $paket);
    }
    public function addSurat($nik,$idSurat){
       if($this->mdl_admin->logged_id()){
            $this->form_validation->set_rules('id_karyawan','Id Karyawan','trim|required');
            //cari data karyawan berdasarkan parameter NIK
            $a = $this->db->query("SELECT * from karyawan where nik = '$nik'"); $getA = $a->row();
            
            if($this->form_validation->run()==FALSE){
                $data['karyawan']= $a->row();
                //cari nama surat
                $d = $this->db->query("SELECT * from jenis_surat where id_surat = '$idSurat'"); $getD = $d->row();
                $data['nSurat'] = $getD->nama_surat;
                $data['surat']=$this->mdl_admin->getJenSur();
                $this->load->view('admin/karyawan/surat/addSurat2',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;
                $this->load->library('upload', $config);

                $id=$this->input->post('id_karyawan');
                $nama_surat = $this->input->post('nama_surat');
                //mencari id jenis surat yang dipilih
                $b = $this->db->query("SELECT * from jenis_surat where nama_surat = '$nama_surat'"); $getB = $b->row();                
                $id_surat = $getB->id_surat;
                //mencari surat dengan jenis yg sama
                $c = $this->db->query("SELECT * from sip_str where id_surat = '$id_surat' and id_karyawan = '$id'"); $getC = $c->row();     
                //update notif = 1 agar notifikasi file data lama tidak tampil
                $where = array( 'id_sipstr' => $getC->id_sipstr ); 
                $data = array( 'mail' => 1 ); 
                $this->mdl_admin->updateData($where,$data,'sip_str');

                $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
                $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
                $no_surat = $this->input->post('no_surat');
                $this->upload->do_upload('file');
                $file = $this->upload->data('file_name');                
                $data4 = array(
                    'id_karyawan' => $id,
                    'id_surat'=>$id_surat,
                    'tgl_mulai'=>$tgl_mulai,
                    'tgl_akhir'=>$tgl_akhir, 
                    'no_surat'=>$no_surat,  
                    'file'=>$file
                );

                $this->mdl_admin->addData('sip_str',$data4);
                redirect("adminKaryawan/karyawanDetail/$id");
            }
        }else{ redirect("login"); } 
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
        //masuk ke detail karyawan
        redirect("adminKaryawan/karyawanDetail/$idk");
    }
    public function Nloker($id_loker,$id_profesi){
        $where = array('id_loker' => $id_loker);
        $data = array('notif' => 1 );
        $this->mdl_pelamar->updatedata($where,$data,'loker');
        redirect("adminPelamar/index2/$id_profesi");
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */