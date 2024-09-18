<?php
include '../../config/koneksi.php';

// Ambil data dari form
$kriteria = $_POST['kriteria'];  // Menangkap Kriteria yang diinput
$sub_kriteria = $_POST['sub_kriteria'];  // Menangkap Sub Kriteria yang diinput
$bobot = $_POST['bobot'];  // Menangkap Bobot yang diinput

// Insert data ke dalam tabel tbl_sub_kriteria
$query = "INSERT INTO tbl_sub_kriteria (kriteria, sub_kriteria, bobot) 
VALUES ('$kriteria', '$sub_kriteria', '$bobot')";

// Eksekusi query dan cek apakah berhasil
if (mysqli_query($koneksi, $query)) {
    // Redirect kembali ke halaman index dengan alert sukses
    header("location:index.php?alert=add_success");
} else {
    // Jika gagal, tampilkan pesan error
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Tutup koneksi database
mysqli_close($koneksi);
