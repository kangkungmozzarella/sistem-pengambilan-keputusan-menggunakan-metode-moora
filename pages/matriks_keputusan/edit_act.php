<?php
include '../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alternatif = $_POST['alternatif'];  // Mengambil alternatif dari form
    $tahun = $_POST['tahun'];  // Mengambil tahun dari form

    // Query untuk mengambil semua kriteria
    $query_kriteria = "SELECT kode_kriteria FROM tbl_kriteria";
    $result_kriteria = mysqli_query($koneksi, $query_kriteria);

    // Lakukan perulangan untuk setiap kriteria
    while ($row_kriteria = mysqli_fetch_assoc($result_kriteria)) {
        $kode_kriteria = $row_kriteria['kode_kriteria'];  // Mengambil kode_kriteria
        $nilai_kriteria = $_POST['nilai_' . $kode_kriteria];  // Mengambil nilai yang diinputkan dari form

        // Update data ke tabel matriks keputusan
        $query_update = "UPDATE tbl_matriks_keputusan 
                         SET nilai='$nilai_kriteria' 
                         WHERE alternatif='$alternatif' 
                         AND tahun='$tahun' 
                         AND kode_kriteria='$kode_kriteria'";

        // Eksekusi query update
        if (!mysqli_query($koneksi, $query_update)) {
            // Jika terjadi kesalahan, tampilkan pesan error dan redirect ke halaman edit
            echo "<script>alert('Gagal memperbarui data!');window.location='edit.php?alternatif=$alternatif&tahun=$tahun';</script>";
            exit();  // Hentikan eksekusi jika ada error
        }
    }

    // Jika semua data berhasil diperbarui, redirect ke halaman index
    echo "<script>alert('Data matriks berhasil diperbarui!');window.location='index.php';</script>";
}
