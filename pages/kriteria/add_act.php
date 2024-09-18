<?php
include '../../config/koneksi.php';

// Ambil data dari form
$kode_kriteria = $_POST['kode_kriteria'];  // Menangkap Kode Kriteria yang diinput
$nama_kriteria = $_POST['nama_kriteria'];  // Menangkap Nama Kriteria (kolom keterangan)
$bobot = $_POST['bobot'];  // Menangkap Bobot yang diinput
$jenis = $_POST['jenis'];  // Menangkap Jenis Kriteria (Benefit/Cost)

// Insert data ke dalam tabel tbl_kriteria
mysqli_query($koneksi, "INSERT INTO tbl_kriteria (kode_kriteria, keterangan, bobot, jenis) 
VALUES ('$kode_kriteria', '$nama_kriteria', '$bobot', '$jenis')");

// Redirect kembali ke halaman index dengan alert sukses
header("location:index.php?alert=add_success");
