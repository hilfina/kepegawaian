<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminStatus extends CI_Controller {
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
        $this->load->helper('download');
	}

	public function index()
	{
		if($this->mdl_admin->logged_id())
		{
            
			$paket['array']=$this->mdl_admin->getKaryawan();
            $this->load->view('admin/Karyawan/riwayat/status/allStatus',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

    public function detailStatus($id)
    {
        $paket['idkk']=$id;
        $paket['array']=$this->mdl_admin->getAllStatus($id);
        $this->load->view('admin/Karyawan/riwayat/status/detailStatus',$paket);

    }

    public function add(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sk','Nomor Surat Keputusan','trim|required');

            if($this->form_validation->run()==FALSE){

                $data['array']=$this->mdl_admin->getJenStatus();
                $this->load->view('admin/Karyawan/riwayat/status/addStatus',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);
                
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $a=$this->input->post('nik');
                $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$a' "));

                $id_karyawan=$data2['id_karyawan'];
                $id_status=$this->input->post('id_status');
                $mulai = date('Y-m-d',strtotime($this->input->post('mulai')));
                $akhir = date('Y-m-d',strtotime($this->input->post('akhir')));
                $nomor_sk=$this->input->post('nomor_sk');
                // $this->upload->do_upload('alamat_sk');

                if(!$this->upload->do_upload('alamat_sk')) {
                    $error = $this->upload->display_errors();

                    $this->session->set_flashdata('msg_error', $error);

                    redirect('adminstatus/addstatus');
                } else {
                    $alamat_sk = $this->upload->data('file_name');
                }
                    
                // $alamat_sk=$this->upload->data('file_name');
               
                $dataStatus= array(
                'id_karyawan' => $id_karyawan,
                'id_status' => $id_status,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'alamat_sk' => $alamat_sk,
                'nomor_sk' => $nomor_sk,
                'aktif' => 1
                );

                
                $updateStatus= array('akhir' => $mulai, 'aktif' => 0);
                $whereS = array('id_karyawan' => $id_karyawan, 'aktif' => 1);
                $this->mdl_admin->updateData($whereS,$updateStatus,'Status');
                
                $dataKaryawan= array('id_status' => $id_status);
                $where = array('id_karyawan' => $id_karyawan);

                $this->mdl_admin->addData('status',$dataStatus);
                $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');

                redirect("adminStatus");
                }
        }
        else{ redirect("login"); } 
    }

    public function addStatus($id){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sk','Nomor Surat Keputusan','trim|required');

            if($this->form_validation->run()==FALSE){
                $where=array('id_karyawan' => $id);
                $data['array']=$this->mdl_admin->getJenStatus();
                $data['array2']=$this->mdl_admin->getData('status', $where);
                $this->load->view('admin/Karyawan/riwayat/status/addStatus2',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);

                $id_karyawan=$id;
                $id_status=$this->input->post('id_status');
                $mulai = date('Y-m-d',strtotime($this->input->post('mulai')));
                $akhir = date('Y-m-d',strtotime($this->input->post('akhir')));
                $nomor_sk=$this->input->post('nomor_sk');
                // $this->upload->do_upload('alamat_sk');

                if(!$this->upload->do_upload('alamat_sk')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect("adminStatus/addStatus/$id");
                } else {
                    $alamat_sk = $this->upload->data('file_name');
                }
                    
                // $alamat_sk=$this->upload->data('file_name');
               
                $dataStatus= array(
                'id_karyawan' => $id_karyawan,
                'id_status' => $id_status,
                'mulai' => $mulai,
                'akhir' => $akhir,
                'alamat_sk' => $alamat_sk,
                'nomor_sk' => $nomor_sk,
                'aktif' => 1
                );

                
                $updateStatus= array('akhir' => $mulai, 'aktif' => 0);
                $whereS = array('id_karyawan' => $id_karyawan, 'aktif' => 1);
                $this->mdl_admin->updateData($whereS,$updateStatus,'Status');
                
                $dataKaryawan= array('id_status' => $id_status);
                $where = array('id_karyawan' => $id_karyawan);

                $this->mdl_admin->addData('status',$dataStatus);
                $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');

                redirect("adminStatus/detailStatus/$id");
                }
        }
        else{ redirect("login"); } 
    }

    public function edit($id, $idk){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sk','Nomor Surat Keputusan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getStatus($id);
                $data['array2']=$this->mdl_admin->getJenStatus();
                $this->load->view('admin/Karyawan/riwayat/status/editStatus',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;


                $this->load->library('upload', $config);
                
                $id_status=$this->input->post('id_status');
                $mulai = date('Y-m-d',strtotime($this->input->post('mulai')));
                $akhir = date('Y-m-d',strtotime($this->input->post('akhir')));
                $nomor_sk=$this->input->post('nomor_sk');
                if($_FILES['alamat_sk']['name'] != '') {
                    if(!$this->upload->do_upload('alamat_sk')) {
                        $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                        $this->session->set_flashdata('msg_error', $error);

                        redirect('adminStatus/edit/$id/$idk');
                    } else {
                        $alamat_sk = $this->upload->data('file_name');
                    }
                } else {
                    $alamat_sk = $this->input->post('file_old');
                }

                $dataStatus= array(
                'mulai' => $mulai,
                'akhir' => $akhir,
                'alamat_sk' => $alamat_sk,
                'nomor_sk' => $nomor_sk,
                );

                $where = array('id' => $id);
                $this->mdl_admin->updateData($where,$dataStatus,'status');
                redirect("adminStatus/detailStatus/$idk");
                }
        }

        else{ redirect("login"); } 
    }
    public function del($id, $idk){
        if($this->mdl_admin->logged_id()){
            $where = array('id'=>$id); 
            $this->mdl_pelamar->hapusdata('status',$where);
            redirect("adminStatus/detailStatus/$idk");
        }else{ redirect("login"); } 
    }

    public function laporan($id){
        $this->load->library('Mypdf');
        $where = array('id_karyawan'=>$id);
        $this->db->select('karyawan.nik, karyawan.nama, karyawan.id_status, jenis_profesi.nama_profesi, jabatan.jabatan, karyawan.id_karyawan');
        $this->db->from('karyawan');
        $this->db->join('jenis_profesi', 'karyawan.id_profesi = jenis_profesi.id_profesi');
        $this->db->join('jabatan', 'karyawan.jabatan = jabatan.id');
        $this->db->where('id_karyawan', $id);
        $data['array'] = $this->db->get()->result();
        $data['data']=$this->mdl_admin->getAllStatus($id);
        $data['datDir']=$this->mdl_admin->getTempat($id);
        $this->mypdf->generate('Laporan/status', $data, 'laporan-riwayat-status', 'A4', 'portrait');
    }

    public function loadimpor(){
        if($this->mdl_admin->logged_id()){
        $this->load->view('admin/Karyawan/Riwayat/Status/impor');
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
                    $id_status= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $mulai = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $akhir = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $alamat_sk= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $nomor_sk= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $tgl_mulai = substr($mulai, 0,4)."-".substr($mulai, 5,2)."-".substr($mulai, 8,4);
                    $tgl_akhir = substr($akhir, 0,4)."-".substr($akhir, 5,2)."-".substr($akhir, 8,4);
                    $data[] = array(
                        'id_karyawan'       =>    $id,
                        'id_status'        =>    $id_status,
                        'nomor_sk'        =>    $nomor_sk,
                        'mulai'             =>    $tgl_mulai,
                        'akhir'             =>    $tgl_akhir,
                        'alamat_sk'      =>    $alamat_sk,
                    );
                }
            }

            $this->mdl_admin->impor('status',$data);
            redirect('Adminstatus');
        }        
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */