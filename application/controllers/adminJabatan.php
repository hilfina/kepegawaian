<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminJabatan extends CI_Controller {
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
            $paket['array']=$this->mdl_home->dataJab();
            $this->load->view('admin/Jabatan/all',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

        public function add(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('jabatan','Jenis Penilaian Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['max'] = $this->mdl_home->maxStatus();
                $this->load->view('admin/Jabatan/add', $data);
            }else{
                $jabatan=$this->input->post('jabatan');
             
                $data = array(
                'jabatan' => $jabatan
                );

                $this->mdl_admin->addData('jabatan',$data);
                
                redirect("AdminJabatan");
                }
        }
        
        else{ redirect("login"); } 
    }

    public function edit($id){
         if($this->mdl_admin->logged_id())
        {
            $this->form_validation->set_rules('jabatan','Jenis Penilaian Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $where = array( 'id' => $id ); 
                $data['array']=$this->mdl_admin->getdata('jabatan',$where);
                $this->load->view('admin/Jabatan/edit',$data);
            }else{
                $jabatan=$this->input->post('jabatan');
             
                $data = array(
                'id' => $id,
                'jabatan' => $jabatan
                );
                $where = array( 'id' => $id ); 
                $this->mdl_admin->updateData($where,$data,'jabatan');
                
                redirect("AdminJabatan");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
        $where = array('id' => $id);
        $this->mdl_pelamar->hapusdata('jenis_penilaian',$where);
        $this->session->set_flashdata('msg','Data Sukses di Hapus');
        redirect("AdminJabatan");
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */