<?php
include '../../config/koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Mengamankan data dari injeksi SQL
$id = mysqli_real_escape_string($koneksi, $id);

// Melakukan query DELETE pada tabel tbl_sub_kriteria berdasarkan id
$query = "DELETE FROM tbl_sub_kriteria WHERE id='$id'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    // Redirect ke halaman index dengan alert hapus
    header("Location: index.php?alert=hapus_success");
} else {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
