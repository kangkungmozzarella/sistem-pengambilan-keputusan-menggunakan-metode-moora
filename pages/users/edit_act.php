<?php
include '../../config/koneksi.php';

$id       = $_POST['id'];
$nama     = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password']; // Menggunakan nama variabel sesuai kolom di tabel
$role     = $_POST['role'];

// Query untuk mengupdate data user
mysqli_query($koneksi, "UPDATE tbl_user SET nama='$nama', username='$username', password='$password', role='$role' WHERE id='$id'");

// Redirect kembali ke halaman index dengan alert sukses
header("location:index.php?alert=edit");
