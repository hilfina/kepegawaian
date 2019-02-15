<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	private $filename = "import_data";

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model('cetak_model');
		$this->load->model('pelangganulp');
		$this->load->model('masalahulp');
		$this->load->model('pengawasvendor_model');
		$this->load->helper('url','form','file');
		$this->load->library('form_validation','image_lib');
	}

	public function index()
	{
		if($this->admin_model->logged_id())
		{

			$this->load->view("dashboard");			

		}else{

			//jika session belum terdaftar, maka redirect ke halaman login
			redirect("login");

		}
	}
	public function uploadpelanggan(){
		$data['pelanggan'] = $this->pelangganulp->view();
		$this->load->view('admin/formupload', $data);
	}
	public function uploadmasalah(){
		$data['masalah'] = $this->masalahulp->view();
		$this->load->view('admin/formupload2', $data);
	}
	public function myProfile(){
		$data['detail'] = $this->admin_model->getProfile();
        $this->load->view('profile', $data); 
	}
	public function datapengguna()
	{
		$data['pengguna']=$this->admin_model->getPengguna();
		$this->load->view('admin/pengguna',$data);
	}

	public function tambahpengguna()
	{
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama','nama','trim|required');
		$this->load->model('admin_model');

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('admin/tambahpengguna');
			$this->session->set_flashdata("pesan", "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pengguna Gagal Ditambahkan.
                  </div>");
		}
		else{
			$config['upload_path']		= './assets/upload/';
			$config['allowed_types']	= 'gif|jpg|png';
			$config['max_size']			= 1000000000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload', $config);
			if (! $this->upload->do_upload('userfile')) {
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('admin/tambahpengguna',$error);
				
			}else{
				$image_data = $this->upload->data();
				$configer = array (
					'image_library' => 'gd2',
					'source_image' => $image_data['full_path'],
					'maintain_ratio' => TRUE,
					'width' => 800,
					'height' => 600,
					);
				$this->load->library('image_lib', $config);
				$this->image_lib->clear();
				$this->image_lib->initialize($configer);
				$this->image_lib->resize();
				$this->admin_model->insertPengguna();
				$this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pengguna Berhasil Ditambahkan.
                  </div>");
				$data['pengguna']=$this->admin_model->getPengguna();
				$this->load->view('admin/pengguna',$data);
			}	
		}
	}

	public function editpengguna($id){
		$this->load->model('admin_model');
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama','nama','trim|required');

		$data['pengguna']=$this->admin_model->getPenggunaEdit($id);

		if ($this->form_validation->run()==FALSE) {
			$this->load->view('admin/editpengguna', $data);
			$this->session->set_flashdata("pesan", "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pengguna Gagal Diubah.
                  </div>");
		}else{
			$config['upload_path']		= './assets/upload/';
			$config['allowed_types']	= 'gif|jpg|png';
			$config['max_size']			= 1000000000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;

			$this->load->library('upload', $config);
			if (! $this->upload->do_upload('userfile')) {
				$this->admin_model->editpengguna($id);
			$this->load->view('admin/tambahpengguna');
			}else{
				$image_data = $this->upload->data();
				$configer = array (
					'image_library' => 'gd2',
					'source_image' => $image_data['full_path'],
					'maintain_ratio' => TRUE,
					'width' => 800,
					'height' => 600,
					);
				$this->load->library('image_lib', $config);
				$this->image_lib->clear();
				$this->image_lib->initialize($configer);
				$this->image_lib->resize();
				$this->admin_model->editpengguna($id);
				$this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pengguna Berhasil Diubah.
                  </div>");
				$data['pengguna']=$this->admin_model->getPengguna();
				$this->load->view('admin/pengguna',$data);
			}	
		}
	}

	public function hapuspengguna($id)
	{
		$this->admin_model->hapuspengguna($id);
		$this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pengguna Berhasil Dihapus.
                  </div>");
		$data['pengguna']=$this->admin_model->getPengguna();
		$this->load->view('admin/pengguna',$data);
	}

	public function detailPengguna($id)
	{
		$data['detail'] = $this->admin_model->getDetailPengguna($id);
        $this->load->view('admin/detailpengguna', $data); 
	}

	public function datapelanggan()
	{
		$data['pelanggan']=$this->admin_model->getPelanggan();
		$this->load->view('admin/pelanggan',$data);
	}

	public function tambahpelanggan()
	{
		$this->load->helper('url','form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('namapel','namapel','trim|required');
		$this->form_validation->set_rules('alamat','alamat','trim|required');
		$this->form_validation->set_rules('tarif','tarif','trim|required');
		$this->form_validation->set_rules('daya','daya','trim|required');
		$this->form_validation->set_rules('kd_tiang','kd_tiang','trim|required');
		$this->form_validation->set_rules('nama_gardu','nama_gardu','trim|required');
		$this->form_validation->set_rules('penyulang','penyulang','trim|required');
		$this->form_validation->set_rules('gardu_induk','gardu_induk','trim|required');
		$this->load->model('admin_model');

		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('admin/tambahpelanggan');
			$this->session->set_flashdata("pesan", "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pelanggan Gagal Ditambahkan.
                  </div>");
		}
		else
		{
			$this->admin_model->insertPelanggan();
			$this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pelanggan Berhasil Ditambahkan.
                  </div>");
			$data['pelanggan']=$this->admin_model->getPelanggan();
			$this->load->view('admin/pelanggan',$data);
		}
	}

	public function editpelanggan($id)
	{
		$this->load->model('admin_model');
		$this->load->helper('url','form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('namapel','namapel','trim|required');
		$this->form_validation->set_rules('alamat','alamat','trim|required');
		$this->form_validation->set_rules('tarif','tarif','trim|required');
		$this->form_validation->set_rules('daya','daya','trim|required');
		$data['pelanggan']=$this->admin_model->getPelangganEdit($id);

		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('admin/editpelanggan',$data);
			$this->session->set_flashdata("pesan", "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pelanggan Gagal Diubah.
                  </div>");
		}
		else
		{
			$this->admin_model->editpelanggan($id);
			$this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pelanggan Berhasil Diubah.
                  </div>");
			$data['pelanggan']=$this->admin_model->getPelanggan();
			$this->load->view('admin/pelanggan',$data);
		}
	}

	public function hapuspelanggan($id)
	{
		$this->admin_model->hapuspelanggan($id);
		$this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pelanggan Berhasil Dihapus.
                  </div>");
		$data['pelanggan']=$this->admin_model->getPelanggan();
		$this->load->view('admin/pelanggan',$data);
	}
	public function form(){
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			$upload = $this->pelangganulp->upload_file($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				echo "wahahah";
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		$this->load->view('admin/formupload', $data);
	}

	public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport

			if($numrow > 1){
				// Kita push (add) array data ke variabel data
				array_push($data, array(
					'idpel'=>$row['A'], // Insert data nis dari kolom A di excel
					'namapel'=>$row['B'], // Insert data nama dari kolom B di excel
					'alamat'=>$row['C'],
					'tarif' => $row['D'],
					'daya' => $row['E'], 
					'kd_tiang' => $row['F'],
					'nama_gardu' => $row['G'],
					'penyulang' => $row['H'],
					'gardu_induk' => $row['I'],
					
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}
		$this->pelangganulp->insert_multiple($data);
		
		redirect("admin/datapelanggan");
	}

	public function datamasalah()
	{
		$data['masalah']=$this->admin_model->getMasalah();
		$this->load->view('admin/masalah',$data);
	}

	public function tambahmasalah()
	{
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('idpel','idpel','trim|required');
		$this->form_validation->set_rules('tanggal','tanggal','trim|required');
		$this->form_validation->set_rules('permasalahan','permasalahan','trim|required');
		$this->form_validation->set_rules('tanggal_janji','tanggal_janji','trim|required');
		$this->form_validation->set_rules('status','status','trim|required');
		$this->load->model('admin_model');

		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('admin/tambahmasalah');
			$this->session->set_flashdata("pesan", "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data masalah Gagal Ditambahkan.
                  </div>");
		}
		else
		{
			$this->admin_model->insertMasalah();
			$this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data masalah Berhasil Ditambahkan.
                  </div>");
			$data['masalah']=$this->admin_model->getMasalah();
			$this->load->view('admin/masalah',$data);
		}
	}

	public function editmasalah($id)
	{
		$this->load->model('admin_model');
		$this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tanggal_janji','tanggal_janji','trim|required');
		$data['masalah']=$this->admin_model->getMasalahEdit($id);

		if($this->form_validation->run()==FALSE)
		{
			$this->load->view('admin/editmasalah',$data);
			$this->session->set_flashdata("pesan", "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data masalah Gagal Diubah.
                  </div>");
		}
		else
		{
			$this->admin_model->editmasalah($id);
			$this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data masalah Berhasil Diubah.
                  </div>");
			$data['masalah']=$this->admin_model->getMasalah();
			$this->load->view('admin/masalah',$data);
		}
	}


	public function hapusmasalah($id)
	{
		$this->admin_model->hapusmasalah($id);
		$this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data masalah Berhasil Dihapus.
                  </div>");
		$data['masalah']=$this->admin_model->getMasalah();
		$this->load->view('admin/masalah',$data);
	}
	public function form2(){
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
			$upload = $this->masalahulp->upload_file($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				echo "wahahah";
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		$this->load->view('admin/formupload2', $data);
	}

	public function import2(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport

			if($numrow > 1){
				// Kita push (add) array data ke variabel data
				array_push($data, array(
					'tanggal' => $row['A'], // Ambil data tanggal
					'permasalahan' => $row['B'], // Ambil data nama
					'tanggal_janji' => $row['C'], // Ambil data tanggal_janji
					'status' => $row['D'],
					'idpel' => $row['E'],	
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}
		$this->masalahulp->insert_multiple($data);
		
		redirect("admin/datamasalah");
	}

	public function datapekerjaan()
	{
		$data['pekerjaan']=$this->admin_model->getPekerjaan();
		$this->load->view('admin/pekerjaan',$data);
	}

	public function searchPelanggan()
	{
		$keyword = $this->uri->segment(3);

		// cari di database
		$data = $this->db->from('pelanggan')->like('namapel',$keyword)->get();	

		// format keluaran di dalam array
		foreach($data->result() as $row)
		{
			$arr['query'] = $keyword;
			$arr['suggestions'][] = array(
				'value'	=>$row->namapel,
				'namapel'	=>$row->namapel
			);
		}
		echo json_encode($arr);
	}


	public function tambahpekerjaan()
	{
		$this->load->helper('url','form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama_pekerjaan','nama_pekerjaan','trim|required');
		$this->load->model('admin_model');

		if($this->form_validation->run()==FALSE)
		{
			$data['vendor']=$this->admin_model->getVendor();
			$this->load->view('admin/tambahpekerjaan',$data);
			$this->session->set_flashdata("pesan", "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pekerjaan Gagal Ditambahkan.
                  </div>");
		}
		else
		{
			$this->admin_model->insertPekerjaan();
			$this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pekerjaan Berhasil Ditambahkan.
                  </div>");
			$data['pekerjaan']=$this->admin_model->getPekerjaan();
			$this->load->view('admin/pekerjaan',$data);
		}
	}

	public function editpekerjaan($id)
	{
		$this->load->model('admin_model');
		$this->load->helper('url','form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama_pekerjaan','nama_pekerjaan','trim|required');
		$data['pekerjaan']=$this->admin_model->getPekerjaanEdit($id);

		if($this->form_validation->run()==FALSE)
		{
			$data['vendor']=$this->admin_model->getVendor();
			$this->load->view('admin/editpekerjaan',$data);
			$this->session->set_flashdata("pesan", "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pekerjaan Gagal Diubah.
                  </div>");
		}
		else
		{
			$this->admin_model->editpekerjaan($id);
			$this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pekerjaan Berhasil Diubah.
                  </div>");
			$data['pekerjaan']=$this->admin_model->getPekerjaan();
			$this->load->view('admin/pekerjaan',$data);
		}
	}

	public function hapuspekerjaan($id)
	{
		$this->admin_model->hapuspekerjaan($id);
		$this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Perhatian!</strong> Data Pekerjaan Berhasil Dihapus.
                  </div>");
		$data['pekerjaan']=$this->admin_model->getPekerjaan();
		$this->load->view('admin/pekerjaan',$data);
	}

	public function getDetailPekerjaan($id)
	{
		$data['detail2'] = $this->admin_model->getDetailPekerjaan($id);
        $this->load->view('admin/detailpekerjaan', $data); 
	}

	public function laporan()
	{
		$data['pekerjaan']=$this->cetak_model->view();
		$this->load->view('preview',$data);
	}

	public function cetakPdf()
	{
		$data['pekerjaan']=$this->cetak_model->view();
		$this->load->view('print',$data);
		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();

		$dompdf = new DOMPDF();
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan pekerjaan.pdf");
		unset($html);
		unset($dompdf);
	}

	public function laporanex()
	{
		$data['excel'] = $this->cetak_model->ex(); 
         $this->load->view('reports',$data);
	}

	public function laporanDetail($id)
	{
		$data['pekerjaan']=$this->cetak_model->viewDetail($id);
		$this->load->view('previewDetail',$data);
	}

	public function cetakPdfDetail()
	{
		$data['pekerjaan']=$this->cetak_model->viewDetail($id);
		$this->load->view('printDetail',$data);
		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();

		$dompdf = new DOMPDF();
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Laporan Detail Pekerjaan.pdf");
		unset($html);
		unset($dompdf);
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */