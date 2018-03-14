<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Personalia extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->template->set_template('template_personalia');
		$this->load->model('md_personalia');
		$this->load->library('user');
		$this->load->helper('ujian');
	}
	public function index()
	{
		if (!$this->user->logged_in('personalia')) {
			redirect('personalia/login');
		}
		


		if ($this->session->flashdata('login_sukses')) {
			$script = $this->session->flashdata('login_sukses');
			$this->template->js_add($script, 'embed');
		}
		$this->template->title('Dashboard Admin');
		$this->template->render('vw_dashboard');
	}



	public function send_mail($data, $jenis)
	{
		
		
		if ($jenis === 'diterima') {
			$isi = '
			<p><strong>Yth Sdr/Sdri&nbsp; '.$data['nama'].'</strong></p>

			<p>Selamat Anda Terpilih Menjadi Bagian Dari Universitas Islam Riau.<strong>.</strong></p>
			<p>Silahkan Menemui Pihak Personalia Di Rektorat Lantai 2  Untuk Proses Selanjutnya</strong></p>

			<p>Terima Kasih.</p>
			';
		} else 
		{
			$isi = '
			<p><strong>Yth Sdr/Sdri&nbsp; ' . $data['nama'] . ' </strong></p>

			<p>Diberitahukan Bahwasannya Anda Berhak Mengikuti Tahapan Seleksi Penerimaan Pegawai Universitas Islam Riau Selanjutnya Dengan Rincian :</p>

			<p><strong>Agenda &nbsp;&nbsp;&nbsp; : Ujian '. ucfirst($jenis) . '</strong></p>

			<p><strong>Waktu&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ' . $data['waktu']. '</strong></p>

			<p><strong>Tempat&nbsp;&nbsp;&nbsp;&nbsp; : ' .$data['tempat'] . ' </strong></p>

			<p>Harap Tiba 15 Menit Sebelum Agenda Dimulai.</p>

			<p>Terima Kasih.</p>
			';
		}
		
		
		

		$this->load->library('email');
		$this->email->from('uir.ujian@ac.id', 'Personalia Universitas Islam Riau');
		$this->email->to($data['email']);
		$this->email->subject("Pengumuman Universitas Islam Riau");
		$this->email->message($isi);

		$sent = $this->email->send();
		if ($sent) {
			return true;
		}
		return false;
		
		
	}
	public function sent()
	{
		error_reporting(0);
		set_time_limit(30);
		$konfig = $this->md_personalia->getLastPengaturan();
		$data['nama'] = 'Kodok';
		$data['ujian'] = 'Akademik';
		$data['waktu'] = $konfig['konfig_periode']['full_ujian_akademik'];
		$data['tempat'] = $konfig['konfig_umum']['lokasi_ujian_akademik'];
		$data['email'] = "cybercature@gmail.com";
		$send_mail = $this->send_mail($data, 'akademik');

	}

	public function cetak_data()
	{
		if ($this->input->post()) {
			$data['tahap'] = $this->input->post('tahap');
			$data['id_fakultas'] = $this->input->post('id_fakultas');
			$data['id_subbag'] = $this->input->post('id_subbag');
			$result['cetak'] = $this->md_personalia->get_data_cetak($data);
			$view = '';
			if (isset($result['cetak'])) {
				switch ($data['tahap']) {
					case '2':
					$view = 'vw_laporan_psikotest';
					break;
					case '3':
					$view = 'vw_laporan_wawancara';

					break;
					case '4' :
					$view = 'vw_laporan_diterima';
					default:
						# code...
					break;
				}
				$output = $this->load->view($view, $result, TRUE);
				
				$this->load->library('pdf');
				$this->dompdf->set_option('isRemoteEnabled', TRUE);
				$this->dompdf->load_html($output);
				$this->dompdf->set_paper("A4", "portrait");
				$this->dompdf->render();
				$this->dompdf->stream("Daftar Pelamar",array("Attachment"=>0));
			} else
			{
				echo "<script type='text/javascript'>";
				echo "window.close();";
				echo "</script>";
			}
		}
		echo "<script type='text/javascript'>";
		echo "window.close();";
		echo "</script>";
	}
	public function lowongan()
	{



		if (!$this->user->logged_in('personalia')) {
			redirect('personalia/login');
		}


		if ($tipe = $this->input->post('tipe')) {
			if ($tipe === 'umum') {
				$data['persyaratan_umum'] = $this->input->post('persyaratan_umum');
				$data['lokasi_ujian_akademik'] = $this->input->post('lokasi_ujian_akademik');
				$data['lokasi_ujian_psikotest'] = $this->input->post('lokasi_ujian_psikotest');
				$data['lokasi_ujian_wawancara'] = $this->input->post('lokasi_ujian_wawancara');
				$data['durasi_ujian_akademik'] = $this->input->post('durasi_ujian_akademik');
				$this->md_personalia->setPengaturan($tipe, $data);
			} else
			if ($tipe === 'periode') {
				$data['id_periode']  = $this->input->post('id_periode');
				$data['tanggal_buka_lamaran']  =$this->input->post('tanggal_buka_lamaran');
				$data['tanggal_tutup_lamaran']  =$this->input->post('tanggal_tutup_lamaran');
				$data['tanggal_ujian_akademik']  =$this->input->post('tanggal_ujian_akademik');
				$data['waktu_ujian_akademik']  =$this->input->post('waktu_ujian_akademik');
				$data['tanggal_ujian_psikotest']  =$this->input->post('tanggal_ujian_psikotest');
				$data['waktu_ujian_psikotest']  =$this->input->post('waktu_ujian_psikotest');
				$data['tanggal_ujian_wawancara']  =$this->input->post('tanggal_ujian_wawancara');
				$data['waktu_ujian_wawancara']  =$this->input->post('waktu_ujian_wawancara');
				$data['id_fakultas']  =$this->input->post('id_fakultas');
				$data['id_subbag']  =$this->input->post('id_subbag');
				$data['jumlah']  =$this->input->post('jumlah');

				$this->md_personalia->setPengaturan($tipe, $data);

			} else 
			if ($tipe === 'akhiri_periode') {
				$this->md_personalia->setPengaturan($tipe);

			}


		}

		$data['list_fakultas'] = $this->md_personalia->getListFakultas();
		$data['list_subbag'] = $this->md_personalia->getListSubbag();
		
		$konfig = $this->md_personalia->getLastPengaturan();

		$data['konfig_umum'] = $konfig['konfig_umum'];
		$data['konfig_periode'] = $konfig['konfig_periode'];

		$data['detail_last_jabatan'] = isset($konfig['detail_last_jabatan']) ? $konfig['detail_last_jabatan'] : '' ;

		$data['is_periode_aktif'] =  $konfig['konfig_umum']['aktif'] === 'Y' ? true : false;

		$this->template->css_add('assets/templates/inspinia_271/css/plugins/datapicker/datepicker3.css');
		$this->template->css_add('assets/templates/inspinia_271/css/plugins/daterangepicker/daterangepicker-bs3.css');
		$this->template->css_add('assets/templates/inspinia_271/css/plugins/switchery/switchery.css');
		$this->template->css_add('assets/templates/inspinia_271/css/plugins/clockpicker/clockpicker.css');
		$this->template->css_add('assets/templates/inspinia_271/css/plugins/clockpicker/clockpicker.css');
		$this->template->js_add('assets/templates/inspinia_271/js/plugins/datapicker/bootstrap-datepicker.js');
		$this->template->js_add('assets/templates/inspinia_271/js/plugins/switchery/switchery.js');
		$this->template->js_add('assets/templates/inspinia_271/js/plugins/daterangepicker/daterangepicker.js');
		$this->template->js_add('assets/templates/inspinia_271/js/plugins/jasny/jasny-bootstrap.min.js');
		$this->template->js_add('assets/templates/inspinia_271/js/plugins/clockpicker/clockpicker.js');
		$this->template->js_add('assets/templates/inspinia_271/js/plugins/jsKnob/jquery.knob.js');
		$this->template->css_add('assets/templates/inspinia_271/css/plugins/sweetalert/sweetalert.css');
		$this->template->js_add('assets/templates/inspinia_271/js/plugins/sweetalert/sweetalert.min.js');

		$this->template->title('Pengaturan Lowongan');
		$this->template->render('vw_lowongan', $data);
	}


	public function subbag()
	{





		$this->template->css_add('assets/templates/inspinia_271/css/plugins/dataTables/datatables.min.css');
		$this->template->js_add('assets/templates/inspinia_271/js/plugins/dataTables/datatables.min.js');	
		$this->template->title('Subbag');
		$this->template->render('vw_subbag');
	}

	public function arsipPegawai() 
	{
		if (!$this->user->logged_in('personalia')) {
			redirect('personalia/login');
		}
		$this->template->css_add('assets/templates/inspinia_271/css/plugins/dataTables/datatables.min.css');
		$this->template->css_add('assets/plugins/iziModal/css/iziModal.min.css');
		$this->template->js_add('assets/templates/inspinia_271/js/plugins/dataTables/datatables.min.js');	
		$this->template->js_add('assets/plugins/iziModal/js/iziModal.min.js');
		$this->template->title("Arsip Pegawai Lulus");
		$this->template->render('vw_arsip_pegawai');
	}



	public function tampilpdf()
	{
		$filename = $this->input->get('file');
		$fullpath = site_url('files/file_lamaran/') . $filename;
		header("Content-type: application/pdf");
		header("Content-Disposition: inline; filename=" .$filename);
		@readfile($fullpath);


	}


	public function kelolaNilai()
	{

		$data['id_subbag'] = $this->input->post('id_subbag');
		$data['id_fakultas'] = $this->input->post('id_fakultas');
		$data['tahap']		= $this->input->post('tahap');
		$data['tipe'] = $this->input->post('tipe');
		$data['data']  = $this->input->post('data');
		$data['nik'] = $this->input->post('nik');


		


		$result = $this->md_personalia->kelolaNilai($data);
		echo json_encode($result);
		exit;
	}

	
	
	public function naikTingkat()
	{
		set_time_limit(120);
		error_reporting(0);
		$last_pengaturan = $this->md_personalia->getLastPengaturan();
		$status = $this->input->post('status');
		$jumlah = $this->input->post('jumlah');
		$id_subbag = $this->input->post('id_subbag');
		$id_fakultas = $this->input->post('id_fakultas');

		$jenis = '';
		if ($status === '2') {
			$jenis = 'psikotest';

		} else
		if ($status === '3') {
			$jenis = 'wawancara';
		} else
		if ($status === '4') {
			$jenis = 'diterima';
		}
		if (is_connected()) {
			$datas_pelamar = $this->md_personalia->getDatasPelamarEmail($status, $jumlah, $id_fakultas, $id_subbag);
			foreach ($datas_pelamar as $key => $value) {
				$email['nama'] = $value['nama'];
				$email['email'] = $value['email'];
				$email['waktu'] = $last_pengaturan['konfig_periode']['full_ujian_' . $jenis];
				$email['tempat'] = $last_pengaturan['konfig_umum']['lokasi_ujian_' . $jenis];
				$this->send_mail($email,  $jenis);
			}
		}
		
		$result = $this->md_personalia->setNaikTingkat($status, $jumlah, $id_fakultas, $id_subbag);
		echo json_encode($result);
	}
	public function jsonDaftarNilai($ujian, $fakultas = null,  $subbag = null)
	{
		header('Content-Type: application/json');
		echo ($this->md_personalia->jsonGetDaftarNilai($ujian,$fakultas, $subbag));
	}


	public function jsonGetListSubbagLastPeriode()
	{

		$id_fakultas = $this->input->post('id_fakultas');
		header('Content-Type: application/json');
		echo json_encode($this->md_personalia->jsonGetListSubbagLastPeriode($id_fakultas));
	}




	public function dummy()
	{
		$id_subbag	= 2;
		$nik['1471101009950001']['nilai_w_rektor']  = 	700;
		$nik['1471101009950001']['nilai_w_wr_1']    = 	500;
		$nik['1471101009950001']['nilai_w_wr_2']    = 	300;
		$nik['1471101009950001']['nilai_w_wr_3']    = 	200;
		$nik['1471101009950001']['nilai_w_yayasan'] = 	70;
		$tahap                                    = 	3;


		$column = '';
		foreach ($nik as $k => $v) {
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

	public function seleksi_administrasi() 
	{
		if ($data['status']  = $this->input->post('verif')) {
			$data['nik'] = $this->input->post('nik');
			if ($data['status'] === '1' && is_connected()) {
				$data_pelamar = $this->md_personalia->jsonGetDetailSeluruhPelamar($data['nik']);
				$email['nama'] = $data_pelamar['nama'];
				$email['email'] = $data_pelamar['email'];
				$email['waktu'] = $last_pengaturan['konfig_periode']['full_ujian_akademik'];
				$email['tempat'] = $last_pengaturan['konfig_umum']['lokasi_ujian_akademik'];

				$this->send_mail($email, 'akademik');
			}

			$this->md_personalia->setVerifikasi($data);
		}
	}

	public function seleksi()
	{
		error_reporting(0);

		if (!$this->user->logged_in('personalia')) {
			redirect('personalia/login');
		}
		$last_pengaturan = $this->md_personalia->getLastPengaturan();

		$data['pengaturan'] = $last_pengaturan;
		$tahap = $this->uri->segment(3);

		if (!$tahap) {
			$waktu_akademik = $last_pengaturan['konfig_periode']['tanggal_ujian_akademik'] . ' ' . $last_pengaturan['konfig_periode']['waktu_ujian_akademik'] ;
			$waktu_psikotest = $last_pengaturan['konfig_periode']['tanggal_ujian_psikotest'] . ' ' . $last_pengaturan['konfig_periode']['waktu_ujian_psikotest'] ;
			$waktu_wawancara = $last_pengaturan['konfig_periode']['tanggal_ujian_wawancara'] . ' ' . $last_pengaturan['konfig_periode']['waktu_ujian_wawancara'] ;
			$waktu_sekarang = date('m/d/Y H:i:s');



			if ($waktu_sekarang >= $waktu_akademik && $waktu_sekarang <= $waktu_psikotest ) {
				redirect('personalia/seleksi/akademik');

			} else
			if ($waktu_sekarang >=  $waktu_psikotest && $waktu_sekarang <= $waktu_wawancara) {
				redirect('personalia/seleksi/psikotest');

			} else

			if ($waktu_sekarang >=  $waktu_wawancara) {
				redirect('personalia/seleksi/wawancara');

			} else

			redirect('personalia/seleksi/administrasi');
		}
		switch ($tahap) {
			case 'administrasi':
			if ($data['status']  = $this->input->post('verif')) {
				$data['nik'] = $this->input->post('nik');
				if ($data['status'] === '1' && is_connected()) {
					$data_pelamar = $this->md_personalia->jsonGetDetailSeluruhPelamar($data['nik']);
					$email['nama'] = $data_pelamar['nama'];
					$email['email'] = $data_pelamar['email'];
					$email['waktu'] = $last_pengaturan['konfig_periode']['full_ujian_akademik'];
					$email['tempat'] = $last_pengaturan['konfig_umum']['lokasi_ujian_akademik'];
					
					$this->send_mail($email, 'akademik');
				}
				
				$this->md_personalia->setVerifikasi($data);
				redirect('personalia/seleksi','refresh');
			}
			$data['total'] = $this->md_personalia->getStatistikPelamar();
			$data['result'] = $this->md_personalia->getSingleBelumVerif();

			$view = 'vw_seleksi_administrasi';
			break;
			case 'akademik':
			$view = 'vw_seleksi_akademik';

			break;
			case 'psikotest':
			$view = 'vw_seleksi_psikotest';

			break;
			case 'wawancara':
			$view = 'vw_seleksi_wawancara';

			break;
			case 'diterima':
			$view = 'vw_diterima';
			break;
			default:
			$view = 'vw_seleksi_administrasi';

			break;
		}
		

		// $a =	array_column($last_pengaturan['detail_last_jabatan'], 'id_fakultas');
		// $data['fakultas'] = $this->db->where_in('id_fakultas', $a)->get('mst_fakultas')->result_array();



		$data['last_jabatan'] = $this->md_personalia->getListFakultasSubbagLastPeriode();
		
		$this->template->title('Seleksi');
		$this->template->css_add('assets/templates/inspinia_271/css/plugins/dataTables/datatables.min.css');

		$this->template->js_add('assets/templates/inspinia_271/js/plugins/dataTables/datatables.min.js');
		$this->template->css_add('assets/plugins/ion.rangeSlider/css/ion.rangeSlider.css');
		$this->template->css_add('assets/plugins/ion.rangeSlider/css/ion.rangeSlider.skinHTML5.css');
		$this->template->js_add('assets/plugins/ion.rangeSlider/js/ion.rangeSlider.min.js');


		$this->template->render($view,$data);
	}


	public function jsonGetArsipPelamar()
	{
		header('Content-Type: application/json');
		echo ($this->md_personalia->jsonGetArsipPelamar());
	}
	public function jsonGetSeluruhPelamar() 
	{
		header('Content-Type: application/json');
		echo ($this->md_personalia->jsonGetSeluruhPelamar());
	}
	public function jsonGetSeluruhSubbag()
	{
		header('Content-Type: application/json');
		echo ($this->md_personalia->jsonGetSeluruhSubbag());
		exit;
	}

	public function jsonGetDetailSeluruhPelamar()
	{
		$nik  = $this->input->post('nik');
		header('Content-Type: application/json');
		echo json_encode($this->md_personalia->jsonGetDetailSeluruhPelamar($nik));


	}
	public function daftarPelamar()
	{


		if (!$this->user->logged_in('personalia')) {
			redirect('personalia/login');
		}
		$this->template->title('Daftar Pelamar');
		$this->template->css_add('assets/templates/inspinia_271/css/plugins/dataTables/datatables.min.css');
		$this->template->js_add('assets/templates/inspinia_271/js/plugins/dataTables/datatables.min.js');
		$this->template->css_add('assets/plugins/iziModal/css/iziModal.min.css');
		$this->template->js_add('assets/plugins/iziModal/js/iziModal.min.js');
		$this->template->render('vw_daftar_pelamar');
	}

	public function verifikasiPelamar()
	{

		if (!$this->user->logged_in('personalia')) {
			redirect('personalia/login');
		}
		$this->template->title('Verifikasi');

		if ($data['status']  = $this->input->post('verif')) {
			$data['nik'] = $this->input->post('nik');
			$this->md_personalia->setVerifikasi($data);
			redirect('personalia/verifikasiPelamar','refresh');
		}
		$data['total'] = $this->md_personalia->getStatistikPelamar();
		$data['result'] = $this->md_personalia->getSingleBelumVerif();

		$this->template->js_add('assets/templates/inspinia_271/js/plugins/pdfjs/pdf.js');
		$this->template->render('vw_verifikasi', $data);

	}
	public function kelolaSoal()
	{
		if (!$this->user->logged_in('personalia')) {
			redirect('personalia/login');
		}

		$id_matpel =  $this->uri->segment(3);
		$data['pilihan'] = array ('A' => 'pilihan_A', 'B' => 'pilihan_B', 'C' => 'pilihan_C', 'D' => 'pilihan_D');
		$data['matpel'] = $this->md_personalia->getMataPelajaran();
		$data['matpel_single'] = $this->md_personalia->getMataPelajaran($id_matpel);
		$data['soal'] = $this->md_personalia->getKumpulanSoal($id_matpel);
		$this->template->title('Kelola Soal');
		$this->template->render('vw_kelola_soal', $data);
	}
	public function kelola_subbag_crud()
	{
		if (!$this->user->logged_in('personalia')) {
			redirect('personalia/login');
		}
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		switch ($type) {
			case 'get':
			$result = $this->md_personalia->getSubbagSingle($id);
			echo json_encode($result);
			break;
			case 'new':
			$data['keterangan'] = $this->input->post('keterangan');
			$data['persyaratan_khusus'] = $this->input->post('persyaratan_khusus');
			$result = $this->md_personalia->inputSubbag($data);
			if ($result) {
				echo json_encode('OK_new');
			} else
			echo json_encode('NO_new');
			break;
			case 'edit' :
			$id = $this->input->post('id');
			$data['keterangan'] = $this->input->post('keterangan');
			$data['persyaratan_khusus'] = $this->input->post('persyaratan_khusus');
			$result = $this->md_personalia->ubahSubbag($data, $id);
			if ($result) {
				echo json_encode('OK_edit');
			} else
			echo json_encode('NO_edit');
			break;
			case 'delete':
			$id = $this->input->post('id');
			$result = $this->md_personalia->deleteSubbag($id);
			if ($result) {
				echo json_encode('OK_delete');
			} else
			echo json_encode('NO_delete');
			default:
				# code...
			break;
		}
	}
	public function kelola_soal_crud() {
		if (!$this->user->logged_in('personalia')) {
			redirect('personalia/login');
		}
		$id = $this->input->post('id_soal');
		$type = $this->input->post('type');
		switch ($type) {
			case 'get':
			$result = $this->md_personalia->getSoalSingle($id);
			echo json_encode($result);
			break;
			case 'new':
			$data['id_pelajaran'] = $this->input->post('id_pelajaran');
			$data['soal'] = $this->input->post('soal');
			$data['pilihan_A'] = $this->input->post('pilihan_A');
			$data['pilihan_B'] = $this->input->post('pilihan_B');
			$data['pilihan_C'] = $this->input->post('pilihan_C');
			$data['pilihan_D'] = $this->input->post('pilihan_D');
			$data['jawaban'] = $this->input->post('jawaban');
			$result = $this->md_personalia->inputSoal($data);
			if ($result) {
				echo json_encode('OK_new');
			} else
			echo json_encode('NO_new');
			break;
			case 'edit' :
			$id = $this->input->post('id_soal');
			$data['id_pelajaran'] = $this->input->post('id_pelajaran');
			$data['soal'] = $this->input->post('soal');
			$data['pilihan_A'] = $this->input->post('pilihan_A');
			$data['pilihan_B'] = $this->input->post('pilihan_B');
			$data['pilihan_C'] = $this->input->post('pilihan_C');
			$data['pilihan_D'] = $this->input->post('pilihan_D');
			$data['jawaban'] = $this->input->post('jawaban');
			$result = $this->md_personalia->ubahSoal($data, $id);
			if ($result) {
				echo json_encode('OK_edit');
			} else
			echo json_encode('NO_edit');
			break;
			case 'delete':
			$id = $this->input->post('id_soal');
			$result = $this->md_personalia->deleteSoal($id);
			if ($result) {
				echo json_encode('OK_delete');
			} else
			echo json_encode('NO_delete');
			default:
				# code...
			break;
		}
	}
	public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == TRUE) {
			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');
			if ($this->user->login('personalia', $data)) {
				$this->session->set_flashdata('login_sukses', show_message('success', 'Selamat Datang Di Halaman Personalia'));
				redirect('personalia');
			} else
			$data['error'] = show_message('error', 'username/password Salah');
			$this->load->view('personalia/vw_login', $data);
		} else
		$this->load->view('personalia/vw_login');
	}
	public function logout()
	{
		$this->user->logout("personalia");
		redirect('personalia/login');
	}
}
/* End of file Personalia.php */
/* Location: ./application/modules/personalia/controllers/Personalia.php */