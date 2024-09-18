<?php
include '../../config/koneksi.php';

$nama     = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$role     = $_POST['role']; // Tambahkan role

// Insert data ke dalam tabel tbl_user termasuk role
mysqli_query($koneksi, "INSERT INTO tbl_user (id, nama, username, password, role) VALUES (null, '$nama', '$username', '$password', '$role')");

// Redirect kembali ke halaman index setelah berhasil menambahkan data
header("Location:index.php?alert=add");
