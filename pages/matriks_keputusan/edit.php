<?php include '../layout/headers.php'; ?>
<?php include '../layout/sidebars.php'; ?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-calendar"></i>
        </span> Data Matriks Keputusan / Edit Data Matriks
    </h3>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Matriks Keputusan</h4>
                <p class="card-description">Silahkan Edit Data Matriks Berdasarkan Alternatif dan Tahun</p>
                <form class="forms-sample" action="edit_act.php" method="POST">
                    <?php
                    include '../../config/koneksi.php';

                    // Mengambil alternatif dan tahun dari URL
                    $alternatif = $_GET['alternatif'];
                    $tahun = $_GET['tahun'];

                    // Query untuk mengambil data matriks berdasarkan alternatif dan tahun
                    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_matriks_keputusan WHERE alternatif = '$alternatif' AND tahun = '$tahun'");

                    if (mysqli_num_rows($sql) == 0) {
                        echo "Data tidak ditemukan!";
                        exit;
                    }

                    // Menyimpan data matriks dalam array
                    $data_matriks = [];
                    while ($row = mysqli_fetch_assoc($sql)) {
                        $data_matriks[$row['kode_kriteria']] = $row['nilai'];
                    }
                    ?>
                    <input type="hidden" name="alternatif" value="<?= $alternatif ?>"> <!-- Tambahkan Alternatif ke input hidden -->
                    <input type="hidden" name="tahun" value="<?= $tahun ?>"> <!-- Tambahkan Tahun ke input hidden -->

                    <!-- Menampilkan kriteria dan nilai yang akan diedit -->
                    <?php
                    $query_kriteria = "SELECT * FROM tbl_kriteria";
                    $sql_kriteria = mysqli_query($koneksi, $query_kriteria);
                    while ($kriteria = mysqli_fetch_array($sql_kriteria)) {
                        $kode_kriteria = $kriteria['kode_kriteria'];
                        $nilai = isset($data_matriks[$kode_kriteria]) ? $data_matriks[$kode_kriteria] : 0;  // Ambil nilai jika ada, jika tidak, set 0
                    ?>
                        <div class="form-group">
                            <label for="nilai_<?= $kode_kriteria ?>"><?= $kode_kriteria ?></label>
                            <input type="number" name="nilai_<?= $kode_kriteria ?>" value="<?= $nilai ?>" class="form-control" id="nilai_<?= $kode_kriteria ?>" placeholder="Masukkan nilai untuk <?= $kode_kriteria ?>">
                        </div>
                    <?php } ?>

                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footers.php'; ?>