<?php
//variabel global
$this->data = array(
            'satker' => "kabupaten", 					//isikan provinsi atau kabupaten
            'kantor' => "Badan Pusat Statistik",
            'lokasi' => "Kab Kendal",					//isikan lokasi kantor
			'tahun'	=> date('Y'),						
			'bulan'	=> date('m'),					//isikan kode unit pada POK
			'tempat' => "Kendal",						//isikan kota tempat kantor berada
			'ar_bulan' => explode(" ","Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember"),
			'ar_bulan2'	=> explode(" ","Jan Feb Mar Apr Mei Jun Jul Agst Sept Okt Nov Des"),
			'ar_twa' => explode(" ","01-02-03 04-05-06 07-08-09 10-11-12"),
			'ar_twb' => explode(" ","JAN-FEB-MAR APR-MEI-JUN JUL-AGUS-SEPT OKT-NOV-DES"),	
			'aplikasi' => "sakip",	
			'ar_level' => explode(" ","admin adminkab operator"),			//level aplikasi
			'ar_akses' => explode(" ","all adminkab-operator operator")		//level aplikasi
        );	
?>