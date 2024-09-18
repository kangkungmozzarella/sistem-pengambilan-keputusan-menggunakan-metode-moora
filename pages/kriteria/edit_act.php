<?php
include '../../config/koneksi.php';

// Ambil data dari form yang dikirim melalui POST
$id = $_POST['id'];  // Mengambil ID dari hidden input
$kode_kriteria = $_POST['kode_kriteria'];  // Mengambil Kode Kriteria yang diedit
$nama_kriteria = $_POST['nama_kriteria'];  // Mengambil Nama Kriteria (kolom keterangan)
$bobot = $_POST['bobot'];  // Mengambil Bobot baru yang diedit
$jenis = $_POST['jenis'];  // Mengambil Jenis kriteria

// Update data kriteria di database
mysqli_query($koneksi, "UPDATE tbl_kriteria SET kode_kriteria='$kode_kriteria', keterangan='$nama_kriteria', bobot='$bobot', jenis='$jenis' WHERE id='$id'");

// Hitung ulang total bobot
$sqlTotalBobot = mysqli_query($koneksi, "SELECT SUM(bobot) as total_bobot FROM tbl_kriteria");
$resultTotalBobot = mysqli_fetch_assoc($sqlTotalBobot);
$totalBobot = $resultTotalBobot['total_bobot'];

// Ambil semua data kriteria untuk menghitung normalisasi
$sqlKriteria = mysqli_query($koneksi, "SELECT * FROM tbl_kriteria");

// Loop untuk menghitung normalisasi setiap kriteria berdasarkan total bobot
while ($row = mysqli_fetch_assoc($sqlKriteria)) {
    $normalisasi = $row['bobot'] / $totalBobot;  // Perhitungan normalisasi
    $id_kriteria = $row['id'];

    // Update nilai normalisasi di database
    mysqli_query($koneksi, "UPDATE tbl_kriteria SET normalisasi='$normalisasi' WHERE id='$id_kriteria'");
}

// Redirect ke halaman index dengan alert sukses
header("location:index.php?alert=edit_success");
