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

	public function index($nama_fungsi)
	{
		//Data Awal
		$data 			= $this->data;
		$data['modul']	= "kegiatan";	//controller
		$data['act']	= $nama_fungsi; //functions
		$id_bidang = $this->bidang->get_id_by_name($nama_fungsi);
		$data['dt_tim'] = $this->tim->get_by_bidang($id_bidang);

		// latihan
		$data['dt_proyek'] = $this->proyek->get_data();

		//Masukkan Script Tambahan
		$data[$nama_fungsi]	= $this->kegiatan->get_menu($this->data['aplikasi'], "");

		//Memanggil view
		$this->load->view('frame', $data);
	}

	public function get_kegiatan_by_proyek()
	{
		if ($this->input->is_ajax_request()) {
			$id_proyek = $this->input->post('id_proyek');

			// Fetch kegiatan based on id_proyek
			$data['dt_kegiatan'] = $this->kegiatan_proyek->get_kegiatan_by_proyek($id_proyek);

			// Load the view and send the data
			$this->load->view('modul/kegiatan/kegiatan-table', $data);
		} else {
			show_error('Akses tidak diizinkan', 403);
		}
	}

	public function get_pekerjaan_by_kegiatan()
	{
		if ($this->input->is_ajax_request()) {
			$id_kegiatan = $this->input->post('id_kegiatan');

			// Fetch kegiatan based on id_proyek
			$data['dt_pekerjaan'] = $this->pekerjaan->get_pekerjaan_by_kegiatan($id_kegiatan);

			// Load the view and send the data
			$this->load->view('modul/kegiatan/pekerjaan-table', $data);
		} else {
			show_error('Akses tidak diizinkan', 403);
		}
	}
}
