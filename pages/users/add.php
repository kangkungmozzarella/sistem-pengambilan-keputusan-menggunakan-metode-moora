<?php include '../layout/headers.php'; ?>
<?php include '../layout/sidebars.php'; ?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Data Users / Tambah User
    </h3>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data</h4>
                <p class="card-description">Silahkan Masukan Data</p>
                <form class="forms-sample" action="add_act.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputNama1">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" id="exampleInputNama1" placeholder="Masukkan Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputUsername1" placeholder="Masukkan Username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputRole1">Role</label>
                        <select name="role" class="form-control" id="exampleInputRole1">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
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