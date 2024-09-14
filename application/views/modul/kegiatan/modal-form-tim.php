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

<!-- Modal Tambah Proyek -->
<div class="modal fade" id="modal-tambah-proyek" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Tambah Proyek <?= $tim_selected->nama_tim ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?php echo base_url('proyek/tambah/' . $tim_selected->id . '') ?>" method="post">
                <div class="modal-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="border-width: 0;">
                        <li class="nav-item mx-2" role="presentation">
                            <button class="nav-link active" id="pills-desc-proyek-tab" data-toggle="pill" data-target="#pills-desc-proyek" type="button" role="tab" aria-controls="pills-desc-proyek" aria-selected="true">Deskripsi Proyek</button>
                        </li>
                        <li class="nav-item mx-2" role="presentation">
                            <button class="nav-link" id="pills-kegiatan-proyek-tab" data-toggle="pill" data-target="#pills-kegiatan-proyek" type="button" role="tab" aria-controls="pills-kegiatan-proyek" aria-selected="false">Kegiatan Proyek</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-desc-proyek" role="tabpanel" aria-labelledby="pills-desc-proyek-tab">
                            <div class="card-body">

                                <!-- Nama Proyek -->
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="master_proyek">Jenis Proyek</label>
                                            <select name="master_proyek" class="form-control select2" style="width: 100%; height: 100px;" required>
                                                <option disabled selected value="">
                                                </option>
                                                <?php foreach ($master_proyek as $proyek) : ?>
                                                    <option value="<?= urlencode($proyek->id) ?>"><?= $proyek->nama_proyek ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <small class="text-secondary">Nama proyek adalah gabungan Jenis Proyek dan Detail Proyek</small>
                                    </div>
                                    <div class="form-group col">
                                        <label for="detail_proyek">Detail Proyek</label>
                                        <input type="text" name="detail_proyek" class="form-control" placeholder="Detail proyek" required>
                                    </div>
                                </div>
                                <h5 class="nama-akhir-proyek"></h5>

                                <!-- Hidden input to store the final project name -->
                                <input type="hidden" name="nama_akhir_proyek" value="">

                                <!-- Date Proyek -->
                                <div class="row">
                                    <div class="form-group col">
                                        <label for="start_proyek">Start Date:</label>
                                        <div class="input-group date input-date" id="start-date" data-target-input="nearest">
                                            <input type="text" name="start_proyek" class="form-control datetimepicker-input" data-target="#start-date" required />
                                            <div class="input-group-append" data-target="#start-date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label for="end_proyek">End Date:</label>
                                        <div class="input-group date input-date" id="end-date" data-target-input="nearest">
                                            <input type="text" name="end_proyek" class="form-control datetimepicker-input" data-target="#end-date" required />
                                            <div class="input-group-append" data-target="#end-date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Summer Note -->
                                <div class="form-group">
                                    <label for="strategi">Strategi Proyek:</label>
                                    <div id="summernote" class="grid-item"></div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-kegiatan-proyek" role="tabpanel" aria-labelledby="pills-kegiatan-proyek-tab">
                            <div class="card-body">
                                <div class="text-right">
                                    <div class="btn btn-primary" id="tambah-kegiatan">Tambah Kegiatan</div>
                                </div>
                                <div class="container-kegiatan" style="max-height: 320px; overflow-y: auto;; overflow-x: hidden;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <div type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</div>
                    <button type="submit" class="btn btn-primary confirm-btn">Save Proyek</button>
                </div>
            </form>
        </div>

    </div>

</div>

<!-- Modal Update Proyek -->
<div class="modal fade" id="modal-update-proyek" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Tambah Proyek <?= $tim_selected->nama_tim ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form action="<?php echo base_url('proyek/tambah/' . $tim_selected->id . '') ?>" method="post">
                <div class="card-body">
                    <!-- Nama Proyek -->
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="master_proyek">Jenis Proyek</label>
                                <input type="text" name="master_proyek" class="form-control" disabled>
                            </div>
                            <h5>Nama proyek adalah gabungan dari bla-bla</h5>
                        </div>
                        <div class="form-group col">
                            <label for="detail_proyek">Detail Proyek</label>
                            <input type="text" name="detail_proyek" class="form-control" placeholder="Detail proyek" required>
                        </div>
                    </div>
                    <h5 class="nama-akhir-proyek"></h5>

                    <!-- Hidden input to store the final project name -->
                    <input type="hidden" name="nama_akhir_proyek" value="">

                    <!-- Date Proyek -->
                    <div class="row">
                        <div class="form-group col">
                            <label for="start_proyek">Start Date:</label>
                            <div class="input-group date input-date" id="start-date" data-target-input="nearest">
                                <input type="text" name="start_proyek" class="form-control datetimepicker-input" data-target="#start-date" required />
                                <div class="input-group-append" data-target="#start-date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="end_proyek">End Date:</label>
                            <div class="input-group date input-date" id="end-date" data-target-input="nearest">
                                <input type="text" name="end_proyek" class="form-control datetimepicker-input" data-target="#end-date" required />
                                <div class="input-group-append" data-target="#end-date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col">
                            <label for="status_proyek">Status:</label>
                            <select name="status_proyek" class="form-control select2" style="width: 100%; height: 100px;" required>
                                <option disabled value=""></option>
                                <option value="Pending">Pending</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>

                    <!-- Summer Note -->
                    <div class="form-group">
                        <label for="strategi">Strategi Proyek:</label>
                        <div id="summernote" class="grid-item"></div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <div type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</div>
                    <button type="submit" class="btn btn-primary confirm-btn">Update Proyek</button>
                </div>
            </form>
        </div>

    </div>

</div>