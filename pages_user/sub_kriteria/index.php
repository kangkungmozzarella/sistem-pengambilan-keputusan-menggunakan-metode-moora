<?php include '../layout/headers.php'; ?>
<?php include '../layout/sidebars.php'; ?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-account-multiple"></i>
        </span> Data Sub Kriteria
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
                        <th> Kriteria </th>
                        <th> Sub Kriteria </th>
                        <th> Bobot </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    // Ambil data sub kriteria dari database
                    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_sub_kriteria");
                    while ($row = mysqli_fetch_array($sql)) {
                    ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td><?= $row['kriteria'] ?></td>
                            <td><?= $row['sub_kriteria'] ?></td>
                            <td><?= $row['bobot'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include '../layout/footers.php'; ?>