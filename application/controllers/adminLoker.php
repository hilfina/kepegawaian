<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLoker extends CI_Controller {
	private $filename = "import_data";
	public function __construct()
	{
		parent::__construct();
        $this->load->model('mdl_login');
		$this->load->model('mdl_admin');
		$this->load->model('mdl_home');
		$this->load->helper('url','form','file');
		$this->load->library('form_validation','image_lib');
        if($this->mdl_admin->logged_id() == null){ redirect("login");}
	}
	public function index()
	{
		if($this->mdl_admin->logged_id())
		{
			$paket['array']=$this->mdl_admin->getLoker();
            $this->load->view('admin/loker/allLoker',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}
    public function lokerbuka(){
        $paket['array']=$this->mdl_admin->getLoker2();
        $this->load->view('admin/loker/allLoker2',$paket);
    }

        public function addLoker(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('id_profesi','Jenis Profesi Lowongan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getProfesi();
                $this->load->view('admin/loker/addloker',$data);
            }else{
                $id_profesi=$this->input->post('id_profesi');
                $kuota=$this->input->post('kuota');
                $mulai=$this->input->post('mulai');
                $akhir=$this->input->post('akhir');
                $ipkmin=$this->input->post('ipkmin');
                $usia=$this->input->post('usia');
                $jenkel=$this->input->post('jenkel');
                $jurusan=$this->input->post('jurusan');

                $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select id_profesi from jenis_profesi where nama_profesi ='$id_profesi'"));
                $dataLoker= array(
                'id_profesi' => $data['id_profesi'],
                'kuota' => $kuota,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'ipkmin' => $ipkmin,
                'usia' => $usia,
                'jenkel' => $jenkel,
                'jurusan' => $jurusan
                );

                $this->mdl_admin->addData('loker',$dataLoker);
                
                redirect("adminLoker");
                }
        }
        
        else{ redirect("login"); } 
    }

    public function edit($id){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('id_profesi','Jenis Profesi Lowongan','trim|required');

            if($this->form_validation->run()==FALSE){
                $where = array( 'id_loker' => $id ); 
                $data['datal']=$this->mdl_admin->getData('loker',$where);
                $data['array']=$this->mdl_admin->getProfesi();
                $this->load->view('admin/loker/editloker',$data);
            }else{
                $id_profesi=$this->input->post('id_profesi');
                $kuota=$this->input->post('kuota');
                $mulai=$this->input->post('mulai');
                $akhir=$this->input->post('akhir');
                $ipkmin=$this->input->post('ipkmin');
                $usia=$this->input->post('usia');
                $jenkel=$this->input->post('jenkel');
                $jurusan=$this->input->post('jurusan');

                $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select id_profesi from jenis_profesi where nama_profesi ='$id_profesi'"));
                $dataLoker= array(
                'id_profesi' => $data['id_profesi'],
                'kuota' => $kuota,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'ipkmin' => $ipkmin,
                'usia' => $usia,
                'jenkel' => $jenkel,
                'jurusan' => $jurusan
                );
                $where = array( 'id_loker' => $id ); 
               $this->mdl_admin->updateData($where,$dataLoker,'loker');
                
                redirect("adminLoker");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
       if($this->mdl_admin->logged_id()){
            $this->mdl_admin->delLoker($id);
            redirect("adminLoker");
        }
        
        else{ redirect("login"); } 
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */