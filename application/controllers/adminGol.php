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

    public function addGol(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sk','Nomor Surat Keputusan','trim|required');

            if($this->form_validation->run()==FALSE){

                $data['array']=$this->mdl_admin->getAlldata('jenis_golongan');
                $this->load->view('admin/Karyawan/addGol',$data);
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
                $id_golongan=$this->input->post('id_golongan');
                $mulai=$this->input->post('mulai');
                $akhir=$this->input->post('akhir');
                $nomor_sk=$this->input->post('nomor_sk');
                $this->upload->do_upload('alamat_sk');
                $alamat_sk=$this->upload->data('file_name');
               
                $datagolongan= array(
                'id_karyawan' => $id_karyawan,
                'id_golongan' => $id_golongan,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'alamat_sk' => $alamat_sk,
                'nomor_sk' => $nomor_sk,
                'aktif' => 1
                );

                
                $updategolongan= array('akhir' => $mulai, 'aktif' => 0);
                $whereS = array('id_karyawan' => $id_karyawan, 'aktif' => 1);
                $this->mdl_admin->updateData($whereS,$updategolongan,'golongan');
                
                $dataKaryawan= array('id_golongan' => $id_golongan);
                $where = array('id_karyawan' => $id_karyawan);

                $this->mdl_admin->addData('golongan',$datagolongan);
                $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');

                redirect("adminGol");
                }
        }
        else{ redirect("login"); } 
    }

    public function edit($id){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sk','Nomor Surat Keputusan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getGoledit($id);
                $data['array2']=$this->mdl_admin->getAlldata('golongan');
                $this->load->view('admin/Karyawan/editGol',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx|png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                
                $id_golongan=$this->input->post('id_golongan');
                $mulai=$this->input->post('mulai');
                $akhir=$this->input->post('akhir');
                $nomor_sk=$this->input->post('nomor_sk');
                if($_FILES['alamat_sk']['name'] != '') {
                    $this->upload->do_upload('alamat_sk');
                    $alamat_sk = $this->upload->data('file_name');
                } else {
                    $alamat_sk = $this->input->post('file_old');
                }
                // $s = $akhir;
                // $date = strtotime($s);
                // $exp = date('d/m/Y', strtotime('+1 day', $date));

                $datagolongan= array(
                'id_golongan' => $id_golongan,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'alamat_sk' => $alamat_sk,
                'nomor_sk' => $nomor_sk,
                );

                $where = array('id' => $id);
                $this->mdl_admin->updateData($where,$datagolongan,'golongan');
                redirect("adminGol");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
        $this->mdl_pelamar->hapusdata('golongan',$id);
        redirect("adminGol");
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */