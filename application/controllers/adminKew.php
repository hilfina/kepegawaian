<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminKew extends CI_Controller {
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
			$paket['array']=$this->mdl_admin->getKew();
            $this->load->view('admin/Karyawan/Kredensial/allKew',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

    public function addKew(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nik','Nomor Induk Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $this->load->view('admin/Karyawan/Kredensial/add');
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|docx';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);
                
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $a=$this->input->post('nik');
                $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$a' "));

                $id_karyawan=$data2['id_karyawan'];
               
                $tgl_pengajuan=date('Y-m-d',strtotime($this->input->post('tgl_pengajuan')));
                if(!$this->upload->do_upload('doku_pengajuan')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect("adminKew/addKew");
                } else {
                    $doku_pengajuan = $this->upload->data('file_name');
                }

               
                $data= array(
                'id_karyawan' => $id_karyawan,
                'tgl_pengajuan' => $tgl_pengajuan,
                'doku_pengajuan' => $doku_pengajuan,
                'penilaian' => '-',
                'tgl_mulai' => date('Y-m-d'),
                'tgl_akhir' => date('Y-m-d'),
                'doku_penilaian' => '-',
                
                );

                $this->mdl_admin->addData('kewenangan_klinis',$data);
                redirect("adminKew");
                }
        }
        else{ redirect("login"); } 
    }

    public function edit($id){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('penilaian','penilaian','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getKewedit($id);
                $this->load->view('admin/Karyawan/Kredensial/edit',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|docx';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);

                if(!$this->upload->do_upload('doku_penilaian')) {
                    $doku_penilaian = $this->input->post('file_old');
                } else {
                    $doku_penilaian = $this->upload->data('file_name');
                }

                $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
                $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
                $pk=$this->input->post('pk');
                $penilaian=$this->input->post('penilaian');
               
                $data= array(
                'penilaian' => $penilaian,
                'tgl_mulai' => $tgl_mulai,
                'tgl_akhir' => $tgl_akhir,
                'doku_penilaian' => $doku_penilaian,
                'pk' => $pk,
                );

                $where = array('id_kewenangan' => $id);
                $this->mdl_admin->updateData($where,$data,'kewenangan_klinis');
                redirect("AdminKew");
            }
        }

        else{ redirect("login"); } 
    }
    public function del($id){
        $where = array('id_kewenangan' => $id);
        $this->mdl_pelamar->hapusdata('kewenangan_klinis',$where);
        redirect("adminKew");
    }

    public function loadimpor(){
        if($this->mdl_admin->logged_id()){
        $this->load->view('admin/Karyawan/Kredensial/impor');
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
                    $tgl_pengajuan= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $doku_pengajuan= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $penilaian = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $mulai = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $akhir= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $pk = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $doku_penilaian= $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $tgl_mulai = substr($mulai, 0,4)."-".substr($mulai, 5,2)."-".substr($mulai, 8,4);
                    $tgl_akhir = substr($akhir, 0,4)."-".substr($akhir, 5,2)."-".substr($akhir, 8,4);
                    $data[] = array(
                        'id_karyawan'       =>    $id,
                        'tgl_pengajuan'        =>    $tgl_pengajuan,
                        'doku_pengajuan'           =>    $doku_pengajuan,
                        'penilaian'             =>    $penilaian,
                        'tgl_mulai'             =>    $tgl_mulai,
                        'tgl_akhir'      =>    $tgl_akhir,
                        'pk' => $pk,
                        'doku_penilaian'              =>    $doku_penilaian,
                    );
                }
            }

            $this->mdl_admin->impor('kewenangan_klinis',$data);
            redirect('AdminKew');
        }        
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */