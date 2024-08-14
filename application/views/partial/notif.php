<?php
$data	= explode("&", $w[link_sub]);
$moduls	= substr($data[0],8,strlen($data[0]));
$acts	= substr($data[1],4,strlen($data[0]));

$nilai	= "";
if($_SESSION['level'][$aplikasi]=="admin" && $moduls=="sistem" && $acts =="user"){
	$query	= mysqli_query($con, "SELECT count(nip) as banyak FROM pegawai_user WHERE `asal` = 'eksternal' and `flag` = '1'");
	$hasil	= mysqli_fetch_array($query);
	$nilai	= $hasil['banyak'];
}
else if($moduls=="pegawai" && $acts =="usul"){
	if($_SESSION['level'][$aplikasi]=="admin")
		$query	= mysqli_query($con, "SELECT count(id) as banyak FROM pegawai_usul where status = '1' or status = '3'");
	else
		$query	= mysqli_query($con, "SELECT count(id) as banyak FROM pegawai_usul where (status > '0' and status < '4') and nip_baru = '".$_SESSION['nip']."'");
	$hasil	= mysqli_fetch_array($query);
	$nilai	= $hasil['banyak'];
}

/*
else if($moduls=="surat" && $acts =="apprbid"){
	if($_SESSION['level'][$aplikasi]=="admin")
		$query	= mysqli_query($con, "SELECT count(id) as banyak FROM surat_usul where year(tgl_buat) = '".date('Y')."' and status = '1' order by status, tgl_buat");
	else if($_SESSION['level'][$aplikasi]=="kpa")
		$query	= mysqli_query($con, "SELECT count(id) as banyak FROM surat_usul where year(tgl_buat) = '".date('Y')."' and status = '1' and kode_sat <> '00' order by status, tgl_buat");
	else
		$query	= mysqli_query($con, "SELECT count(id) as banyak FROM surat_usul where year(tgl_buat) = '".date('Y')."' and status = '1' and kode_sat = '".$_SESSION['satker']."' and kode_bag like '".substr($_SESSION['bagian'],0,1)."%' order by status, tgl_buat");
	$hasil	= mysqli_fetch_array($query);
	$nilai	= $hasil['banyak'];
}
else if($moduls=="surat" && $acts =="apprkpa"){
	if(strlen($_SESSION['level'][$aplikasi])==4 && substr($_SESSION['level'][$aplikasi],0,3)=="ppk")
		$query	= mysqli_query($con, "select count(id) as banyak FROM surat_usul where year(tgl_buat) = '".date('Y')."' and status = '2' and (case when `kdprogram` = 'GG' and (`kdkeg`='2897' or `kdkeg`='2900' or `kdkeg`='2904' or `kdkeg`='2909' or `kdkeg`='2910') then 'ppk5' when `kdprogram` = 'GG' and (`kdkeg`='2896' or `kdkeg`='2898' or `kdkeg`='2899' or `kdkeg`='2901' or `kdkeg`='2902' or `kdkeg`='2903' or `kdkeg`='2905' or `kdkeg`='2906' or `kdkeg`='2907' or `kdkeg`='2908') then 'ppk6' when `kdprogram` = 'WA' and `kdkeg`='2886' and `kdout`='EBA' and `kdrout`='994' and `kdkomp`='002' then 'ppk3' else 'ppk4' end) = '".$_SESSION['level'][$aplikasi]."' order by status, tgl_buat");
	/*	
	if($_SESSION['level'][$aplikasi]=="ppk1")
		$query	= mysqli_query($con, "SELECT count(id) as banyak FROM surat_usul where year(tgl_buat) = '".date('Y')."' and status = '2' and (kdprogram = '01' or kdprogram = 'WA') order by status, tgl_buat");
	else if($_SESSION['level'][$aplikasi]=="ppk2")
		$query	= mysqli_query($con, "SELECT count(id) as banyak FROM surat_usul where year(tgl_buat) = '".date('Y')."' and status = '2' and kdprogram <> '01' and kdprogram <> 'WA' order by status, tgl_buat");
	else if($_SESSION['level'][$aplikasi]=="ppk1")
		$query	= mysqli_query($con, "SELECT count(id) as banyak FROM surat_usul where year(tgl_buat) = '".date('Y')."' and status = '2' and kdprogram <> '01' and kdprogram <> 'WA' order by status, tgl_buat");
	/
	else
		$query	= mysqli_query($con, "SELECT count(id) as banyak FROM surat_usul where year(tgl_buat) = '".date('Y')."' and status = '2' order by status, tgl_buat");
	$hasil	= mysqli_fetch_array($query);
	$nilai	= $hasil['banyak'];
}
else if($moduls=="surat" && $acts =="memo"){
	$query	= mysqli_query($con, "SELECT count(id) as banyak FROM surat_usul where year(tgl_buat) = '".date('Y')."' and status = '3' order by status, tgl_buat");
	$hasil	= mysqli_fetch_array($query);
	$nilai	= $hasil['banyak'];
}
else if($moduls=="surat" && $acts =="apprstu"){
	$query	= mysqli_query($con, "SELECT count(id) as banyak FROM surat_usul where year(tgl_buat) = '".date('Y')."' and status = '4' order by status, tgl_buat");
	$hasil	= mysqli_fetch_array($query);
	$nilai	= $hasil['banyak'];
}
else if($moduls=="surat" && $acts =="spd"){
	$query	= mysqli_query($con, "SELECT count(id) as banyak FROM surat_usul where year(tgl_buat) = '".date('Y')."' and status = '7' and status_spd = '0' and kdakun <>''");
	$hasil	= mysqli_fetch_array($query);
	$nilai	= $hasil['banyak'];
}*/
?>