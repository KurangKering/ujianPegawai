<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Md_pelamar extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	//Do your magic here
	}


	public function getLogPilihan()
	{
		$log_ujian_akademik = $this->getLogUjian();
		$log_jawaban = $log_ujian_akademik['jawaban_dipilih'];
		$finalArray = array();
		if (!empty($log_jawaban)) {

			$asArr = explode( ',', $log_jawaban );

			foreach( $asArr as $val ){
				$tmp = explode( '=', $val );
				$finalArray[ $tmp[0] ] = $tmp[1];
			}
		}
		return $finalArray;

	}
	public function setSelesaiUjian()
	{
		$pelamar = $this->session->userdata('pelamar');

		$this->db->where('nik', $pelamar['nik']);
		$this->db->update('log_ujian_akademik', array('status' => 'Y'));
		$log_ujian_akademik = $this->getLogUjian();
		$log_jawaban = $log_ujian_akademik['jawaban_dipilih'];
		$finalArray = array();
		if (isset($log_jawaban)) {

			$asArr = explode( ',', $log_jawaban );

			foreach( $asArr as $val ){
				$tmp = explode( '=', $val );
				$finalArray[ $tmp[0] ] = $tmp[1];
			}
		}

		$list_soal = $this->db->get('soal_ujian_akademik')->result_array();
		//return $list_soal;
		$benar = 0;
		foreach ($list_soal as $k => $v) {
			if ($v['jawaban'] === $finalArray[$v['id_soal']]) {
				$benar++;
			}
		}


		$nilai = (float) $benar / count($list_soal) * 100 ; 

		$this->db->where('nik', $pelamar['nik']);
		$res = $this->db->get('daftar_nilai')->row_array();
		$arrAkademik = array('nilai_akademik' => $nilai);
		if ($res) {
			$this->db->where('nik', $pelamar['nik']);
			$this->db->update('daftar_nilai', $arrAkademik );
		} else
		$this->db->insert('daftar_nilai', array('nilai_akademik' => $nilai, 'nik'=> $pelamar['nik']));
		return $nilai;




	}
	public function getKumpulanSoal()
	{
		$this->db->select('distinct(mst_pelajaran_akademik.id_pelajaran) as id_pelajaran');
		$this->db->from('mst_pelajaran_akademik');
		$this->db->join('soal_ujian_akademik', 'mst_pelajaran_akademik.id_pelajaran = soal_ujian_akademik.id_pelajaran');
		$this->db->order_by('id_pelajaran', 'RANDOM');
		return $this->db->get()->result_array();

	}
	public function getLogUjian()
	{
		$pelamar = $this->session->userdata('pelamar');
		$this->db->select('*');
		$this->db->where('nik', $pelamar['nik']);
		$result = $this->db->get('log_ujian_akademik')->row_array();
		return $result;
	}
	public function countSoal() 
	{
		return $this->db->get('soal_ujian_akademik')->num_rows();
	}
	public function tampilSoal($limit, $offset)
	{
		return $this->db->get('soal_ujian_akademik', $limit, $offset)->result_array();
	}

	/**
	 * [getIdentitas description]
	 * @param  [type] $nik [passing no ktp dari calon pegawai]
	 * @return [type]         [array data yang akan ditampilkan di view pengajuan]
	 */
	public function getIdentitas($nik)
	{
		$this->db->where('nik',$nik);
		return $this->db->get('pelamar')->row_array();

	}
	public function setIdentitas($nik, $data)
	{
		$data['pelamar']['id_periode'] = $this->db->select('id_periode')->order_by('id_periode DESC')->get('konfig_periode')->row_array()['id_periode'];
		$tbl_pelamar  = $this->db->insert('pelamar', $data['pelamar']);
		return true;
	}

	public function getInfoKelulusan($status)
	{
		$id_periode = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];
		$this->db->select('pelamar.*, mst_fakultas.nama_fakultas, mst_subbag.nama_subbag');
		$this->db->from('pelamar');
		$this->db->join('mst_subbag', 'pelamar.id_subbag = mst_subbag.id_subbag');
		$this->db->join('mst_fakultas', 'pelamar.id_fakultas = mst_fakultas.id_fakultas');
		$this->db->where('id_periode', $id_periode);
		$this->db->where('status', $status);
		return $this->db->get()->result_array();
	}
}
/* End of file pelamar_md.php */
/* Location: ./application/modules/pelamar/models/pelamar_md.php */