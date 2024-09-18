<?php include '../layout/headers.php'; ?>
<?php include '../layout/sidebars.php'; ?>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Data Sub Kriteria / Tambah Sub Kriteria
    </h3>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Sub Kriteria</h4>
                <p class="card-description">Silahkan Masukkan Data Sub Kriteria</p>
                <form class="forms-sample" action="add_act.php" method="POST">
                    <div class="form-group">
                        <label for="kriteria">Kriteria</label>
                        <input type="text" name="kriteria" class="form-control" id="kriteria" placeholder="Masukkan Kriteria" required>
                    </div>
                    <div class="form-group">
                        <label for="subKriteria">Sub Kriteria</label>
                        <input type="text" name="sub_kriteria" class="form-control" id="subKriteria" placeholder="Masukkan Sub Kriteria" required>
                    </div>
                    <div class="form-group">
                        <label for="bobot">Bobot</label>
                        <input type="number" step="1" name="bobot" class="form-control" id="bobot" placeholder="Masukkan Bobot" required>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <a href="index.php" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footers.php'; ?>