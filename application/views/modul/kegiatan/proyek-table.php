<?php
// var_dump($dt_proyek);
?>

<table class="table table-bordered table-striped" id="dataTable-proyek" width="100%" cellspacing="0">
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
        <?php foreach ($dt_proyek as $index => $proyek) : ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= $proyek->nama_proyek ?></td>
                <td><?= $proyek->start_date ?></td>
                <td><?= $proyek->end_date ?></td>
                <td class="project-state">
                    <?php
                    switch ($proyek->status) {
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
                            echo '<span class="badge badge-secondary">' . $proyek->status . '</span>';
                            break;
                    }
                    ?>

                    <?php
                    $endDate = new DateTime($proyek->end_date);
                    $today = new DateTime();
                    $diff = (new DateTime($proyek->end_date))->diff(new DateTime());
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
                <td><?= $proyek->tahun ?></td>
                <td>
                    <div>
                        <div class="btn btn-warning btn-edit-proyek" data-id_proyek="<?= $proyek->id; ?>">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </div>
                        <form action="<?php echo base_url('proyek/hapus/' . $proyek->id . ''); ?>" method="post" style="display:inline;">
                            <button type="submit" class="btn btn-danger confirm-btn">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                        <div class="tr-proyek btn btn-outline-success" data-id_proyek="<?= $proyek->id; ?>" data-nama_proyek="<?= $proyek->nama_proyek; ?>">
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>