<?php
// var_dump($id_proyek_selected);
?>

<?php if (isset($dt_kegiatan)) : ?>
    <table class="table table-bordered table-striped" id="dataTable-kegiatan" width="100%" cellspacing="0">
        <thead>
            <tr style="background-color: #4fadfd;">
                <td>No</td>
                <td>Kegiatan</td>
                <td>Tanggal Mulai</td>
                <td>Tanggal Akhir</td>
                <!-- Status dan Hitungan DL -->
                <td>Progress</td>
                <td>Status</td>
                <!-- Info (IKU, Catatan, Comment) dan Edit -->
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dt_kegiatan as $index => $kegiatan) : ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= $kegiatan->nama_kegiatan; ?></td>
                    <td><?= $kegiatan->start_date; ?></td>
                    <td><?= $kegiatan->end_date; ?></td>
                    <td class="project_progress">
                        <div class="progress progress-sm" style="position: relative;">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?= $kegiatan->progress; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $kegiatan->progress; ?>%; height: 100%;">
                            </div>
                        </div>
                        <small>
                            <?= $kegiatan->progress; ?>% Progress
                        </small>
                    </td>

                    <td class="project-state">
                        <?php
                        switch ($kegiatan->status) {
                            case 'In Progress':
                                echo '<span class="badge badge-info">In Progress</span>';
                                break;
                            case 'Pending':
                                echo '<span class="badge badge-warning">Pending</span>';
                                break;
                            case 'Selesai':
                                echo '<span class="badge badge-success">Selesai</span>';
                                break;
                            default:
                                echo '<span class="badge badge-secondary">' . $kegiatan->status . '</span>';
                                break;
                        }
                        ?>

                        <?php
                        $endDate = new DateTime($kegiatan->end_date);
                        $today = new DateTime();
                        $diff = (new DateTime($kegiatan->end_date))->diff(new DateTime());
                        $daysLeft = $diff->days;

                        // Badge Jarak Harian
                        if ($endDate > $today) {
                            if ($daysLeft > 28) {
                                $monthsLeft = floor($daysLeft / 30);
                                echo '<small class="badge badge-primary"><i class="far fa-clock"></i> ' . $monthsLeft . ' month' . ($monthsLeft > 1 ? 's' : '') . '</small>';
                            } elseif ($daysLeft > 7) {
                                $weeksLeft = floor($daysLeft / 7);
                                echo '<small class="badge badge-info"><i class="far fa-clock"></i> ' . $weeksLeft . ' week' . ($weeksLeft > 1 ? 's' : '') . '</small>';
                            } else {
                                echo '<small class="badge badge-warning"><i class="far fa-clock"></i> ' . $daysLeft . ' day' . ($daysLeft > 1 ? 's' : '') . '</small>';
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <div>
                            <div class="btn btn-warning">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </div>
                            <form action="<?php echo base_url('kegiatan_proyek/hapus/' . $kegiatan->id . ''); ?>" method="post" style="display:inline;">
                                <button type="submit" class="btn btn-danger confirm-btn">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                            <div class="tr-kegiatan btn btn-outline-success" data-id_kegiatan="<?= $kegiatan->id; ?>" data-nama_kegiatan="<?= $kegiatan->nama_kegiatan; ?>">
                                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach;
            ?>
        </tbody>
    </table>

<?php else : ?>
    <h1>Belum ada kegiatan</h1>
<?php endif; ?>

<div class="text-right">
    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-kegiatan">
        Tambah Kegiatan Proyek
    </button>
</div>


<?php
$master_kegiatan = $this->session->userdata('master_kegiatan');
$anggota_tim = $this->session->userdata('anggota_tim');
?>

<!-- Modal Tambah Kegiatan -->
<div class="modal fade" id="modal-tambah-kegiatan" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Tambah Kegiatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('kegiatan_proyek/tambah/' . $id_proyek_selected) ?>">
                <div class="modal-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="border-width: 0;">
                        <li class="nav-item mx-2" role="presentation">
                            <button class="nav-link active" id="pills-desc-kegiatan-tab" data-toggle="pill" data-target="#pills-desc-kegiatan" type="button" role="tab" aria-controls="pills-desc-kegiatan" aria-selected="true">Deskripsi Kegiatan</button>
                        </li>
                        <li class="nav-item mx-2" role="presentation">
                            <button class="nav-link" id="pills-pekerjaan-tab" data-toggle="pill" data-target="#pills-pekerjaan" type="button" role="tab" aria-controls="pills-pekerjaan" aria-selected="false">Pembagian Pekerjaan</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-desc-kegiatan" role="tabpanel" aria-labelledby="pills-desc-kegiatan-tab">
                            <div class="card-body">
                                <!-- Nama Kegiatan -->
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="master_kegiatan">Jenis Kegiatan</label>
                                            <select name="master_kegiatan" class="form-control select2" style="width: 100%; height: 100px;" required>
                                                <option disabled selected value="">
                                                </option>
                                                <?php foreach ($master_kegiatan as $kegiatan) : ?>
                                                    <option value="<?= urlencode($kegiatan->id . '|' . $kegiatan->nama_kegiatan) ?>"><?= $kegiatan->nama_kegiatan ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label for="pic_kegiatan">PIC Kegiatan</label>
                                        <select name="pic_kegiatan" class="form-control select2" style="width: 100%; height: 100px;" required>
                                            <option disabled selected value="">
                                            </option>
                                            <?php foreach ($anggota_tim as $anggota) : ?>
                                                <option value="<?= urlencode($anggota->nama) ?>"><?= $anggota->nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Date Kegiatan -->
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="start_kegiatan">Start Date:</label>
                                        <div class="input-group date input-date" id="start-date-kegiatan" data-target-input="nearest">
                                            <input type="text" name="start_kegiatan" class="form-control datetimepicker-input" data-target="#start-date-kegiatan" required />
                                            <div class="input-group-append" data-target="#start-date-kegiatan" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label for="end_kegiatan">End Date:</label>
                                        <div class="input-group date input-date" id="end-date-kegiatan" data-target-input="nearest">
                                            <input type="text" name="end_kegiatan" class="form-control datetimepicker-input" data-target="#end-date-kegiatan" required />
                                            <div class="input-group-append" data-target="#end-date-kegiatan" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <label for="iku_kegiatan">Indikator Kinerja Kegiatan</label>
                                    <select name="iku_kegiatan" class="form-control select2" style="width: 100%; height: 100px;" required>
                                        <option disabled selected value="">
                                        </option>
                                        <?php foreach ($indikator_kinerja as $indikator) : ?>
                                            <option value="<?= urlencode($indikator->id) ?>">
                                                <?= $indikator->kode . ' - ' . $indikator->jenis . ' - ' . $indikator->indikator ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-pekerjaan" role="tabpanel" aria-labelledby="pills-pekerjaan-tab">
                            <div class="card-body">
                                <div class="text-right">
                                    <div class="btn btn-primary" id="tambah-pegawai-kegiatan">Tambah Pegawai</div>
                                </div>
                                <div class="container-pegawai-kegiatan" style="max-height: 320px; overflow-y: auto;; overflow-x: hidden;">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</div>
                    <button type="submit" class="btn btn-primary confirm-btn">Save Kegiatan</button>
                </div>
            </form>
        </div>

    </div>

</div>