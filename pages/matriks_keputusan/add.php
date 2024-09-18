<?php include '../layout/headers.php'; ?>
<?php include '../layout/sidebars.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-plus"></i>
        </span> Tambah Data Matriks Keputusan
    </h3>
</div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form action="add_act.php" method="POST">
                <div class="form-group">
                    <label for="alternatif">Alternatif</label>
                    <input type="text" name="alternatif" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <select name="tahun" class="form-control">
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
                <?php
                $query_kriteria = "SELECT * FROM tbl_kriteria";
                $sql_kriteria = mysqli_query($koneksi, $query_kriteria);
                while ($kriteria = mysqli_fetch_array($sql_kriteria)) {
                ?>
                    <div class="form-group">
                        <label for="nilai_<?= $kriteria['kode_kriteria'] ?>"><?= $kriteria['kode_kriteria'] ?></label>
                        <input type="number" name="nilai_<?= $kriteria['kode_kriteria'] ?>" class="form-control" required>
                    </div>
                <?php } ?>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <!-- Tambahkan tombol Cancel -->
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?php include '../layout/footers.php'; ?>