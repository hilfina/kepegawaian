<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminRiwayat extends CI_Controller {
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
            
			$paket['array']=$this->mdl_admin->getKaryawan();
            $this->load->view('admin/Karyawan/Riwayat/Penempatan/allRiwayat',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

    public function detailRiwayat($id)
    {
        $paket['id']=$id;
        $paket['array']=$this->mdl_admin->getRiwayat($id);
        $this->load->view('admin/Karyawan/Riwayat/Penempatan/detailRiwayat',$paket);

    }

    public function addRiwayat($id){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('ruangan','Penempatan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['id']=$id;
                $this->load->view('admin/Karyawan/Riwayat/Penempatan/addRiwayat',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $data1=mysqli_fetch_array(mysqli_query($konek,"select max(id_riwayat) as last from riwayat"));
                
                if(!$this->upload->do_upload('alamat_sk')) {
                    $error = $this->upload->display_errors();

                    $this->session->set_flashdata('msg_error', $error);

                    redirect("adminRiwayat/addRiwayat/$id");
                } else {
                    $alamat_sk = $this->upload->data('file_name');
                }
                $id_riwayat = $data1['last']+1;
                $ruangan=$this->input->post('ruangan');
                $id_karyawan=$id;
                $mulai= date('Y-m-d');
                $akhir = date('Y-m-d');
               
                $dataRiwayat= array(
                'id_riwayat' => $id_riwayat,
                'ruangan' => $ruangan,
                'id_karyawan' => $id_karyawan,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'alamat_sk' => $alamat_sk
                );
                $this->mdl_admin->addData('Riwayat',$dataRiwayat);

                redirect("adminRiwayat/detailRiwayat/$id");
                }
        }
        else{ redirect("login"); } 
    }

    public function edit($id, $idk){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('mulai','Tanggal Mulai Penempatan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['datRi']=$this->mdl_admin->getEditRi($id);
                $this->load->view('admin/Karyawan/Riwayat/Penempatan/editRiwayat',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);
                $ruangan=$this->input->post('ruangan');
                $mulai = date('Y-m-d',strtotime($this->input->post('mulai')));
                $akhir = date('Y-m-d',strtotime($this->input->post('akhir')));
                if($_FILES['alamat_sk']['name'] != '') {
                    if(!$this->upload->do_upload('alamat_sk')) {
                        $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");
                        $this->session->set_flashdata('msg_error', $error);

                        redirect("adminRiwayat/edit/$id/$idk");
                    } else {
                        $alamat_sk = $this->upload->data('file_name');
                    }
                } else {
                    $alamat_sk = $this->input->post('file_old');
                }

                $dataRiwayat= array(
                'ruangan' => $ruangan,
                'alamat_sk' => $alamat_sk,
                'mulai' => $mulai,
                'akhir' => $akhir,
                );

                $where2 = array('id_riwayat' => $id);
                $this->mdl_admin->updateData($where2,$dataRiwayat,'Riwayat');

                redirect("adminRiwayat/detailRiwayat/$idk");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id, $idk){
       if($this->mdl_admin->logged_id()){
            $where = array('id_riwayat' => $id);
            $this->mdl_pelamar->hapusdata('riwayat',$where);
            redirect("adminRiwayat/detailRiwayat/$idk");
        }
        
        else{ redirect("login"); } 
    }

    public function laporan($id){
        $this->load->library('Mypdf');
        $data['data'] = $this->mdl_admin->getRiwayat($id);
        $data['jabatan']=$this->mdl_admin->getJab($id);
        $this->mypdf->generate('Laporan/penempatan', $data, 'laporan-riwayat-penempatan', 'A4', 'portrait');
    }

    public function loadimpor(){
        if($this->mdl_admin->logged_id()){
        $this->load->view('admin/Karyawan/Riwayat/penempatan/impor');
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
                    $ruangan= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $mulai = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $akhir = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $tgl_mulai = substr($mulai, 0,4)."-".substr($mulai, 5,2)."-".substr($mulai, 8,4);
                    $tgl_akhir = substr($akhir, 0,4)."-".substr($akhir, 5,2)."-".substr($akhir, 8,4);
                    $data[] = array(
                        'id_karyawan'       =>    $id,
                        'ruangan'        =>    $ruangan,
                        'mulai'             =>    $tgl_mulai,
                        'akhir'             =>    $tgl_akhir
                    );
                }
            }

            $this->mdl_admin->impor('riwayat',$data);
            redirect('AdminRiwayat');
        }        
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */