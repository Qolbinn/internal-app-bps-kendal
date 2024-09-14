<?php
// var_dump($master_kegiatan);
// var_dump($anggota_tim);
?>
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="https://picsum.photos/seed/picsum/300/300" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?= $ketua_tim->nama ?></h3>
                <p class="text-muted text-center"><?= $ketua_tim->jabatan ?></p>
                <div class="btn btn-primary btn-block"><b>Ketua Tim</b></div>
            </div>

        </div>
    </div>
    <div class="col-md-9">
        <h3 class="text-primary mx-2 mt-2 mb-3">
            <i class="fa fa-users"></i> <?= $tim_selected->nama_tim ?>
        </h3>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong><i class="fas fa-book mr-1"></i> Jumlah Anggota</strong>
                        <p class="text-muted">
                            <?= $anggota_tim ? count($anggota_tim) : '0'; ?> Orang
                        </p>
                    </div>
                    <div>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-info-anggota">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </button>
                        <button class="btn btn-success" data-toggle="modal" data-target="#modal-tambah-anggota">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <hr class="mt-0">
                <!-- Jumlah Proyek -->
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong><i class="fas fa-book mr-1"></i> Jumlah Proyek</strong>
                        <p class="text-muted">
                            <?= $dt_proyek ? count($dt_proyek) : '0'; ?> Proyek
                        </p>
                    </div>
                    <div>
                        <button class="btn btn-success" data-toggle="modal" data-target="#modal-tambah-proyek">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <hr class="mt-0">
            </div>
        </div>
    </div>
</div>