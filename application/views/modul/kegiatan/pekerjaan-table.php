<?php
// var_dump($dt_pekerjaan);
?>

<?php if (isset($dt_pekerjaan)) : ?>
    <table class="table table-bordered table-striped" id="dataTable-pekerjaan" width="100%" cellspacing="0">
        <thead>
            <tr style="background-color: #4fadfd;">
                <td>No</td>
                <td>Nama Petugas</td>
                <td>Target</td>
                <td>Realisasi</td>
                <td>Progress</td>
                <td>Status</td>
                <!-- Kotak Submit (Link submittan dan Submit Date, ada Catatan dan Comment) dan Approval -->
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dt_pekerjaan as $index => $pekerjaan) : ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $pekerjaan->pegawai ?></td>
                    <td><?= $pekerjaan->target ?></td>
                    <td class="d-flex justify-content-between align-items-center">
                        <span><?= $pekerjaan->realisasi ?></span>
                        <div class="d-flex justify-content-end align-items-center">
                            <a class="btn btn-primary mr-2" href="<?= base_url('bukti_pekerjaan/' . $pekerjaan->bukti); ?>" target="_blank">
                                <i class="fa fa-file" aria-hidden="true"></i>
                            </a>
                            <span><?= $pekerjaan->submit_date ?></span>
                        </div>
                    </td>
                    <td class="project_progress">
                        <div class="progress progress-sm" style="position: relative;">
                            <div
                                class="progress-bar <?= $pekerjaan->temp_progress != 0 ? 'bg-warning' : 'bg-info'; ?>"
                                role="progressbar"
                                aria-valuenow="<?= $pekerjaan->temp_progress != 0 ? $pekerjaan->temp_progress : $pekerjaan->progress; ?>"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                style="width: <?= $pekerjaan->temp_progress != 0 ? $pekerjaan->temp_progress : $pekerjaan->progress; ?>%; height: 100%;">
                            </div>
                        </div>
                        <small>
                            <?= $pekerjaan->temp_progress != 0 ? $pekerjaan->temp_progress : $pekerjaan->progress; ?>% Progress
                        </small>
                    </td>

                    <td class="project-state">
                        <?php
                        switch ($pekerjaan->status) {
                            case 'Approve':
                                echo '<span class="badge badge-info">In Progress</span>';
                                break;
                            case 'Pending':
                                echo '<span class="badge badge-warning">Pending</span>';
                                break;
                            case 'Selesai':
                                echo '<span class="badge badge-success">Selesai</span>';
                                break;
                            default:
                                echo '<span class="badge badge-secondary">' . $pekerjaan->status . '</span>';
                                break;
                        }
                        ?>
                    </td>
                    <td>
                        <div>
                            <div class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-pekerjaan-<?= $pekerjaan->id ?>">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </div>
                            <form action="<?php echo base_url('pekerjaan/hapus/' . $pekerjaan->id . ''); ?>" method="post" style="display:inline;">
                                <button type="submit" class="btn btn-danger confirm-btn">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                            <form action="<?php echo base_url('pekerjaan/approve/' . $pekerjaan->id . ''); ?>" method="post" style="display:inline;">
                                <input type="number" name="temp_progress" value="<?= $pekerjaan->temp_progress ?>" hidden>
                                <button type="submit" class="btn btn-outline-success confirm-btn"
                                    <?php if ($pekerjaan->temp_progress == 0) echo 'disabled'; ?>>
                                    <i class="fa fa-check-square" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal edit -->
    <?php foreach ($dt_pekerjaan as $pekerjaan) : ?>
        <div class="modal fade" id="modal-edit-pekerjaan-<?= $pekerjaan->id ?>" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Edit Pekerjaan <?= $pekerjaan->pegawai ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form method="post" action="<?= base_url('pekerjaan/edit/' . $pekerjaan->id . '') ?>" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="pegawai">Pegawai</label>
                                    <input type="text" value="<?= $pekerjaan->pegawai ?>" disabled>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="target">Target</label>
                                            <input type="number" name="target" value="<?= $pekerjaan->target ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="realisasi">Realisasi</label>
                                            <input type="number" name="realisasi" value="<?= $pekerjaan->realisasi ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="file_bukti">Bukti Pekerjaan</label>
                                    <input type="file" name="file_bukti" value="<?= $pekerjaan->target ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <div type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</div>
                            <button type="submit" class="btn btn-primary confirm-btn">Save Pekerjaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

<?php else : ?>
    <h1>Belum ada pekerjaan untuk pegawai</h1>
<?php endif; ?>

<div class="text-right">
    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-pekerjaan">
        Tambah Pekerjaan
    </button>
</div>


<!-- Modal Tambah Pekerjaan -->
<div class="modal fade" id="modal-tambah-pekerjaan" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Tambah Pekerjaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('pekerjaan/tambah/' . $id_kegiatan_selected) ?>">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="text-right">
                            <div class="btn btn-primary" id="tambah-pekerjaan-pegawai">Tambah Pegawai</div>
                        </div>
                        <div class="container-pekerjaan-pegawai" style="max-height: 320px; overflow-y: auto; overflow-x: hidden;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</div>
                    <button type="submit" class="btn btn-primary confirm-btn">Save Pekerjaan Tambahan</button>
                </div>
            </form>
        </div>
    </div>
</div>