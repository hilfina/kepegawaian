<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminJP extends CI_Controller {
	private $filename = "import_data";
	public function __construct()
	{
		parent::__construct();
        $this->load->model('mdl_login');
		$this->load->model('mdl_admin');
		$this->load->model('mdl_home');
        $this->load->model('mdl_pelamar');
		$this->load->helper('url','form','file');
		$this->load->library('form_validation','image_lib');
	}
	public function index()
	{
		if($this->mdl_admin->logged_id())
		{
            $paket['array']=$this->mdl_home->dataJP();
            $this->load->view('admin/JenisNilai/all',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

        public function add(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('jenis','Jenis Penilaian Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['max'] = $this->mdl_home->maxStatus();
                $this->load->view('admin/JenisNilai/add', $data);
            }else{
                $jenis=$this->input->post('jenis');
             
                $data = array(
                'jenis' => $jenis
                );

                $this->mdl_admin->addData('jenis_penilaian',$data);
                
                redirect("AdminJP");
                }
        }
        
        else{ redirect("login"); } 
    }

    public function edit($id){
         if($this->mdl_admin->logged_id())
        {
            $this->form_validation->set_rules('jenis','Jenis Penilaian Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $where = array( 'id' => $id ); 
                $data['array']=$this->mdl_admin->getdata('jenis_penilaian',$where);
                $this->load->view('admin/JenisNilai/edit',$data);
            }else{
                $jenis=$this->input->post('jenis');
             
                $data = array(
                'id' => $id,
                'jenis' => $jenis
                );
                $where = array( 'id' => $id ); 
                $this->mdl_admin->updateData($where,$data,'jenis_penilaian');
                
                redirect("AdminJP");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
        $where = array('id' => $id);
        $this->mdl_pelamar->hapusdata('jenis_penilaian',$where);
        $this->session->set_flashdata('msg','Data Sukses di Hapus');
        redirect("AdminJP");
    }

    public function laporan($id){
        $this->load->library('Mypdf');
        $where = array('id_karyawan'=>$id);
        $data['array']=$this->mdl_admin->getData('karyawan',$where);
        $data['data']=$this->mdl_admin->getData('penilaian_karyawan',$where);
        $data['datDir']=$this->mdl_admin->getTempat($id);
        $this->mypdf->generate('Laporan/penilaian', $data, 'laporan-riwayat-penilaian', 'A4', 'portrait');
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */