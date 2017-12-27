<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personalia extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function index()
	{
		$this->template->render('vw_dashboard');
	}

	public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'required');
		if ($this->form_validation->run() == TRUE or FALSE) {

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$cekUser = $this->db->where(array('username' => $username , 'password' => $password))->get('personalia')->result_array();
			if ($cekUser) {
				$this->session->set_userdata(array('username' => $username, 'status' => 'aktif'));
				redirect('personalia');
			}
		} else {
			$this->template->render('vw_login');
		}
		
	}

}

/* End of file Personalia.php */
/* Location: ./application/modules/personalia/controllers/Personalia.php */