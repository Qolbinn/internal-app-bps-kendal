<?php
// var_dump($dt_proyek);
?>

<table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr style="background-color: #4fadfd;">
            <td>No</td>
            <td>Proyek</td>
            <td>Tanggal Mulai</td>
            <td>Tanggal Akhir</td>
            <!-- Status dan hitungan DL -->
            <td>Status</td>
            <td>Tahun</td>
            <!-- Info (Strategi) dan Edit -->
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dt_proyek as $proyek) : ?>
            <tr>
                <td><?= $proyek->id; ?></td>
                <td><?= $proyek->nama_proyek ?></td>
                <td><?= $proyek->start_date ?></td>
                <td><?= $proyek->end_date ?></td>
                <td><?= $proyek->status ?></td>
                <td><?= $proyek->tahun ?></td>
                <td>
                    <div>
                        <div class="btn btn-primary">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </div>
                        <div class="btn btn-warning">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </div>
                        <div class="tr-proyek btn btn-outline-success" data-id_proyek="<?= $proyek->id; ?>" data-nama_proyek="<?= $proyek->nama_proyek; ?>">
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>