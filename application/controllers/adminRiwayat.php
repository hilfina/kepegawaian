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
                $data['array']=$this->mdl_admin->getProfesi();
                $this->load->view('admin/Karyawan/Riwayat/Penempatan/addRiwayat',$data);
            }else{
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $a=$this->input->post('nik');
                $b =$this->input->post('id_profesi');
                $data1=mysqli_fetch_array(mysqli_query($konek,"select max(id_riwayat) as last from riwayat"));
                
                $data3=mysqli_fetch_array(mysqli_query($konek,"select id_profesi from jenis_profesi where nama_profesi = '$b' "));

                $id_riwayat = $data1['last']+1;
                $ruangan=$this->input->post('ruangan');
                $id_profesi= $data3['id_profesi'];
                $id_karyawan=$id;
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

    public function edit($id, $idk){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('mulai','Tanggal Mulai Penempatan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['datRi']=$this->mdl_admin->getEditRi($id);
                $data['array']=$this->mdl_admin->getProfesi();
                $this->load->view('admin/Karyawan/Riwayat/Penempatan/editRiwayat',$data);
            }else{
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $this->input->post('nik');
                $b =$this->input->post('id_profesi');
                $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$a' "));
                $data3=mysqli_fetch_array(mysqli_query($konek,"select id_profesi from jenis_profesi where nama_profesi = '$b' "));

                $ruangan=$this->input->post('ruangan');
                $id_profesi= $data3['id_profesi'];
                $mulai = date('Y-m-d',strtotime($this->input->post('mulai')));
                $akhir = date('Y-m-d',strtotime($this->input->post('akhir')));
               
                $dataRiwayat= array(
                'ruangan' => $ruangan,
                'id_profesi' => $id_profesi,
                'mulai' => $mulai,
                'akhir' => $akhir,
                );

                $dataKaryawan= array('id_profesi' => $id_profesi);
                $where = array('id_karyawan' => $id_karyawan);
                $where2 = array('id_riwayat' => $id);
                $this->mdl_admin->updateData($where2,$dataRiwayat,'Riwayat');
                $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');

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
        $this->mypdf->generate('Laporan/penempatan', $data, 'laporan-riwayat-penempatan', 'A4', 'portrait');
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */