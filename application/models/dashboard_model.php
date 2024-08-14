<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');

class dashboard_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
    }
	
	public function get_menu_ini($aplikasi, $modul, $act)
    {
		$datah	= array();
		
		//$kondisi= "?module=".$modul;
		$kondisi= $modul."/";
		if($act <> ""){
			//$kondisi		= $kondisi."&act=".$act;
			$kondisi		= $kondisi.$act;
		}
		
		if($modul=="home" || empty($modul)){
			$datah['menu']	= "Dashboard";
			$datah['level']	= "";
		}
		else{
			if(!empty($this->$modul->get_menu($aplikasi, "link = '".$kondisi."'"))){
                $datas 	= $this->$modul->get_menu($aplikasi, "link = '".$kondisi."'");
				foreach ($datas as $item){
					$datah['menu']	= $item->nama_menu;
					$datah['level']	= $item->level;
				}
            }else{
				if(!empty($this->$modul->get_submenu($aplikasi, "link_sub = '".$kondisi."'"))){
					$datas 	= $this->$modul->get_submenu($aplikasi, "link_sub = '".$kondisi."'");
					foreach ($datas as $item){
						$datah['menu']	= $item->nama_sub;
						$datah['level']	= $item->level;
					}
				}else{
					if(!empty($this->$modul->get_submenu($aplikasi, "link_sub = '".$modul."'"))){
						$datas 	= $this->$modul->get_submenu($aplikasi, "link_sub = '".$modul."'");
						foreach ($datas as $item){
							$datah['menu']	= $item->nama_sub;
							$datah['level']	= $item->level;
						}
					}else{
						$datah['menu']	= $act;
						$datah['level']	= "";
					}
				}
            }
		}
		return $datah;
    }
	
	public function get_menu($aplikasi, $kondisi)
    {
		$tabel	= $aplikasi."_mainmenu";
		$this->db->select("*");
        $this->db->from($tabel);
        if($kondisi<>"")
			$this->db->where($kondisi);
        return $this->db->get()->result();
	}
	
	public function get_submenu($aplikasi, $kondisi)
    {
		$tabel	= $aplikasi."_submenu";
		$this->db->select("*");
        $this->db->from($tabel);
        if($kondisi<>"")
			$this->db->where($kondisi);
        return $this->db->get()->result();
	}
}
?>