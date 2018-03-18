<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		
		$this->load->view('vw_homepage');
	}

	public function login()
	{

		$this->form_validation->set_rules('username', 'Username', 'trim|required|');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == TRUE) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$role = $this->user->login();
			if ($role === '-1') {
				redirect('personalia','refresh');
			} else
			if ($role === '0') {
				redirect('kabag','refresh');
			} else
			$this->session->set_flashdata('error', 'Username/Password Salah');
		} else {
			$this->load->view('login');
		}
		

	}
}
