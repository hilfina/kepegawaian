<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminKaryawan extends CI_Controller {
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
        $this->load->library('email');
	}
    //MENAMPILKAN DATA TABEL BERISI DATA KARYAWAN
	public function index(){
		if($this->mdl_admin->logged_id()){            
			$paket['array']=$this->mdl_admin->getKaryawan();
            $this->load->view('admin/Karyawan/allKaryawan',$paket);
		}else{redirect("login");}
	}
    //MENAMPILKAN FORM TAMBAH KARYAWAN DAN PROSES PENYIMPANANNYA
    public function addKaryawan(){
        if($this->mdl_admin->logged_id()){
            $this->form_validation->set_rules('nik','Nomor Induk Karyawan','trim|required');
            $this->form_validation->set_rules('nama','Nama Karyawan','trim|required');
            $this->form_validation->set_rules('no_ktp','Nomor KTP','trim|required');
            $this->form_validation->set_rules('no_telp','Nomor Telepon','trim|required');
            $this->form_validation->set_rules('email','Alamat Email','trim|required');
            $this->form_validation->set_rules('alamat','Alamat','trim|required');
            if($this->form_validation->run()==FALSE){

                $data['status']=$this->mdl_admin->getJenStatus();
                $data['profesi']=$this->mdl_admin->getProfesi();
                $data['golongan']=$this->mdl_admin->getGolongan();
                $this->load->view('admin/Karyawan/addKaryawan',$data);
            }else{

                $id_profesi=$this->input->post('id_profesi');
                $id_golongan=$this->input->post('id_golongan');
                $id_status=$this->input->post('id_status');
                $nik=$this->input->post('nik');
                $nama=$this->input->post('nama');
                $no_ktp=$this->input->post('no_ktp');
                $no_telp=$this->input->post('no_telp');
                $email=$this->input->post('email');
                $alamat=$this->input->post('alamat');   
                $tgl = date('d/m/Y');
                $cip=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select id_profesi from jenis_profesi where nama_profesi ='$id_profesi'"));
                $dataKaryawan= array(
                'id_profesi' => $cip['id_profesi'],
                'id_status' => $id_status,
                'id_golongan' => $id_golongan,
                'nik' => $nik,
                'nama' => $nama,
                'no_ktp' => $no_ktp,
                'no_telp' => $no_telp,
                'email' => $email,
                'foto' => 'profile.png',
                'alamat' => $alamat
                );

                $this->mdl_admin->addData('karyawan',$dataKaryawan);
                 $cariId=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select * from karyawan where no_ktp = '$no_ktp'"));
                $dataLogin=array('username'=>$email, 'password'=>md5($no_ktp), 'level'=>'Karyawan', 'aktif'=>1, 'id_karyawan'=>$cariId['id_karyawan']);
                $dataRiwayat=array('id_karyawan'=>$cariId['id_karyawan'], 'id_profesi'=>$cip['id_profesi'], 'mulai' => $tgl);
                $dataStatus=array('id_karyawan'=>$cariId['id_karyawan'], 'id_status'=>$id_status, 'mulai' => $tgl);
                $dataGolongan=array('id_karyawan'=>$cariId['id_karyawan'], 'id_golongan'=>$id_golongan, 'mulai' => $tgl);
                
                $config = array();
                $config['charset'] = 'utf-8';
                $config['useragent'] = 'CodeIgniter';
                $config['protocol']= "smtp";
                $config['mailtype']= "html";
                $config['smtp_host']= "ssl://smtp.gmail.com";
                $config['smtp_port']= "465";
                $config['smtp_timeout']= "400";
                $config['smtp_user']= "hilfinaamaris09@gmail.com";
                $config['smtp_pass']= "hilfina090798";
                $config['crlf']="\r\n"; 
                $config['newline']="\r\n"; 
                $config['wordwrap'] = TRUE;
                $this->email->initialize($config);
                $encrypted_id = $cariId['id_karyawan'];
                $this->email->from($config['smtp_user']);
                $this->email->to($email);
                $this->email->subject("Verifikasi Akun");
                $this->email->message(
                    "terimakasih telah melakukan registrasi, untuk memverifikasi silahkan klik tombol dibawah ini<br><br>".
                    "<a href='".site_url("login/verification/$encrypted_id")."'><button>verifikasi</button</a>"
                );
                
                if($this->email->send())
                {
                    $this->mdl_admin->addData('login',$dataLogin);
                    $this->mdl_admin->addData('status',$dataStatus);
                    $this->mdl_admin->addData('golongan',$dataGolongan);
                    $this->mdl_admin->addData('riwayat',$dataRiwayat);
                }else{}
                redirect("adminKaryawan");
            }
        }else{ redirect("login"); } 
    }
    //LIHAT DETAIL KARYAWAN
    public function karyawanDetail($id){
        if($this->mdl_admin->logged_id()){
            $where = array( 'id_karyawan' => $id ); 
            $paket['array']=$this->mdl_admin->getProfesi();
            $paket['datSta']=$this->mdl_admin->getJenStatus();
            $paket['datGol']=$this->mdl_admin->getAlldata('jenis_golongan');
            $paket['datDir']=$this->mdl_admin->getTempat($id);
            $paket['datSta']=$this->mdl_admin->getJenStatus();
            $paket['datPen']=$this->mdl_admin->getData('pendidikan',$where);
            $paket['datSur']=$this->mdl_admin->cariJenisSurat($id);
            $this->load->view('admin/Karyawan/detailKaryawan',$paket);
        }else{ redirect("login"); } 
    }
    // SIMPAN DATA YANG DIUBAH DI DETAIL KARYAWAN
    public function editData($id){
        if($this->mdl_admin->logged_id()){

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

            $xxx =mysqli_connect("localhost","root","","kepegawaian");
            $idPro=mysqli_fetch_array(mysqli_query($xxx,"select * from jenis_profesi where nama_profesi = '$id_profesi'"));
            $riwayatm=mysqli_fetch_array(mysqli_query($xxx,"select * from riwayat where id_karyawan = $id order by mulai desc limit 1"));
            $statusm=mysqli_fetch_array(mysqli_query($xxx,"select * from status where id_karyawan = $id and aktif = 1 "));
            $golonganm=mysqli_fetch_array(mysqli_query($xxx,"select * from golongan where id_karyawan = $id and aktif = 1 "));
            $tdy=date('y-m-d');

            $tdy=date('Y-m-d');
            $dtPro = date('Y-m-d', strtotime($riwayatm['mulai']));
            $dtSta = date('Y-m-d', strtotime($statusm['mulai']));
            $dtGol = date('Y-m-d', strtotime($golonganm['mulai']));
           
            $dataProfesi = array('id_karyawan' => $id, 'ruangan' => $ruangan, 'id_profesi' => $idPro['id_profesi'], 'mulai' => $tdy );
            $addStatus = array('id_karyawan' => $id, 'id_status' => $id_status, 'mulai' => $tdy, 'aktif' => 1 );
            $editStatus = array('akhir' => $tdy, 'aktif' => 0 );
            $addGolongan = array('id_karyawan' => $id, 'id_golongan' => $id_golongan, 'mulai' => $tdy, 'aktif' => 1 );
            $editGolongan = array('akhir' => $tdy, 'aktif' => 0 );

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

             //jika profesi yg dipilih berubah atau ruangan penempatannya berubah
            if ($riwayatm['id_profesi'] != $idPro['id_profesi'] || $riwayatm['ruangan'] != $ruangan) {
                //jika tanggal di riwayat berbeda dengan hari waktu perubahab
                if ($dtPro != $tdy) {
                    // tambah data riwayat penempatan terbaru
                    // karena berarti karyawan tersebut ganti profesi atau ganti penempatan, maka harus dibuat riwayat baru
                    $this->mdl_admin->addData('riwayat',$dataProfesi);
                }else{ //jika tanggalnya tetap
                    //data riwayat yang sudah ada diupdate saja.
                    $this->mdl_admin->updateProf($ruangan,$idPro['id_profesi'],$riwayatm['id_riwayat']);
                }
            }else{}
            // jika id status yang dipilih berubah
            if ($statusm['id_status'] != $id_status) {
                // jika tanggal di riwayat status beda dg hari ini
                if ($dtSta != $tdy) {
                    $where1 = array('id' => $statusm['id']);
                    //untuk edit riwayat status jika data mau diganti 
                    // karena pada tanggal yang berbeda terdapat pergantian status pada karyawan
                    $this->mdl_admin->updateData($where1,$editStatus,'Status');
                    //tambah riwayat status baru.
                    $this->mdl_admin->addData('status',$addStatus);
                }else{// jika waktu merubah id status pada hari yang sama berulang
                    // isi dari riwayat tersbt hanya di edit id_statusnya saja
                    $this->mdl_admin->updateStat($id_status,$id);
                }
            }else{}
            // jika id golongan yang dipilih berubah
            if ($golonganm['id_golongan'] != $id_golongan) {
                // jika tanggal di riwayat golongan beda dg hari ini
                if ($dtGol != $tdy) {
                    $where1 = array('id' => $golonganm['id']);
                    //untuk edit riwayat golongan jika data mau diganti 
                    // karena pada tanggal yang berbeda terdapat pergantian golongan pada karyawan
                    $this->mdl_admin->updateData($where1,$editGolongan,'golongan');
                    //tambah riwayat golongan baru.
                    $this->mdl_admin->addData('golongan',$addGolongan);
                }else{// jika waktu merubah id golongan pada hari yang sama berulang
                    // isi dari riwayat tersbt hanya di edit id_golongannya saja
                    $this->mdl_admin->updateGol($id_golongan,$id);
                }
            }else{}
            // update data karyawan
            $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');
            redirect("adminKaryawan/karyawanDetail/$id");
        }else{ redirect("login");} 
    }
    // MENAMPILKAN FORM TAMBAH PENDIDIKAN MELALUI HALAMAN DETAIL
   public function addpend($id){
    if($this->mdl_admin->logged_id()){
        $this->load->helper('url','form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required' );

        if ($this->form_validation->run()==FALSE) {
            $idl['id']=$id;
            $this->load->view('admin/karyawan/pendidikan/addpendidikan',$idl);
        }
        else{
            $config['upload_path']      = './Assets/dokumen/';
            $config['allowed_types']    = 'jpg|png';
            $config['max_size']         = 2000;
            $config['max_width']        = 10240;
            $config['max_height']       = 7680;
            $this->load->library('upload', $config);
 
            $pendidikan = $this->input->post('pendidikan');
            $id_karyawan  = $this->input->post('id_karyawan');
            $jurusan  = $this->input->post('jurusan');
            $nilai = $this->input->post('nilai');
            $mulai = $this->input->post('mulai');
            $akhir = $this->input->post('akhir');
            $nomor_ijazah = $this->input->post('nomor_ijazah');
            
            $this->upload->do_upload('file');
            $a = $this->upload->data('file_name');
            $data3 = array(
                    'pendidikan'=>$pendidikan,
                    'jurusan' => $jurusan,
                    'nilai' => $nilai,
                    'mulai'=>$mulai,
                    'akhir'=>$akhir,
                    'nomor_ijazah'=>$nomor_ijazah,
                    'id_karyawan' => $id_karyawan,
                    'file'=>$a,
                    'verifikasi'=> 1,
                );
            $insert3 = $this->mdl_pelamar->tambahdata('pendidikan',$data3);

            $this->session->set_flashdata('msg','Data Sukses di tambahkan');
            redirect("adminKaryawan/karyawanDetail/$id_karyawan");
        }
        
        }
        else{ redirect("login"); }
        
    }

    public function editpend($id){
        if($this->mdl_admin->logged_id()){
            $this->load->helper('url','form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pendidikan', 'Nama Pendidikan', 'trim|required' );
            $this->load->model('mdl_pelamar');

            if ($this->form_validation->run()==FALSE) {
                $paket['array']=$this->mdl_pelamar->getDetailpend($id);
                $this->load->view('admin/Karyawan/pendidikan/editpendidikan', $paket);
            }
            else{
                $config['upload_path']      = './Assets/dokumen/';
                $config['allowed_types']    = 'jpg|png';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                $pendidikan = $this->input->post('pendidikan');
                $jurusan  = $this->input->post('jurusan');
                $nik = $this->input->post('nik');
                $nilai = $this->input->post('nilai');
                $mulai = $this->input->post('mulai');
                $akhir = $this->input->post('akhir');
                $nomor_ijazah = $this->input->post('nomor_ijazah');

                $s=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select * from pendidikan where id = $id"));
                $datax=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select id_karyawan from karyawan where nik = '$nik'"));
                $id_karyawan = $datax['id_karyawan'];
                if ($this->upload->do_upload('file')) {
                    $file = $this->upload->data('file_name');
                }else {
                    $file = $s['file'];
                }
                $data3 = array(
                        'pendidikan'=>$pendidikan,
                        'jurusan' => $jurusan,
                        'nilai' => $nilai,
                        'id_karyawan' => $id_karyawan,
                        'mulai'=>$mulai,
                        'akhir'=>$akhir,
                        'nomor_ijazah'=>$nomor_ijazah,
                        'file'=>$file
                    );
                $where = array(
                    'id' => $id
                );

                $update = $this->mdl_pelamar->updatedata($where,$data3,'pendidikan');
                $this->session->set_flashdata('msg','Data Sukses di Update');
                redirect("adminKaryawan/karyawanDetail/$id_karyawan");
            }
        }else{ redirect("login"); }         
    }
    
    public function delPend($id,$idk){
       if($this->mdl_admin->logged_id()){
            $this->mdl_admin->delPend($id);
            redirect("adminKaryawan/karyawanDetail/$idk");
        }
        
        else{ redirect("login"); } 
    }

    //VERIFIKASI IJASAH
    public function verPend($id,$idk){
       if($this->mdl_admin->logged_id())
        {
            $where = array( 'id' => $id ); 
            $data = array( 'verifikasi' => 1 ); 
            $this->mdl_admin->updateData($where,$data,'pendidikan');
            redirect("adminKaryawan/karyawanDetail/$idk");
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