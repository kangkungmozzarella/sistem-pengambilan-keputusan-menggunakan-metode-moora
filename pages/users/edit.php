<?php include '../layout/headers.php'; ?>
<?php include '../layout/sidebars.php'; ?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Data Users / Edit User
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
                    $id = $_GET['id'];
                    $sql = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE id = '$id'");
                    $data = mysqli_fetch_array($sql);
                    ?>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Nama Lengkap</label>
                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                        <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control" id="exampleInputUsername1" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>
                        <input type="text" name="username" value="<?= $data['username'] ?>" class="form-control" id="exampleInputUsername1" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" value="<?= $data['password'] ?>" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputRole1">Role</label>
                        <select name="role" class="form-control" id="exampleInputRole1">
                            <option value="admin" <?= ($data['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                            <option value="user" <?= ($data['role'] == 'user') ? 'selected' : '' ?>>User</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <a href="index.php" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../layout/footers.php'; ?>