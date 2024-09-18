<?php include '../layout/headers.php'; ?>
<?php include '../layout/sidebars.php'; ?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-account-multiple"></i>
        </span> Data Users
    </h3>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Pengguna</h4>
            <a href="add.php" class="btn btn-primary" style="margin-bottom: 20px;">Tambah Pengguna</a>
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th> No </th>
                        <th> Nama </th>
                        <th> Username </th>
                        <th> Password </th>
                        <th> Role </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    // Ambil data dari tabel tbl_user
                    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_user");
                    while ($row = mysqli_fetch_array($sql)) {
                    ?>
                        <tr class="text-center">
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['password'] ?></td> <!-- Menampilkan password -->
                            <td><?= $row['role'] ?></td> <!-- Menampilkan role (admin/user) -->
                            <td>
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                                <a onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger" href="delete.php?id=<?= $row['id'] ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include '../layout/footers.php'; ?>