<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class homepelamar extends CI_Controller {

	 public function __construct()
    {
        parent::__construct();
        //load model mdl_home
        $this->load->model('mdl_home');
    }

	public function index()
	{
		if($this->mdl_home->logged_id())
		{

			$this->load->view("home");			

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
}

/* End of file monitoring.php */
/* Location: ./application/controllers/home.php */