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
			$paket['array']=$this->mdl_admin->getBerkala();
            $this->load->view('admin/Karyawan/riwayat/berkala/allBerkala',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

    public function addBerkala(){
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
                $mulai=$this->input->post('mulai');
                $akhir=$this->input->post('akhir');
                $nomor_sk=$this->input->post('nomor_sk');
                $this->upload->do_upload('alamat_sk');
                $alamat_sk=$this->upload->data('file_name');
               
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

    public function edit($id){
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

                $databerkala= array(
                'berkala' => $berkala,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'alamat_sk' => $alamat_sk,
                'nomor_sk' => $nomor_sk,
                );

                $where = array('id' => $id);
                $this->mdl_admin->updateData($where,$databerkala,'berkala');
                redirect("AdminBerkala");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
        $this->mdl_pelamar->hapusdata('berkala',$id);
        redirect("AdminBerkala");
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */