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
            $this->load->view('admin/Karyawan/mou/Sekolah/allSekolah',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}

    public function addSekolah(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('no_mou','Nomor Surat MOU','trim|required');

            if($this->form_validation->run()==FALSE){
                $this->load->view('admin/Karyawan/mou/Sekolah/addSekolah');
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
                $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
                $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
                $no_mou=$this->input->post('no_mou');
                if(!$this->upload->do_upload('file')) {
                    $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect('AdminSekolah/addSekolah');
                } else {
                    $file = $this->upload->data('file_name');
                }

               
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
                $this->load->view('admin/Karyawan/mou/Sekolah/editSekolah',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf|jpg|docx|png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                
                $beasiswa=$this->input->post('beasiswa');
                $ket=$this->input->post('ket');
                $tgl_mulai = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
                $tgl_akhir = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));
                $no_mou=$this->input->post('no_mou');
                if($_FILES['file']['name'] != '') {
                    if(!$this->upload->do_upload('file')) {
                        $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");
                        $this->session->set_flashdata('msg_error', $error);

                        redirect("AdminSekolah/edit/$id");
                    } else {
                        $file = $this->upload->data('file_name');
                    }
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
        $where = array('id' => $id);
        $this->mdl_pelamar->hapusdata('mou_sekolah',$where);
        redirect("AdminSekolah");
    }

    public function loadimpor(){
        if($this->mdl_admin->logged_id()){
        $this->load->view('admin/Karyawan/MOU/Sekolah/impor');
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
                    $no_mou= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $tgl_mulai = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $tgl_akhir = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $beasiswa= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $ket= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $file= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $data[] = array(
                        'id_karyawan'       =>    $id,
                        'no_mou'        =>    $no_mou,
                        'tgl_mulai'             =>    $tgl_mulai,
                        'tgl_akhir'             =>    $tgl_akhir,
                        'beasiswa'      =>    $beasiswa,
                        'ket'             =>    $ket,
                        'file'              =>    $file,
                    );
                }
            }

            $this->mdl_admin->impor('mou_sekolah',$data);
            redirect('AdminSekolah');
        }        
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */