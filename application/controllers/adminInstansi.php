<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class adminInstansi extends CI_Controller {
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
        if($this->mdl_admin->logged_id())
        {
            $paket['array']=$this->mdl_admin->getAlldata("mou_instansi");
            $this->load->view('admin/Karyawan/mou/instansi/allinstansi',$paket);
        }else{
            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");
        }
    }

    public function add(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('no_mou','Nomor Surat MOU','trim|required');

            if($this->form_validation->run()==FALSE){
                $this->load->view('admin/Karyawan/mou/instansi/addinstansi');
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);
                
                $instansi=$this->input->post('instansi');
                $ket=$this->input->post('ket');
                $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
                $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
                $no_mou=$this->input->post('no_mou');
                if(!$this->upload->do_upload('file')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect('adminInstansi/add');
                } else {
                    $file = $this->upload->data('file_name');
                }

               
                $data= array(
                'instansi' => $instansi,
                'tgl_mulai' => $tgl_mulai,
                'tgl_akhir' => $tgl_akhir,
                'ket' => $ket,
                'file' => $file,
                'no_mou' => $no_mou
                );

                $this->mdl_admin->addData('mou_instansi',$data);

                redirect("adminInstansi");
                }
        }
        else{ redirect("login"); } 
    }

    public function edit($id){
         if($this->mdl_admin->logged_id()){

                $where = array('id' => $id);
            $this->form_validation->set_rules('no_mou','Nomor Surat Keputusan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getData("mou_instansi",$where);
                $this->load->view('admin/Karyawan/mou/instansi/editinstansi',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx|png';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);
                $ket=$this->input->post('ket');
                $instansi=$this->input->post('instansi');
                $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
                $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
                $no_mou=$this->input->post('no_mou');
                if($_FILES['file']['name'] != '') {
                    if(!$this->upload->do_upload('file')) {
                        $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 MB");
                        $this->session->set_flashdata('msg_error', $error);

                        redirect("adminInstansi/edit/$id");
                    } else {
                        $file = $this->upload->data('file_name');
                    }
                } else {
                    $file = $this->input->post('file_old');
                }

                $data= array(
                'tgl_mulai' => $tgl_mulai,
                'tgl_akhir' => $tgl_akhir,
                'instansi' => $instansi,
                'ket' => $ket,
                'file' => $file,
                'no_mou' => $no_mou
                );

                $this->mdl_admin->updateData($where,$data,'mou_instansi');
                redirect("adminInstansi");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
        $where = array('id' => $id);
        $this->mdl_pelamar->hapusdata('mou_instansi',$where);
        redirect("adminInstansi");
    }

    public function loadimpor(){
        if($this->mdl_admin->logged_id()){
        $this->load->view('admin/Karyawan/mou/instansi/impor');
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
                    $instansi = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $no_mou= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $mulai = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $akhir = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $ket= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $file= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $tgl_mulai = substr($mulai, 0,4)."-".substr($mulai, 5,2)."-".substr($mulai, 8,4);
                    $tgl_akhir = substr($akhir, 0,4)."-".substr($akhir, 5,2)."-".substr($akhir, 8,4);
                    $data[] = array(
                        'instansi'       =>    $instansi,
                        'no_mou'        =>    $no_mou,
                        'tgl_mulai'             =>    $tgl_mulai,
                        'tgl_akhir'             =>    $tgl_akhir,
                        'ket'             =>    $ket,
                        'file'              =>    $file,
                    );
                }
            }
            $this->mdl_admin->impor('mou_instansi',$data);
            redirect('adminInstansi');
        }        
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */