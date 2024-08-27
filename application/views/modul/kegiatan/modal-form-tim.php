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