<?php
include '../../config/koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM tbl_user WHERE id='$id'");

header("location:index.php?alert=hapus");
