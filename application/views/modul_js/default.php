<!-- AdminLTE App -->
<script type="text/javascript" src="<?php echo base_url('dist/js/adminlte.min.js'); ?>"></script>
<!-- DataTables -->
<script type="text/javascript" src="<?php echo base_url('plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>

<!-- DataTables Eksport-->
<script type="text/javascript" src="<?php echo base_url('plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('plugins/jszip/jszip.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('plugins/pdfmake/pdfmake.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('plugins/pdfmake/vfs_fonts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>

<!-- DataTables Scroll-->
<script type="text/javascript" src="<?php echo base_url('plugins/datatables-rowreorder/js/dataTables.rowReorder.min.js'); ?>"></script>

<!-- SweetAlert 2-->
<script type="text/javascript" src="<?php echo base_url('plugins/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

<!-- Select2 -->
<script type="text/javascript" src="<?php echo base_url('plugins/select2/js/select2.full.min.js'); ?>"></script>

<!-- InputMask -->
<script type="text/javascript" src="<?php echo base_url('plugins/moment/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('plugins/inputmask/min/jquery.inputmask.bundle.min.js'); ?>"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script type="text/javascript" src="<?php echo base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>

<!-- date-range-picker -->
<script type="text/javascript" src="<?php echo base_url('plugins/daterangepicker/daterangepicker.js'); ?>"></script>

<!-- Numerik Input -->
<script type="text/javascript" src="<?php echo base_url('plugins/autonumeric/autoNumeric-1.9.41.js'); ?>"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".demo").autoNumeric('init', {
			mDec: '0'
		});
		$(".des").autoNumeric('init', {
			mDec: '2'
		});
	});
</script>

<!-- Summernote -->
<script type="text/javascript" src="<?php echo base_url('plugins/summernote/summernote-bs4.min.js'); ?>"></script>

<script type="text/javascript">
	$(function() {
		//Initialize Select2 Elements
		$('.select2').select2()

		//Initialize Select2 Elements
		$('.select2bs4').select2({
			theme: 'bootstrap4'
		})

		//Initialize Data Table
		var printCounter = 0;

		$('#testTable').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"ordering": false,
			"info": false,
			"autoWidth": true
		});
		$('#dataTable').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			"info": false,
			"autoWidth": true
		});
		$('#dataTable1').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": false,
			"info": false,
			"autoWidth": true,
			dom: 'Bfrtip',
			buttons: [{
					extend: 'excel',
					messageBottom: 'The information in this table is copyright to <?php echo strtoupper($aplikasi); ?>.'
				},
				{
					extend: 'pdf',
					messageBottom: 'The information in this table is copyright to <?php echo strtoupper($aplikasi); ?>.'
				},
				{
					extend: 'print',
					messageBottom: 'The information in this table is copyright to <?php echo strtoupper($aplikasi); ?>.'
				}
			]
		});
		$('#dataTable2').DataTable({
			"scrollY": '70vh',
			"scrollX": false,
			"searching": false,
			"paging": false,
			"ordering": false,
			"autoWidth": true,
			"info": false
		});
		$('#dataTable3').DataTable({
			"rowReorder": false,
			"scrollY": '50vh',
			"scrollX": true,
			"searching": true,
			"ordering": false,
			"paging": true,
			"autoWidth": true
		});

		//Date range picker
		$('.reservationdate').datetimepicker({
			format: 'L'
		});

		//Date range picker
		$('#reservation').daterangepicker()

		// Summernote
		$('.textarea').summernote({
			toolbar: [
				['undo', ['undo', ]],
				['redo', ['redo', ]],
				//['style', ['style']],
				['font', ['bold', 'underline', 'italic']],
				['fontname', ['fontname']],
				['fontsize', ['fontsize']],
				//['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				//['table', ['table']],
				//['insert', ['link', 'picture', 'video']],
				['view', ['fullscreen', 'codeview', 'help']],
			],
			callbacks: {
				onPaste: function(e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
		$('.texta').summernote({
			toolbar: [
				//['undo', ['undo',]],
				//['redo', ['redo',]],
				//['style', ['style']],
				//['font', ['bold', 'underline', 'italic']],
				//['fontname', ['fontname']],
				//['fontsize', ['fontsize']],
				//['color', ['color']],
				//['para', ['ul', 'ol', 'paragraph']],
				//['table', ['table']],
				//['insert', ['link', 'picture', 'video']],
				//['view', ['fullscreen', 'codeview', 'help']],
			],
			callbacks: {
				onPaste: function(e) {
					var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
					e.preventDefault();
					document.execCommand('insertText', false, bufferText);
				}
			}
		});
	});
</script>

<!-- Untuk Alert Confirm Form Button -->
<script>
	document.querySelectorAll('.confirm-btn').forEach(button => {
		button.addEventListener('click', function(event) {
			event.preventDefault();

			let form = button.closest('form');
			let isValid = form.checkValidity(); // Memeriksa validitas form

			if (!isValid) {
				form.reportValidity();
				return;
			}

			let message = form.getAttribute('data-confirm-message') || "Apakah Anda yakin ingin mengirimkan form ini?";

			Swal.fire({
				title: 'Konfirmasi',
				text: message,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, kirim!',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.value) {
					form.submit();
				}
			});
		});
	});
</script>