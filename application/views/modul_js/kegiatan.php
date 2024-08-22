<script>
    $(document).ready(function() {
        function loadTable(kontenTabel) {
            $.ajax({
                url: "<?php echo base_url('kegiatan/load_table'); ?>", // URL ke method di controller 'kegiatan'
                type: "POST", // Menggunakan metode POST
                data: {
                    konten_tabel: kontenTabel
                }, // Data yang dikirimkan ke method
                success: function(response) {
                    $('#table-container').html(response); // Tampilkan response di dalam div dengan id 'table-container'
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        $('#breadcrumb-proyek').on('click', function() {
            $('#breadcrumb-nama-proyek').hide();
            $('#breadcrumb-nama-kegiatan').hide();
            $('.kegiatan-table').hide();
            $('.pekerjaan-table').hide();
            $('.proyek-table').show();
        });

        $('#breadcrumb-nama-proyek').on('click', function() {
            $('#breadcrumb-nama-kegiatan').hide();
            $('.pekerjaan-table').hide();
            $('.kegiatan-table').show();
        });

        // Fetching Kegiatan pada Proyek Terkait
        $('.tr-proyek').on('click', function() {
            var id_proyek = $(this).data('id_proyek');
            var nama_proyek = $(this).data('nama_proyek');

            // Update Nama Proyek breadcrumb 
            $('#breadcrumb-nama-proyek').text(nama_proyek);

            $('.proyek-table').hide();
            $('.kegiatan-table').show();
            $('#breadcrumb-nama-proyek').show();

            // Lakukan AJAX request untuk fetching kegiatan_proyek berdasarkan id_proyek
            $.ajax({
                url: "<?php echo base_url('kegiatan/get_kegiatan_by_proyek'); ?>", // URL ke controller untuk fetching data
                type: "POST",
                data: {
                    id_proyek: id_proyek
                },
                success: function(response) {
                    // Update konten tabel kegiatan dengan data yang diterima
                    $('.kegiatan-table').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Fetching Pekerjaan Pegawai pada Kegiatan Proyek Terkait
        $(document).on('click', '.tr-kegiatan', function() {
            console.log("klik kegiatan ajax");
            var id_kegiatan = $(this).data('id_kegiatan');
            var nama_kegiatan = $(this).data('nama_kegiatan');
            console.log(id_kegiatan);
            console.log(nama_kegiatan);

            // Update Nama Proyek breadcrumb 
            $('#breadcrumb-nama-kegiatan').text(nama_kegiatan);

            $('.kegiatan-table').hide();
            $('.pekerjaan-table').show();
            $('#breadcrumb-nama-kegiatan').show();

            // Lakukan AJAX request untuk fetching pekerjaan berdasarkan kegiatan
            $.ajax({
                url: "<?php echo base_url('kegiatan/get_pekerjaan_by_kegiatan'); ?>", // URL ke controller untuk fetching data
                type: "POST",
                data: {
                    id_kegiatan: id_kegiatan
                },
                success: function(response) {
                    // Update konten tabel kegiatan dengan data yang diterima
                    $('.pekerjaan-table').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

    });
</script>