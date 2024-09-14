<script>
    $(document).ready(function() {

        // Handling Reset Breadcrumb proyek
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
        $(document).on('click', '.tr-proyek', function() {
            var id_proyek = $(this).data('id_proyek');
            var nama_proyek = $(this).data('nama_proyek');

            $('#breadcrumb-nama-proyek').text(nama_proyek);

            $('.proyek-table').hide();
            $('.kegiatan-table').show();
            $('#breadcrumb-nama-proyek').show();

            $.ajax({
                url: "<?php echo base_url('kegiatan/get_kegiatan_by_proyek'); ?>",
                type: "POST",
                data: {
                    id_proyek: id_proyek
                },
                success: function(response) {
                    $('.kegiatan-table').html(response);
                    $('.select2').select2();
                    // Datepicker Tambah Kegiatan
                    $('#start-date-kegiatan').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                    $('#end-date-kegiatan').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                    if ($.fn.DataTable.isDataTable('#dataTable-kegiatan')) {
                        $('#dataTable-kegiatan').DataTable().destroy();
                    }

                    // Inisialisasi ulang DataTables setelah konten tabel dimuat
                    $('#dataTable-kegiatan').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": true,
                        "ordering": true,
                        "info": false,
                        "autoWidth": true
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Fetching Pekerjaan Pegawai pada Kegiatan Proyek Terkait
        $(document).on('click', '.tr-kegiatan', function() {
            var id_kegiatan = $(this).data('id_kegiatan');
            var nama_kegiatan = $(this).data('nama_kegiatan');

            $('#breadcrumb-nama-kegiatan').text(nama_kegiatan);

            $('.kegiatan-table').hide();
            $('.pekerjaan-table').show();
            $('#breadcrumb-nama-kegiatan').show();

            $.ajax({
                url: "<?php echo base_url('kegiatan/get_pekerjaan_by_kegiatan'); ?>",
                type: "POST",
                data: {
                    id_kegiatan: id_kegiatan
                },
                success: function(response) {
                    $('.pekerjaan-table').html(response);
                    if ($.fn.DataTable.isDataTable('#dataTable-pekerjaan')) {
                        $('#dataTable-pekerjaan').DataTable().destroy();
                    }

                    // Inisialisasi ulang DataTables setelah konten tabel dimuat
                    $('#dataTable-pekerjaan').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": true,
                        "ordering": true,
                        "info": false,
                        "autoWidth": true
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Search anggota
        $('#search-anggota-tim').on('keyup', function() {
            var searchTerm = $(this).val().toLowerCase();

            $('.user-block').each(function() {
                var userName = $(this).find('.nama-anggota-tim').text().toLowerCase();

                if (userName.indexOf(searchTerm) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // format inputan date
        $(function() {
            $('.input-date').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'en',
            });
        });

        // Summernote
        $('#summernote').summernote({
            placeholder: 'Tuliskan strategi proyek ini',
            tabsize: 2,
            height: 100
        });

        // Menambah field kegiatan proyek secara dinamis saat membuat proyek baru
        $('#tambah-kegiatan').click(function() {
            // Elemen HTML yang akan di-append
            var kegiatanIndex = $('.item-kegiatan').length + 1;
            var newItem = `
            <div class="item-kegiatan mr-2">
                <h5 class="text-primary font-weight-bold">Kegiatan ke-` + kegiatanIndex + `</h5>
                <input type="hidden" name="kegiatanIndex[]" value="` + kegiatanIndex + `" required>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="master_kegiatan-` + kegiatanIndex + `">Jenis Kegiatan</label>
                            <select name="master_kegiatan-` + kegiatanIndex + `" class="form-control select2" style="width: 100%; height: 100px;" required>
                                <option value="" selected></option>
                                <?php foreach ($master_kegiatan as $kegiatan) : ?>
                                    <option value="<?= urlencode($kegiatan->id) ?>"><?= $kegiatan->nama_kegiatan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="pic-` + kegiatanIndex + `">Person in Charge</label>
                            <select name="pic-` + kegiatanIndex + `" class="form-control select2" style="width: 100%; height: 100px;" required>
                                <option selected="selected" value=""></option>
                                <?php foreach ($anggota_tim as $anggota) : ?>
                                    <option value="<?= urlencode($anggota->nama) ?>"><?= $anggota->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="start_kegiatan-` + kegiatanIndex + `">Start Date:</label>
                        <div class="input-group date input-date" id="start-date-` + kegiatanIndex + `" data-target-input="nearest">
                            <input type="text" name="start_kegiatan-` + kegiatanIndex + `" class="form-control datetimepicker-input" data-target="#start-date-` + kegiatanIndex + `" required/>
                            <div class="input-group-append" data-target="#start-date-` + kegiatanIndex + `" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="end_kegiatan-` + kegiatanIndex + `">End Date:</label>
                        <div class="input-group date input-date" id="end-date-` + kegiatanIndex + `" data-target-input="nearest">
                            <input type="text" name="end_kegiatan-` + kegiatanIndex + `" class="form-control datetimepicker-input" data-target="#end-date-` + kegiatanIndex + `" required/>
                            <div class="input-group-append" data-target="#end-date-` + kegiatanIndex + `" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="indikator_kinerja-` + kegiatanIndex + `">Indikator Kinerja Kegiatan</label>
                    <select name="indikator_kinerja-` + kegiatanIndex + `" class="form-control select2" style="width: 100%; height: 100px;" required>
                        <option selected="selected" value=""></option>
                        <?php foreach ($indikator_kinerja as $indikator) : ?>
                            <option value="<?= urlencode($indikator->id) ?>">
                                <?= $indikator->kode . ' - ' . $indikator->jenis . ' - ' . $indikator->indikator ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="text-right">
                <button type="button" class="btn btn-danger btn-hapus-kegiatan">Hapus</button>
                <hr>
                </div>
            </div>
            `;

            $('.container-kegiatan').append(newItem);
            $('.select2').select2();
            $('#start-date-' + kegiatanIndex).datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#end-date-' + kegiatanIndex).datetimepicker({
                format: 'YYYY-MM-DD'
            });
            kegiatanIndex++;

        });

        // Menghapus field kegiatan proyek secara dinamis saat menambah proyek baru
        $(document).on('click', '.btn-hapus-kegiatan', function() {
            $(this).closest('.item-kegiatan').remove();

            // Update index kegiatan setelah salah satu dihapus
            $('.item-kegiatan').each(function(index) {
                var kegiatanIndex = index + 1; // Mulai dari 1
                $(this).find('h5').text('Kegiatan ke-' + kegiatanIndex);
                $(this).find('select[name^="master_kegiatan"]').attr('name', 'master_kegiatan-' + kegiatanIndex);
                $(this).find('select[name^="pic_kegiatan"]').attr('name', 'pic_kegiatan-' + kegiatanIndex);
                $(this).find('input[name^="start_date"]').attr('name', 'start_date-' + kegiatanIndex);
                $(this).find('input[name^="end_date"]').attr('name', 'end_date-' + kegiatanIndex);
                $(this).find('select[name^="indikator_kinerja"]').attr('name', 'indikator_kinerja-' + kegiatanIndex);

                // Update ID untuk datetimepicker
                $(this).find('.input-date').each(function() {
                    var id = $(this).attr('id').split('-')[0];
                    $(this).attr('id', id + '-' + kegiatanIndex);
                    $(this).find('input').attr('data-target', '#' + id + '-' + kegiatanIndex);
                    $(this).find('.input-group-append').attr('data-target', '#' + id + '-' + kegiatanIndex);
                });
            });
        });

        // Update nama akhir proyek
        function updateNamaAkhirProyek() {
            var selectedProyek = $('select[name="master_proyek"] option:selected').text();
            var detailProyek = $('input[name="detail_proyek"]').val().trim();
            var namaAkhir = selectedProyek + ' ~ ' + detailProyek;

            $('.nama-akhir-proyek').text(namaAkhir);

            // Update the hidden input value
            $('input[name="nama_akhir_proyek"]').val(namaAkhir);
        }

        $('select[name="master_proyek"]').on('change', updateNamaAkhirProyek);
        $('input[name="detail_proyek"]').on('input', updateNamaAkhirProyek);


        // Ajax untuk modal edit proyek
        $('.btn-edit-proyek').on('click', function() {
            var id_proyek = $(this).data('id_proyek');
            console.log(id_proyek);

            $.ajax({
                url: '<?= base_url('proyek/show') ?>/' + id_proyek,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Isi data modal dengan data yang di-fetch
                    var namaProyekParts = data.nama_proyek.split(' ~ ');
                    console.log(data);
                    $('#modal-update-proyek input[name="master_proyek"]').val(namaProyekParts[0]);
                    $('#modal-update-proyek input[name="detail_proyek"]').val(namaProyekParts[1] || '');
                    $('#modal-update-proyek input[name="start_proyek"]').val(data.start_date);
                    $('#modal-update-proyek input[name="end_proyek"]').val(data.end_date);
                    $('#modal-update-proyek input[name="nama_akhir_proyek"]').val(data.nama_proyek);
                    $('#modal-update-proyek select[name="status_proyek"]').val(data.status);
                    // Tampilkan modal
                    $('#modal-update-proyek').modal('show');
                }
            });
        });


        // Add pekerjaan pegawai pada saat add kegiatan baru
        $(document).on('click', '#tambah-pegawai-kegiatan', function() {
            // Elemen HTML yang akan di-append
            var pegawaiKegiatanIndex = $('.item-pegawai-kegiatan').length + 1;
            var newItem = `
            <div class="item-pegawai-kegiatan mr-2">
                <h5 class="text-primary font-weight-bold">Pegawai ke-` + pegawaiKegiatanIndex + `</h5>
                <input type="hidden" name="pegawaiKegiatanIndex[]" value="` + pegawaiKegiatanIndex + `" required>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="pegawai_pekerjaan-` + pegawaiKegiatanIndex + `">Pegawai</label>
                            <select name="pegawai_pekerjaan-` + pegawaiKegiatanIndex + `" class="form-control select2" style="width: 100%; height: 100px;" required>
                                <option selected="selected" value=""></option>
                                <?php foreach ($pegawai as $pgw) : ?>
                                    <option value="<?= urlencode($pgw->nama) ?>"><?= $pgw->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="master_satuan-` + pegawaiKegiatanIndex + `">Jenis Satuan</label>
                            <select name="master_satuan-` + pegawaiKegiatanIndex + `" class="form-control select2" style="width: 100%; height: 100px;" required>
                                <option value="" selected></option>
                                <?php foreach ($master_satuan as $satuan) : ?>
                                    <option value="<?= urlencode($satuan->id) ?>"><?= $satuan->nama_satuan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="target_pekerjaan-` + pegawaiKegiatanIndex + `">Jumlah target_pekerjaan</label>
                            <input type="number" name="target_pekerjaan-` + pegawaiKegiatanIndex + `" class="form-control" placeholder="Detail proyek" required>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                <button type="button" class="btn btn-danger btn-hapus-pegawai-kegiatan">Hapus</button>
                <hr>
                </div>
            </div>
            `;

            $('.container-pegawai-kegiatan').append(newItem);
            $('.select2').select2();

        });

        // Menghapus field kegiatan proyek secara dinamis saat menambah proyek baru
        $(document).on('click', '.btn-hapus-pegawai-kegiatan', function() {
            $(this).closest('.item-pegawai-kegiatan').remove();

            // Update index kegiatan setelah salah satu dihapus
            $('.item-pegawai-kegiatan').each(function(index) {
                var pegawaiKegiatanIndex = index + 1; // Mulai dari 1
                $(this).find('h5').text('Pegawai ke-' + pegawaiKegiatanIndex);
                $(this).find('select[name^="pegawai_pekerjaan"]').attr('name', 'pegawai_pekerjaan-' + pegawaiKegiatanIndex);
                $(this).find('select[name^="master_satuan"]').attr('name', 'master_satuan-' + pegawaiKegiatanIndex);
                $(this).find('input[name^="target_pekerjaan"]').attr('name', 'target_pekerjaan-' + pegawaiKegiatanIndex);
            });
        });

        // Add pekerjaan baru
        $(document).on('click', '#tambah-pekerjaan-pegawai', function() {
            // Elemen HTML yang akan di-append
            var pekerjaanPegawaiIndex = $('.item-pekerjaan-pegawai').length + 1;
            var newItem = `
            <div class="item-pekerjaan-pegawai mr-2">
                <h5 class="text-primary font-weight-bold">Pegawai ke-` + pekerjaanPegawaiIndex + `</h5>
                <input type="hidden" name="pekerjaanPegawaiIndex[]" value="` + pekerjaanPegawaiIndex + `" required>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="pekerjaan_pegawai-` + pekerjaanPegawaiIndex + `">Pegawai</label>
                            <select name="pekerjaan_pegawai-` + pekerjaanPegawaiIndex + `" class="form-control select2" style="width: 100%; height: 100px;" required>
                                <option selected="selected" value=""></option>
                                <?php foreach ($pegawai as $pgw) : ?>
                                    <option value="<?= urlencode($pgw->nama) ?>"><?= $pgw->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="pekerjaan_satuan-` + pekerjaanPegawaiIndex + `">Jenis Satuan</label>
                            <select name="pekerjaan_satuan-` + pekerjaanPegawaiIndex + `" class="form-control select2" style="width: 100%; height: 100px;" required>
                                <option value="" selected></option>
                                <?php foreach ($master_satuan as $satuan) : ?>
                                    <option value="<?= urlencode($satuan->id) ?>"><?= $satuan->nama_satuan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="pekerjaan_target-` + pekerjaanPegawaiIndex + `">Jumlah </label>
                            <input type="number" name="pekerjaan_target-` + pekerjaanPegawaiIndex + `" class="form-control" placeholder="Detail proyek" required>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                <button type="button" class="btn btn-danger btn-hapus-pekerjaan-pegawai">Hapus</button>
                <hr>
                </div>
            </div>
            `;

            $('.container-pekerjaan-pegawai').append(newItem);
            $('.select2').select2();

        });

        // Menghapus field kegiatan proyek secara dinamis saat menambah proyek baru
        $(document).on('click', '.btn-hapus-pekerjaan-pegawai', function() {
            $(this).closest('.item-pekerjaan-pegawai').remove();

            // Update index kegiatan setelah salah satu dihapus
            $('.item-pekerjaan-pegawai').each(function(index) {
                var pekerjaanPegawaiIndex = index + 1; // Mulai dari 1
                $(this).find('h5').text('Pegawai ke-' + pekerjaanPegawaiIndex);
                $(this).find('select[name^="pekerjaan_pegawai"]').attr('name', 'pekerjaan_pegawai-' + pekerjaanPegawaiIndex);
                $(this).find('select[name^="pekerjaan_satuan"]').attr('name', 'pekerjaan_satuan-' + pekerjaanPegawaiIndex);
                $(this).find('input[name^="pekerjaan_target"]').attr('name', 'pekerjaan_target-' + pekerjaanPegawaiIndex);
            });
        });


    });
</script>