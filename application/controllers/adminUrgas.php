<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class adminUrgas extends CI_Controller {
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
			$paket['array']=$this->mdl_admin->getUrgas();
            $this->load->view('admin/Karyawan/Urgas/allUrgas',$paket);
		}else{ redirect("login"); }
	}

    public function addUrgas(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nik','Nomor Induk Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $this->load->view('admin/Karyawan/Urgas/add');
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx|png';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);
                
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $a=$this->input->post('nik');
                $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$a' "));

                $id_karyawan=$data2['id_karyawan'];
                $this->upload->do_upload('file_urgas');
                $file_urgas=$this->upload->data('file_name');
               
                $data= array(
                'id_karyawan' => $id_karyawan,
                'file_urgas' => $file_urgas,
                );

                $this->mdl_admin->addData('uraian_tugas',$data);

                redirect("adminUrgas");
                }
        }
        else{ redirect("login"); } 
    }

    public function edit($id){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('file_urgas','File Uraian Tugas','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getUrgasedit($id);
                $this->load->view('admin/Karyawan/Urgas/edit',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx|png';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);
                if($_FILES['file_urgas']['name'] != '') {
                    $this->upload->do_upload('file_urgas');
                    $file_urgas = $this->upload->data('file_name');
                } else {
                    $file_urgas = $this->input->post('file_old');
                }

                $data= array(
                'file_urgas' => $file_urgas,
                );

                $where = array('id_uraian' => $id);
                $this->mdl_admin->updateData($where,$data,'uraian_tugas');
                redirect("adminUrgas");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
        $where = array('id_uraian' => $id);
        $this->mdl_pelamar->hapusdata('uraian_tugas',$where);
        redirect("adminUrgas");
    }

    public function loadimpor(){
        if($this->mdl_admin->logged_id()){
        $this->load->view('admin/Karyawan/Urgas/impor');
        }else{ redirect("login"); }
    }
    public function impor()
    {
    include APPPATH."/libraries/PHPExcel.php";
    if(isset($_FILES["file"]["name"]))
        {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for($row=2; $row<=$highestRow; $row++)
                {   
                    $nik = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $konek = mysqli_connect("localhost","root","","kepegawaian");
                    $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$nik' "));
                    $id=$data2['id_karyawan'];
                    $file_urgas= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $data[] = array(
                        'id_karyawan'       =>    $id,
                        'file_urgas'        =>    $file_urgas,
                    );
                }
            }

            $this->mdl_admin->impor('uraian_tugas',$data);
            redirect('adminUrgas');
        }        
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */