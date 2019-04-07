<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminKaryawan extends CI_Controller {
	private $filename = "import_data";
	public function __construct()
	{
		parent::__construct();
        $this->load->model('mdl_login');
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
            $this->load->view('admin/Karyawan/allKaryawan',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

    public function karyawanDetail($id){
        if($this->mdl_admin->logged_id())
        {
            $where = array( 'id_karyawan' => $id ); 
            $paket['array']=$this->mdl_admin->getProfesi();
            $paket['datSta']=$this->mdl_admin->getAlldata('jenis_status');
            $paket['datGol']=$this->mdl_admin->getAlldata('jenis_golongan');
            $paket['datDir']=$this->mdl_admin->getTempat($id);
            $paket['datPen']=$this->mdl_admin->getData('pendidikan',$where);
            $paket['datSur']=$this->mdl_admin->cariJenisSurat($id);
            $this->load->view('admin/Karyawan/detailKaryawan',$paket);
        }

        else{ redirect("login"); } 
        
    }
    public function editData($id){
         if($this->mdl_admin->logged_id())
        {
            $nik=$this->input->post('nik');
            $no_ktp=$this->input->post('no_ktp');
            $no_bpjs=$this->input->post('no_bpjs');
            $nama=$this->input->post('nama');
            $alamat=$this->input->post('alamat');
            $no_telp=$this->input->post('no_telp');
            $email=$this->input->post('email');
            $id_status=$this->input->post('id_status');
            $id_profesi=$this->input->post('id_profesi');
            $id_golongan=$this->input->post('id_golongan');
            $ruangan=$this->input->post('ruangan');

            $where = array('id_karyawan' => $id);

            $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select * from riwayat where id_karyawan =$id order by mulai limit 1"));

            $tdy=date('y-m-d');
            $dataRiwayat = array(
                'id_karyawan' => $id,
                'ruangan' => $ruangan,
                'id_profesi' => $id_profesi,
                'mulai' => $tdy
                );

             $dataKaryawan = array(
                'nik' => $nik,
                'no_ktp' => $no_ktp,
                'no_bpjs' => $no_bpjs,
                'nama' => $nama,
                'alamat' => $alamat,
                'no_telp' => $no_telp,
                'email' => $email,
                'id_status' => $id_status,
                'id_profesi' => $id_profesi,
                'id_golongan' => $id_golongan
                );

            if ($data['ruangan'] == '-') {
                $this->mdl_admin->updateData($where,$dataRiwayat,'riwayat');
                $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');
            redirect("adminKaryawan/karyawanDetail/$id");
            }else if ( $ruangan == $data['ruangan']) {
                $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');
            redirect("adminKaryawan/karyawanDetail/$id");
            }else{
                $this->mdl_admin->addData('riwayat',$dataRiwayat);
                $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');
            redirect("adminKaryawan/karyawanDetail/$id");
            }
            //
            
            
        }

        else{ redirect("login"); } 
    }
        public function addKaryawan(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('id_profesi','Jenis Profesi Lowongan','trim|required');

            if($this->form_validation->run()==FALSE){

                $data['array']=$this->mdl_admin->getProfesi();
                $this->load->view('admin/Karyawan/addKaryawan',$data);
            }else{
                $id_profesi=$this->input->post('id_profesi');
                $kuota=$this->input->post('kuota');
                $mulai=$this->input->post('mulai');
                $akhir=$this->input->post('akhir');
                $ipkmin=$this->input->post('ipkmin');
                $usia=$this->input->post('usia');
                $jenkel=$this->input->post('jenkel');
                $jurusan=$this->input->post('jurusan');

                $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select id_profesi from jenis_profesi where nama_profesi ='$id_profesi'"));
                $dataKaryawan= array(
                'id_profesi' => $data['id_profesi'],
                'kuota' => $kuota,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'ipkmin' => $ipkmin,
                'usia' => $usia,
                'jenkel' => $jenkel,
                'jurusan' => $jurusan
                );

                $this->mdl_admin->addData('Karyawan',$dataKaryawan);
                
                redirect("adminKaryawan");
                }
        }
        
        else{ redirect("login"); } 
    }

    public function edit($id){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('id_profesi','Jenis Profesi Lowongan','trim|required');

            if($this->form_validation->run()==FALSE){
                $where = array( 'id_Karyawan' => $id ); 
                $data['datal']=$this->mdl_admin->getData('Karyawan',$where);
                $data['array']=$this->mdl_admin->getProfesi();
                $this->load->view('admin/Karyawan/editKaryawan',$data);
            }else{
                $id_profesi=$this->input->post('id_profesi');
                $kuota=$this->input->post('kuota');
                $mulai=$this->input->post('mulai');
                $akhir=$this->input->post('akhir');
                $ipkmin=$this->input->post('ipkmin');
                $usia=$this->input->post('usia');
                $jenkel=$this->input->post('jenkel');
                $jurusan=$this->input->post('jurusan');

                $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select id_profesi from jenis_profesi where nama_profesi ='$id_profesi'"));
                $dataKaryawan= array(
                'id_profesi' => $data['id_profesi'],
                'kuota' => $kuota,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'ipkmin' => $ipkmin,
                'usia' => $usia,
                'jenkel' => $jenkel,
                'jurusan' => $jurusan
                );
                $where = array( 'id_Karyawan' => $id ); 
               $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');
                
                redirect("adminKaryawan");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
       if($this->mdl_admin->logged_id()){
            $this->mdl_admin->delKaryawan($id);
            redirect("adminKaryawan");
        }
        
        else{ redirect("login"); } 
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */