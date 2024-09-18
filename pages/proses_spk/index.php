<?php include '../layout/headers.php'; ?>
<?php include '../layout/sidebars.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-calculator"></i>
        </span> Proses Perhitungan Moora
    </h3>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Normalisasi Matriks Keputusan</h4>

                <!-- Form untuk memilih tahun dan mencari alternatif -->
                <form method="GET" action="index.php">
                    <div class="form-group">
                        <label for="tahun">Pilih Tahun:</label>
                        <select id="tahun" name="tahun" class="form-control" onchange="showSearch()">
                            <option value="">Pilih Tahun</option>
                            <option value="2021" <?= (isset($_GET['tahun']) && $_GET['tahun'] == '2021') ? 'selected' : '' ?>>2021</option>
                            <option value="2022" <?= (isset($_GET['tahun']) && $_GET['tahun'] == '2022') ? 'selected' : '' ?>>2022</option>
                            <option value="2023" <?= (isset($_GET['tahun']) && $_GET['tahun'] == '2023') ? 'selected' : '' ?>>2023</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary">Lihat Data</button>
                </form>

                <?php
                if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                    $tahun = $_GET['tahun'];
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Mengambil semua data alternatif tanpa pagination
                    $alternatifQuery = mysqli_query($koneksi, "
                        SELECT DISTINCT alternatif 
                        FROM tbl_matriks_keputusan 
                        WHERE tahun='$tahun' 
                        AND alternatif LIKE '%$search%'
                    ");
                    $alternatifData = mysqli_fetch_all($alternatifQuery, MYSQLI_ASSOC);

                    echo "<h4 class='mt-4'>Normalisasi Matriks Keputusan Tahun $tahun</h4>";

                    echo '<div class="table-responsive">';
                    echo '<table class="table table-bordered">';
                    echo '<thead>';
                    echo '<tr class="text-center">';
                    echo '<th>No</th>';
                    echo '<th>Alternatif</th>';
                    $kriteriaQuery = mysqli_query($koneksi, "SELECT * FROM tbl_kriteria");
                    $kriteriaList = [];
                    while ($kriteria = mysqli_fetch_assoc($kriteriaQuery)) {
                        echo "<th>{$kriteria['kode_kriteria']} ({$kriteria['jenis']})</th>";
                        $kriteriaList[] = $kriteria;
                    }
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    $sumSquaresQuery = mysqli_query($koneksi, "
                        SELECT kode_kriteria, SUM(POWER(nilai, 2)) as sum_squares
                        FROM tbl_matriks_keputusan
                        WHERE tahun='$tahun'
                        GROUP BY kode_kriteria
                    ");
                    $sumSquaresData = [];
                    while ($row = mysqli_fetch_assoc($sumSquaresQuery)) {
                        $sumSquaresData[$row['kode_kriteria']] = sqrt($row['sum_squares']);
                    }

                    $nilaiQuery = mysqli_query($koneksi, "
                        SELECT alternatif, kode_kriteria, nilai 
                        FROM tbl_matriks_keputusan 
                        WHERE tahun='$tahun'
                    ");
                    $nilaiData = [];
                    while ($nilaiRow = mysqli_fetch_assoc($nilaiQuery)) {
                        $nilaiData[$nilaiRow['alternatif']][$nilaiRow['kode_kriteria']] = $nilaiRow['nilai'];
                    }

                    $no = 1;
                    if (count($alternatifData) > 0) {
                        foreach ($alternatifData as $altRow) {
                            echo "<tr class='text-center'>";
                            echo "<td>{$no}</td>";
                            echo "<td>{$altRow['alternatif']}</td>";

                            foreach ($kriteriaList as $kode_kriteria) {
                                if (isset($nilaiData[$altRow['alternatif']][$kode_kriteria['kode_kriteria']])) {
                                    $nilai = $nilaiData[$altRow['alternatif']][$kode_kriteria['kode_kriteria']];
                                    $akarKuadrat = $sumSquaresData[$kode_kriteria['kode_kriteria']];

                                    if ($akarKuadrat > 0) {
                                        $nilaiNormalisasi = $nilai / $akarKuadrat;
                                        echo "<td>" . round($nilaiNormalisasi, 2) . "</td>";
                                    } else {
                                        echo "<td>-</td>";
                                    }
                                } else {
                                    echo "<td>-</td>";
                                }
                            }

                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='100%' class='text-center'>Tidak ada data yang ditemukan</td></tr>";
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';

                    // Optimasi MOORA tanpa pagination
                    echo '<div class="table-responsive mt-4">';
                    echo '<h4 class="mt-4">Hasil Optimasi MOORA</h4>';
                    echo '<table class="table table-bordered">';
                    echo '<thead>';
                    echo '<tr class="text-center">';
                    echo '<th>No</th>';
                    echo '<th>Alternatif</th>';
                    echo '<th>Optimasi Benefit</th>';
                    echo '<th>Optimasi Cost</th>';
                    echo '<th>Rasio MOORA</th>';
                    echo '<th>Ranking</th>';
                    echo '<th>Kelayakan</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    // Hitung rasio MOORA
                    $rasioMooraArray = [];
                    foreach ($alternatifData as $altRow) {
                        $optimasiBenefit = 0;
                        $optimasiCost = 0;

                        foreach ($kriteriaList as $kriteria) {
                            $kode_kriteria = $kriteria['kode_kriteria'];
                            if (isset($nilaiData[$altRow['alternatif']][$kode_kriteria])) {
                                $nilai = $nilaiData[$altRow['alternatif']][$kode_kriteria];
                                $akarKuadrat = $sumSquaresData[$kode_kriteria];

                                if ($akarKuadrat > 0) {
                                    $nilaiNormalisasi = $nilai / $akarKuadrat;
                                    if ($kriteria['jenis'] == 'Benefit') {
                                        $optimasiBenefit += $nilaiNormalisasi * $kriteria['normalisasi'];
                                    } else {
                                        $optimasiCost += $nilaiNormalisasi * $kriteria['normalisasi'];
                                    }
                                }
                            }
                        }

                        $rasioMoora = $optimasiBenefit - $optimasiCost;
                        $rasioMooraArray[] = ['alternatif' => $altRow['alternatif'], 'rasio_moora' => $rasioMoora, 'optimasi_benefit' => $optimasiBenefit, 'optimasi_cost' => $optimasiCost];
                    }

                    // Hitung rata-rata rasio MOORA
                    $sumRasioMoora = array_sum(array_column($rasioMooraArray, 'rasio_moora'));
                    $averageRasioMoora = $sumRasioMoora / count($rasioMooraArray);

                    // Urutkan berdasarkan rasio MOORA untuk menambahkan ranking
                    usort($rasioMooraArray, function ($a, $b) {
                        return $b['rasio_moora'] <=> $a['rasio_moora'];
                    });

                    // Tambahkan ranking ke setiap alternatif
                    $ranking = 1;
                    foreach ($rasioMooraArray as &$row) {
                        $row['ranking'] = $ranking++;
                    }

                    // Urutkan kembali berdasarkan urutan alternatif asli untuk menjaga urutan tabel
                    usort($rasioMooraArray, function ($a, $b) use ($alternatifData) {
                        return array_search($a['alternatif'], array_column($alternatifData, 'alternatif')) - array_search($b['alternatif'], array_column($alternatifData, 'alternatif'));
                    });

                    $no = 1;
                    foreach ($rasioMooraArray as $row) {
                        $kelayakan = ($row['rasio_moora'] >= $averageRasioMoora) ? 'Layak' : 'Tidak Layak';

                        echo "<tr class='text-center'>";
                        echo "<td>{$no}</td>";
                        echo "<td>{$row['alternatif']}</td>";
                        echo "<td>" . round($row['optimasi_benefit'], 4) . "</td>";
                        echo "<td>" . round($row['optimasi_cost'], 4) . "</td>";
                        echo "<td>" . round($row['rasio_moora'], 4) . "</td>";
                        echo "<td>{$row['ranking']}</td>";
                        echo "<td>{$kelayakan}</td>";
                        echo "</tr>";

                        $no++;
                    }

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo "<p class='mt-4 text-center'>Pilih tahun terlebih dahulu untuk melihat data.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include '../layout/footers.php'; ?>