<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	private $filename = "import_data";
	public function __construct()
	{
		parent::__construct();
        $this->load->model('mdl_login');
		$this->load->model('mdl_admin');
		$this->load->model('mdl_home');
		$this->load->helper('url','form','file');
		$this->load->library('form_validation','image_lib');
	}
	public function index()
	{
		if($this->mdl_admin->logged_id())
		{
			$paket['array']=$this->mdl_admin->getPelamar();
            $this->load->view('admin/pelamar/allPelamar',$paket);
		}else{
			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
	//............................................PELAMAR............................................//

	//SEMUA DATA PELAMAR
	public function pelamar(){
        if($this->mdl_admin->logged_id())
        {
            $paket['array']=$this->mdl_admin->getPelamar();
            $this->load->view('admin/pelamar/allPelamar',$paket);
        }

        else{ redirect("login"); } 
	}

    public function pelamarDiterima($id){
        if($this->mdl_admin->logged_id()) {
        $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select email from karyawan where id_karyawan ='$id'")); 

        $this->load->library('email');
        $config = array();
        $config['charset'] = 'utf-8';
        $config['useragent'] = 'CodeIgniter';
        $config['protocol']= "smtp";
        $config['mailtype']= "html";
        $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
        $config['smtp_port']= "465";
        $config['smtp_timeout']= "400";
        $config['smtp_user']= "hilfinaamaris09@gmail.com"; // isi dengan email kamu
        $config['smtp_pass']= "hilfina090798"; // isi dengan password kamu
        $config['crlf']="\r\n"; 
        $config['newline']="\r\n"; 
        $config['wordwrap'] = TRUE;
        //memanggil library email dan set konfigurasi untuk pengiriman email
            
        $this->email->initialize($config);
        //konfigurasi pengiriman
        $this->email->from($config['smtp_user']);
        $this->email->to($data['email']);
        $this->email->subject("Notifikasi");
        $this->email->message("Selamat, anda mendapat panggilan untuk melakukan seleksi di RSIA tahap ");
        $this->email->send();
        
        $where = array( 'id_karyawan' => $id ); 
        $data = array( 'id_status' => 'Calon Karyawan' ); 
        $this->mdl_admin->updateData($where,$data,'karyawan');


        $dataSel = array(
            'id_karyawan' => $id,
            'tgl_seleksi' => " ",
            'nilai_agama' => "0",
            'nilai_kompetensi' => "0",
            'tes_ppa' => "",
            'tes_psikologi' => " ",
            'tes_kesehatan' => " ",
            'nilai_wawancara' => " "
        );
        $this->mdl_admin->addData('seleksi',$dataSel);
        $paket['array']=$this->mdl_admin->getPelamar();
        $this->load->view('admin/pelamar/allPelamar',$paket);
        }

        else{ redirect("login"); } 
    }

    public function pelamarDitolak($id){
        if($this->mdl_admin->logged_id()) {
        $dataa=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"),"select email from karyawan where id_karyawan ='$id'")); 

        $this->load->library('email');
        $config = array();
        $config['charset'] = 'utf-8';
        $config['useragent'] = 'CodeIgniter';
        $config['protocol']= "smtp";
        $config['mailtype']= "html";
        $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
        $config['smtp_port']= "465";
        $config['smtp_timeout']= "400";
        $config['smtp_user']= "hilfinaamaris09@gmail.com"; // isi dengan email kamu
        $config['smtp_pass']= "hilfina090798"; // isi dengan password kamu
        $config['crlf']="\r\n"; 
        $config['newline']="\r\n"; 
        $config['wordwrap'] = TRUE;
        //memanggil library email dan set konfigurasi untuk pengiriman email
            
        $this->email->initialize($config);
        //konfigurasi pengiriman
        $this->email->from($config['smtp_user']);
        $this->email->to($dataa['email']);
        $this->email->subject("Notifikasi");
        $this->email->message("Maaf, anda gagal dalam seleksi di RSIA");
        $this->email->send();
        
        $where = array( 'id_karyawan' => $id ); 
        $data = array( 'id_status' => 'Pelamar Ditolak' ); 
        $this->mdl_admin->updateData($where,$data,'karyawan');

        $paket['array']=$this->mdl_admin->getPelamar();
        $this->load->view('admin/pelamar/allPelamar',$paket);
        }

        else{ redirect("login"); } 
    }
    //DATA DETAIL PELAMAR
    public function pelamarDetail($id){
        if($this->mdl_admin->logged_id())
        {
            $where = array( 'id_karyawan' => $id ); 
            $paket['array']=$this->mdl_admin->getProfesi();
            $paket['datDir']=$this->mdl_admin->getData('karyawan',$where);
            $paket['datPen']=$this->mdl_admin->getData('pendidikan',$where);
            $paket['datSel']=$this->mdl_admin->getData('Seleksi',$where);
            $paket['datSur']=$this->mdl_admin->cariJenisSurat($id);
            $paket['datLo']=$this->mdl_admin->getData('Lowongan',$where);
            $this->load->view('admin/Pelamar/detailPelamar',$paket);
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
            redirect("admin/pelamarDetail/$idk");
        }

        else{ redirect("login"); } 
    }

    public function verPend2($id,$idk){
       if($this->mdl_admin->logged_id())
        {
            $where = array( 'id' => $id ); 
            $data = array( 'verifikasi' => 1 ); 
            $this->mdl_admin->updateData($where,$data,'pendidikan');
            redirect("adminKaryawan/karyawanDetail/$idk");
        }

        else{ redirect("login"); } 
    }

    //EDIT DATA SELEKSI
    public function editDataSel(){
        if($this->mdl_admin->logged_id())
        {   
            $idk=$this->input->post('idKSel');
            $id_sel = $this->input->post('idSel');
            $tgl_sel = $this->input->post('tglSel');
            $nw_sel = $this->input->post('nwSel');
            $nk_sel = $this->input->post('nkSel');
            $na_sel = $this->input->post('naSel');
            $tp_sel = $this->input->post('tpSel');
            $tps_sel = $this->input->post('tpsSel');
            $tk_sel = $this->input->post('tkSel');
         
            $dataSel = array(
            'id_karyawan' => $idk,
            'tgl_seleksi' => $tgl_sel,
            'nilai_agama' => $na_sel,
            'nilai_kompetensi' => $nk_sel,
            'tes_ppa' => $tp_sel,
            'tes_psikologi' => $tps_sel,
            'tes_kesehatan' => $tk_sel,
            'nilai_wawancara' => $nw_sel
            );
            $where = array( 'id_karyawan' => $idk);

            $this->mdl_admin->updateData($where,$dataSel,'seleksi');
            redirect("admin/pelamarDetail/$idk");
        }

        else{ redirect("login"); } 
    }

    public function dataSeleksi(){
       if($this->mdl_admin->logged_id())
        {
            $paket['array']=$this->mdl_admin->getSeleksi();
            $this->load->view('admin/pelamar/allSeleksi',$paket);
        }

        else{ redirect("login"); } 
    }
    public function editSeleksi($id){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('idKSel','ID Karyawan Seleksi','trim|required');

            if($this->form_validation->run()==FALSE){
                $where = array( 'id_karyawan' => $id);
                $data['array']=$this->mdl_admin->getData('seleksi',$where);
                $this->load->view('admin/pelamar/editSeleksi',$data);
            }else{
                
                $idk=$this->input->post('idKSel');
                $id_sel = $this->input->post('idSel');
                $tgl_sel = $this->input->post('tglSel');
                $nw_sel = $this->input->post('nwSel');
                $nk_sel = $this->input->post('nkSel');
                $na_sel = $this->input->post('naSel');
                $tp_sel = $this->input->post('tpSel');
                $tps_sel = $this->input->post('tpsSel');
                $tk_sel = $this->input->post('tkSel');
             
                $dataSel = array(
                'id_karyawan' => $idk,
                'tgl_seleksi' => $tgl_sel,
                'nilai_agama' => $na_sel,
                'nilai_kompetensi' => $nk_sel,
                'tes_ppa' => $tp_sel,
                'tes_psikologi' => $tps_sel,
                'tes_kesehatan' => $tk_sel,
                'nilai_wawancara' => $nw_sel
                );
                $where = array( 'id_karyawan' => $idk);

                $this->mdl_admin->updateData($where,$dataSel,'seleksi');
                $this->session->set_flashdata('msg','Success');
                redirect("admin/dataSeleksi");
                }
        }

        else{ redirect("login"); } 
    }
        public function addPelamar(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('no_ktp','Nomor Kartu Penduduk','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['array']=$this->mdl_admin->getProfesi();
                $this->load->view('admin/pelamar/addPelamar',$data);
            }else{
                $nik=$this->input->post('nik');
                $no_ktp=$this->input->post('no_ktp');
                $nama=$this->input->post('nama');
                $alamat=$this->input->post('alamat');
                $no_telp=$this->input->post('no_telp');
                $email=$this->input->post('email');
                $id_status=$this->input->post('id_status');
                $id_profesi=$this->input->post('id_profesi');
                $pendidikan=$this->input->post('pendidikan');
             
                $dataKaryawan = array(
                'nik' => $nik,
                'no_ktp' => $no_ktp,
                'no_bpjs' => '-',
                'nama' => $nama,
                'alamat' => $alamat,
                'no_telp' => $no_telp,
                'email' => $email,
                'foto' => 'profile.png',
                'id_status' => 'Pelamar',
                'id_profesi' => $id_profesi,
                'id_golongan' => 'Tidak Ada'
                );

                $this->mdl_admin->addData('karyawan',$dataKaryawan);
                $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select * from karyawan where no_ktp = $no_ktp"));

                $dataLowongan = array(
                'id_karyawan' => $data['id_karyawan'],
                'pend_akhir' => '-',
                'nilai_akhir' => '-'
                );

                $dataLogin = array(
                'id_karyawan' => $data['id_karyawan'],
                'username' => $data['no_ktp'],
                'password' => md5($data['no_ktp']),
                'level' => 'Pelamar',
                'aktif' => 0
                );

                $dataPend = array(
                'id_karyawan' => $data['id_karyawan'],
                'pendidikan' => $pendidikan,
                'mulai' => 0,
                'akhir' => 0,
                'nomor_ijazah' => '-',
                'file' => '-',
                'verifikasi' => 0
                );

                $this->mdl_admin->addData('lowongan',$dataLowongan);
                $this->mdl_admin->addData('login',$dataLogin);
                $this->mdl_admin->addData('pendidikan',$dataPend);
                $this->session->set_flashdata('msg','Success');
                $encrypted_id = $data['id_karyawan'];
                $this->load->library('email');
                $config = array();
                $config['charset'] = 'utf-8';
                $config['useragent'] = 'CodeIgniter';
                $config['protocol']= "smtp";
                $config['mailtype']= "html";
                $config['smtp_host']= "ssl://smtp.gmail.com";//pengaturan smtp
                $config['smtp_port']= "465";
                $config['smtp_timeout']= "400";
                $config['smtp_user']= "hilfinaamaris09@gmail.com"; // isi dengan email kamu
                $config['smtp_pass']= "hilfina090798"; // isi dengan password kamu
                $config['crlf']="\r\n"; 
                $config['newline']="\r\n"; 
                $config['wordwrap'] = TRUE;
                //memanggil library email dan set konfigurasi untuk pengiriman email
                    
                $this->email->initialize($config);
                //konfigurasi pengiriman
                $this->email->from($config['smtp_user']);
                $this->email->to($email);
                $this->email->subject("Notifikasi");
                $this->email->message("Mohon lengkapi data lamaran anda di RSI Aisyiyah Malang, karena penseleksian akan segera dilakukan.<br>
                Klik tombol dibawah ini untuk aktifikasi akun anda.<br>
                Masukkan username dan password dengan nomor KTP sesuai data lamaran yang telah anda kirim.<br><br>".
                "<a href='".site_url("login/verification/$encrypted_id")."'><button>verifikasi</button</a>");
                $this->email->send();

                redirect("admin/pelamar/allPelamar");
                }
        }
        
        else{ redirect("login"); } 
    }

    public function editDataPel($id){
         if($this->mdl_admin->logged_id())
        {
            $nik=$this->input->post('nik');
            $no_ktp=$this->input->post('no_ktp');
            $nama=$this->input->post('nama');
            $alamat=$this->input->post('alamat');
            $no_telp=$this->input->post('no_telp');
            $email=$this->input->post('email');
            $id_profesi=$this->input->post('id_profesi');

             $dataKaryawan = array(
                'no_ktp' => $no_ktp,
                'nama' => $nama,
                'alamat' => $alamat,
                'no_telp' => $no_telp,
                'email' => $email,
                'id_profesi' => $id_profesi
                );
             $where = array('id_karyawan' => $id);
             $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');
             redirect("admin/pelamarDetail/$id");
        }

        else{ redirect("login"); } 
    }
    public function editMagang($id){
         if($this->mdl_admin->logged_id())
        {
            $where = array('id_karyawan' => $id);
            $dataKaryawan = array(
                'id_status' => 'Magang'
                );
            
            $konek = mysqli_connect("localhost","root","","kepegawaian");
            $data=mysqli_fetch_array(mysqli_query($konek, "select * from karyawan where id_karyawan = $id"));
            $data1=mysqli_fetch_array(mysqli_query($konek,"select max(id_riwayat) as last from riwayat"));
            $dataRiwayat = array(
                'id_riwayat' => $data1['last']+1,
                'id_karyawan' => $id,
                'ruangan' => '-',
                'id_profesi' => $data['id_profesi'],
                'mulai' => date('d-m-y')
            );

            $dataStatus = array(
                'id_karyawan' => $id,
                'id_status' => 'Magang',
                'mulai' => '-',
                'akhir' => '-',
                'nomor_sk' => '-',
                'alamat_sk' => '-',
                'aktif' => 1
            );

            $datalogin = array(
                'level' => 'Karyawan',
            );

             $this->mdl_admin->updateData($where,$dataKaryawan,'Karyawan');
             $this->mdl_admin->addData('riwayat',$dataRiwayat);
             $this->mdl_admin->addData('Status',$dataStatus);
             $this->mdl_admin->updateData($where,$datalogin,'login');
             redirect("adminKaryawan/karyawanDetail/$id");
        }

        else{ redirect("login"); } 
    }

    //Add pendidikan pada karyawan
    public function addPend($id){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('id_karyawan','Id Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['id']=$id;
                $this->load->view('admin/pelamar/addPend',$data);
            }else{
                $config['upload_path']      = './Assets/gambar/';
                $config['allowed_types']    = 'gif|jpg|png|pdf|docx';
                $config['max_size']         = 2000000000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);

                $id=$this->input->post('id_karyawan');
                $pendidikan = $this->input->post('pendidikan');
                $nilai = $this->input->post('nilai');
                $mulai = $this->input->post('mulai');
                $akhir = $this->input->post('akhir');
                $nomor_ijazah = $this->input->post('nomor_ijazah');
                $this->upload->do_upload('file');
                $a = $this->upload->data('file_name');
                $data3 = array(
                        'pendidikan'=>$pendidikan,
                        'mulai'=>$mulai,
                        'akhir'=>$akhir,
                        'nomor_ijazah'=>$nomor_ijazah,
                        'id_karyawan' => $id,
                        'file'=>$a,
                        'verifikasi'=> 0,
                        'nilai' => $nilai,
                    );
                $this->mdl_admin->addData('pendidikan',$data3);
                redirect("admin/pelamarDetail/$id");
                
                }
        }else{ redirect("login"); } 
    }


    public function datapend(){
        $paket['pen']=$this->mdl_admin->getPendidikan();
        $this->load->view('admin/pendidikan/allpendidikan',$paket);
    }
    //add pendidikan pada semua tabel pendidikan
    public function addPendidikan(){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('nik','Nomor Induk Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $this->load->view('admin/pendidikan/addPendidikan');
            }else{
                $config['upload_path']      = './Assets/gambar/';
                $config['allowed_types']    = 'gif|jpg|png|pdf|docx';
                $config['max_size']         = 2000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);
                $konek = mysqli_connect("localhost","root","","kepegawaian");
                $nik=$this->input->post('nik');
                $data2=mysqli_fetch_array(mysqli_query($konek,"select id_karyawan from karyawan where nik = '$nik' "));

                $id=$data2['id_karyawan'];
                $pendidikan = $this->input->post('pendidikan');
                $nilai = $this->input->post('nilai');
                $mulai = $this->input->post('mulai');
                $akhir = $this->input->post('akhir');
                $nomor_ijazah = $this->input->post('nomor_ijazah');
                $this->upload->do_upload('file');
                $file = $this->upload->data('file_name');
                $data3 = array(
                        'pendidikan'=>$pendidikan,
                        'mulai'=>$mulai,
                        'akhir'=>$akhir,
                        'nomor_ijazah'=>$nomor_ijazah,
                        'id_karyawan' => $id,
                        'file'=>$file,
                        'verifikasi'=> 0,
                        'nilai' => $nilai,
                    );
                $this->session->set_flashdata('msg','Data Sukses di tambahkan');
                $this->mdl_admin->addData('pendidikan',$data3);
                redirect("admin/dataPend");
                
                }
        }else{ redirect("login"); } 
    }

    public function hapuspend($id)
    {
        $where = array('id' => $id);
        $this->mdl_pelamar->hapusdata('pendidikan',$where);
        $this->session->set_flashdata('msg','Data Sukses di Hapus');
        redirect(site_url('karyawan/datapend'));
    }
    
    public function addSurat($id){
       if($this->mdl_admin->logged_id()){

            $this->form_validation->set_rules('id_karyawan','Id Karyawan','trim|required');

            if($this->form_validation->run()==FALSE){
                $data['id']=$id;
                $data['surat']=$this->mdl_admin->getJenSur();
                $this->load->view('admin/pelamar/addSurat',$data);
            }else{
                $config['upload_path']      = './Assets/gambar/';
                $config['allowed_types']    = 'gif|jpg|png|pdf|docx';
                $config['max_size']         = 2000000000;
                $config['max_width']        = 10240;
                $config['max_height']       = 7680;

                $this->load->library('upload', $config);

                $id=$this->input->post('id_karyawan');
                $nama_surat = $this->input->post('nama_surat');
                $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select id_surat from jenis_surat where nama_surat = '$nama_surat'"));
                $xxx = $data['id_surat'];
                $id_surat = $xxx;
                $tgl_mulai = $this->input->post('tgl_mulai');
                $tgl_akhir = $this->input->post('tgl_akhir');
                $no_surat = $this->input->post('no_surat');
                $this->upload->do_upload('file');
                $b = $this->upload->data('file_name');
                $data4 = array(
                    'id_karyawan' => $id,
                    'id_surat'=>$id_surat,
                    'tgl_mulai'=>$tgl_mulai,
                    'tgl_akhir'=>$tgl_akhir, 
                    'no_surat'=>$no_surat,  
                    'file'=>$b,
                    'aktif'=> 0,
                );

                $this->mdl_admin->addData('sip_str',$data4);
                redirect("admin/pelamarDetail/$id");
                
                }
        }
        
        else{ redirect("login"); } 
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */