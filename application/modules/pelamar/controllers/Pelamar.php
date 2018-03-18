<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pelamar extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('md_pelamar');
		$this->template->set_template('template_pelamar');
		$this->load->library('user');
	}


	public function info_kelulusan()
	{
		$this->load->model('personalia/md_personalia');
		$pengaturan = $this->md_personalia->getLastPengaturan();
		$pengaturan = $pengaturan['konfig_periode'];
		$now = date('Y-m-d H:i:s');
		$data = array();

		if ($now > $pengaturan['tanggal_buka_lamaran'] && $now < $pengaturan['tanggal_tutup_lamaran']) {
			$data['judul'] = "Daftar Seluruh Pelamar ";
			$data['pelamar'] = $this->md_pelamar->getInfoKelulusan('0');
		} else 
		if ($now > $pengaturan['tanggal_tutup_lamaran'] && $now < $pengaturan['full_ujian_akademik']) {
			$data['judul'] = "Daftar Lulus Verifikasi Berkas";
			$data['pelamar'] = $this->md_pelamar->getInfoKelulusan('1');
		} else 
		if ($now > $pengaturan['full_ujian_akademik'] && $now < $pengaturan['full_ujian_psikotest']) {
			$data['judul'] = "Daftar Lulus Ujian Akademik";
			$data['pelamar'] = $this->md_pelamar->getInfoKelulusan('2');
		} else 
		if ($now > $pengaturan['full_ujian_psikotest'] && $now < $pengaturan['full_ujian_wawancara']) {
			$data['judul'] = "Daftar Lulus Ujian Psikotest";
			$data['pelamar'] = $this->md_pelamar->getInfoKelulusan('3');
		}
		else 
			if ($now > $pengaturan['full_ujian_wawancara']) {
				$data['judul'] = "Daftar Pelamar Yang Diterima Bekerja";
				$data['pelamar'] = $this->md_pelamar->getInfoKelulusan('4');
			}
			$this->template->css_add('assets/templates/inspinia_271/css/plugins/dataTables/datatables.min.css');
			$this->template->js_add('assets/templates/inspinia_271/js/plugins/dataTables/datatables.min.js');	
			$this->template->render('vw_kelulusan', $data);
		}
		public function index()
		{



			$this->load->model('personalia/md_personalia');
			$data = $this->md_personalia->getLastPengaturan();


			if ($data['konfig_umum']['aktif'] !== 'Y') {
				$this->load->view('vw_periode_berakhir');
			} else
			{
				$this->template->title('Sistem Penerimaan Pegawai');
				$this->template->render('vw_halaman_depan', $data);
			}
		}


		public function pengajuan() 
		{	
			$this->load->model('personalia/md_personalia');
			$pengaturan = $this->md_personalia->getLastPengaturan();
			$now = date('Y-m-d H:i:s');


			if (($now < $pengaturan['konfig_periode']['full_buka_lamaran'] || $now > $pengaturan['konfig_periode']['full_tutup_lamaran']))
			{

				$this->template->title('Pengajuan Tutup');
				$this->template->render('vw_pengajuan_tutup');
				return;

			} 
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nik', 'NIK', 'required|exact_length[16]|integer|is_unique[pelamar.nik]'
				, array
				(
					'is_unique' => 'Anda Hanya Dapat Mengajukan Lamaran 1 Kali Per Periode',
					'exact_length' => '%s Terdiri Dari 16 Angka',

					)
				);
			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
			$this->form_validation->set_rules('email', 'email', 'required');
			if ($this->form_validation->run() === FALSE )
			{
				$data['error'] = validation_errors();


			} else 
			{

				$data['pelamar']['nama'] = $this->input->post('nama');
				$data['pelamar']['email'] = $this->input->post('email');
				$data['pelamar']['id_fakultas'] = $this->input->post('fakultas');
				$data['pelamar']['id_subbag'] = $this->input->post('subbag');
				$data['pelamar']['nik'] = $this->input->post('nik');
				$data['pelamar']['date_created'] = date('Y-m-d H:i:s');
				$uploadFileLamaran = $this->upload_file_lamaran($data['pelamar']['nik'], "file_lamaran");
				$uploadPhoto = $this->upload_photo($data['pelamar']['nik'], "file_photo");
				if (!isset($uploadFileLamaran['error']) && !isset($uploadPhoto['error'])  ) {
					$data['pelamar']['file_lamaran'] = $uploadFileLamaran['upload_data']['file_name'];
					$data['pelamar']['file_photo'] = $uploadPhoto['upload_data']['file_name'];
					$this->md_pelamar->setIdentitas($data['pelamar']['nik'], $data);
					$this->template->title('Pengajuan Sukses');
					$this->template->render('vw_pengajuan_sukses');
					return;
				} else 
				{
					$data['error'] .= $uploadFileLamaran['error'];
					$data['error'] .= $uploadPhoto['error'];
				}
			}


			$this->load->model('personalia/md_personalia');
			$last_pengaturan = $this->md_personalia->getLastPengaturan();
			$a =	array_column($last_pengaturan['detail_last_jabatan'], 'id_fakultas');
			$data['fakultas'] = $this->db->where_in('id_fakultas', $a)->get('mst_fakultas')->result_array();
			$this->template->css_add('assets/templates/inspinia_271/css/plugins/iCheck/custom.css');
			$this->template->css_add('assets/templates/inspinia_271/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css');
			$this->template->css_add('assets/templates/inspinia_271/css/plugins/jasny/jasny-bootstrap.min.css');
			$this->template->css_add('assets/plugins/jquery-file-upload/css/jquery.fileupload.css');
			$this->template->js_add('assets/templates/inspinia_271/js/plugins/jasny/jasny-bootstrap.min.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js');
			$this->template->js_add('assets/plugins/JavaScript-Load-Image/js/load-image.all.min.js');
			$this->template->js_add('assets/plugins/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.iframe-transport.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.fileupload.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.fileupload-image.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.fileupload-audio.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.fileupload-video.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.fileupload-validate.js');
			$this->template->js_add('assets/templates/inspinia_271/js/plugins/iCheck/icheck.min.js');
			$this->template->title('Pengajuan');
			$this->template->render('vw_pengajuan', $data);	


		}
		public function old_pengajuan()
		{	
			$data = '';	
			$data['nik'] = $this->input->get('nik');
			if ($this->user->login('pelamar', $data)) {
				redirect('pelamar', 'refresh');
			}

			$this->user->logout("pelamar");
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nik', 'NIK', 'required|max_length[16]|integer');
			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
			$this->form_validation->set_rules('email', 'email', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data['pelamar'] = $this->md_pelamar->getIdentitas($data['nik']);
			} else {
				$nik = $this->input->post('nik_hidden');
				$data['nik'] = $this->input->post('nik');
				$data['calon_pegawai']['nama'] = $this->input->post('nama');
				$data['calon_pegawai']['email'] = $this->input->post('email');
				$data['calon_pegawai']['formasi'] = $this->input->post('formasi');
				$data['calon_pegawai']['nik'] = $this->input->post('nik');
				$data['calon_pegawai']['date_created'] = date('Y-m-d H:i:s');
				$uploadFileLamaran = $this->upload_file_lamaran($nik, "file_lamaran");
				$uploadPhoto = $this->upload_photo($nik, "file_photo");
				if (!isset($uploadFileLamaran['error']) && !isset($uploadPhoto['error'])  ) {
					$data['calon_pegawai']['file_lamaran'] = $uploadFileLamaran['upload_data']['file_name'];
					$data['calon_pegawai']['file_photo'] = $uploadPhoto['upload_data']['file_name'];
					$this->md_pelamar->setIdentitas($nik, $data);
					$this->user->login('pelamar', $data);
					redirect('pelamar', 'refresh');
				}
			}
			$this->template->css_add('assets/templates/inspinia_271/css/plugins/iCheck/custom.css');
			$this->template->css_add('assets/templates/inspinia_271/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css');
			$this->template->css_add('assets/templates/inspinia_271/css/plugins/jasny/jasny-bootstrap.min.css');
			$this->template->css_add('assets/plugins/jquery-file-upload/css/jquery.fileupload.css');
			$this->template->js_add('assets/templates/inspinia_271/js/plugins/jasny/jasny-bootstrap.min.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js');
			$this->template->js_add('assets/plugins/JavaScript-Load-Image/js/load-image.all.min.js');
			$this->template->js_add('assets/plugins/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.iframe-transport.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.fileupload.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.fileupload-image.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.fileupload-audio.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.fileupload-video.js');
			$this->template->js_add('assets/plugins/jquery-file-upload/js/jquery.fileupload-validate.js');
			$this->template->js_add('assets/templates/inspinia_271/js/plugins/iCheck/icheck.min.js');
			$this->template->title('Pengajuan');
			$this->template->render('vw_pengajuan', $data);
		}
		private function upload_file_lamaran($nik, $filename)
		{
			$configFileLamaran['file_name'] = $nik . "_FILE_LAMARAN";
			$configFileLamaran['upload_path']          = './files/file_lamaran';
			$configFileLamaran['allowed_types']        = 'pdf';
			$configFileLamaran['overwrite']        = true;
			$this->upload->initialize($configFileLamaran);
			if ( ! $this->upload->do_upload($filename))
			{
				$data = array('error' => $this->upload->display_errors());
			}  else
			{
				$data = array('upload_data' => $this->upload->data());
			}
			return $data;
		}
		private function upload_photo($nik,$filename)
		{
			$configFilePhoto['file_name'] = $nik . "_PHOTO";
			$configFilePhoto['upload_path']          = './files/photo';
			$configFilePhoto['allowed_types']        = 'jpg|png';
			$configFilePhoto['overwrite']        = true;
			$this->upload->initialize($configFilePhoto);
			if ( ! $this->upload->do_upload($filename))
			{
				$data = array('error' => $this->upload->display_errors());
			}  else
			{
				$data = array('upload_data' => $this->upload->data());
			}
			return $data;
		}





		public function jsonSetLogUjian()
		{
			$pelamar = $this->session->userdata('pelamar');
			$logUjian = $this->md_pelamar->getLogUjian();
			$dataForm = $this->input->post();
			$newDataForm = array();
			foreach ($dataForm as $index => $value) {
				foreach ($value as $key => $v) {
					$newDataForm[$v['name']] = $v['value'];
				}
			}

			$log_jawaban = $logUjian['jawaban_dipilih'];
			$finalArray = array();
			if (isset($log_jawaban)) {

				$asArr = explode( ',', $log_jawaban );

				foreach( $asArr as $val ){
					$tmp = explode( '=', $val );
					$finalArray[ $tmp[0] ] = $tmp[1];
				}
			}

			$finalJawaban = $newDataForm + $finalArray;
			$finalJawaban = http_build_query($finalJawaban,'',',');
			$result = $this->db->update('log_ujian_akademik', array('jawaban_dipilih' => $finalJawaban), array('nik' => $pelamar['nik']));
			echo json_encode('OK');

		}

		public function ujian()
		{

			$this->load->model('personalia/md_personalia');
			$pengaturan = $this->md_personalia->getLastPengaturan();
			if ($this->input->post()) {
				$this->load->library('user');
				$data['nik'] = $this->input->post('nik');

				$isPelamarExist = $this->user->login('pelamar', $data);

			

				if ($isPelamarExist == 1) {
					$data_pelamar = $this->db->where('nik', $data['nik'])->get('pelamar')->row_array();
					if ($data_pelamar['status'] != 1) {
						$this->session->set_flashdata('error', 'Anda Tidak Berhak Mengikuti Ujian');
						
					} else
					{

						redirect('pelamar/ujianAkademik','refresh');
					}

				} else {

					$this->session->set_flashdata('error', 'NIK Tidak Ada Pada Database');
				}
			}


			$this->template->title('Ujian Akademik');

			$now = date('Y-m-d H:i:s');
			if ($now < $pengaturan['konfig_periode']['full_ujian_akademik']) {
				$this->template->render('vw_countdown_ujian');
			} else
			{
				$this->template->render('vw_dashboard_ujian');

			}
		}

		public function dummy()
		{
			$w = $this->md_pelamar->getLogUjian();
			print_r($w);
			exit;
			
		}
		public function ujianAkademik()
		{


			if (!$this->user->logged_in('pelamar')) {
				redirect('pelamar/ujian','refresh');
			}

			$pelamar = $this->user->get_data('pelamar');

			$data_pelamar = $this->db->where('nik', $pelamar['nik'])->get('pelamar')->row_array();
			if ($data_pelamar['status'] != 1) {
				show_404();
			}
			$this->load->model('personalia/md_personalia');
			$data['pengaturan'] = $this->md_personalia->getLastPengaturan();

			$log_ujian = $this->md_pelamar->getLogUjian();


			if ($this->input->post('selesai')) {

				$selesai = $this->md_pelamar->setSelesaiUjian();
				echo json_encode($selesai);
				exit;

			} else

			if ($log_ujian) {
				if ($log_ujian['status'] === 'Y') {
					$this->user->logout("pelamar");
					$this->template->title('Selesai Ujian Akademik');
					$this->template->render('vw_selesai_ujian');
					return;
				} 
			} else
			{

				$list_matpel = $this->md_pelamar->getKumpulanSoal();
				$id_random_matpel = implode(',', array_map(create_function('$a', 'return $a["id_pelajaran"];'), $list_matpel)); 
				$config['nik'] = $pelamar['nik'];
				$config['list_matpel'] = $id_random_matpel;
				$config['waktu_mulai'] = date("Y-m-d H:i:s");
				$this->db->insert('log_ujian_akademik', $config);
				$log_ujian = $this->md_pelamar->getLogUjian();

			}


			$list_matpel = explode(',', $log_ujian['list_matpel']);

			$this->load->library('pagination');

			$config['base_url'] = base_url('pelamar/ujianAkademik/');
			$config['total_rows'] = count($list_matpel);
			$config['per_page'] = 1;
			$config['uri_segment'] = 3;
			$config['num_links'] = 5;
			$config['full_tag_open'] = '<nav><ul class="pagination" style="margin-top:0px">';
			$config['full_tag_close'] = "</ul></nav>";
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = 'Selanjutnya';
			$config['next_tag_open'] = '<li class="save">';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = 'Sebelumnya';
			$config['prev_tag_open'] = '<li class="save">';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['display_pages'] = FALSE;

			$this->pagination->initialize($config);

			$index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;
			$data['matpel'] = $this->db->select('*')->where('id_pelajaran', $list_matpel[$index])->get('mst_pelajaran_akademik')->row_array();
			$data['kumpulan_soal'] = $this->db->select('*')->where('id_pelajaran', $list_matpel[$index])->get('soal_ujian_akademik')->result_array();
			$data['waktu_selesai'] =  date('Y-m-d H:i',strtotime("+{$data['pengaturan']['konfig_umum']['durasi_ujian_akademik']} minutes",strtotime($data['pengaturan']['konfig_periode']['tanggal_ujian_akademik'] . ' ' . $data['pengaturan']['konfig_periode']['waktu_ujian_akademik'])));

			$data['current_date'] = date('Y-m-d H:i:s');
			$data['log_pilihan'] = $this->md_pelamar->getLogPilihan();
			$this->template->title('Ujian Akademik');
			$this->template->js_add('assets/plugins/jquery.countdown/jquery.countdown.min.js');
			$this->template->css_add('assets/templates/inspinia_271/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css');
			$this->template->render('vw_ujian_akademik', $data);
		}
		public function logout()
		{
			$this->user->logout("pelamar");
			redirect('welcome');
		}



	}
	/* End of file pelamar.php */
/* Location: ./application/modules/pelamar/controllers/pelamar.php */