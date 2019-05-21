<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDiklat extends CI_Controller {
    
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

    public function detailDiklat($id)
    {
        $where=array('id_karyawan' => $id);
        $paket['array']=$this->mdl_admin->getData('diklat',$where);
        $this->load->view('admin/Karyawan/Diklat/detailDiklat',$paket);

    }

        public function add(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sertif','Nomor Sertifikat','trim|required');

            if($this->form_validation->run()==FALSE){
                $this->load->view('admin/Karyawan/Diklat/add');
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $a=$this->input->post('nik');
                $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$a' "));

                $id_karyawan=$data2['id_karyawan'];
                $nama_diklat=$this->input->post('nama_diklat');
                $jenis_diklat=$this->input->post('jenis_diklat');
                $tahun=$this->input->post('tahun');
                $jam=$this->input->post('jam');
                $wjam = abs(substr($jam, 0,2)) * 60; //waktu jam x 60
                $tjam = 0; //total jam
                while($wjam >= 50) { // jika waktu jam >= 50
                    $wjam-=50; // wktu jam - 50
                    $tjam++; //total jam +1
                }
                $wmnt = abs(substr($jam, 3,2)) + $wjam;
                while($wmnt >= 50) { // jika waktu menit >= 50
                    $wmnt-=50; // wktu menit - 50
                    $tjam++; //total jam +1
                }
                $wdtk = substr($jam, 6,2);
                $waktu = $tjam.":".$wmnt.":".$wdtk;
                $tgl_mulai=date('Y-m-d', strtotime($this->input->post('tgl_mulai')));
                $tgl_akhir=date('Y-m-d', strtotime($this->input->post('tgl_akhir')));
                $nomor_sertif=$this->input->post('nomor_sertif');

                if(!$this->upload->do_upload('file')) {
                    $error = ("<b>Error!</b> file harus diisi dengan format pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect("adminDiklat/add");
                } else {
                    $file = $this->upload->data('file_name');
                }

               
                $dataDiklat= array(
                    'id_karyawan' => $id_karyawan,
                    'nama_diklat' => $nama_diklat,
                    'jenis_diklat' => $jenis_diklat,
                    'tgl_mulai' => $tgl_mulai,
                    'tgl_akhir' => $tgl_akhir,
                    'jam' => $waktu,
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

    public function addDiklat($id){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sertif','Nomor Sertifikat','trim|required');

            if($this->form_validation->run()==FALSE){
                $where=array('id_karyawan' => $id);
                $data['array']=$this->mdl_admin->getData('diklat', $where);
                $this->load->view('admin/Karyawan/Diklat/addDiklat',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);

                $id_karyawan=$id;
                $nama_diklat=$this->input->post('nama_diklat');
                $jenis_diklat=$this->input->post('jenis_diklat');
                $tahun=$this->input->post('tahun');
                $jam=$this->input->post('jam');
                $tgl_mulai=date('Y-m-d', strtotime($this->input->post('tgl_mulai')));
                $tgl_akhir=date('Y-m-d', strtotime($this->input->post('tgl_akhir')));
                $nomor_sertif=$this->input->post('nomor_sertif');

                if(!$this->upload->do_upload('file')) {
                    $error = ("<b>Error!</b> file harus diisi dengan format pdf dan berukuran lebih dari 2 mb");

                    $this->session->set_flashdata('msg_error', $error);

                    redirect("adminDiklat/addDiklat/$id");
                } else {
                    $file = $this->upload->data('file_name');
                }

               $wjam = abs(substr($jam, 0,2)) * 60; //waktu jam x 60
                $tjam = 0; //total jam
                while($wjam >= 50) { // jika waktu jam >= 50
                    $wjam-=50; // wktu jam - 50
                    $tjam++; //total jam +1
                }
                $wmnt = abs(substr($jam, 3,2)) + $wjam;
                while($wmnt >= 50) { // jika waktu menit >= 50
                    $wmnt-=50; // wktu menit - 50
                    $tjam++; //total jam +1
                }
                $wdtk = substr($jam, 6,2);
                $waktu = $tjam.":".$wmnt.":".$wdtk;
                $dataDiklat= array(
                    'id_karyawan' => $id_karyawan,
                    'nama_diklat' => $nama_diklat,
                    'jenis_diklat' => $jenis_diklat,
                    'tgl_mulai' => $tgl_mulai,
                    'tgl_akhir' => $tgl_akhir,
                    'jam' => $waktu,
                    'tahun'=>$tahun,
                    'nomor_sertif' => $nomor_sertif,
                    'file ' => $file
                );

                $this->mdl_admin->addData('Diklat',$dataDiklat);

                redirect("adminDiklat/detailDiklat/$id");
                }
        }
        else{ redirect("login"); } 
    }

    public function editDiklat($id, $idk){
         if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nomor_sertif','Nomor Sertifikat','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_karyawan->detDiklat($id);
                $this->load->view('admin/Karyawan/Diklat/editDiklat',$data);
            }else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'pdf';
                $config['max_size']         = 2000;

                $this->load->library('upload', $config);

                $nama_diklat=$this->input->post('nama_diklat');
                $jenis_diklat=$this->input->post('jenis_diklat');
                $tahun=$this->input->post('tahun');
                $jam=$this->input->post('jam');
                $tgl_mulai=date('Y-m-d', strtotime($this->input->post('tgl_mulai')));
                $tgl_akhir=date('Y-m-d', strtotime($this->input->post('tgl_akhir')));
                $nomor_sertif=$this->input->post('nomor_sertif');

                if($_FILES['file']['name'] != '') {
                    if(!$this->upload->do_upload('file')) {
                        $error = ("<b>Error!</b> file harus berbentuk pdf dan berukuran lebih dari 2 mb");

                        $this->session->set_flashdata('msg_error', $error);

                        redirect("adminDiklat/editDiklat/$id/$idk");
                    } else {
                        $file = $this->upload->data('file_name');
                    }
                } else {
                    $file = $this->input->post('file_old');
                }


                $dataDiklat= array(
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
                redirect("adminDiklat/detailDiklat/$idk");
            }
        }else{ redirect("login"); } 
    }

    public function delDiklat($id, $idk){
        if($this->mdl_admin->logged_id()){
            $this->mdl_pelamar->hapusdata('diklat',$id);
            redirect("adminDiklat/detailDiklat/$idk");
        }else{ redirect("login"); } 
    }

    public function loadimpor(){
        if($this->mdl_admin->logged_id()){
        $this->load->view('admin/karyawan/Diklat/impor');
        }else{ redirect("login"); }
    }

    public function impor(){
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
                        $nama_diklat= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $jenis_diklat= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $tgl_mulai = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $tgl_akhir = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $tahun= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $jam= $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $nomor_sertif= $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $file= $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                        $data[] = array(
                            'id_karyawan'       =>    $id,
                            'nama_diklat'        =>    $nama_diklat,
                            'jenis_diklat'           =>    $jenis_diklat,
                            'tgl_mulai'             =>    strtotime($tgl_mulai),
                            'tgl_akhir'             =>    strtotime($tgl_akhir),
                            'tahun'      =>    $tahun,
                            'jam'             =>    time($jam),
                            'nomor_sertif'              =>    $nomor_sertif,
                            'file'              =>    $file,
                        );
                    }
                }

                $this->mdl_admin->impor('diklat',$data);
                redirect('AdminDiklat');
            }
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */