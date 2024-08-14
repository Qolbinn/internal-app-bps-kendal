<script type="text/javascript">
function user_editin(nip,nama,sso,lev,blok,email,user){
		$('#user-editin').modal('show');
		
		document.getElementById('editin-nip').value 		= nip;
		document.getElementById('editin-nama').value 		= nama;
		if(sso === "1"){
			document.getElementById('editin-sso').checked 	= true;
		}
		if(lev !== ""){
			document.getElementById('editin-level').value 	= lev;
		}
		if(blok !== ""){
			document.getElementById('editin-blokir').value 	= blok;
		}
		document.getElementById('editin-email').value 		= email;
		if(user!=="")
			document.getElementById('editin-username').disabled= true;
		document.getElementById('editin-username').value 	= user;
	};

function user_editek(nip,nama,blok,jab,email,user){
		$('#user-editek').modal('show');
		
		document.getElementById('editek-nip').value 		= nip;
		document.getElementById('editek-nama').value 		= nama;
		if(blok !== ""){
			document.getElementById('editek-blokir').value = blok;
		}
		document.getElementById('editek-jabfung').value 	= jab;
		document.getElementById('editek-email').value 		= email;
		if(user!=="")
			document.getElementById('editek-username').disabled= true;
		document.getElementById('editek-username').value 	= user;
	};
</script>
<?php	
	
	
	if ($_SESSION['level'][$aplikasi]=='admin'){
	  $query_view	= mysqli_query($con, "SELECT * FROM `pegawai_user` WHERE ".$kondisi." order by kode_wil, nama");
	}
	else if ($_SESSION['level'][$aplikasi]=='adminkab'){
	  $query_view	= mysqli_query($con, "SELECT * FROM `pegawai_user` WHERE ".$kondisi." and kode_wil = '33".$_SESSION['satker']."' order by kode_wil, nama");
	}
	else{
	  $query_view	= mysqli_query($con, "SELECT * FROM `pegawai_user` WHERE nip = '".$_SESSION['nip']."' order by kode_wil, nama");
	}
	
	echo "<table class='table table-bordered table-striped' id='dataTable' width='100%' cellspacing='0'><thead>
		  <tr style='background-color: #4fadfd;'>
		  <td class='left' width='10%'>nip</td>
		  <td class='left' width='30%'>nama</td>
		  <td class='left'>Satker</td>
		  <td class='left'>Login SSO</td>
		  <td class='center'>Level ".ucfirst($aplikasi)."</td>
		  <td class='center'>Blokir</td>
		  <td class='center'>aksi</td>
		  </tr></thead> "; 
	$no=1;
	while ($r_view = mysqli_fetch_array($query_view)){
		if($r_view['kode_wil']<>"3399"){
			$wil		= $arr_satker[$r_view['kode_wil']];
		}
		else
			$wil		= $r_view['satker'];
		
		if($_SESSION['level'][$aplikasi]=='admin' || $_SESSION['level'][$aplikasi]=='adminkab'){
			$lev		= $r_view['pegawai_level'];
			$blok		= $r_view['blokir'];
		}
		else{
			$lev		= "";
			$blok		= "";
		}
		
		echo "<tr><td class='left' width='25'>".$r_view['nip']."</td>
			<td class='left'>".$r_view['nama']."</td>
			<td class='left'>".$wil."</td>
			<td class='left'>".$r_view['sso']."</td>
			<td class='center'>".$r_view['pegawai_level']."</td>
			<td class='center'>".$r_view['blokir']."</td>
			<td class='center' width='8%' style='text-align:center;'>";
		if($_SESSION['level'][$aplikasi]=='admin' && $r_view['flag']=='1' && $r_view['asal']=='eksternal'){
			echo "<button title='Aktifkan Pengguna' class='btn btn-primary' data-toggle='modal' data-target='#confirm-aktif-".$r_view['nip']."'><span class='fa fa-user-tie'></button> ";
		}
		else if($r_view['flag']=='2' && $r_view['asal']=='eksternal'){
			echo "menunggu email";
		}
		else if($r_view['flag']=='0'){
			if($r_view['asal']=="internal")
				echo "<a href='#' class='btn btn-primary' title='Edit Pengguna' onClick=\"user_editin('".$r_view['nip']."', '".$r_view['nama']."', '".$r_view['sso']."', '".$lev."', '".$blok."', '".$r_view['email']."', '".$r_view['username']."')\"><i class='icon-item fas fa-edit'></i></a>";
			else
				echo "<a href='#' class='btn btn-primary' title='Edit Pengguna' onClick=\"user_editek('".$r_view['nip']."', '".$r_view['nama']."', '".$blok."', '".$r_view['jenis_jab']."', '".$r_view['email']."', '".$r_view['username']."')\"><i class='icon-item fas fa-edit'></i></a>";
		}
		
		echo "</td></tr>";
		?>
		<!--Modal------------------------------------------------------------------------------------->
		<div class="modal fade" id="confirm-aktif-<?php echo $r_view['nip']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Konfirmasi Aktivasi Pengguna Eksternal</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<form method=POST action='?module=<?php echo $_GET['module']; ?>&act=<?php echo $_GET['act']; ?>' enctype='multipart/form-data'>
					<div class="modal-body">
						<input type=hidden name=proses value=aktif>
						<input type=hidden name=nip value=<?php echo $r_view['nip']; ?>>
						<input type=hidden name=asal value=<?php echo $asal; ?>>
						<input type=hidden name=blokir value=<?php echo $blokir; ?>>
						<p>Pengguna yang akan diaktifkan :<br></p>
						<ol>
							<li>Nama : <?php echo $r_view[nama]; ?></li>
							<li>Satker : <?php echo $r_view[satker]; ?></li>
							<li>Username : <?php echo $r_view[username]; ?></li>
						</ol>
						<p>Link Aktivasi akan dikirimkan melalui email ke alamat email pengguna di <b><?php echo $r_view['email']; ?></b>.</p>
						<p>Ingin dilanjutkan?</p>
						<p class="debug-url"></p>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button class='btn btn-primary' type=submit class="btn btn-danger btn-ok">Aktifkan</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		<!--------------------------------------------------------------------------------------------->
		<?php
	  $no++;
	}
	echo "</table>";
?>
<!-- Modal-->
	<div class="modal fade" id="user-editin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Edit User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<form method=POST action='?module=<?php echo $_GET['module']; ?>&act=<?php echo $_GET['act']; ?>' enctype='multipart/form-data'>
				<div class="modal-body">
					<input type=hidden name=proses value=edit>
					<input type=hidden id='editin-nip' name='nip' value=''>
				<?php
					echo "<P>";
					echo "<b>Nama :</b><br><input type=text id='editin-nama' name='nama' value='' style='width: 90%; line-height: 0px; border: 1px solid #dddddd; padding: 10px;' disabled><br>";
					if($_SESSION['level'][$aplikasi]=='admin' || $_SESSION['level'][$aplikasi]=='adminkab'){
						echo "<label><b>Login SSO :</b></label><input type='checkbox' id='editin-sso' name='sso' value='1'><br>";
						echo "<b>Level ".ucfirst($aplikasi).":</b> <br><select name='level' id='editin-level' class='form-control select2' style='width: 90%; line-height: 0px;'><option value=''>-pilih-</option>";
						$no	= count($arraylevel);
						$co	= 0;
						foreach ($arraylevel as $level) {
							if($_SESSION['level'][$aplikasi]==$level){
								$co	= $no;
							}
							echo "<option value='".$level."'>".$level."</option>";
							$no	= $no-1;
						}
						echo "</select>";
						
						echo "<b>Blokir :</b> <br><select name='blokir' id='editin-blokir' class='form-control select2' style='width: 90%; line-height: 0px;'>";
						echo "<option value=''>-pilih-</option>";
						echo "<option value='Y' >Ya</option>";
						echo "<option value='N' >Tidak</option>";
						echo "</select>";
					}
					echo "<b>Email :</b><br><input type=text id='editin-email' name='email' value='' style='width: 92%; line-height: 0px; border: 1px solid #dddddd; padding: 10px;'><br>";
					echo "<b>Username :</b><br><input type=text id='editin-username' name='username' value='' style='width: 92%; line-height: 0px; border: 1px solid #dddddd; padding: 10px;'><br>";
					echo "<b>Password :</b><br><input type=password name='password' value='' style='width: 92%; line-height: 0px; border: 1px solid #dddddd; padding: 10px;'> *) <br>";
					echo "<br><small><i>*) Apabila password tidak diubah, dikosongkan saja.</i></small></P>";
				?>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button class='btn btn-primary' type=submit class="btn btn-danger btn-ok">Edit</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="user-editek" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Edit User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<form method=POST action='?module=<?php echo $_GET['module']; ?>&act=<?php echo $_GET['act']; ?>' enctype='multipart/form-data'>
				<div class="modal-body">
					<input type=hidden name=proses value=edit>
					<input type=hidden id='editek-nip' name='nip' value=''>
				<?php
					echo "<P>";
					echo "<b>Nama :</b><br><input type=text id='editek-nama' name='nama' value='' style='width: 90%; line-height: 0px; border: 1px solid #dddddd; padding: 10px;' disabled><br>";
					if($_SESSION['level'][$aplikasi]=='admin' || $_SESSION['level'][$aplikasi]=='adminkab'){
						echo "<b>Blokir :</b> <br><select name='blokir' id='editek-blokir' class='form-control select2' style='width: 90%; line-height: 0px;'>";
						echo "<option value=''>-pilih-</option>";
						echo "<option value='Y' >Ya</option>";
						echo "<option value='N' >Tidak</option>";
						echo "</select>";
					}
					echo "<b>JabFung Saat Ini :</b><br>";
					echo "<select name='jenis_jab' id='editek-jabfung' class='form-control select2' style='width: 90%; line-height: 0px;'>";
					$i			= 0;
					while($i <= $n){
						echo "<option value= '".$arr_kodejf[$i]."'>".$arr_namajf[$i]."</option>";
						$i = $i+1;
					}
					echo "</select>";
					
					echo "<b>Email :</b><br><input type=text id='editek-email' name='email' value='' style='width: 92%; line-height: 0px; border: 1px solid #dddddd; padding: 10px;' disabled><br>";
					echo "<b>Username :</b><br><input type=text id='editek-username' name='username' value='' style='width: 92%; line-height: 0px; border: 1px solid #dddddd; padding: 10px;'><br>";
					echo "<b>Password :</b><br><input type=password name='password' value='' style='width: 92%; line-height: 0px; border: 1px solid #dddddd; padding: 10px;'> *) <br>";
					echo "<br><small><i>*) Apabila password tidak diubah, dikosongkan saja.</i></small></P>";
				?>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button class='btn btn-primary' type=submit class="btn btn-danger btn-ok">Edit</button>
				</div>
				</form>
			</div>
		</div>
	</div>