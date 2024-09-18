<?php
include '../../config/koneksi.php'; // Sesuaikan dengan lokasi file koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alternatif = $_POST['alternatif'];  // Ambil alternatif dari form
    $tahun = $_POST['tahun'];  // Ambil tahun dari form

    // Ambil data kriteria dari tabel tbl_kriteria
    $query_kriteria = "SELECT kode_kriteria FROM tbl_kriteria";
    $result_kriteria = mysqli_query($koneksi, $query_kriteria);

    // Periksa apakah data untuk alternatif dan tahun yang sama sudah ada
    $cek_tahun = mysqli_query($koneksi, "SELECT * FROM tbl_matriks_keputusan WHERE alternatif='$alternatif' AND tahun='$tahun'");

    if (mysqli_num_rows($cek_tahun) > 0) {
        // Jika data tahun dan alternatif sudah ada, tampilkan pesan
        echo "<script>alert('Data untuk alternatif dan tahun tersebut sudah ada!');window.location='add.php';</script>";
    } else {
        // Lakukan perulangan untuk setiap kriteria dan masukkan nilai ke tbl_matriks_keputusan
        while ($row_kriteria = mysqli_fetch_assoc($result_kriteria)) {
            $kode_kriteria = $row_kriteria['kode_kriteria'];  // Ambil kode kriteria
            $nilai_kriteria = $_POST['nilai_' . $kode_kriteria];  // Ambil nilai yang diinputkan untuk kriteria tersebut

            // Masukkan data ke tabel matriks keputusan
            $query_insert = "INSERT INTO tbl_matriks_keputusan (alternatif, tahun, kode_kriteria, nilai) 
                             VALUES ('$alternatif', '$tahun', '$kode_kriteria', '$nilai_kriteria')";

            if (!mysqli_query($koneksi, $query_insert)) {
                // Jika terjadi kesalahan saat insert, tampilkan pesan error
                echo "<script>alert('Gagal menambahkan data matriks!');window.location='add.php';</script>";
                exit();  // Hentikan proses jika terjadi error
            }
        }
        // Jika semua data berhasil diinput, tampilkan pesan sukses dan redirect ke halaman index
        echo "<script>alert('Data matriks berhasil ditambahkan!');window.location='index.php';</script>";
    }
}
