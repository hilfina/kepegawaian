<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDiklat extends CI_Controller {
	private $filename = "import_data";
	public function __construct()
	{
		parent::__construct();
        $this->load->model('mdl_login');
        $this->load->model('mdl_pelamar');
        $this->load->model('mdl_karyawan');
		$this->load->model('mdl_admin');
		$this->load->model('mdl_home');
		$this->load->helper('url','form','file');
		$this->load->library('form_validation','image_lib');
	}

	public function index()
	{
		if($this->mdl_admin->logged_id())
		{
			$paket['array']=$this->mdl_karyawan->getaDiklat();
            $this->load->view('admin/Karyawan/Diklat/allDiklat',$paket);
		}else{ redirect("login"); }
	}

    public function diklatDetail($id)
    {
        $where=array('id_karyawan' => $id);
        $paket['array']=$this->mdl_admin->getData('diklat',$where);
        $this->load->view('admin/Karyawan/Diklat/detailDiklat',$paket);

    }

    public function addDiklat(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sertif','Nomor Sertifikat','trim|required');

            if($this->form_validation->run()==FALSE){

                $data['array']=$this->mdl_admin->getAlldata('jenis_golongan');
                $this->load->view('admin/Karyawan/Diklat/addDiklat',$data);
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
                $nama_diklat=$this->input->post('nama_diklat');
                $jenis_diklat=$this->input->post('jenis_diklat');
                $tahun=$this->input->post('tahun');
                $jam=$this->input->post('jam');
                $tgl_mulai=date('Y-m-d', strtotime($this->input->post('tgl_mulai')));
                $tgl_akhir=date('Y-m-d', strtotime($this->input->post('tgl_akhir')));
                $nomor_sertif=$this->input->post('nomor_sertif');

                $this->upload->do_upload('file');
                $file =$this->upload->data('file_name');
               
                $dataDiklat= array(
                    'id_karyawan' => $id_karyawan,
                    'nama_diklat' => $nama_diklat,
                    'jenis_diklat' => $jenis_diklat,
                    'tgl_mulai' => $tgl_mulai,
                    'tgl_akhir' => $tgl_akhir,
                    'jam' => $jam,
                    'tahun'=>$tahun,
                    'nomor_sertif' => $nomor_sertif,
                    'file ' => $file
                );

                $this->mdl_admin->addData('Diklat',$dataDiklat);

                redirect("adminDiklat");
                }
        }
        else{ redirect("login"); } 
    }

    public function editDiklat($id){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sertif','Nomor Sertifikat','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_karyawan->detDiklat($id);
                $this->load->view('admin/Karyawan/Diklat/editDiklat',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx|png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $a=$this->input->post('nik');
                $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$a' "));
                $id_karyawan=$data2['id_karyawan'];
                $nama_diklat=$this->input->post('nama_diklat');
                $jenis_diklat=$this->input->post('jenis_diklat');
                $tahun=$this->input->post('tahun');
                $jam=$this->input->post('jam');
                $tgl_mulai=date('Y-m-d', strtotime($this->input->post('tgl_mulai')));
                $tgl_akhir=date('Y-m-d', strtotime($this->input->post('tgl_akhir')));
                $nomor_sertif=$this->input->post('nomor_sertif');

                if ($this->upload->do_upload('file')) {
                    $file = $this->upload->data('file_name');
                }else {
                    $file = $this->input->post('file_old');
                }

                $dataDiklat= array(
                    'id_karyawan' => $id_karyawan,
                    'nama_diklat' => $nama_diklat,
                    'jenis_diklat' => $jenis_diklat,
                    'tgl_mulai' => $tgl_mulai,
                    'tgl_akhir' => $tgl_akhir,
                    'jam' => $jam,
                    'tahun'=>$tahun,
                    'nomor_sertif' => $nomor_sertif,
                    'file ' => $file
                );

                $where = array('id_diklat' => $id);
                $this->mdl_admin->updateData($where,$dataDiklat,'diklat');
                redirect("adminDiklat");
            }
        }else{ redirect("login"); } 
    }

    public function delDiklat($id){
        if($this->mdl_admin->logged_id()){
            $this->mdl_pelamar->hapusdata('diklat',$id);
            redirect("adminDiklat");
        }else{ redirect("login"); } 
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */