<?php include '../layout/headers.php'; ?>
<?php include '../layout/sidebars.php'; ?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Data Kriteria / Edit Kriteria
    </h3>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data</h4>
                <p class="card-description">Silahkan Edit Data</p>
                <form class="forms-sample" action="edit_act.php" method="POST">
                    <?php
                    include '../../config/koneksi.php';

                    // Ubah menjadi kode_kriteria karena URL memiliki ?kode_kriteria
                    $kode_kriteria = $_GET['kode_kriteria'];  // Mengambil kode_kriteria dari URL

                    // Perbaiki query untuk menggunakan kode_kriteria
                    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_kriteria WHERE kode_kriteria = '$kode_kriteria'");
                    $data = mysqli_fetch_array($sql);

                    // Periksa apakah query berhasil mendapatkan data
                    if (!$data) {
                        echo "Data tidak ditemukan!";
                        exit;
                    }

                    // Hitung total bobot untuk normalisasi
                    $sqlTotalBobot = mysqli_query($koneksi, "SELECT SUM(bobot) as total_bobot FROM tbl_kriteria");
                    $resultTotalBobot = mysqli_fetch_assoc($sqlTotalBobot);
                    $totalBobot = $resultTotalBobot['total_bobot'];

                    // Hitung normalisasi untuk kriteria ini
                    $normalisasi = $data['bobot'] / $totalBobot;
                    ?>
                    <div class="form-group">
                        <label for="kodeKriteria">Kode Kriteria</label>
                        <input type="hidden" name="id" value="<?= $data['id'] ?>"> <!-- ID Hidden -->
                        <input type="text" name="kode_kriteria" value="<?= $data['kode_kriteria'] ?>" class="form-control" id="kodeKriteria" placeholder="Kode Kriteria">
                    </div>
                    <div class="form-group">
                        <label for="namaKriteria">Nama Kriteria</label>
                        <input type="text" name="nama_kriteria" value="<?= $data['keterangan'] ?>" class="form-control" id="namaKriteria" placeholder="Nama Kriteria">
                    </div>
                    <div class="form-group">
                        <label for="bobot">Bobot</label>
                        <input type="number" step="0.01" name="bobot" value="<?= $data['bobot'] ?>" class="form-control" id="bobot" placeholder="Bobot">
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select name="jenis" class="form-control" id="jenis" required>
                            <option value="Benefit" <?= $data['jenis'] == 'Benefit' ? 'selected' : '' ?>>Benefit</option>
                            <option value="Cost" <?= $data['jenis'] == 'Cost' ? 'selected' : '' ?>>Cost</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="normalisasi">Normalisasi</label>
                        <input type="text" name="normalisasi" value="<?= number_format($normalisasi, 2) ?>" class="form-control" id="normalisasi" readonly style="background-color: #e9ecef;">
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <a href="index.php" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footers.php'; ?>