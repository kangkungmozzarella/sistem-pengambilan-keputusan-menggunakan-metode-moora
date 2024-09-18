<?php include '../../config/config.php'; ?>
<?php include '../../config/koneksi.php'; ?>

<div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="<?= $base_url ?>dashboard">SPK-MOORA</a>
            <a class="navbar-brand brand-logo-mini" href="<?= $base_url ?>dashboard">WEB</a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>dashboard">
                        <span class="menu-title">Dashboard</span>
                        <i class="mdi mdi-view-dashboard menu-icon"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>kriteria">
                        <span class="menu-title">Data Kriteria</span>
                        <i class="mdi mdi-database menu-icon"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>sub_kriteria">
                        <span class="menu-title">Data Sub Kriteria</span>
                        <i class="mdi mdi-file-tree menu-icon"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>matriks_keputusan">
                        <span class="menu-title">Matriks Keputusan</span>
                        <i class="mdi mdi-format-superscript menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>proses_spk">
                        <span class="menu-title">Perhitungan SPK</span>
                        <i class="mdi mdi-calculator menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url ?>users">
                        <span class="menu-title">Data Users</span>
                        <i class="mdi mdi-account-multiple menu-icon"></i>
                    </a>
                </li>

                <li class="nav-item sidebar-actions">
                    <span class="nav-link">
                        <a href="<?= $base_url ?>auth" class="btn btn-block btn-lg btn-gradient-danger mt-4">Log Out</a>
                    </span>
                </li>
            </ul>

        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <script>
                    document.getElementById('perhitunganSPKToggle').addEventListener('click', function() {
                        var submenu = document.getElementById('perhitunganSPKSubmenu');
                        if (submenu.style.maxHeight === "0px" || submenu.style.maxHeight === "") {
                            submenu.style.maxHeight = submenu.scrollHeight + "px"; // Menyesuaikan dengan tinggi konten
                        } else {
                            submenu.style.maxHeight = "0px";
                        }
                    });
                </script>