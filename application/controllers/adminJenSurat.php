<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminJenSurat extends CI_Controller {
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
            $paket['array']=$this->mdl_admin->getAllData('jenis_surat');
            $this->load->view('admin/JenisSurat/all',$paket);
        }else{
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");
        }
    }

        public function add(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('jenis_surat','Jenis Status Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $this->load->view('admin/JenisSurat/add');
            }else{
                $jenis_surat=$this->input->post('jenis_surat');
                $nama_surat=$this->input->post('nama_surat');
             
                $datastatus = array(
                'jenis_surat' => $jenis_surat,
                'nama_surat' => $nama_surat
                );

                $this->mdl_admin->addData('jenis_surat',$datastatus);
                
                redirect("AdminJenSurat");
                }
        }
        
        else{ redirect("login"); } 
    }

    public function edit($id){
         if($this->mdl_admin->logged_id())
        {
            $this->form_validation->set_rules('jenis_surat','Jenis Status Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $where = array( 'id_surat' => $id ); 
                $data['array']=$this->mdl_admin->getdata('jenis_surat',$where);
                $this->load->view('admin/JenisSurat/edit',$data);
            }else{
                $jenis_surat=$this->input->post('jenis_surat');
                $nama_surat=$this->input->post('nama_surat');
             
                $datastatus = array(
                'jenis_surat' => $jenis_surat,
                'nama_surat' => $nama_surat
                );
                $where = array( 'id_surat' => $id ); 
                $this->mdl_admin->updateData($where,$datastatus,'jenis_surat');
                
                redirect("AdminJenSurat");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
        $where = array('id_surat' => $id);
        $this->mdl_pelamar->hapusdata('jenis_surat',$where);
        $this->session->set_flashdata('msg','Data Sukses di Hapus');
        redirect("AdminJenSurat");
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */