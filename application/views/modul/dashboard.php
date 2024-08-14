<!-- Small boxes (Stat box) -->
<?php
	/*/Data1
	$query_data	= mysqli_query($con, "SELECT max(bulan) as bulan FROM `pegawai_master` WHERE tahun = '".$tahun."'");
	while ($r_data	= mysqli_fetch_array($query_data)){
		$bulan = $r_data['bulan'];
	}
	
	$tot		= 0;
	$jft		= 0;
	$query		= mysqli_query($con,"SELECT left(jenis_jab,4) as jenis_jab, count(jenis_jab) as jumlah from pegawai_master WHERE tahun = '".$tahun."' and bulan = '".$bulan."' GROUP BY left(jenis_jab,4)");
	while($pr = mysqli_fetch_array($query)){
		$data['terisi'][$pr['jenis_jab']] = $pr['jumlah'];
		$tot = $tot + $pr['jumlah'];
		if($pr['jenis_jab'] <> "JFU" && $pr['jenis_jab'] <> "Stru")
			$jft = $jft+$pr['jumlah'];
	}
	
	//Data2
	$usulan		= 0;
	$query		= mysqli_query($con,"SELECT left(jenis_jab_tujuan,4) as jenis_jab From pegawai_usul WHERE status < '4' and status > '0'");
	while($pr = mysqli_fetch_array($query)){
		$data['usulan'][$pr['jenis_jab']] = $data['usulan'][$pr['jenis_jab']]+1;
		$usulan	= $usulan+1;
	}
	
	//Grafik	
	$data21 	= "";
	$data22		= "";
	$labels		= "";
	$x			= 1;
	$query		= mysqli_query($con,"SELECT * FROM 0_bagian WHERE kode_bag <> '00' and kode_bag like '%0' and kode_bag < '90' order by kode_bag");
	$y			= mysqli_num_rows($query);
	while($pr = mysqli_fetch_array($query)){
		$labels	= $labels."'".$pr['alias']."'";
		$data21	= $data21.$data[$pr['kode_bag']]['Laki-laki'];
		$data22	= $data22.$data[$pr['kode_bag']]['Perempuan'];
		if($x>0 && $x<$y){
			$labels	= $labels.",";
			$data21	= $data21.",";
			$data22	= $data22.",";
		}
		$x++;
	}*/
?>
<div class="row">
	<div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo number_format(2,0,",",".")." Pegawai"; ?></h3>
                <p>Total Pegawai</p>
            </div>
			<div class="icon">
				<!--<i class="ion ion-bag"></i>-->
			</div>
			<a href="#" class="small-box-footer"></i></a>
        </div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-success">
			<div class="inner">
				<h3><?php echo number_format(2,0,",",".")." Pegawai"; ?></h3>
				<p>Fungsional Tertentu</p>
			</div>
			<div class="icon">
				<!--<i class="ion ion-stats-bars"></i>-->
			</div>
			<a href="#" class="small-box-footer"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-warning">
			<div class="inner">
				<h3><?php echo number_format(2,0,",",".")." Pegawai"; ?></h3>
				<p>Fungsional Umum/Pelaksana</p>
			</div>
			<div class="icon">
				<!--<i class="ion ion-person-add"></i>-->
			</div>
			<a href="#" class="small-box-footer"></i></a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-danger">
			<div class="inner">
				<h3><?php echo number_format(2,0,",",".")." Permintaan"; ?></h3>
				<p>Usulan Pindah Formasi</p>
			</div>
			<div class="icon">
				<!--<i class="ion ion-pie-graph"></i>-->
			</div>
			<a href="#" class="small-box-footer"></i></a>
		</div>
	</div>
    <!-- ./col -->
</div>
<div class="row">
	<div class="col-lg-6">
		<div class="card card-primary">
			<div class="card-header border-0">
				<h3 class="card-title"><i class="fa fa-table"></i> Tabel XXX</h3>
				<div class="card-tools">
				</div>
			</div>
			<div class="card-body table-responsive p-0">
				<table class="table table-striped table-valign-middle">
					<thead>
						<tr>
							<th style='text-align:center;'>Fungsional</th>
							<th style='text-align:center;'>Pegawai</th>
							<th style='text-align:center;'>Usulan</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//isi data
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- /.card -->
	</div>
	<div class="col-lg-6">
		<div class="card bg-secondary">
			<div class="card-header border-0">
				<h3 class="card-title"><i class="fa fa-book"></i> File-File Terkait</h3>
				<div class="card-tools">
				</div>
			</div>
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center border-bottom mb-3">
					<p>
						Format template <i>Curriculum Vitae (CV)</i>
					</p>
					<p class="d-flex flex-column text-right" style="text-align:right;">
						<a href="./files/template/TEMPLATE CV.pdf" class="btn btn-sm btn-tool" target="_blank">
							<i class="fas fa-download"></i>
						</a>
					</p>
				</div>
				<div class="d-flex justify-content-between align-items-center border-bottom mb-3">
					<p>
						Format template Rencana Aksi
					</p>
					<p class="d-flex flex-column text-right">
						<a href="./files/template/TEMPLATE RENCANA AKSI.docx" class="btn btn-sm btn-tool" target="_blank">
							<i class="fas fa-download"></i>
						</a>
					</p>
				</div>
				<!-- /.d-flex -->
			</div>
		</div>
		<div class="card card-info">
			<div class="card-header border-0">
				<h3 class="card-title"><i class="fa fa-bell"></i> Pemberitahuan</h3>
				<div class="card-tools">
				</div>
			</div>
			<div class="card-body">
				<?php
				if($_SESSION['email']==""){
					echo "<div class='d-flex justify-content-between align-items-center border-bottom mb-3'>";
					echo "<p><b>Anda belum melakukan input email</b>, silahkan perbaharui data email anda agar dapat dikirimkan notifikasi terkait perubahan usulan anda</p><br>";
					echo "</div>";
				}
				
				if($_SESSION['jabfung']==""){
					echo "<div class='d-flex justify-content-between align-items-center border-bottom mb-3'>";
					echo "<p><b>Informasi jabfung anda masih kosong</b>, silahkan perbaharui data jabfung anda agar dapat melakukan usulan pengajuan pindah formasi jabatan</p><br>";
					echo "</div>";
				}
				?>
				<!-- /.d-flex -->
			</div>
		</div>
	</div>
</div>