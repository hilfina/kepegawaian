<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminPengguna extends CI_Controller {
	private $filename = "import_data";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_admin');
		$this->load->model('mdl_user');
		$this->load->helper('url','form','file', 'custom');
		$this->load->library('form_validation','image_lib');
        $this->load->helper(array('url','download'));
        $this->load->library('email');
        if($this->mdl_admin->logged_id() == null){ redirect("login");}
	}
    //menampilkan semua pengguna pada sistem 
    public function index(){
        $paket['array']=$this->mdl_user->getUser();
        $this->load->view('admin/user/all',$paket);
    }
    public function add(){
        $this->form_validation->set_rules('nik','Nomor Induk Karyawan','trim|required');
        if($this->form_validation->run()==FALSE){
            $this->load->view('admin/user/add');
        }else{
            $level = $this->input->post('level');
            $data=$this->input->post('nik');
            $pecah = explode("-", $data); //memecah kata antara simbol -
            $nik = $pecah[0];
            //cari id karyawan
            $A = $this->db->query("SELECT id_karyawan from karyawan where nik = $nik");
            $dataA = $A->row();
            $dataLogin= array(
            'id_karyawan' => $dataA->id_karyawan,
            'username' => 'admin'.$nik,
            'password' => md5($nik),
            'level' => $level,
            'aktif' => 1
            );

            $this->mdl_admin->addData('Login',$dataLogin);
            redirect("AdminPengguna/");
        }
    }
    public function edit($id_login){
            $this->form_validation->set_rules('id_login','ID','trim|required');

            if($this->form_validation->run()==FALSE){ 
                $data['data']=$this->mdl_user->editdata($id_login);
                $this->load->view('admin/user/edit',$data);
            }else{
                $data = $this->mdl_user->editdata($id_login);
                $id_login=$this->input->post('id_login');
                $level=$this->input->post('level');
                $username=$this->input->post('username');
                if ($data->password != $this->input->post('password')) {
                    $password=md5($this->input->post('password'));
                }else{
                    $password=$data->password;
                }
             
                $data = array(
                'level' => $level,
                'username' => $username,
                'password' => $password
                );
                $where = array( 'id_login' => $id_login ); 
                $this->mdl_admin->updateData($where,$data,'login');
                
                redirect("AdminPengguna/");
        }
    }
    public function del($id_login){
        $where = array('id_login' => $id_login);
        $this->mdl_admin->hapusdata('login',$where);
        redirect("AdminPengguna");
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */