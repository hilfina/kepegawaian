<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	private $filename = "import_data";

	public function __construct()
	{
		parent::__construct();
        $this->load->model('mdl_login');
		$this->load->model('mdl_admin');
		$this->load->model('mdl_home');
		$this->load->helper('url','form','file');
		$this->load->library('form_validation','image_lib');
	}
	public function index()
	{
		if($this->mdl_admin->logged_id())
		{
			$paket['array']=$this->mdl_admin->getPelamar();
            $this->load->view('admin/pelamar/allPelamar',$paket);
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

	//SEMUA DATA PELAMAR
	public function pelamar(){
        if($this->mdl_admin->logged_id())
        {
            $paket['array']=$this->mdl_admin->getPelamar();
            $this->load->view('admin/pelamar/allPelamar',$paket);
        }

        else{ redirect("login"); } 
	}

    public function pelamarDiterima($id){
        if($this->mdl_admin->logged_id()) {
        $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select email from karyawan where id_karyawan ='$id'")); 

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
        $this->email->message("Selamat, anda mendapat panggilan untuk melakukan seleksi di RSIA tahap ");
        $this->email->send();
        
        $where = array( 'id_karyawan' => $id ); 
        $data = array( 'id_status' => 'Calon Karyawan' ); 
        $this->mdl_admin->updateData($where,$data,'karyawan');

        $dataSel = array(
            'id_karyawan' => $id,
            'tgl_seleksi' => "-",
            'nilai_agama' => "-",
            'nilai_kompetensi' => "-",
            'tes_ppa' => "-",
            'tes_psikologi' => "-",
            'tes_kesehatan' => "-",
            'nilai_wawancara' => "-"
        );
        $this->mdl_admin->addData('seleksi',$dataSel);
        $paket['array']=$this->mdl_admin->getPelamar();
        $this->load->view('admin/pelamar/allPelamar',$paket);
        }

        else{ redirect("login"); } 
    }

    public function pelamarDitolak($id_karyawan){
        if($this->mdl_admin->logged_id()) {
        $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select email from karyawan where id_karyawan ='$id'")); 

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
        $this->email->message("Maaf, anda gagal dalam seleksi di RSIA");
        $this->email->send();
        
        $where = array( 'id_karyawan' => $id ); 
        $data = array( 'id_status' => 'Pelamar Ditolak' ); 
        $this->mdl_admin->updateData($where,$data,'karyawan');

        $paket['array']=$this->mdl_admin->getPelamar();
        $this->load->view('admin/pelamar/allPelamar',$paket);
        }

        else{ redirect("login"); } 
    }
    //DATA DETAIL PELAMAR
    public function pelamarDetail($id){
        if($this->mdl_admin->logged_id())
        {
            $where = array( 'id_karyawan' => $id ); 
            $paket['datDir']=$this->mdl_admin->getData('karyawan',$where);
            $paket['datPen']=$this->mdl_admin->getData('pendidikan',$where);
            $paket['datSel']=$this->mdl_admin->getData('Seleksi',$where);
            $paket['datSur']=$this->mdl_admin->cariJenisSurat($id);
            $this->load->view('admin/Pelamar/detailPelamar',$paket);
        }

        else{ redirect("login"); } 
        
    }
	//VERIFIKASI IJASAH
    public function verPend($id,$idk){
       if($this->mdl_admin->logged_id())
        {
            $where = array( 'id' => $id ); 
            $data = array( 'verifikasi' => 1 ); 
            $this->mdl_admin->updateData($where,$data,'pendidikan');
            redirect("admin/pelamarDetail/$idk");
        }

        else{ redirect("login"); } 
    }

    //EDIT DATA SELEKSI
    public function editDataSel(){
        if($this->mdl_admin->logged_id())
        {   
            $idk=$this->input->post('idKSel');
            $id_sel = $this->input->post('idSel');
            $tgl_sel = $this->input->post('tglSel');
            $nw_sel = $this->input->post('nwSel');
            $nk_sel = $this->input->post('nkSel');
            $na_sel = $this->input->post('naSel');
            $tp_sel = $this->input->post('tpSel');
            $tps_sel = $this->input->post('tpsSel');
            $tk_sel = $this->input->post('tkSel');
         
            $dataSel = array(
            'id_karyawan' => $idk,
            'tgl_seleksi' => $tgl_sel,
            'nilai_agama' => $na_sel,
            'nilai_kompetensi' => $nk_sel,
            'tes_ppa' => $tp_sel,
            'tes_psikologi' => $tps_sel,
            'tes_kesehatan' => $tk_sel,
            'nilai_wawancara' => $nw_sel
            );
            $where = array( 'id_karyawan' => $idk);

            $this->mdl_admin->updateData($where,$dataSel,'seleksi');
            redirect("admin/pelamarDetail/$idk");
        }

        else{ redirect("login"); } 
    }

    public function dataSeleksi(){
       if($this->mdl_admin->logged_id())
        {
            $paket['array']=$this->mdl_admin->getSeleksi('seleksi');
            $this->load->view('admin/pelamar/allSeleksi',$paket);
        }

        else{ redirect("login"); } 
    }
    public function editSeleksi($id){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('idKSel','ID Karyawan Seleksi','trim|required');

            if($this->form_validation->run()==FALSE){
                $where = array( 'id_karyawan' => $id);
                $data['array']=$this->mdl_admin->getData('seleksi',$where);
                $this->load->view('admin/pelamar/editSeleksi',$data);
            }else{
                
                $idk=$this->input->post('idKSel');
                $id_sel = $this->input->post('idSel');
                $tgl_sel = $this->input->post('tglSel');
                $nw_sel = $this->input->post('nwSel');
                $nk_sel = $this->input->post('nkSel');
                $na_sel = $this->input->post('naSel');
                $tp_sel = $this->input->post('tpSel');
                $tps_sel = $this->input->post('tpsSel');
                $tk_sel = $this->input->post('tkSel');
             
                $dataSel = array(
                'id_karyawan' => $idk,
                'tgl_seleksi' => $tgl_sel,
                'nilai_agama' => $na_sel,
                'nilai_kompetensi' => $nk_sel,
                'tes_ppa' => $tp_sel,
                'tes_psikologi' => $tps_sel,
                'tes_kesehatan' => $tk_sel,
                'nilai_wawancara' => $nw_sel
                );
                $where = array( 'id_karyawan' => $idk);

                $this->mdl_admin->updateData($where,$dataSel,'seleksi');
                $this->session->set_flashdata('msg','Success');
                redirect("admin/dataSeleksi");
                }
        }

        else{ redirect("login"); } 
    }

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */