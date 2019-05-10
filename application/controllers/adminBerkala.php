<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminBerkala extends CI_Controller {
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
			$paket['array']=$this->mdl_admin->getKaryawan();
            $this->load->view('admin/Karyawan/riwayat/berkala/allBerkala',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

    public function detailBerkala($id)
    {
        $paket['array']=$this->mdl_admin->getBerkala($id);
        $paket['id']=$id;
        $this->load->view('admin/Karyawan/riwayat/berkala/detailBerkala',$paket);

    }

    public function add(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sk','Nomor Surat Keputusan','trim|required');

            if($this->form_validation->run()==FALSE){
                $this->load->view('admin/Karyawan/riwayat/berkala/addBerkala');
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx}png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $a=$this->input->post('nik');
                $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$a' "));

                $id_karyawan=$data2['id_karyawan'];
                $berkala=$this->input->post('berkala');
                $mulai= date('Y-m-d',strtotime($this->input->post('mulai')));
                $akhir= date('Y-m-d',strtotime($this->input->post('akhir')));
                $nomor_sk=$this->input->post('nomor_sk');
                if(!$this->upload->do_upload('alamat_sk')) {
                    $error = $this->upload->display_errors();

                    $this->session->set_flashdata('msg_error', $error);

                    redirect("adminBerkala/addBerkala");
                } else {
                    $alamat_sk = $this->upload->data('file_name');
                }
               
                $data= array(
                'id_karyawan' => $id_karyawan,
                'berkala' => $berkala,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'alamat_sk' => $alamat_sk,
                'nomor_sk' => $nomor_sk,
                'aktif' => 1
                );

                
                $updateberkala= array('akhir' => $mulai, 'aktif' => 0);
                $whereS = array('id_karyawan' => $id_karyawan, 'aktif' => 1);
                $this->mdl_admin->updateData($whereS,$updateberkala,'berkala');

                $this->mdl_admin->addData('berkala',$data);

                redirect("AdminBerkala");
                }
        }
        else{ redirect("login"); } 
    }

    public function addBerkala($id){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sk','Nomor Surat Keputusan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['id']=$id;
                $this->load->view('admin/Karyawan/riwayat/berkala/addBerkala2', $data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx}png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                $id_karyawan=$id;
                $berkala=$this->input->post('berkala');
                $mulai= date('Y-m-d',strtotime($this->input->post('mulai')));
                $akhir= date('Y-m-d',strtotime($this->input->post('akhir')));
                $nomor_sk=$this->input->post('nomor_sk');
                if(!$this->upload->do_upload('alamat_sk')) {
                    $error = $this->upload->display_errors();

                    $this->session->set_flashdata('msg_error', $error);

                    redirect("adminBerkala/addBerkala/$id");
                } else {
                    $alamat_sk = $this->upload->data('file_name');
                }
               
                $data= array(
                'id_karyawan' => $id_karyawan,
                'berkala' => $berkala,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'alamat_sk' => $alamat_sk,
                'nomor_sk' => $nomor_sk,
                'aktif' => 1
                );

                
                $updateberkala= array('akhir' => $mulai, 'aktif' => 0);
                $whereS = array('id_karyawan' => $id_karyawan, 'aktif' => 1);
                $this->mdl_admin->updateData($whereS,$updateberkala,'berkala');

                $this->mdl_admin->addData('berkala',$data);

                redirect("adminBerkala/detailBerkala/$id");
                }
        }
        else{ redirect("login"); } 
    }

    public function edit($id, $idk){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sk','Nomor Surat Keputusan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getBerkalaedit($id);
                $this->load->view('admin/Karyawan/riwayat/berkala/editBerkala',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx|png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                
                $berkala=$this->input->post('berkala');
                $mulai=date('Y-m-d',strtotime($this->input->post('mulai')));
                $akhir=date('Y-m-d',strtotime($this->input->post('akhir')));
                $nomor_sk=$this->input->post('nomor_sk');

                if($_FILES['alamat_sk']['name'] != '') {
                    if(!$this->upload->do_upload('alamat_sk')) {
                        $error = $this->upload->display_errors();

                        $this->session->set_flashdata('msg_error', $error);

                        redirect("adminStatus/edit/$id/$idk");
                    } else {
                        $alamat_sk = $this->upload->data('file_name');
                    }
                } else {
                    $alamat_sk = $this->input->post('file_old');
                }

                $databerkala= array(
                'berkala' => $berkala,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'alamat_sk' => $alamat_sk,
                'nomor_sk' => $nomor_sk,
                );

                $where = array('id' => $id);
                $this->mdl_admin->updateData($where,$databerkala,'berkala');
                redirect("adminBerkala/detailBerkala/$idk");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id, $idk){
        $where = array('id' => $id);
        $this->mdl_pelamar->hapusdata('berkala',$where);
        redirect("adminBerkala/detailBerkala/$idk");
    }

    public function laporan($id){
        $this->load->library('Mypdf');
        $where = array('id_karyawan'=>$id);
        $data['array']=$this->mdl_admin->getData('karyawan',$where);
        $data['data'] = $this->mdl_admin->getBerkala($id);
        $data['datDir']=$this->mdl_admin->getTempat($id);
        $this->mypdf->generate('Laporan/berkala', $data, 'laporan-riwayat-berkala', 'A4', 'portrait');
    }
    public function loadimpor(){
        if($this->mdl_admin->logged_id()){
        $this->load->view('admin/Karyawan/Riwayat/berkala/impor');
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
                    $berkala= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $mulai = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $akhir = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $alamat_sk= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $nomor_sk= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $data[] = array(
                        'id_karyawan'       =>    $id,
                        'berkala'        =>    $berkala,
                        'mulai'             =>    $mulai,
                        'akhir'             =>    $akhir,
                        'nomor_sk'      =>    $nomor_sk,
                        'alamat_sk'      =>    $alamat_sk,
                    );
                }
            }

            $this->mdl_admin->impor('berkala',$data);
            redirect('Adminberkala');
        }        
    }
}


/* End of file admin.php */
/* Location: ./application/controllers/admin.php */