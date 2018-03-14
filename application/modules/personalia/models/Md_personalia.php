<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Md_personalia extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}



	public function kelolaNilai($data)
	{
		$id_periode = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];

		switch ($data['tipe']) {
			case 'get':
			$result = '';
			$table = '';
			switch ($data['tahap']) {
				case '2':
				$this->db->select('pelamar.nik, pelamar.nama, daftar_nilai.nilai_psikotest');
				$this->db->from('pelamar');
				$this->db->join('daftar_nilai', 'pelamar.nik = daftar_nilai.nik', 'LEFT');
				$this->db->where('pelamar.id_fakultas', $data['id_fakultas']);
				$this->db->where('pelamar.id_subbag', $data['id_subbag']);
				$this->db->where('pelamar.status', $data['tahap']);
				$this->db->where('pelamar.id_periode', $id_periode);
				$result = $this->db->get()->result_array();

				$table .= "<table class = \"table table-striped\"  width=\"100%\"> "  ;
				$table .= "<thead>" ;
				$table .= "<tr>";
				$table .= "<th width=\"30%\">NIK</th>";
				$table .= "<th width=\"50%\">Nama</th>";
				$table .= "<th> Nilai</th>";
				
				$table .= "</tr>";
				$table .= "</thead>" ;
				$table .= "<tbody>";
				foreach ($result as $k => $v) {
					$table .= "<tr>";
					$table .= "<td>{$v['nik']}</td>";
					$table .= "<td>{$v['nama']}</td>";
					$table .= "<td><input type=\"text\" class=\"form-control\" id=\"\" name=\"nik[{$v['nik']}]\" value=\"{$v['nilai_psikotest']}\"></td>";
					
					$table .= "</tr>";
				}
				$table .= "</tbody>";
				$table .= "</table>";

				break;
				case '3':
				$this->db->select('pelamar.nik, pelamar.nama, daftar_nilai.*');
				$this->db->from('pelamar');
				$this->db->join('daftar_nilai', 'pelamar.nik = daftar_nilai.nik', 'LEFT');
				$this->db->where('pelamar.id_subbag', $data['id_subbag']);
				$this->db->where('pelamar.id_fakultas', $data['id_fakultas']);
				$this->db->where('pelamar.status', $data['tahap']);
				$this->db->where('pelamar.id_periode', $id_periode);
				$result = $this->db->get()->result_array();

				$table .= "<table class = \"table table-striped\"  width=\"100%\"> "  ;
				$table .= "<thead>" ;
				$table .= "<tr>";
				$table .= "<th width=\"5%\">NIK</th>";
				$table .= "<th width=\"45%\">Nama</th>";
				$table .= "<th width=\"10%\">Rektor</th>";
				$table .= "<th width=\"10%\">WR 1</th>";
				$table .= "<th width=\"10%\">WR 2</th>";
				$table .= "<th width=\"10%\">WR 3</th>";
				$table .= "<th width=\"10%\">Yayasan</th>";
				$table .= "</tr>";
				$table .= "</thead>" ;
				$table .= "<tbody>";
				foreach ($result as $k => $v) {
					$table .= "<tr>";
					$table .= "<td>{$v['nik']}</td>";
					$table .= "<td>{$v['nama']}</td>";
					$table .= "<td><input type=\"text\" class=\"form-control\" id=\"\" name=\"nik[{$v['nik']}][nilai_w_rektor]\" value=\"{$v['nilai_w_rektor']}\"></td>";
					$table .= "<td><input type=\"text\" class=\"form-control\" id=\"\" name=\"nik[{$v['nik']}][nilai_w_wr_1]\" value=\"{$v['nilai_w_wr_1']}\"></td>";
					$table .= "<td><input type=\"text\" class=\"form-control\" id=\"\" name=\"nik[{$v['nik']}][nilai_w_wr_2]\" value=\"{$v['nilai_w_wr_2']}\"></td>";
					$table .= "<td><input type=\"text\" class=\"form-control\" id=\"\" name=\"nik[{$v['nik']}][nilai_w_wr_3]\" value=\"{$v['nilai_w_wr_3']}\"></td>";
					$table .= "<td><input type=\"text\" class=\"form-control\" id=\"\" name=\"nik[{$v['nik']}][nilai_w_yayasan]\" value=\"{$v['nilai_w_yayasan']}\"></td>";
					$table .= "</tr>";
				}
				$table .= "</tbody>";
				$table .= "</table>";
				break;
				default:
					# code...
				break;
			}
			
			return $table;
			
			
			break;
			case 'input':

			$column = '';
			if ($data['tahap'] === '2') {
				$column = 'nilai_psikotest';
				foreach ($data['nik'] as $k => $v) {
					$col = array ($column => $v);
					$this->db->where('nik', $k);
					$res = $this->db->get('daftar_nilai')->row_array();
					if ($res) {

						$this->db->where('nik', $k);
						$this->db->update('daftar_nilai',  $col);
					} else {
						$col2 = array('nik' => $k,$column => $v	);	
						$this->db->insert('daftar_nilai', $col2);
					}
				}

			} else 
			if ($data['tahap'] ==='3') {
				$column = '';
				foreach ($data['nik'] as $k => $v) {
					foreach ($v as $key => $value) {
						$this->db->where('nik', $k);
						$res = $this->db->get('daftar_nilai')->row_array();
						if ($res) {

							$this->db->where('nik', $k);
							$this->db->update('daftar_nilai',  array($key => $value));
						} else {
							$col2 = array
							(
								'nik' => $k,
								$key => $value
							);	

							$this->db->insert('daftar_nilai', $col2);
						}

					}
				}
			}
			break;
			default:
				# code...
			break;
		}
	}


	public function jsonGetListSubbagLastPeriode($id_fakultas)
	{
		$last_pengaturan = $this->getLastPengaturan();
		$tmp = array();
		foreach ($last_pengaturan['detail_last_jabatan'] as $key => $value) {
			if ($value['id_fakultas'] == $id_fakultas) {
				$tmp[] = $value['id_subbag'];
			}
		}
		$subbag = $this->db->where_in('id_subbag', $tmp)->get('mst_subbag')->result_array();

		return $subbag;

	}
	public function jsonGetDaftarNilai($tahap, $fakultas, $subbag) 
	{
		$this->load->library('datatables');
		$id_periode = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];
		switch ($tahap) {
			case 'akademik':
			$this->datatables->select('pelamar.nik, pelamar.nama, daftar_nilai.nilai_akademik, mst_fakultas.nama_fakultas, mst_subbag.nama_subbag');
			$this->datatables->from('pelamar');
			$this->datatables->join('mst_fakultas', 'pelamar.id_fakultas = mst_fakultas.id_fakultas');
			$this->datatables->join('mst_subbag', 'pelamar.id_subbag = mst_subbag.id_subbag');
			$this->datatables->join('daftar_nilai', 'daftar_nilai.nik = pelamar.nik');
			$this->datatables->where('pelamar.id_fakultas' , $fakultas);
			$this->datatables->where('pelamar.id_subbag' , $subbag);
			$this->datatables->where('pelamar.status' , '1');
			$this->datatables->where('pelamar.id_periode' , $id_periode);
			return $this->datatables->generate();
			break;
			case 'psikotest':
			$this->datatables->select('pelamar.nik, pelamar.nama, daftar_nilai.nilai_psikotest, mst_fakultas.nama_fakultas, mst_subbag.nama_subbag ');
			$this->datatables->from('pelamar');
			$this->datatables->join('mst_fakultas', 'pelamar.id_fakultas = mst_fakultas.id_fakultas');
			$this->datatables->join('mst_subbag', 'pelamar.id_subbag = mst_subbag.id_subbag');
			$this->datatables->join('daftar_nilai', 'daftar_nilai.nik = pelamar.nik');
			$this->datatables->where('pelamar.id_fakultas' , $fakultas);
			$this->datatables->where('pelamar.id_subbag' , $subbag);
			$this->datatables->where('pelamar.status' , '2');
			$this->datatables->where('pelamar.id_periode' , $id_periode);
			return $this->datatables->generate();
			break;
			case 'wawancara':
			$this->datatables->select('pelamar.nik, pelamar.nama, daftar_nilai.nilai_w_rektor, daftar_nilai.nilai_w_wr_1, daftar_nilai.nilai_w_wr_2,  daftar_nilai.nilai_w_wr_3,  daftar_nilai.nilai_w_yayasan , CAST(((daftar_nilai.nilai_w_rektor + daftar_nilai.nilai_w_wr_1 + daftar_nilai.nilai_w_wr_2 + daftar_nilai.nilai_w_wr_3 +   daftar_nilai.nilai_w_yayasan)  / 5 ) as unsigned)   as rata_rata, mst_fakultas.nama_fakultas, mst_subbag.nama_subbag');
			$this->datatables->from('pelamar');
			$this->datatables->join('mst_fakultas', 'pelamar.id_fakultas = mst_fakultas.id_fakultas');
			$this->datatables->join('mst_subbag', 'pelamar.id_subbag = mst_subbag.id_subbag');
			$this->datatables->join('daftar_nilai', 'daftar_nilai.nik = pelamar.nik');
			$this->datatables->where('pelamar.id_fakultas' , $fakultas);
			$this->datatables->where('pelamar.id_subbag' , $subbag);
			$this->datatables->where('pelamar.status' , '3');
			$this->datatables->where('pelamar.id_periode' , $id_periode);
			return $this->datatables->generate();
			break;
			case 'diterima':
			$this->datatables->select('pelamar.nik,mst_fakultas.nama_fakultas, mst_subbag.nama_subbag, pelamar.nama, CAST(((daftar_nilai.nilai_akademik + daftar_nilai.nilai_psikotest + daftar_nilai.nilai_w_rektor + daftar_nilai.nilai_w_wr_1 + daftar_nilai.nilai_w_wr_2 + daftar_nilai.nilai_w_wr_3 + daftar_nilai.nilai_w_yayasan) / 7)  AS UNSIGNED ) AS rata_rata');
			$this->datatables->from('pelamar');
			$this->datatables->join('mst_fakultas', 'pelamar.id_fakultas = mst_fakultas.id_fakultas');
			$this->datatables->join('mst_subbag', 'pelamar.id_subbag = mst_subbag.id_subbag');
			$this->datatables->join('daftar_nilai', 'daftar_nilai.nik = pelamar.nik');
			if ($fakultas != null) {
				$this->datatables->where('pelamar.id_fakultas' , $fakultas);
				
			}
			if ($subbag != null) {
				$this->datatables->where('pelamar.id_subbag' , $subbag);
				
			}
			$this->datatables->where('pelamar.status' , '4');
			$this->datatables->where('pelamar.id_periode' , $id_periode);
			return $this->datatables->generate();
			break;
			default:
			break;
		}
	}
	// public function jsonGetDaftarNilai($tahap, $jabatan) 
	// {
	// 	$this->load->library('datatables');
	// 	$id_periode = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];
	// 	switch ($tahap) {
	// 		case 'akademik':
	// 		$this->datatables->select('pelamar.nik, pelamar.nama, daftar_nilai.nilai_akademik');
	// 		$this->datatables->from('pelamar');
	// 		$this->datatables->join('daftar_nilai', 'daftar_nilai.nik = pelamar.nik');
	// 		$this->datatables->where('pelamar.id_jabatan' , $jabatan);
	// 		$this->datatables->where('pelamar.status' , '1');
	// 		$this->datatables->where('pelamar.id_periode' , $id_periode);
	// 		return $this->datatables->generate();
	// 		break;
	// 		case 'psikotest':
	// 		$this->datatables->select('pelamar.nik, pelamar.nama, daftar_nilai.nilai_akademik, daftar_nilai.nilai_psikotest, CAST(((daftar_nilai.nilai_akademik + daftar_nilai.nilai_psikotest) /2) AS UNSIGNED)  AS rata_rata');
	// 		$this->datatables->from('pelamar');
	// 		$this->datatables->join('daftar_nilai', 'daftar_nilai.nik = pelamar.nik');
	// 		$this->datatables->where('pelamar.id_jabatan' , $jabatan);
	// 		$this->datatables->where('pelamar.status' , '2');
	// 		$this->datatables->where('pelamar.id_periode' , $id_periode);
	// 		return $this->datatables->generate();
	// 		break;
	// 		case 'wawancara':
	// 		$this->datatables->select('pelamar.nik, pelamar.nama, daftar_nilai.nilai_akademik, daftar_nilai.nilai_psikotest, daftar_nilai.nilai_wawancara, CAST(((daftar_nilai.nilai_akademik + daftar_nilai.nilai_psikotest + daftar_nilai.nilai_wawancara) / 3) AS UNSIGNED) AS rata_rata');
	// 		$this->datatables->from('pelamar');
	// 		$this->datatables->join('daftar_nilai', 'daftar_nilai.nik = pelamar.nik');
	// 		$this->datatables->where('pelamar.id_jabatan' , $jabatan);
	// 		$this->datatables->where('pelamar.status' , '3');
	// 		$this->datatables->where('pelamar.id_periode' , $id_periode);
	// 		return $this->datatables->generate();
	// 		break;
	// 		case 'diterima':
	// 		$this->datatables->select('pelamar.nik, pelamar.nama, daftar_nilai.nilai_akademik, daftar_nilai.nilai_psikotest, daftar_nilai.nilai_wawancara, CAST(((daftar_nilai.nilai_akademik + daftar_nilai.nilai_psikotest + daftar_nilai.nilai_wawancara) / 3) AS UNSIGNED) AS rata_rata');
	// 		$this->datatables->from('pelamar');
	// 		$this->datatables->join('daftar_nilai', 'daftar_nilai.nik = pelamar.nik');
	// 		$this->datatables->where('pelamar.jabatan' , $jabatan);
	// 		$this->datatables->where('pelamar.status' , '4');
	// 		$this->datatables->where('pelamar.id_periode' , $id_periode);
	// 		return $this->datatables->generate();
	// 		break;
	// 		default:
	// 		break;
	// 	}
	// }
	// 
	// 
	public function get_data_cetak($data)
	{
		$id_periode = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];
		$result = '';

		$this->db->select('pelamar.nik, pelamar.nama, mst_fakultas.nama_fakultas, mst_subbag.nama_subbag');
		$this->db->from('pelamar');
		$this->db->join('daftar_nilai', 'pelamar.nik = daftar_nilai.nik', 'LEFT');
		$this->db->join('mst_fakultas', 'pelamar.id_fakultas = mst_fakultas.id_fakultas', 'LEFT');
		$this->db->join('mst_subbag', 'pelamar.id_subbag = mst_subbag.id_subbag', 'LEFT');
		if ($data['id_fakultas'] != null) {
			$this->db->where('pelamar.id_fakultas', $data['id_fakultas']);
		}

		if ($data['id_subbag'] != null) {
			$this->db->where('pelamar.id_subbag', $data['id_subbag']);
		}
		$this->db->where('pelamar.status', $data['tahap']);
		$this->db->where('pelamar.id_periode', $id_periode);
		$result = $this->db->get()->result_array();

		return $result;
	}
	public function getListSubbag() 
	{
		$result = $this->db->get('mst_subbag')->result_array();
		return $result;

	}
	public function getListFakultas() 
	{
		$result = $this->db->get('mst_fakultas')->result_array();
		return $result;

	}
	public function jsonGetSeluruhSubbag()
	{

		$this->load->library('datatables');
		$this->datatables->select('id, keterangan, persyaratan_khusus');
		$this->datatables->from('mst_subbag');
		$this->datatables->add_column('action', '<a href="#" class="btn btn-warning btn-sm" onClick="showModals($1)">Edit</a> <a href="#"  class="btn btn-danger btn-sm" onClick="deleteSubbag($1)">delete</a>', 'id');
		return $this->datatables->generate();
	}

	public function jsonGetArsipPelamar()
	{
		$this->load->library('datatables');
		$this->datatables->select('pelamar.nik, pelamar.nama, pelamar.email, mst_fakultas.nama_fakultas, mst_subbag.nama_subbag');
		$this->datatables->from('pelamar');
		$this->datatables->join('mst_subbag','pelamar.id_subbag = mst_subbag.id_subbag ');
		$this->datatables->join('mst_fakultas','pelamar.id_fakultas = mst_fakultas.id_fakultas ');
		$this->datatables->where('pelamar.status', '4');
		$this->datatables->add_column('nik_link', '<a  class="text-info" onclick="showModals($1)">$1</a>', 'nik');
		return $this->datatables->generate();
	}
	public function jsonGetDetailSeluruhPelamar($nik)
	{
		$this->db->select('pelamar.*, mst_fakultas.nama_fakultas, mst_subbag.nama_subbag, mst_tingkatan.keterangan, daftar_nilai.nilai_akademik, daftar_nilai.nilai_psikotest, cast(((daftar_nilai.nilai_w_rektor + daftar_nilai.nilai_w_wr_1 + daftar_nilai.nilai_w_wr_2 + daftar_nilai.nilai_w_wr_3 + daftar_nilai.nilai_w_yayasan) / 5) as unsigned) as nilai_wawancara,  cast(((daftar_nilai.nilai_akademik + daftar_nilai.nilai_psikotest + ((daftar_nilai.nilai_w_rektor + daftar_nilai.nilai_w_wr_1 + daftar_nilai.nilai_w_wr_2 + daftar_nilai.nilai_w_wr_3 + daftar_nilai.nilai_w_yayasan) / 5)) / 3 ) as unsigned) as rata_rata  , pelamar.nik');
		$this->db->from('pelamar');
		$this->db->join('mst_fakultas', 'pelamar.id_fakultas = mst_fakultas.id_fakultas');
		$this->db->join('mst_subbag', 'pelamar.id_subbag = mst_subbag.id_subbag');
		$this->db->join('daftar_nilai' , 'pelamar.nik = daftar_nilai.nik', 'left');
		$this->db->join('mst_tingkatan', 'pelamar.status = mst_tingkatan.id_tingkatan');
		$this->db->where('pelamar.nik', $nik);
		return $this->db->get()->row_array();

	}
	public function jsonGetSeluruhPelamar()
	{
		$id_periode = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];
		$this->load->library('datatables');
		$this->datatables->select('pelamar.nik, pelamar.nama, pelamar.email, mst_tingkatan.keterangan as status_keterangan, mst_subbag.nama_subbag, mst_fakultas.nama_fakultas');
		$this->datatables->from('pelamar');
		$this->datatables->join('mst_fakultas', 'pelamar.id_fakultas = mst_fakultas.id_fakultas');
		$this->datatables->join('mst_tingkatan', 'pelamar.status = mst_tingkatan.id_tingkatan');
		$this->datatables->join('mst_subbag', 'pelamar.id_subbag = mst_subbag.id_subbag' );
		$this->datatables->where('id_periode', $id_periode);
		$this->datatables->add_column('nik_link', '<a  class="text-info" onclick="showModals($1)">$1</a>', 'nik');
		return $this->datatables->generate();

	}

	public function getDatasPelamarEmail($status, $jumlah, $id_fakultas, $id_subbag) 
	{
		$query = '';
		switch ($status) {
			case '2':
			$query = "select pelamar.* from pelamar join daftar_nilai ON pelamar.nik = daftar_nilai.nik WHERE pelamar.id_fakultas = '{$id_fakultas}' AND pelamar.id_subbag = '{$id_subbag}' AND pelamar.status = 1 ORDER BY daftar_nilai.nilai_akademik DESC limit {$jumlah}";
			break;
			case '3':
			$query = "select pelamar.* from pelamar join daftar_nilai ON pelamar.nik = daftar_nilai.nik WHERE pelamar.id_fakultas = '{$id_fakultas}' AND pelamar.id_subbag = '{$id_subbag}' AND pelamar.status = 2 ORDER BY daftar_nilai.nilai_psikotest DESC limit {$jumlah}";
			break;
			case '4':
			$query = "select pelamar.*, (daftar_nilai.nilai_w_rektor + daftar_nilai.nilai_w_wr_1 + daftar_nilai.nilai_w_wr_2 + daftar_nilai.nilai_w_wr_3 +   daftar_nilai.nilai_w_yayasan) /  5 as rata_rata from pelamar join daftar_nilai ON pelamar.nik = daftar_nilai.nik WHERE pelamar.id_fakultas = '{$id_fakultas}' AND pelamar.id_subbag = '{$id_subbag}' AND pelamar.status = 3 ORDER BY rata_rata DESC limit {$jumlah}";
			break;
			default:
				# code...
			break;
		}
		return $this->db->query($query)->result_array();
	}
	public function setNaikTingkat($status,$jumlah, $id_fakultas, $id_subbag, $opsi = 'up')
	{
		$id_periode = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];
		$query = '';
		switch ($status) {
			case '2':
			if ($opsi === 'up') {
				$query = "update pelamar as t1   join ( select pelamar.nik from pelamar join daftar_nilai ON pelamar.nik = daftar_nilai.nik WHERE pelamar.id_fakultas = '{$id_fakultas}' AND pelamar.id_subbag = '{$id_subbag}' AND pelamar.status = 1 ORDER BY daftar_nilai.nilai_akademik DESC limit {$jumlah}) as t2 set status =  '{$status}' WHERE  t1.nik = t2.nik AND t1.id_periode = {$id_periode}";
			}
			break;
			case '3':
			if ($opsi === 'up') {
				$query = "update pelamar as t1   join ( select pelamar.nik from pelamar join daftar_nilai ON pelamar.nik = daftar_nilai.nik WHERE pelamar.id_fakultas = '{$id_fakultas}' AND pelamar.id_subbag = '{$id_subbag}' AND pelamar.status = 2 ORDER BY daftar_nilai.nilai_psikotest DESC limit {$jumlah}) as t2 set status =  '{$status}' WHERE  t1.nik = t2.nik AND t1.id_periode = {$id_periode}";
			}
			break;
			case '4':
			if ($opsi === 'up') {
				$query = "update pelamar as t1   join ( select pelamar.nik , (daftar_nilai.nilai_w_rektor + daftar_nilai.nilai_w_wr_1 + daftar_nilai.nilai_w_wr_2 + daftar_nilai.nilai_w_wr_3 +   daftar_nilai.nilai_w_yayasan) /  5 as rata_rata from pelamar join daftar_nilai ON pelamar.nik = daftar_nilai.nik WHERE pelamar.id_fakultas = '{$id_fakultas}' AND pelamar.id_subbag = '{$id_subbag}' AND pelamar.status = 3 ORDER BY rata_rata DESC limit {$jumlah}) as t2 set status =  '{$status}' WHERE  t1.nik = t2.nik AND t1.id_periode = {$id_periode}";
			}
			default:
				# code...
			break;
		}
		return $this->db->query($query);
	}
	// public function setNaikTingkat($status,$jumlah, $jabatan, $opsi = 'up')
	// {
	// 	$id_periode = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];
	// 	$query = '';
	// 	switch ($status) {
	// 		case '2':
	// 		if ($opsi === 'up') {
	// 			$query = "update pelamar as t1   join ( select pelamar.nik from pelamar join daftar_nilai ON pelamar.nik = daftar_nilai.nik WHERE pelamar.id_jabatan = '{$jabatan}' AND pelamar.status = 1 ORDER BY daftar_nilai.nilai_akademik DESC limit {$jumlah}) as t2 set status =  '{$status}' WHERE  t1.nik = t2.nik AND t1.id_periode = {$id_periode}";
	// 		}
	// 		break;
	// 		case '3':
	// 		if ($opsi === 'up') {
	// 			$query = "update pelamar as t1   join ( select pelamar.nik, CAST(((daftar_nilai.nilai_akademik + daftar_nilai.nilai_psikotest) /2) AS UNSIGNED)  AS rata_rata from pelamar join daftar_nilai ON pelamar.nik = daftar_nilai.nik WHERE pelamar.id_jabatan = '{$jabatan}' AND pelamar.status = 2 ORDER BY rata_rata DESC limit {$jumlah}) as t2 set status =  '{$status}' WHERE  t1.nik = t2.nik AND t1.id_periode = {$id_periode}";
	// 		}
	// 		break;
	// 		case '4':
	// 		if ($opsi === 'up') {
	// 			$query = "update pelamar as t1   join ( select pelamar.nik, CAST(((daftar_nilai.nilai_akademik + daftar_nilai.nilai_psikotest + daftar_nilai.nilai_wawancara) / 3) AS UNSIGNED) AS rata_rata from pelamar join daftar_nilai ON pelamar.nik = daftar_nilai.nik WHERE pelamar.id_jabatan = '{$jabatan}' AND pelamar.status = 3 ORDER BY rata_rata DESC limit {$jumlah}) as t2 set status =  '{$status}' WHERE  t1.nik = t2.nik AND t1.id_periode = {$id_periode}";
	// 		}
	// 		default:
	// 			# code...
	// 		break;
	// 	}
	// 	return $this->db->query($query);
	// }
	public function setPengaturan($tipe, $data = null)
	{


		$id_periode = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];
		if ($tipe === 'umum') {

			$isKonfigUmumExist = (bool) $this->db->get('konfig_umum')->row_array();
			if ($isKonfigUmumExist) {
				$this->db->update('konfig_umum', $data);
			} else
			{
				$this->db->insert('konfig_umum', $data);
			}
			return true;


		} else
		if ($tipe === 'periode') {

			$newData['tanggal_buka_lamaran'] = date_conversion($data['tanggal_buka_lamaran']);
			$newData['tanggal_tutup_lamaran'] = date_conversion($data['tanggal_tutup_lamaran']);
			$newData['tanggal_ujian_akademik'] = date_conversion($data['tanggal_ujian_akademik']) . ' ' . $data['waktu_ujian_akademik'];
			$newData['tanggal_ujian_wawancara'] = date_conversion($data['tanggal_ujian_wawancara']) . ' ' . $data['waktu_ujian_wawancara'];
			$newData['tanggal_ujian_psikotest'] = date_conversion($data['tanggal_ujian_psikotest']) . ' ' . $data['waktu_ujian_psikotest'];
			$data['periode_baru'] = $this->db->select('aktif')->get('konfig_umum')->row_array()['aktif'] === 'Y' ? false : true;

			$cek_ada_periode = $this->db->get('konfig_periode')->row_array();
			if ($data['periode_baru'] || !$cek_ada_periode) {
				if ($id_periode = $data['id_periode']) {

					$this->db->where('id_periode', $id_periode);
					$this->db->where_not_in('status', '4');
					$this->db->delete('pelamar');

				}
				$this->db->insert('konfig_periode', $newData);
				$this->db->update('konfig_umum', array('aktif' => 'Y'));
				$data['id_periode'] = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];
			} else
			{
				$this->db->where('id_periode', $data['id_periode']);
				$this->db->update('konfig_periode', $newData);
			}


			if ($resultDetailSubbag = $this->db->get('detail_jabatan_periode', $data['id_periode'])->result_array())
			{
				$this->db->where('id_periode', $data['id_periode']);
				$this->db->delete('detail_jabatan_periode');
			}
			if (isset($data['id_subbag'])) {
				foreach ($data['id_subbag'] as $k => $v) {
					$this->db->insert('detail_jabatan_periode', array('id_periode' => $data['id_periode'], 'id_fakultas' => $data['id_fakultas'][$k], 'id_subbag' => $data['id_subbag'][$k],  'jumlah' => $data['jumlah'][$k]));
				}
			}


		} else
		if ($tipe === 'akhiri_periode') {
			$is_periode_aktif = $this->db->select('aktif')->get('konfig_umum')->row_array()['aktif'] === 'Y' ? true : false;
			if ($is_periode_aktif) {

				$data = array('aktif' => 'N' );
				$this->db->where('id_periode', $id_periode);
				$this->db->where_not_in('status', '4');
				$pelamars = $this->db->get('pelamar')->result_array();

				foreach ($pelamars as $key => $value) {

					$file_path =  	realpath('files/file_lamaran/' . $value['file_lamaran']);
					$photo_path = realpath('files/photo/' . $value['file_photo']);
					if (file_exists($file_path)) {
						unlink($file_path);
					}
					if (file_exists($photo_path)) {
						unlink($photo_path);
					}



				}
				$this->db->where('id_periode', $id_periode);
				$this->db->where_not_in('status', '4');
				$this->db->delete('pelamar');

				$this->db->update('konfig_umum', $data);
			}

		}



	}
	public function getLastPengaturan()
	{
		$id_periode = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];

		$data['konfig_umum'] = $this->db->get('konfig_umum')->row_array();
		$this->db->select('id_periode');
		$this->db->select('date_format(tanggal_buka_lamaran, "%m/%d/%Y") as tanggal_buka_lamaran');

		$this->db->select('date_format(tanggal_tutup_lamaran, "%m/%d/%Y") as tanggal_tutup_lamaran');
		$this->db->select('date_format(tanggal_ujian_akademik, "%m/%d/%Y") as tanggal_ujian_akademik');
		$this->db->select('date_format(tanggal_ujian_wawancara, "%m/%d/%Y") as tanggal_ujian_wawancara');
		$this->db->select('date_format(tanggal_ujian_psikotest, "%m/%d/%Y") as tanggal_ujian_psikotest');
		$this->db->select('date_format(tanggal_ujian_psikotest, "%H:%i") as waktu_ujian_psikotest');
		$this->db->select('date_format(tanggal_ujian_wawancara, "%H:%i") as waktu_ujian_wawancara');
		$this->db->select('date_format(tanggal_ujian_akademik, "%H:%i") as waktu_ujian_akademik');
		$this->db->select('tanggal_buka_lamaran as full_buka_lamaran');
		$this->db->select('tanggal_tutup_lamaran as full_tutup_lamaran');
		$this->db->select('tanggal_ujian_akademik as full_ujian_akademik');
		$this->db->select('tanggal_ujian_psikotest as full_ujian_psikotest');
		$this->db->select('tanggal_ujian_wawancara as full_ujian_wawancara');
		$this->db->order_by('id_periode', 'DESC');
		$data['konfig_periode'] = $this->db->get('konfig_periode', 1)->row_array();



		$this->db->where('id_periode', $id_periode);
		$this->db->select('*');
		$data['detail_last_jabatan'] = $this->db->get('detail_jabatan_periode')->result_array();
		return $data;
	}
	public function getStatistikPelamar()
	{
		$id_periode = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];
		$this->db->where('id_periode', $id_periode);
		$data['total'] = $this->db->get('pelamar')->num_rows();

		$this->db->where('id_periode', $id_periode);
		$this->db->where('status >', '0');
		$data['diverifikasi'] = $this->db->get('pelamar')->num_rows();

		$this->db->where('id_periode', $id_periode);
		$this->db->where('status ', '-1');
		$data['ditolak'] = $this->db->get('pelamar')->num_rows();

		$this->db->where('id_periode', $id_periode);
		$tmp = $this->db->get('detail_jabatan_periode')->result_array();

		$listFakultas = $this->getListFakultas();
		$listSubbag  = $this->getListSubbag();

		$jabatan = '';
		$jumlah = '';
		$data['detail_jabatan_periode'] = array();
		foreach ($tmp as $key => $value) {

			foreach ($listFakultas as $kf => $vf) {
				if ($vf['id_fakultas'] == $value['id_fakultas']) {
					$jabatan = $vf['nama_fakultas'];
				}
			}

			foreach ($listSubbag as $ks => $vs) {
				if ($vs['id_subbag'] == $value['id_subbag']) {
					$jabatan .= ' - ' .$vs['nama_subbag'];
				}
			}

			$this->db->select('count(*) as jumlah');
			$this->db->where('id_fakultas', $value['id_fakultas']);
			$this->db->where('id_subbag', $value['id_subbag']);
			$this->db->where('status >', '0');
			$jumlah = $this->db->get('pelamar')->row_array()['jumlah'];


			$data['detail_jabatan_periode'][$key]['keterangan'] = $jabatan;
			$data['detail_jabatan_periode'][$key]['jumlah'] = $jumlah;
		}



		$this->db->where('id_periode', $id_periode);
		$this->db->where('status', '0');
		$data['belum'] = $this->db->get('pelamar')->num_rows();


		return $data;
	}

	public function getListFakultasSubbagLastPeriode()
	{

		$list_fakultas = $this->getListFakultas();
		$list_subbag = $this->getListSubbag();
		$last_jabatan = $this->getLastPengaturan()['detail_last_jabatan'];


		$container = array();
		foreach ($last_jabatan as $key => $last) {
			foreach ($list_fakultas as $keyf => $vf) {
				if ($last['id_fakultas'] == $vf['id_fakultas']) {
					$container[$key]['id_fakultas'] = $vf['id_fakultas'];
					$container[$key]['nama_fakultas'] = $vf['nama_fakultas'];
				}
			}

			foreach ($list_subbag as $keyf => $vf) {
				if ($last['id_subbag'] == $vf['id_subbag']) {
					$container[$key]['id_subbag'] = $vf['id_subbag'];
					$container[$key]['nama_subbag'] = $vf['nama_subbag'];
				}
			}
		}
		return $container;

	}
	public function setVerifikasi($data)
	{
		$this->db->where('nik', $data['nik']);
		return $this->db->update('pelamar' , array('status' => $data['status']));
	}
	public function getSingleBelumVerif()
	{
		$id_periode = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];
		$this->db->select('pelamar.*, mst_fakultas.nama_fakultas, mst_subbag.nama_subbag');
		$this->db->from('pelamar');
		$this->db->join('mst_subbag', 'pelamar.id_subbag = mst_subbag.id_subbag');
		$this->db->join('mst_fakultas', 'pelamar.id_fakultas = mst_fakultas.id_fakultas');
		$this->db->where('id_periode', $id_periode);
		$this->db->where('status', '0');
		$this->db->order_by('date_created');
		$this->db->limit('1');
		$result = $this->db->get()->row_array();
		return $result;
	}
	public function getDaftarPelamar()
	{
		$id_periode = $this->db->select('id_periode')->order_by('id_periode desc')->get('konfig_periode', '1')->row_array()['id_periode'];
		$this->db->select('pelamar.*, mst_tingkatan.*');
		$this->db->from('pelamar');
		$this->db->join('mst_tingkatan', 'pelamar.status = mst_tingkatan.id');
		$this->db->where('pelamar.id_periode' , $id_periode);
		$this->db->order_by('date_created', 'ASC');
		return $this->db->get()->result_array();
	}
	public function getDaftarPersetujuan()
	{
		$this->db->where('status', '0');
		$this->db->where_not_in('file_lamaran', '');
		$result = $this->db->get('pelamar')->result_array();
		return $result;
	}
	public function getMataPelajaran($id = '')
	{
		if ($id == '') {
			return $this->db->get('mst_pelajaran_akademik')->result_array();
		} else {
			$this->db->where('id_pelajaran', $id);
			return $this->db->get('mst_pelajaran_akademik')->row_array();
		}
	}
	public function getKumpulanSoal($id_matpel)
	{
		$this->db->where('id_pelajaran', $id_matpel);
		return $this->db->get('soal_ujian_akademik')->result_array();
	}
	public function getSoalSingle($id_soal)
	{
		$this->db->where('id_soal', $id_soal);
		return $this->db->get('soal_ujian_akademik')->row_array();
	}
	public function inputSoal($data) 
	{
		return $this->db->insert('soal_ujian_akademik', $data);
	}
	public function ubahSoal($data, $id)
	{
		$this->db->where('id_soal', $id);
		return $this->db->update('soal_ujian_akademik', $data);
	}
	public function deleteSoal($id)
	{
		$this->db->where('id_soal', $id);
		$result = $this->db->delete('soal_ujian_akademik');
		return $result;
	}

	public function getSubbagSingle($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('mst_subbag')->row_array();
	}
	public function inputSubbag($data) 
	{
		return $this->db->insert('mst_subbag', $data);
	}
	public function ubahSubbag($data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update('mst_subbag', $data);
	}
	public function deleteSubbag($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->delete('mst_subbag');
		return $result;
	}
}
/* End of file Md_personalia.php */
/* Location: ./application/modules/personalia/models/Md_personalia.php */