<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminProfesi extends CI_Controller {
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
			$paket['array']=$this->mdl_admin->getProfesi();
            $this->load->view('admin/Profesi/allProfesi',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

        public function add(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('id_profesi','Jenis Profesi Lowongan','trim|required');

            if($this->form_validation->run()==FALSE){
                $this->load->view('admin/Profesi/addProfesi');
            }else{
                $id_profesi=$this->input->post('id_profesi');
                $nama_profesi=$this->input->post('nama_profesi');
             
                $dataProfesi = array(
                'id_profesi' => $id_profesi,
                'nama_profesi' => $nama_profesi
                );

                $this->mdl_admin->addData('jenis_profesi',$dataProfesi);
                
                redirect("AdminProfesi");
                }
        }
        
        else{ redirect("login"); } 
    }

    public function editProfesi($id){
         if($this->mdl_admin->logged_id())
        {
            $this->form_validation->set_rules('id_profesi','Jenis Profesi Lowongan','trim|required');

            if($this->form_validation->run()==FALSE){
                $where = array( 'id_profesi' => $id ); 
                $data['array']=$this->mdl_admin->getdata('jenis_profesi',$where);
                $this->load->view('admin/Profesi/editProfesi',$data);
            }else{
                $id_profesi=$this->input->post('id_profesi');
                $nama_profesi=$this->input->post('nama_profesi');
             
                $dataProfesi = array(
                'id_profesi' => $id_profesi,
                'nama_profesi' => $nama_profesi
                );
                $where = array( 'id_profesi' => $id ); 
                $this->mdl_admin->updateData($where,$dataProfesi,'jenis_profesi');
                
                redirect("AdminProfesi");
                }
        }

        else{ redirect("login"); } 
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */