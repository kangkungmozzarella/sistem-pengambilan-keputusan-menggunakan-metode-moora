<?php include '../layout/headers.php'; ?>
<?php include '../layout/sidebars.php'; ?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-account-multiple"></i>
        </span> Data Kriteria
    </h3>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"></h4>
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th> No </th>
                        <th> Kode Kriteria </th>
                        <th> Nama Kriteria </th>
                        <th> Bobot </th>
                        <th> Normalisasi </th>
                        <th> Jenis </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $totalBobot = 0;
                    $totalNormalisasi = 0;

                    // Hitung total bobot dari database
                    $sql = mysqli_query($koneksi, "SELECT SUM(bobot) as total_bobot FROM tbl_kriteria");
                    $result = mysqli_fetch_assoc($sql);
                    $totalBobot = $result['total_bobot'];

                    // Ambil data kriteria dari database
                    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_kriteria");
                    while ($row = mysqli_fetch_array($sql)) {
                        // Hitung normalisasi berdasarkan bobot / total bobot
                        $normalisasi = $row['bobot'] / $totalBobot;

                        // Tambahkan normalisasi saat ini ke total normalisasi
                        $totalNormalisasi += $normalisasi;
                    ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td><?= $row['kode_kriteria'] ?></td>
                            <td><?= $row['keterangan'] ?></td>
                            <td><?= $row['bobot'] ?></td>
                            <td><?= number_format($normalisasi, 2) ?></td> <!-- Normalisasi diperbaiki ke 2 desimal -->
                            <td><?= $row['jenis'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-center">Total Bobot</th>
                        <th class="text-center"><?= number_format($totalBobot, 0) ?></th>
                        <th class="text-center"><?= number_format($totalNormalisasi, 2) ?></th> <!-- Total normalisasi diperbaiki ke 2 desimal -->
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php include '../layout/footers.php'; ?>