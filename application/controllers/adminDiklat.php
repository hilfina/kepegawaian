<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDiklat extends CI_Controller {
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
			$paket['array']=$this->mdl_admin->getDiklat();
            $this->load->view('admin/Karyawan/allDiklat',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

    public function diklatDetail($id)
    {
        $where=array('id_karyawan' => $id);
        $paket['array']=$this->mdl_admin->getData('diklat',$where);
        $this->load->view('admin/Karyawan/detailDiklat',$paket);

    }

    public function addDiklat($id, $idk){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nama_diklat','Nama Diklat','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getAlldata('diklat');
                $this->load->view('admin/Karyawan/addDiklat',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'jpg|pdf|docx|png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                $tgl_mulai = $this->input->post('tgl_mulai');
                $tgl_akhir = $this->input->post('tgl_akhir');
                $nomor_sertif = $this->input->post('nomor_sertif');
                $nama_diklat = $this->input->post('nama_diklat');
                $jenis_diklat = $this->input->post('jenis_diklat');
                $jam = $this->input->post('jam');
                $tahun = $this->input->post('tahun');
                $this->upload->do_upload('file');
                $file = $this->upload->data('file_name');
                $data = array(
                        'id_karyawan' => $id,
                        'nomor_sertif'=>$nomor_sertif,
                        'nama_diklat'=>$nama_diklat,
                        'jenis_diklat'=>$jenis_diklat,
                        'tgl_mulai'=>$tgl_mulai,
                        'tgl_akhir'=>$tgl_akhir, 
                        'jam'=>$jam, 
                        'tahun'=>$tahun,
                        'file'=>$file,
                    );

                $insert = $this->mdl_pelamar->tambahdata('diklat',$data);
                $this->session->set_flashdata('msg','Data Sukses di tambahkan');
                redirect(site_url('AdminDiklat/diklatDetail/$idk'));
                }
        }
        else{ redirect("login"); } 
    }

    public function edit($id, $idk){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nama_diklat','Nama Diklat','trim|required');

            if($this->form_validation->run()==FALSE){
                $where=array('id_diklat' => $id);
                $paket['array']=$this->mdl_admin->getData('diklat',$where);
                $this->load->view('admin/Karyawan/editDIklat',$paket);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx|png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                
                if($_FILES['file']['name'] != '') {
                    $this->upload->do_upload('file');
                    $file = $this->upload->data('file_name');
                } else {
                    $file = $this->input->post('file_old');
                }
                $tgl_mulai = $this->input->post('tgl_mulai');
                $tgl_akhir = $this->input->post('tgl_akhir');
                $nomor_sertif = $this->input->post('nomor_sertif');
                $nama_diklat = $this->input->post('nama_diklat');
                $jenis_diklat = $this->input->post('jenis_diklat');
                $jam = $this->input->post('jam');
                $tahun = $this->input->post('tahun');

                $data = array(
                    'nomor_sertif'=>$nomor_sertif,
                    'nama_diklat'=>$nama_diklat,
                    'jenis_diklat'=>$jenis_diklat,
                    'tgl_mulai'=>$tgl_mulai,
                    'tgl_akhir'=>$tgl_akhir, 
                    'jam'=>$jam, 
                    'tahun'=>$tahun,
                    'file'=>$file,
                );

                $where = array('id' => $id);
                $this->mdl_admin->updateData($where,$data,'diklat');
                redirect(site_url('AdminDiklat/diklatDetail/$idk'));
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id, $idk){
        $where = array('id_diklat' => $id);
        $this->mdl_pelamar->hapusdata('diklat',$where);
        redirect("adminDiklat/diklatDetail/$idk");
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */