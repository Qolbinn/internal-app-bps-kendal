<?php
// var_dump($dt_proyek);
// foreach ($dt_tim as $tim):
//     echo $tim->nama_tim . '<br>';
// endforeach;
?>


<div class="row">
    <?php foreach ($dt_tim as $tim) : ?>
        <div class="col info-box shadow">
            <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
            <div class="info-box-content">
                <span class="info-box-number"><?= $tim->nama_tim ?></span>
                <span class="info-box-text">Shadows1</span>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="https://picsum.photos/seed/picsum/300/300" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">Bu Ernie</h3>
                <p class="text-muted text-center">Statistisi</p>
                <div class="btn btn-primary btn-block"><b>Ketua Tim</b></div>
            </div>

        </div>
    </div>
    <div class="col-md-9">
        <h3 class="text-primary mx-2 mt-2 mb-3">
            <i class="fa fa-users"></i> Tim Desa Cantik
        </h3>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong><i class="fas fa-book mr-1"></i> Jumlah Anggota</strong>
                        <p class="text-muted">
                            15 Orang
                        </p>
                    </div>
                    <div>
                        <div class="btn btn-primary">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </div>
                        <div class="btn btn-warning">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <hr class="mt-0">
                <!-- Jumlah Proyek -->
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong><i class="fas fa-book mr-1"></i> Jumlah Proyek</strong>
                        <p class="text-muted">
                            15 Orang
                        </p>
                    </div>
                    <div>
                        <div class="btn btn-primary">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </div>
                        <div class="btn btn-warning">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <hr class="mt-0">
            </div>
        </div>
    </div>
</div>

<div class="">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" id="breadcrumb-proyek"><a>Proyek</a></li>
        <li class="breadcrumb-item" id="breadcrumb-bidang"><?php echo $rmenu ?></li>
        <li class="breadcrumb-item active" id="breadcrumb-nama-proyek" style="display: none;"></li>
        <li class="breadcrumb-item active" id="breadcrumb-nama-kegiatan" style="display: none;"></li>
    </ol>
</div>

<!-- Div untuk memuat tabel -->
<div id="table-container">
    <!-- Isi Tabel Dinamis -->
    <div class="proyek-table" style="display: inline;">
        <?php
        include 'proyek-table.php';
        ?>
    </div>
    <div class="kegiatan-table" style="display: none;">
        <?php
        include 'kegiatan-table.php';
        ?>
    </div>
    <div class="pekerjaan-table" style="display: none;">
        <?php
        include 'pekerjaan-table.php';
        ?>
    </div>
</div>


<!-- Toggle Modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary">
    Launch Primary Modal
</button>

<div class="modal fade" id="modal-primary" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Informasi Anggota $NamaTIM</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div> -->