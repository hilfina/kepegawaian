<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminGol extends CI_Controller {
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
	}

	public function index()
	{
		if($this->mdl_admin->logged_id())
		{
			$paket['array']=$this->mdl_admin->getGol();
            $this->load->view('admin/Karyawan/allGolongan',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

    public function addStatus(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nik','Nomor Induk Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){

                $data['array']=$this->mdl_admin->getJenStatus();
                $this->load->view('admin/Karyawan/addStatus',$data);
            }else{
                $config['upload_path']      = './Assets/gambar/';
                $config['allowed_types']    = 'gif|jpg|png';
                $config['max_size']         = 2000000000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                $this->upload->do_upload('file');
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $a=$this->input->post('nik');
                $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$a' "));

                $id_karyawan=$data2['id_karyawan'];
                $id_status=$this->input->post('id_status');
                $mulai=$this->input->post('mulai');
                $nomor_sk=$this->input->post('nomor_sk');
                $alamat_sk=$this->upload->data('file_name');
               
                $dataStatus= array(
                'id_karyawan' => $id_karyawan,
                'id_status' => $id_status,
                'mulai' => $mulai,
                'alamat_sk' => $alamat_sk,
                'nomor_sk' => $nomor_sk,
                'aktif' => 1
                );

                
                $updateStatus= array('akhir' => $mulai, 'aktif' => 0);
                $whereS = array('id_karyawan' => $id_karyawan, 'aktif' => 1);
                $this->mdl_admin->updateData($whereS,$updateStatus,'Status');
                
                $dataKaryawan= array('id_status' => $id_status);
                $where = array('id_karyawan' => $id_karyawan);

                $this->mdl_admin->addData('status',$dataStatus);
                $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');

                redirect("adminRiwayat");
                }
        }
        else{ redirect("login"); } 
    }

    public function edit($id){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nik','Nomor Induk Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $where = array('id_riwayat' => $id);
                $data['datRi']=$this->mdl_admin->getData('riwayat',$where);
                $data['array']=$this->mdl_admin->getProfesi();
                $this->load->view('admin/Karyawan/editRiwayat',$data);
            }else{
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $a=$this->input->post('nik');
                $b =$this->input->post('id_profesi');
                $data1=mysqli_fetch_array(mysqli_query($konek,"select max(id_riwayat) as last from riwayat"));
                $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$a' "));
                $data3=mysqli_fetch_array(mysqli_query($konek,"select id_profesi from jenis_profesi where nama_profesi = '$b' "));

                $id_riwayat = $data1['last']+1;
                $ruangan=$this->input->post('ruangan');
                $id_profesi= $data3['id_profesi'];
                $id_karyawan=$data2['id_karyawan'];
                $mulai= date('Y-m-d');
               
                $dataRiwayat= array(
                'id_riwayat' => $id_riwayat,
                'ruangan' => $ruangan,
                'id_profesi' => $id_profesi,
                'id_karyawan' => $id_karyawan,
                'mulai' => $mulai
                );

                $dataKaryawan= array('id_profesi' => $id_profesi);
                $where = array('id_karyawan' => $id_karyawan);

                $this->mdl_admin->addData('Riwayat',$dataRiwayat);
                $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');

                redirect("adminRiwayat");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
        $this->mdl_pelamar->hapusdata('magang',$id);
        redirect("adminStatus");
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */