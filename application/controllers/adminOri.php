<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminOri extends CI_Controller {
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
	}

	public function index()
	{
		if($this->mdl_admin->logged_id()) {
			$paket['array']=$this->mdl_admin->getOri();
            $this->load->view('admin/Karyawan/Orientasi/allOri',$paket);
		}else{ redirect("login"); }
	}

    public function addOri(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nik','Nomor Induk Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $this->load->view('admin/Karyawan/Orientasi/addOri');
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx|png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $a=$this->input->post('nik');
                $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$a' "));

                $id_karyawan=$data2['id_karyawan'];
                $tgl_mulai=$this->input->post('tgl_mulai');
                $tgl_akhir=$this->input->post('tgl_akhir');
                $this->upload->do_upload('doku_hadir');
                $doku_hadir=$this->upload->data('file_name');
               
                $data= array(
                'id_karyawan' => $id_karyawan,
                'tgl_mulai' => $tgl_mulai,
                'tgl_akhir' => $tgl_akhir,
                'doku_hadir' => $doku_hadir,
                );

                $this->mdl_admin->addData('orientasi',$data);

                redirect("adminOri");
                }
        }
        else{ redirect("login"); } 
    }

    public function edit($id){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('tgl_mulai','Tanggal orientasi','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getOriedit($id);
                $this->load->view('admin/Karyawan/Orientasi/editOri',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx|png';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);
                $tgl_mulai=$this->input->post('tgl_mulai');
                $tgl_akhir=$this->input->post('tgl_akhir');
                if($_FILES['doku_hadir']['name'] != '') {
                    $this->upload->do_upload('doku_hadir');
                    $doku_hadir = $this->upload->data('file_name');
                } else {
                    $doku_hadir = $this->input->post('file_old');
                }

                $data= array(
                'tgl_mulai' => $tgl_mulai,
                'tgl_akhir' => $tgl_akhir,
                'doku_hadir' => $doku_hadir,
                );

                $where = array('id_orientasi' => $id);
                $this->mdl_admin->updateData($where,$data,'orientasi');
                redirect("adminOri");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
        $this->mdl_pelamar->hapusdata('orientasi',$id);
        redirect("adminOri");
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */