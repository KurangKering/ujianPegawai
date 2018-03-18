<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class User {

	var $CI = null;

	function User()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');
	}
	public function set_session($role, $data)
	{

		if ($role === 'personalia') {
			$array = array(
				'username' => $data['username'],
				'nama' => $data['keterangan'],
				'role' => $role
				);
			$this->CI->session->unset_userdata( 'personalia');
			$this->CI->session->set_userdata( 'personalia', $array );
		} else 
		if ($role === 'pelamar') {
			$array = array(
				'nik' => $data['nik'],
				'nama' => $data['nama'],
				);
			$this->CI->session->unset_userdata( 'pelamar');
			$this->CI->session->set_userdata( 'pelamar', $array );
		} else
		return false;
		
		return true;
	}
	
	public function logged_in($role)
	{
		if ($this->CI->session->userdata($role)) {
			return true;
		} else
		return false;
	}

	public function login($role, $data)
	{

		$this->CI->load->database();

		if ($role === 'personalia') {
			$this->CI->load->library('encrypt');
			$this->CI->db->where('username', $data['username']);
			$this->CI->db->where('password', $data['password']);
			$result = $this->CI->db->get('personalia')->row_array();
			if ($result) {
				$this->set_session($role, $result);
				return true;
			} else 
			return false;
		} else
		if ($role === 'pelamar') {
			$this->CI->db->where('nik', $data['nik']);
			$result = $this->CI->db->get('pelamar')->row_array();
			if ($result) {
				$this->set_session($role, $result);
				return true;
			} else
			return false;
		} 


	}


	public function get_data($role)
	{
		return $this->CI->session->userdata($role);
	}
	public function logout($role)
	{

		
		$this->CI->session->userdata($role);
		$this->CI->session->unset_userdata($role);
		$this->CI->session->sess_destroy();



		return true;
	}
}
