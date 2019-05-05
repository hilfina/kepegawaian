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
			$paket['array']=$this->mdl_admin->getKaryawan();
            $this->load->view('admin/Karyawan/riwayat/golongan/allGolongan',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

    public function detailGol($id)
    {
        $paket['idkar']=$id;
        $paket['array']=$this->mdl_admin->getGol($id);
        $this->load->view('admin/Karyawan/riwayat/Golongan/detailGol',$paket);

    }

    public function addGol($id){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sk','Nomor Surat Keputusan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['idkaka']=$id;
                $data['array']=$this->mdl_admin->getAlldata('jenis_golongan');
                $this->load->view('admin/Karyawan/riwayat/Golongan/addGol',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx|png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
            
                $id_karyawan=$id;
                $id_golongan=$this->input->post('id_golongan');
                $mulai = date('Y-m-d',strtotime($this->input->post('mulai')));
                $akhir = date('Y-m-d',strtotime($this->input->post('akhir')));
                $nomor_sk=$this->input->post('nomor_sk');
                if(!$this->upload->do_upload('alamat_sk')) {
                    $error = $this->upload->display_errors();

                    $this->session->set_flashdata('msg_error', $error);

                    redirect("adminGol/addGol/$id");
                } else {
                    $alamat_sk = $this->upload->data('file_name');
                }
               
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

                redirect("adminGol/detailGol/$id");
                }
        }
        else{ redirect("login"); } 
    }

    public function edit($id, $idk){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sk','Nomor Surat Keputusan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getGoledit($id);
                $data['array2']=$this->mdl_admin->getAlldata('golongan');
                $this->load->view('admin/Karyawan/riwayat/golongan/editGol',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx|png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                
                $id_golongan=$this->input->post('id_golongan');
                $mulai = date('Y-m-d',strtotime($this->input->post('mulai')));
                $akhir = date('Y-m-d',strtotime($this->input->post('akhir')));
                $nomor_sk=$this->input->post('nomor_sk');
                if($_FILES['alamat_sk']['name'] != '') {
                    if(!$this->upload->do_upload('alamat_sk')) {
                        $error = $this->upload->display_errors();

                        $this->session->set_flashdata('msg_error', $error);

                        redirect("adminStatus/addStatus/$id");
                    } else {
                        $alamat_sk = $this->upload->data('file_name');
                    }
                } else {
                    $alamat_sk = $this->input->post('file_old');
                }


                $datagolongan= array(
                'id_golongan' => $id_golongan,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'alamat_sk' => $alamat_sk,
                'nomor_sk' => $nomor_sk,
                );

                $where = array('id' => $id);
                $this->mdl_admin->updateData($where,$datagolongan,'golongan');
                redirect("adminGol/detailGol/$idk");
                }
        }

        else{ redirect("login"); } 
    }

    public function del($id, $idk)
    {
        if($this->mdl_admin->logged_id()){
            $where = array('id' => $id);
            $this->mdl_pelamar->hapusdata('golongan',$where);
            redirect("adminGol/detailGol/$idk");
        }else{ redirect("login"); } 

    }

    public function laporan($id){
        $this->load->library('Mypdf');
        $where = array('id_karyawan'=>$id);
        $data['array']=$this->mdl_admin->getData('karyawan',$where);
        $data['data']=$this->mdl_admin->getGol($id);
        $this->mypdf->generate('Laporan/golongan', $data, 'laporan-riwayat-golongan', 'A4', 'portrait');
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */