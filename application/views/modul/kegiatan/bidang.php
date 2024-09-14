<?php
// var_dump($dt_proyek);
// foreach ($dt_tim as $tim):
//     echo $tim->nama_tim . '<br>';
// endforeach;
// $id_tim = NULL;
?>

<form method="get" action="<?= base_url('kegiatan/' . $bidang . '') ?>">
    <div class="form-group">
        <label>Pilih Nama Tim</label>
        <select name="nama_tim" class="form-control select2" style="width: 100%;">
            <option selected="selected" value="">
                <?php
                if (isset($tim_selected)):
                    echo '' . $tim_selected->nama_tim . '';
                endif;
                ?>
            </option>
            <?php foreach ($dt_tim as $tim) : ?>
                <option value="<?= urlencode($tim->nama_tim) ?>"><?= $tim->nama_tim ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div style="text-align: right;">
        <button type="submit" class="btn btn-primary mb-2">Pilih Tim</button>
    </div>
</form>

<?php if (isset($tim_selected)): ?>
    <div class="content-bidang">

        <?php
        include 'tim-description.php';
        include 'modal-form-tim.php';
        ?>

        <ol class="breadcrumb">
            <li class="breadcrumb-item" id="breadcrumb-proyek">Proyek</li>
            <li class="breadcrumb-item" id="breadcrumb-bidang"><?php echo $tim_selected->nama_tim ?></li>
            <li class="breadcrumb-item active" id="breadcrumb-nama-proyek" style="display: none;">
                <!-- <?php echo $nama_proyek_selected ?? "proyek tidak terambil"; ?> -->
            </li>
            <li class="breadcrumb-item active" id="breadcrumb-nama-kegiatan" style="display: none;">
                <!-- <?php echo $nama_kegiatan_selected ?? "kegiatan tidak terambil"; ?> -->
            </li>
        </ol>

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
                // include 'kegiatan-table.php';
                ?>
            </div>
            <div class="pekerjaan-table" style="display: none;">
                <?php
                // include 'pekerjaan-table.php';
                ?>
            </div>
        </div>



    </div>

<?php else : ?>
    <div class="none-tim">
        <h1>Tolong Pilih Timnya dahulu</h1>
    </div>

    <?php
    // var_dump($tim_selected);
    ?>
<?php endif; ?>