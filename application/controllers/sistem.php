<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sistem extends CI_Controller {

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

        $this->load->model('sistem_model', 'sistem');
    }
	
	public function user()
	{
		//Data Awal
		$data 			= $this->data;
		$data['modul']	= "sistem";	//controller
		$data['act']	= "user"; //function
		
		//Masukkan Script Tambahan
		require FCPATH . 'plugins/PHPMailer-master/src/Exception.php';
		require FCPATH . 'plugins/PHPMailer-master/src/PHPMailer.php';
		require FCPATH . 'plugins/PHPMailer-master/src/SMTP.php';
		
		if($this->input->post('nip') !== null)
			$data['nip']		= str_replace(" ","",$this->input->post('nip'));
		if($this->input->post('password') !== null)
			$data['password']	= str_replace(" ","",$this->input->post('password'));
		
		if($this->input->post('asal') !== null)
			$data['asal']		= $this->input->post('asal');
		else
			$data['asal']		= "internal";
		
		
		if($this->input->post('blokir') !== null)
			$blokir		= $this->input->post('blokir');
		else
			$blokir		= "Y";
		
		if($data['asal']=="internal")
			$kondisi = "asal = '".$data['asal']."'";
		else
			$kondisi = "asal = '".$data['asal']."' and blokir = '".$blokir."'";

		//Memanggil view
		$this->load->view('frame', $data);
	}
	
	public function mainmenu()
	{
		//Data Awal
		$data 			= $this->data;
		$data['modul']	= "sistem";	//controller
		$data['act']	= "mainmenu"; //function
		
		//Masukkan Script Tambahan
		$data['mainmenu']	= $this->sistem->get_menu($this->data['aplikasi'], "");
		
		//Memanggil view
		$this->load->view('frame', $data);
	}
	
	public function submenu()
	{
		//Data Awal
		$data 			= $this->data;
		$data['modul']	= "sistem";	//controller
		$data['act']	= "submenu"; //function
		
		//Masukkan Script Tambahan
		
		//Memanggil view
		$this->load->view('frame', $data);
	}
}
