<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calpeg extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function index()
	{
		
	}

	public function pengajuan()
	{
		$noKtp = $this->input->post('noKtp');
		$cekNoKtp = $this->db->where(array('no_ktp' => $noKtp))->get('calon_pegawai')->result_array();
		if ($cekNoKtp) {
			$data['file'] = $this->db->where(array('ktp_calon_pegawai' => $noKtp))->get('file_lamaran')->result_array();
			$data['fileSertifikat'] =  $this->db->where(array('ktp_calon_pegawai' => $noKtp))->get('file_lamaran_sertifikat')->result_array();


		}


	}

}

/* End of file Calpeg.php */
/* Location: ./application/modules/calpeg/controllers/Calpeg.php */