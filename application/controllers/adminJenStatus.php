<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminJenStatus extends CI_Controller {
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
            $paket['array']=$this->mdl_home->getData();
            $this->load->view('admin/JenisStatus/all',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

        public function add(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('id_status','Jenis Status Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['max'] = $this->mdl_home->maxStatus();
                $this->load->view('admin/JenisStatus/add', $data);
            }else{
                $id_status=$this->input->post('id_status');
                $id=$this->input->post('id');
                $kuota_cuti=$this->input->post('kuota_cuti');
             
                $datastatus = array(
                'id' => $id+1,
                'id_status' => $id_status,
                'kuota_cuti' => $kuota_cuti
                );

                $this->mdl_admin->addData('jenis_status',$datastatus);
                
                redirect("AdminJenStatus");
                }
        }
        
        else{ redirect("login"); } 
    }

    public function edit($id){
         if($this->mdl_admin->logged_id())
        {
            $this->form_validation->set_rules('id_status','Jenis Status Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $where = array( 'id_status' => $id ); 
                $data['array']=$this->mdl_admin->getdata('jenis_status',$where);
                $this->load->view('admin/JenisStatus/edit',$data);
            }else{
                $id_status=$this->input->post('id_status');
                $kuota_cuti=$this->input->post('kuota_cuti');
             
                $datastatus = array(
                'id_status' => $id_status,
                'kuota_cuti' => $kuota_cuti
                );
                $where = array( 'id' => $id ); 
                $this->mdl_admin->updateData($where,$datastatus,'jenis_status');
                
                redirect("AdminJenStatus");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
        $where = array('id' => $id);
        $this->mdl_pelamar->hapusdata('jenis_status',$where);
        $this->session->set_flashdata('msg','Data Sukses di Hapus');
        redirect("AdminJenStatus");
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */