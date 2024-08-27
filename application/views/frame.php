<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title><?php echo $aplikasi; ?></title>
	<link rel="shortcut icon" href="<?php echo base_url('dist/img/icons/icon.ico'); ?>">

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="<?php echo base_url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
	<!-- Bootstrap4 Duallistbox -->
	<link rel="stylesheet" href="<?php echo base_url('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'); ?>">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="<?php echo base_url('dist/css/googleapis.css'); ?>">
	<!-- OPTIONAL CSS -->
	<?php
	if (file_exists(FCPATH . '/application/views/modul_css/' . $modul . '.php'))
		include "modul_css/" . $modul . ".php";
	else
		include "modul_css/default.php";
	?>
	<!-- Tambahan style -->
	<link rel="stylesheet" href="<?php echo base_url('dist/css/tambahan.css'); ?>">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<!-- Navbar -->
		<?php include "partial/navbar.php"; ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="./" class="brand-link">
				<img src="<?php echo base_url('dist/img/BPS.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">SiMas ASN</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="<?php echo base_url($_SESSION['foto']); ?>" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<span class="nav-header">
							<?php
							echo  $_SESSION["nama"] . "<br>";
							echo "<small><i>" . $_SESSION['jabfung'] . "</i></small><br>";
							?>
							<small>Level Pengguna : <?php echo $_SESSION["level"][$aplikasi]; ?></small>
						</span><br>
						<small><a href="#"><i class="fa fa-circle text-success"></i> Online</a></small>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<?php include "partial/navside.php"; ?>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<?php
						$rdata	= $this->$modul->get_menu_ini($aplikasi, $modul, $act);
						$rmenu 	= $rdata['menu'];
						$rlevel	= $rdata['level'];
						?>
						<div class="col-sm-6">
							<h1 class="m-0 text-dark"><?php echo $rmenu; ?></h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="./">Home</a></li>
								<li class="breadcrumb-item active"><?php echo $rmenu; ?></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<?php include "content.php"; ?>

			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->

		<!-- Main Footer -->
		<footer class="main-footer">
			<strong>Copyright &copy; Angga Refa dan Qolbin 2024 </strong>
			All rights reserved.
			<div class="float-right d-none d-sm-inline-block">
				<b>AdminLTE</b> 3.0.5
			</div>
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script type="text/javascript" src="<?php echo base_url('plugins/jquery/jquery.min.js'); ?>"></script>
	<!-- Bootstrap -->
	<script type="text/javascript" src="<?php echo base_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

	<!-- OPTIONAL SCRIPTS -->
	<?php
	if (file_exists(FCPATH . '/application/views/modul_js/' . $modul . '.php')) {
		include "modul_js/" . $modul . ".php";
	}
	include "modul_js/default.php";
	?>

	<?php if ($this->session->flashdata('success')): ?>
		<script>
			Swal.fire({
				icon: 'success',
				title: 'Success!',
				text: '<?= $this->session->flashdata('success'); ?>',
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true
			});
		</script>
	<?php endif; ?>

	<?php if ($this->session->flashdata('warning')): ?>
		<script>
			Swal.fire({
				icon: 'warning',
				title: 'Warning!',
				text: '<?= $this->session->flashdata('warning'); ?>',
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000,
				timerProgressBar: true
			});
		</script>
	<?php endif; ?>

</body>

</html>