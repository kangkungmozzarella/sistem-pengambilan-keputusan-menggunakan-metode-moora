<?php
include '../../config/koneksi.php'; // Sesuaikan path file koneksi

// Ambil data alternatif dan tahun dari URL
$alternatif = $_GET['alternatif'];
$tahun = $_GET['tahun'];

// Mengamankan data dari injeksi SQL dengan prepared statement
if ($stmt = $koneksi->prepare("DELETE FROM tbl_matriks_keputusan WHERE alternatif = ? AND tahun = ?")) {
    // Bind parameter (s = string, i = integer, d = double, b = blob)
    $stmt->bind_param("si", $alternatif, $tahun);  // s untuk string (alternatif) dan i untuk integer (tahun)

    // Eksekusi statement
    if ($stmt->execute()) {
        // Jika berhasil, redirect ke halaman index dengan alert sukses
        header("Location: index.php?alert=hapus_success");
        exit();
    } else {
        // Jika ada kesalahan dalam eksekusi
        echo "Error: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
} else {
    // Jika ada kesalahan dalam persiapan statement
    echo "Error preparing statement: " . $koneksi->error;
}

// Tutup koneksi database
mysqli_close($koneksi);
