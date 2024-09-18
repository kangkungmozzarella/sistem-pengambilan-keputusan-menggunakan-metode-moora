<?php
include '../../config/koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Mengamankan data dari injeksi SQL
$id = mysqli_real_escape_string($koneksi, $id);

// Melakukan query DELETE pada tabel tbl_kriteria berdasarkan id
$query = "DELETE FROM tbl_kriteria WHERE id='$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    // Menghitung ulang total bobot setelah penghapusan
    $total_bobot_query = mysqli_query($koneksi, "SELECT SUM(bobot) as total_bobot FROM tbl_kriteria");
    $total_bobot_result = mysqli_fetch_array($total_bobot_query);
    $total_bobot = $total_bobot_result['total_bobot'];

    // Menghitung ulang nilai normalisasi untuk semua kriteria yang tersisa
    $kriteria_query = mysqli_query($koneksi, "SELECT * FROM tbl_kriteria");
    while ($kriteria = mysqli_fetch_array($kriteria_query)) {
        $new_normalisasi = $kriteria['bobot'] / $total_bobot;
        $update_normalisasi_query = "UPDATE tbl_kriteria SET normalisasi='$new_normalisasi' WHERE id='" . $kriteria['id'] . "'";
        mysqli_query($koneksi, $update_normalisasi_query);
    }

    // Redirect ke halaman index dengan alert hapus
    header("Location: index.php?alert=hapus");
} else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
