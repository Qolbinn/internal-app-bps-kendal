<div class="content">
    <div class="container-fluid">
    <?php
	if($modul=="dashboard"){
		include "modul/dashboard.php";
	}
	else{
		$l 	= 0;
		$m	= 0;
		foreach($ar_level as $level){
			if($_SESSION['level'][$aplikasi]==$level && $ar_akses[$l] == 'all'){
				$m	= 1;
			}
			else {
				$akses		= explode("-",$ar_akses[$l]);
				$y			= 0;
				foreach($akses as $subakses){
					if($rlevel==$subakses)
						$y	= 1;
				}
				
				if ($_SESSION['level'][$aplikasi]==$level && $y == 1){
					$m	= 1;
				}
			}
			$l++;
		}
		if($m == 1){
			echo "<section class='content'>
					<div class='container-fluid'>
						<div class='card card-primary card-outline'>
							<div class='card-body'>";
			include "modul/".$modul."/".$act.".php";
			echo "			</div><!-- /.card-body -->
						</div>
					</div><!-- /.container-fluid -->
				</section>";
		}
		else{
			echo "<p><b>MODUL BELUM ADA ATAU ANDA TIDAK MEMPUNYAI HAK AKSES</b></p>";
		}
	}
	?>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>