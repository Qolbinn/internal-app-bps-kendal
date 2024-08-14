<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

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

        $this->load->model('dashboard_model', 'dashboard');
        //$this->load->library('Pdf');
    }
	
	public function index()
	{
		//Data Awal
		$data 			= $this->data;
		$data['modul']	= "dashboard";
		$data['act']	= "";
		
		//Masukkan Script Tambahan
		
		//Memanggil view
		$this->load->view('frame', $data);
	}
}
