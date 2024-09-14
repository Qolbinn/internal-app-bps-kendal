<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kegiatan extends CI_Controller
{

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		include FCPATH . '/config/variabel.php';

		$_SESSION['username'] 		= "Angga";
		$_SESSION['foto']     		= "dist/img/foto/nofoto.jpg";
		$_SESSION['nama']    	 	= "Angga Al Refai P";
		$_SESSION['nip']  			= "198710102010121008";
		$_SESSION['satker']       	= "24";
		$_SESSION['wil']  			= "";
		$_SESSION['foto']    	  	= "dist/img/foto/nofoto.jpg";
		$_SESSION['email']    		= "alrefai";
		$_SESSION['level'][$this->data['aplikasi']] = 'admin';
		$_SESSION['jabfung']		= "prakom";

		$this->load->model('kegiatan_model', 'kegiatan');
		$this->load->model('Bidang_model', 'bidang');
		$this->load->model('Tim_model', 'tim');
		$this->load->model('Proyek_model', 'proyek');
		$this->load->model('KegiatanProyek_model', 'kegiatan_proyek');
		$this->load->model('Pekerjaan_model', 'pekerjaan');
		$this->load->model('UserRole_model', 'user_role');
		$this->load->model('User_model', 'user');
		$this->load->model('MasterProyek_model', 'master_proyek');
		$this->load->model('MasterKegiatan_model', 'master_kegiatan');
		$this->load->model('MasterSatuan_model', 'master_satuan');
		$this->load->model('IndikatorKinerja_model', 'indikator_kinerja');
	}

	public function load_table()
	{
		if ($this->input->is_ajax_request()) {
			$konten_tabel = $this->input->post('konten_tabel');

			// Tentukan view yang akan dimuat berdasarkan konten_tabel
			switch ($konten_tabel) {
				case "proyek":
					$this->load->view('modul/kegiatan/proyek-table');
					break;
				case "kegiatan":
					$this->load->view('modul/kegiatan/kegiatan-table');
					break;
				case "pekerjaan":
					$this->load->view('modul/kegiatan/pekerjaan-table');
					break;
				default:
					$this->load->view('modul/kegiatan/proyek-table');
					break;
			}
		} else {
			show_error('Akses tidak diizinkan', 403);
		}
	}

	// public function index($nama_fungsi)
	// {
	// 	//Data Awal
	// 	$data 			= $this->data;
	// 	$data['modul']	= "kegiatan";	//controller
	// 	$data['act']	= $nama_fungsi; //functions
	// 	$id_bidang = $this->bidang->get_id_by_name($nama_fungsi);
	// 	$data['dt_tim'] = $this->tim->get_by_bidang($id_bidang);
	// 	$data['dt_proyek'] = $this->proyek->get_data();
	// 	$data['bidang'] = $nama_fungsi;

	// 	//Masukkan Script Tambahan
	// 	$data[$nama_fungsi]	= $this->kegiatan->get_menu($this->data['aplikasi'], "");

	// 	// Periksa apakah ada data tim_selected di session
	// 	$tim_selected = $this->session->flashdata('tim_selected');
	// 	if ($tim_selected) {
	// 		$data['tim_selected'] = $tim_selected;
	// 	}

	// 	// Menyimpan nama fungsi untuk redirect di session
	// 	$this->session->set_flashdata('current_function', $nama_fungsi);

	// 	//Memanggil view
	// 	$this->load->view('frame', $data);
	// }

	public function index($nama_fungsi)
	{
		$nama_tim = $this->input->get('nama_tim', TRUE);

		// Data Awal
		$data = $this->data;
		$data['modul'] = "kegiatan"; //controller
		$data['act'] = $nama_fungsi; //functions
		$id_bidang = $this->bidang->get_id_by_name($nama_fungsi);
		$data['dt_tim'] = $this->tim->get_by_bidang($id_bidang);
		$data['bidang'] = $nama_fungsi;

		// Jika ada parameter nama_tim
		if ($nama_tim) {
			$tim_selected = $this->tim->get_by_name(urldecode($nama_tim));
			$id_tim = $tim_selected->id;
			$data['tim_selected'] = $tim_selected;
			$data['ketua_tim'] = $this->user_role->get_ketua_tim($id_tim);
			$data['anggota_tim'] = $this->user_role->get_list_anggota_tim($id_tim);
			$data['new_anggota'] = $this->user_role->get_list_non_anggota_tim($id_tim);
			$data['pegawai'] = $this->user->get_data();
			$data['master_proyek'] = $this->master_proyek->get_data_by_bidang($nama_fungsi);
			$data['master_kegiatan'] = $this->master_kegiatan->get_data();
			$data['master_satuan'] = $this->master_satuan->get_data();
			$data['indikator_kinerja'] = $this->indikator_kinerja->get_data();
			$data['dt_proyek'] = $this->proyek->get_proyek_tim($id_tim);

			$this->session->set_userdata([
				'anggota_tim' => $data['anggota_tim'],
				'master_kegiatan' => $data['master_kegiatan'],
				'master_satuan' => $data['master_satuan']
			]);
		}

		// Masukkan Script Tambahan
		$data[$nama_fungsi] = $this->kegiatan->get_menu($this->data['aplikasi'], "");

		// Memanggil view
		$this->load->view('frame', $data);
	}

	public function get_kegiatan_by_proyek()
	{
		if ($this->input->is_ajax_request()) {
			$id_proyek = $this->input->post('id_proyek');

			// Fetch kegiatan based on id_proyek
			// $this->session->set_userdata('id_proyek_selected', $id_proyek);
			$data['id_proyek_selected'] = $id_proyek;
			$data['dt_kegiatan'] = $this->kegiatan_proyek->get_kegiatan_by_proyek($id_proyek);
			$data['indikator_kinerja'] = $this->indikator_kinerja->get_data();

			// Load the view and send the data
			$this->load->view('modul/kegiatan/kegiatan-table', $data);
			// echo json_encode($dt_kegiatan);
		} else {
			show_error('Akses tidak diizinkan', 403);
		}
	}



	public function get_pekerjaan_by_kegiatan()
	{
		if ($this->input->is_ajax_request()) {
			$id_kegiatan = $this->input->post('id_kegiatan');

			// Fetch kegiatan based on id_proyek
			$data['id_kegiatan_selected'] = $id_kegiatan;
			$data['dt_pekerjaan'] = $this->pekerjaan->get_pekerjaan_by_kegiatan($id_kegiatan);

			// Load the view and send the data
			$this->load->view('modul/kegiatan/pekerjaan-table', $data);
		} else {
			show_error('Akses tidak diizinkan', 403);
		}
	}

	public function get_selected_tim()
	{
		$id_tim = $this->input->post('id_tim');

		// Ambil data tim berdasarkan id_tim
		$tim_selected = $this->tim->get_data($id_tim);
		$this->session->set_flashdata('tim_selected', $tim_selected);

		// Redirect kembali ke method index untuk memuat view dengan data baru
		redirect('kegiatan/index/' . $this->session->flashdata('current_function'));
	}
}
