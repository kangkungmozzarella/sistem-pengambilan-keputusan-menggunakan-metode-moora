<?php include '../layout/headers.php'; ?>
<?php include '../layout/sidebars.php'; ?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Data Sub Kriteria / Edit Sub Kriteria
    </h3>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Sub Kriteria</h4>
                <p class="card-description">Silahkan Edit Data Sub Kriteria</p>
                <form class="forms-sample" action="edit_act.php" method="POST">
                    <?php
                    include '../../config/koneksi.php';

                    // Mengambil id dari URL
                    $id = $_GET['id'];  // Mengambil id dari URL

                    // Query untuk mengambil data sub kriteria berdasarkan id
                    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_sub_kriteria WHERE id = '$id'");
                    $data = mysqli_fetch_array($sql);

                    // Periksa apakah query berhasil mendapatkan data
                    if (!$data) {
                        echo "Data tidak ditemukan!";
                        exit;
                    }
                    ?>
                    <input type="hidden" name="id" value="<?= $data['id'] ?>"> <!-- Tambahkan ID ke input hidden -->
                    <div class="form-group">
                        <label for="kriteria">Kriteria</label>
                        <input type="text" name="kriteria" value="<?= $data['kriteria'] ?>" class="form-control" id="kriteria" placeholder="Kriteria">
                    </div>
                    <div class="form-group">
                        <label for="subKriteria">Sub Kriteria</label>
                        <input type="text" name="sub_kriteria" value="<?= $data['sub_kriteria'] ?>" class="form-control" id="subKriteria" placeholder="Sub Kriteria">
                    </div>
                    <div class="form-group">
                        <label for="bobot">Bobot</label>
                        <input type="number" step="1" name="bobot" value="<?= $data['bobot'] ?>" class="form-control" id="bobot" placeholder="Bobot">
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <a href="index.php" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footers.php'; ?>