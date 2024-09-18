<?php include '../layout/headers.php'; ?>
<?php include '../layout/sidebars.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Dashboard
    </h3>
</div>

<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-primary card-img-holder text-white">
            <div class="card-body">
                <img src="../../src/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Jumlah Data Kriteria <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <?php
                $sql = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_kriteria");
                $data = mysqli_fetch_assoc($sql);
                $jumlah_kriteria = $data['total'];
                ?>
                <h2 class="mb-5"><?= $jumlah_kriteria ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="../../src/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Jumlah Data Sub Kriteria <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <?php
                $sql = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_sub_kriteria");
                $data = mysqli_fetch_assoc($sql);
                $jumlah_subkriteria = $data['total'];
                ?>
                <h2 class="mb-5"><?= $jumlah_subkriteria ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="../../src/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Jumlah Data Matriks Keputusan <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <?php
                $sql = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_matriks_keputusan");
                $data = mysqli_fetch_assoc($sql);
                $jumlah_matrikskeputusan = $data['total'];
                ?>
                <h2 class="mb-5"><?= $jumlah_matrikskeputusan ?></h2>
            </div>
        </div>
    </div>

    <?php include '../layout/footers.php'; ?>

    </style>