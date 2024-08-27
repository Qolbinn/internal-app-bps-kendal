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


<!-- Modal Info Anggota TIM -->
<div class="modal fade" id="modal-info-anggota" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Anggota <?= $tim_selected->nama_tim ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" id="search-anggota-tim" class="form-control" placeholder="Cari anggota tim...">
                    </div>
                    <div class="col" style="max-height: 300px; overflow-y: auto;">
                        <?php if (!empty($anggota_tim)) : ?>
                            <?php foreach ($anggota_tim as $anggota) : ?>
                                <form action="<?php echo base_url('hapus_anggota_tim/' . $anggota->user_role_id . ''); ?>" method="post" data-confirm-message="Apakah yakin ingin menghapus anggota tim?">
                                    <div class="user-block col mb-2">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <img class="img-circle img-bordered-sm" src="https://picsum.photos/seed/picsum/128/128" alt="User Image">
                                                <span class="username nama-anggota-tim">
                                                    <?= htmlspecialchars($anggota->nama) ?>
                                                </span>
                                                <span class="description"><?= htmlspecialchars($anggota->jabatan) ?></span>
                                            </div>
                                            <div class="col-4 text-right">
                                                <button type="submit" class="btn btn-danger confirm-btn" style="padding: 4px 8px; font-size: 12px; border-radius: 4px;">
                                                    <i class="fa fa-trash" aria-hidden="true" style="font-size: 14px;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <h3 class="text-center">-- Belum ada anggota tim --</h1>
                            <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="modal-footer text-right">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Tambah Anggota Tim -->
<div class="modal fade" id="modal-tambah-anggota" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url('tambah_anggota_tim/' . $tim_selected->id . ''); ?>" method="post" data-confirm-message="Apakah yakin ingin menambah anggota tim?">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title">Tambah Anggota</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_pegawai">Pilih Anggota Baru <?= $tim_selected->nama_tim ?></label>
                        <select name="id_pegawai" class="form-control select2" style="width: 100%;" required>
                            <option selected="selected" value="">
                            </option>
                            <?php foreach ($new_anggota as $anggota) : ?>
                                <option value="<?= urlencode($anggota->id) ?>"><?= $anggota->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="button submit" class="btn btn-primary confirm-btn">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>