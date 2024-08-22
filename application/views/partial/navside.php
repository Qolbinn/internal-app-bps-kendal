<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
		<li class="header"><span style="color: #f8f9fa">NAVIGASI UTAMA</span></li>
		<li class="nav-item">
			<a href="<?php echo base_url(); ?>" <?php if ($modul == "home") echo "class='nav-link active'";
												else echo "class='nav-link'"; ?>>
				<i class="nav-icon fas fa-tachometer-alt"></i>
				<p>
					Beranda
					<span class="badge badge-info right"></span>
				</p>
			</a>
		</li>
		<?php
		$l			= 0;
		foreach ($ar_level as $level) {
			$kondisi1 	= "";
			$kondisi2 	= "";
			if ($_SESSION['level'][$aplikasi] == $level) {

				if ($ar_akses[$l] != 'all') {
					$akses		= explode("-", $ar_akses[$l]);
					$y			= 1;
					foreach ($akses as $subakses) {
						if ($y > 1) {
							$kondisi1	= $kondisi1 . " OR ";
							$kondisi2	= $kondisi2 . " OR ";
						}
						$kondisi1	= $kondisi1 . "level = '" . $subakses . "'";
						$kondisi2	= $kondisi2 . "level = '" . $subakses . "'";
						$y++;
					}
				}

				if ($kondisi1 == "") {
					$mainmenu = $this->$modul->get_menu($aplikasi, "aktif = 'Y'");
				} else {
					$mainmenu = $this->$modul->get_menu($aplikasi, "aktif = 'Y' and (" . $kondisi1 . ")");
				}

				foreach ($mainmenu as $item) {
					if (empty($item->link)) {
						if (strtolower($modul) == strtolower($item->nama_menu))
							echo '<li class="nav-item has-treeview menu-open"><a href="#" class="nav-link active"><i class="nav-icon fas fa-th"></i><span>' . $item->nama_menu . '</span>
									<span class="pull-right-container right">
									  <i class="fa fa-angle-left"></i>
									</span></a>';
						else
							echo '<li class="nav-item has-treeview"><a href="#" class="nav-link"><i class="nav-icon fas fa-th"></i><span>' . $item->nama_menu . '</span>
									<span class="pull-right-container right">
									  <i class="fa fa-angle-left"></i>
									</span></a>';
					} else {
						echo '<li class="nav-item"><a href="' . base_url() . $item->link . '" class="nav-link"><i class="nav-icon fas fa-th"></i><span>' . $item->nama_menu . '</span>
									<span class="pull-right-container right">
									  <i class="fa fa-angle-left"></i>
									</span></a>';
					}

					if ($kondisi2 == "") {
						$sub = $this->$modul->get_submenu($aplikasi, "id_main = '" . $item->id_main . "' and aktif='Y'");
					} else {
						$sub = $this->$modul->get_submenu($aplikasi, "id_main = '" . $item->id_main . "' and aktif='Y' and (" . $kondisi2 . ")");
					}

					if (!empty($sub)) {
						echo '<ul class="nav nav-treeview">';
						foreach ($sub as $item2) {
							if (strpos($item2->link_sub, "&", 0) !== false) {
								$ac1 = "?module=" . $modul . "&act=" . $act;
							} else {
								$ac1 = $modul . "/" . $act;
							}

							echo '<li class="nav-item">';
							if ($ac1 == $item2->link_sub)
								echo '<a href="' . base_url() . $item2->link_sub . '" class="nav-link active">';
							else
								echo '<a href="' . base_url() . $item2->link_sub . '" class="nav-link">';

							//include "notif.php";
							//if($nilai==0)
							$nilai = "";
							echo '<i class="far fa-circle nav-icon"></i>
									<p>
										' . $item2->nama_sub . ' 
										<span class="badge badge-info right">' . $nilai . '</span>
									</p>
								</a></li>';
						}
						echo '</ul>';
					}
					echo '</li>';
				}
			}
			$l++;
		}
		?>
	</ul>
</nav>