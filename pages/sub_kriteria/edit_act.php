<?php
include '../../config/koneksi.php';

// Ambil data dari form yang dikirim melalui POST
$id = $_POST['id'];  // Mengambil ID dari hidden input
$kriteria = $_POST['kriteria'];  // Mengambil Kriteria yang diedit
$sub_kriteria = $_POST['sub_kriteria'];  // Mengambil Sub Kriteria yang diedit
$bobot = $_POST['bobot'];  // Mengambil Bobot baru yang diedit

// Update data sub kriteria di database
$update = mysqli_query($koneksi, "UPDATE tbl_sub_kriteria SET kriteria='$kriteria', sub_kriteria='$sub_kriteria', bobot='$bobot' WHERE id='$id'");

// Periksa apakah query berhasil
if ($update) {
    // Redirect ke halaman index dengan alert sukses
    header("location:index.php?alert=edit_success");
} else {
    // Redirect ke halaman index dengan alert error jika update gagal
    header("location:index.php?alert=edit_failed");
}
