<style type="text/css">
	table{
	  width:100%;
	  table-layout: fixed;
	}
	.table-bordered th{
	  padding: 10px 10px;
	  text-align: center;
	  vertical-align:middle;
	  text-transform: uppercase;
	  font-size: 11px;
	}
	.table-bordered td{
	  text-align: left;
	  vertical-align:middle;
	  border-bottom: solid 1px rgba(255,255,255,0.1);
	  font-size: 12px;
	  padding: 5px;
	}
	
	.center{
		text-align: center;
		vertical-align:middle;
	}
	
	.tomb{
		text-align: center;
		font-size: 10px;
	}
</style>

<?php
	echo '<input class="btn btn-primary" value="Tambah Menu Utama" data-toggle="modal" data-target="#tambah-utama">';
	echo '<table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0"><thead>
		<tr style="background-color: #4fadfd;">
			<td class="center" width="25px">no</td>
			<td class="center">menu utama</td>
			<td class="left">link</td>
			<td class="center">aktif</td>
			<td class="center">level</td>
			<td class="center" width="100px" >aksi</td>
		</tr></thead><tbody>';
	
	$no = 1;
	foreach ($mainmenu as $item){
		echo '<tr>
				<td class="center">'.$no.'</td>
				<td class="left">'.$item->nama_menu.'</td>
				<td class="left">'.$item->link.'</td>
				<td class="center">'.$item->aktif.'</td>
				<td class="center">'.$item->level.'</td>
				<td class="center"style="text-align:center;">
					<button title="Edit Menu Utama" class="btn btn-primary tomb" data-toggle="modal" data-target="#confirm-edit-'.$item->id_main.'"><span class="fa fa-edit"></button>
					<button title="Hapus Menu Utama" class="btn btn-primary tomb" data-toggle="modal" data-target="#confirm-hapus-'.$item->id_main.'"><span class="fa fa-trash"></button>
			 </td></tr>';
		?>
		<!--Modal------------------------------------------------------------------------------------->
		<div class="modal fade" id="confirm-hapus-<?php echo $item->id_main; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus Menu Utama</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<form id="myForm2" method="GET" action="<?php echo base_url().$modul.'/'.$act;?>">
					<div class="modal-body">
						<input type=hidden name=proses value=hapus>
						<input type=hidden name=id value=<?php echo $item->id_main; ?>>
						<p>Apakah anda akan menghapus menu <b><?php echo $item->nama_menu; ?></b>.</p>
						<p>Ingin dilanjutkan?</p>
						<p class="debug-url"></p>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button class='btn btn-primary' type=submit class="btn btn-danger btn-ok">Hapus</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		<div class="modal fade" id="confirm-edit-<?php echo $item->id_main; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">Edit Menu Utama</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<form id="myForm2" method="GET" action="<?php echo base_url().$modul.'/'.$act;?>">
					<div class="modal-body">
					<?php
						echo '<input type="hidden" name="proses" value="edit">
							  <input type="hidden" name="id" value="'.$item->id_main.'">';
						echo '<P>';
						echo '<b>Nama Menu :</b><br><input type=text name="nama_menu" value="'.$item->nama_menu.'"><br>
							  <b>Link :</b><br><input type=text name="link" value="'.$item->link.'"><br>';
						
						if ($item->aktif == 'Y'){
						  echo '<b>Aktif :</b> <br><input type="radio" name="aktif" value="Y" checked>Yes  
												   <input type="radio" name="aktif" value="N"> No <br>';
						}
						else{
						  echo '<b>Aktif :</b> <br><input type=radio name="aktif" value="Y">Yes  
												   <input type=radio name="aktif" value="N" checked> No <br>';
						}

						echo '<b>Level :</b> <br><select name="level">';
						foreach ($ar_level as $level) {
							if($item->level == $level)
								echo '<option value='.$item->level.' selected>'.$item->level.'</option>';
							else
								echo '<option value='.$item->level.'>'.$item->level.'</option>';
						}
						echo '</select><br>';
						echo '</P>
							<p class="debug-url"></p>';
					?>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button class="btn btn-primary" type="submit" class="btn btn-danger btn-ok">Edit</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		<!--------------------------------------------------------------------------------------------->
		<?php
	  $no++;
	}
	echo '</tbody></table>';
	echo '<div id="paging">*) Data pada Menu tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit Menu Utama.<br>
						 **) Untuk link menu Beranda (Home) harus diubah ketika online menjadi http://NamaDomainAnda.com
		  </div><br>';
?>
<!-- Modal-->
    <!--Form Tambah Menu Utama-->
	<div class="modal fade" id="tambah-utama" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Tambah Menu Utama</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<form id="myForm2" method="GET" action="<?php echo base_url().$modul.'/'.$act;?>">
				<div class="modal-body">
				<?php
					echo '<input type="hidden" name="proses" value="tambah">';
					echo '<P>';
					echo '<b>Nama Menu :</b><br><input type="text" name="nama_menu"><br>';
					echo '<b>Link :</b><br><input type="text" name="link"><br>';
					echo '<b>Aktif :</b> <br><input type="radio" name="aktif" value="Y" checked>Yes  
								<input type="radio" name="aktif" value="N"> No <br>';

					echo '<b>Level :</b> <br><select name="level">';
					foreach ($ar_level as $level) {
						echo '<option value="'.$level.'">$level</option>';
					}
					echo '</select><br>';
					echo '</P>
						<p class="debug-url"></p>';
				?>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary" type="submit" class="btn btn-danger btn-ok">Tambah</button>
				</div>
				</form>
			</div>
		</div>
	</div>