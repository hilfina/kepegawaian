<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminPendidikan extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->model('mdl_login');
        $this->load->model('mdl_admin');
		$this->load->model('mdl_pelamar');
		$this->load->model('mdl_home');
		$this->load->helper('url','form','file');
		$this->load->library('form_validation','image_lib', 'Excel');
	}

	public function index(){
		if($this->mdl_admin->logged_id()){
        $paket['pen']=$this->mdl_admin->getPendidikan();
        $this->load->view('admin/pendidikan/allpendidikan',$paket);
		}
        else{redirect("login");}
	}
    
	//VERIFIKASI IJASAH
    public function verPend($id,$idk){
       if($this->mdl_admin->logged_id())
        {
            $where = array( 'id' => $id ); 
            $data = array( 'verifikasi' => 1 ); 
            $this->mdl_admin->updateData($where,$data,'pendidikan');
            redirect("admin/pelamarDetail/$idk");
        }
        else{ redirect("login"); } 
    }

    
    public function addPend(){
       if($this->mdl_admin->logged_id()){
        
            $this->form_validation->set_rules('nik','Nomor Induk Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $this->load->view('admin/pendidikan/addPendidikan');
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'gif|jpg|png|pdf|docx';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $a=$this->input->post('nik');
                $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$a' "));

                $id=$data2['id_karyawan'];
                $pendidikan = $this->input->post('pendidikan');
                $nilai = $this->input->post('nilai');
                $mulai = $this->input->post('mulai');
                $akhir = $this->input->post('akhir');
                $nomor_ijazah = $this->input->post('nomor_ijazah');
                if(!$this->upload->do_upload('file')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect('AdminPendidikan/addPend');
                } else {
                    $file = $this->upload->data('file_name');
                }

                $data3 = array(
                        'pendidikan'=>$pendidikan,
                        'mulai'=>$mulai,
                        'akhir'=>$filekhir,
                        'nomor_ijazah'=>$nomor_ijazah,
                        'id_karyawan' => $id,
                        'file'=>$file,
                        'verifikasi'=> 0,
                        'nilai' => $nilai,
                    );
                $this->mdl_admin->addData('pendidikan',$data3);
                redirect("AdminPendidikan");
                
                }
        }else{ redirect("login"); } 
    }

    public function editpend($id){
        if($this->mdl_admin->logged_id()){
            $this->load->helper('url','form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required' );
            $this->load->model('mdl_pelamar');

            if ($this->form_validation->run()==FALSE) {
                $paket['array']=$this->mdl_pelamar->getDetailpend($id);
                $this->load->view('admin/pendidikan/editpendidikan', $paket);
            }
            else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);
                $pendidikan = $this->input->post('pendidikan');
                $jurusan  = $this->input->post('jurusan');
                $nik = $this->input->post('nik');
                $nilai = $this->input->post('nilai');
                $mulai = $this->input->post('mulai');
                $akhir = $this->input->post('akhir');
                $nomor_ijazah = $this->input->post('nomor_ijazah');

                if($_FILES['file']['name'] != '') {
                    if(!$this->upload->do_upload('file')) {
                        $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                        $this->session->set_flashdata('msg_error', $error);

                        redirect("AdminPendidikan/editpend/$id");
                    } else {
                        $file = $this->upload->data('file_name');
                    }
                } else {
                    $file = $this->input->post('file_old');
                }

                $data3 = array(
                        'pendidikan'=>$pendidikan,
                        'jurusan' => $jurusan,
                        'nilai' => $nilai,
                        'mulai'=>$mulai,
                        'akhir'=>$akhir,
                        'nomor_ijazah'=>$nomor_ijazah,
                        'file'=>$file
                    );
                $where = array(
                    'id' => $id
                );

                $update = $this->mdl_pelamar->updatedata($where,$data3,'pendidikan');
                $this->session->set_flashdata('msg','Data Sukses di Update');
                redirect("AdminPendidikan");
            }
        }else{ redirect("login"); }         
    }
    public function delpend($id)
    {
        $where = array('id' => $id);
        $this->mdl_pelamar->hapusdata('pendidikan',$where);
        $this->session->set_flashdata('msg','Data Sukses di Hapus');
        redirect("AdminPendidikan");
    }

    public function loadimpor(){
        if($this->mdl_admin->logged_id()){
        $this->load->view('admin/pendidikan/impor');
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
                    $pendidikan= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $jurusan= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $mulai = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $akhir = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $nomor_ijazah= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $nilai= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $file= $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $data[] = array(
                        'id_karyawan'       =>    $id,
                        'pendidikan'        =>    $pendidikan,
                        'jurusan'           =>    $jurusan,
                        'mulai'             =>    $mulai,
                        'akhir'             =>    $akhir,
                        'nomor_ijazah'      =>    $nomor_ijazah,
                        'nilai'             =>    $nilai,
                        'file'              =>    $file,
                    );
                }
            }

            $this->mdl_admin->impor('pendidikan',$data);
            redirect('AdminPendidikan');
        }        
    }


}
/* End of file admin.php */
/* Location: ./application/controllers/admin.php */