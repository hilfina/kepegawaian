<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminSekolah extends CI_Controller {
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
			$paket['array']=$this->mdl_admin->getSekolah();
            $this->load->view('admin/Karyawan/allSekolah',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

    public function addSekolah(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('no_mou','Nomor Surat MOU','trim|required');

            if($this->form_validation->run()==FALSE){
                $this->load->view('admin/Karyawan/addSekolah');
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
                $beasiswa=$this->input->post('beasiswa');
                $ket=$this->input->post('ket');
                $tgl_mulai=$this->input->post('tgl_mulai');
                $tgl_akhir=$this->input->post('tgl_akhir');
                $no_mou=$this->input->post('no_mou');
                $this->upload->do_upload('file');
                $file=$this->upload->data('file_name');
               
                $data= array(
                'id_karyawan' => $id_karyawan,
                'beasiswa' => $beasiswa,
                'tgl_mulai' => $tgl_mulai,
                'tgl_akhir' => $tgl_akhir,
                'ket' => $ket,
                'file' => $file,
                'no_mou' => $no_mou,
                'aktif' => 1
                );

                $this->mdl_admin->addData('mou_sekolah',$data);

                redirect("AdminSekolah");
                }
        }
        else{ redirect("login"); } 
    }

    public function edit($id){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('no_mou','Nomor Surat Keputusan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getSekolahedit($id);
                $this->load->view('admin/Karyawan/editSekolah',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx|png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                
                $beasiswa=$this->input->post('beasiswa');
                $ket=$this->input->post('ket');
                $tgl_mulai=$this->input->post('tgl_mulai');
                $tgl_akhir=$this->input->post('tgl_akhir');
                $no_mou=$this->input->post('no_mou');
                if($_FILES['file']['name'] != '') {
                    $this->upload->do_upload('file');
                    $file = $this->upload->data('file_name');
                } else {
                    $file = $this->input->post('file_old');
                }
                // $s = $tgl_akhir;
                // $date = strtotime($s);
                // $exp = date('d/m/Y', strtotime('+1 day', $date));

                $data= array(
                'beasiswa' => $beasiswa,
                'tgl_mulai' => $tgl_mulai,
                'tgl_akhir' => $tgl_akhir,
                'ket' => $ket,
                'file' => $file,
                'no_mou' => $no_mou,
                'aktif' => 1
                );

                $where = array('id' => $id);
                $this->mdl_admin->updateData($where,$data,'mou_sekolah');
                redirect("AdminSekolah");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
        $this->mdl_pelamar->hapusdata('mou_sekolah',$id);
        redirect("AdminSekolah");
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */