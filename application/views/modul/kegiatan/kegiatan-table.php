<?php
// var_dump($dt_kegiatan);
?>

<table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
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
        <?php foreach ($dt_kegiatan as $kegiatan) : ?>
            <tr class="tr-kegiatan" data-id_kegiatan="<?= $kegiatan->id; ?>" data-nama_kegiatan="<?= $kegiatan->nama_kegiatan; ?>">
                <td><?= $kegiatan->id; ?></td>
                <td><?= $kegiatan->nama_kegiatan; ?></td>
                <td><?= $kegiatan->start_date; ?></td>
                <td><?= $kegiatan->end_date; ?></td>
                <td><?= $kegiatan->progress; ?></td>
                <td><?= $kegiatan->status; ?></td>
                <td>
                    <div>
                        <div class="btn btn-primary">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </div>
                        <div class="btn btn-warning">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>