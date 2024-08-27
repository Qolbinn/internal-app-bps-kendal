<?php
// var_dump($dt_pekerjaan);
?>

<table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr style="background-color: #4fadfd;">
            <td>No</td>
            <td>Nama Petugas</td>
            <td>Target</td>
            <td>Realisasi</td>
            <td>Status</td>
            <td>Progress</td>
            <!-- Kotak Submit (Link submittan dan Submit Date, ada Catatan dan Comment) dan Approval -->
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dt_pekerjaan as $pekerjaan) : ?>
            <tr>
                <td>1</td>
                <td><?= $pekerjaan->pegawai ?></td>
                <td><?= $pekerjaan->target ?></td>
                <td><?= $pekerjaan->realisasi ?></td>
                <td><?= $pekerjaan->status ?></td>
                <td><?= $pekerjaan->progress ?></td>
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