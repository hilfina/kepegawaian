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
                    $idp= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $data3=mysqli_fetch_array(mysqli_query($konek,"select id_profesi from jenis_profesi where nama_profesi = '$idp' "));
                    $id_profesi=$data3['id_profesi'];
                    $tgl_mulai = substr($mulai, 0,4)."-".substr($mulai, 5,2)."-".substr($mulai, 8,4);
                    $tgl_akhir = substr($akhir, 0,4)."-".substr($akhir, 5,2)."-".substr($akhir, 8,4);
                    $data[] = array(
                        'id_karyawan'       =>    $id,
                        'ruangan'        =>    $ruangan,
                        'mulai'             =>    $tgl_mulai,
                        'akhir'             =>    $tgl_akhir,
                        'id_profesi'      =>    $id_profesi,
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