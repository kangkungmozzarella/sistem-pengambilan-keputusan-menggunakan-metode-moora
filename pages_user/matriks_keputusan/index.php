<?php include '../layout/headers.php'; ?>
<?php include '../layout/sidebars.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-calendar"></i>
        </span> Matriks Keputusan
    </h3>
</div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"></h4>

            <!-- Dropdown untuk memilih tahun -->
            <div style="margin-bottom: 20px;">
                <form method="GET" action="">
                    <select name="tahun" class="form-control">
                        <option value="">Pilih Tahun</option>
                        <option value="2021" <?= isset($_GET['tahun']) && $_GET['tahun'] == '2021' ? 'selected' : '' ?>>2021</option>
                        <option value="2022" <?= isset($_GET['tahun']) && $_GET['tahun'] == '2022' ? 'selected' : '' ?>>2022</option>
                        <option value="2023" <?= isset($_GET['tahun']) && $_GET['tahun'] == '2023' ? 'selected' : '' ?>>2023</option>
                    </select>
                    <button type="submit" class="btn btn-success" style="margin-top: 10px;">Lihat Data</button>
                </form>
            </div>

            <?php
            // Pastikan variabel $limit dan $offset terdefinisi sebelum digunakan
            $limit = 10; // Jumlah data per halaman

            // Halaman saat ini, jika tidak ada, maka halaman pertama
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            // Hitung offset berdasarkan halaman saat ini
            $offset = ($page - 1) * $limit;

            // Filter pencarian alternatif
            $search_query = isset($_GET['search']) ? $_GET['search'] : '';

            // Cek apakah tahun sudah dipilih
            $tahun_filter = isset($_GET['tahun']) ? $_GET['tahun'] : '';

            if ($tahun_filter) {
            ?>

                <!-- Form pencarian alternatif -->
                <div style="margin-bottom: 20px;">
                    <form method="GET" action="">
                        <input type="hidden" name="tahun" value="<?= $tahun_filter ?>">
                        <input type="text" name="search" class="form-control" placeholder="Cari Alternatif..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" style="margin-bottom: 10px;">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>

            <?php
            }
            ?>

            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th> No </th>
                        <th> Alternatif </th>
                        <?php
                        $query_kriteria = "SELECT * FROM tbl_kriteria";
                        $sql_kriteria = mysqli_query($koneksi, $query_kriteria);
                        $kriteria_list = [];
                        while ($kriteria = mysqli_fetch_array($sql_kriteria)) {
                            echo "<th>" . $kriteria['kode_kriteria'] . "</th>";
                            $kriteria_list[] = $kriteria['kode_kriteria'];
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $offset + 1;

                    if ($tahun_filter) {
                        // Query untuk menghitung total alternatif dengan filter pencarian
                        $query_count = "SELECT COUNT(DISTINCT alternatif) AS total 
                                        FROM tbl_matriks_keputusan 
                                        WHERE tahun = '$tahun_filter' 
                                        AND alternatif LIKE '%$search_query%'";

                        $result_count = mysqli_query($koneksi, $query_count);
                        $total_data = mysqli_fetch_assoc($result_count)['total'];

                        // Query untuk mengambil alternatif unik dengan LIMIT, OFFSET, dan filter pencarian
                        $query = "SELECT DISTINCT alternatif 
                                  FROM tbl_matriks_keputusan 
                                  WHERE tahun = '$tahun_filter' 
                                  AND alternatif LIKE '%$search_query%'
                                  ORDER BY LENGTH(alternatif), alternatif 
                                  LIMIT $limit OFFSET $offset";

                        $sql = mysqli_query($koneksi, $query);

                        $data_alternatif = [];
                        while ($row = mysqli_fetch_assoc($sql)) {
                            $data_alternatif[] = $row['alternatif'];
                        }

                        foreach ($data_alternatif as $alternatif) {
                            // Query untuk mendapatkan nilai per kriteria untuk setiap alternatif
                            $query_kriteria_values = "SELECT kode_kriteria, nilai 
                                                      FROM tbl_matriks_keputusan 
                                                      WHERE alternatif = '$alternatif' AND tahun = '$tahun_filter'
                                                      ORDER BY kode_kriteria ASC";

                            $sql_kriteria_values = mysqli_query($koneksi, $query_kriteria_values);
                            $kriteria_values = [];
                            while ($row = mysqli_fetch_assoc($sql_kriteria_values)) {
                                $kriteria_values[$row['kode_kriteria']] = $row['nilai'];
                            }
                    ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $alternatif ?></td>
                                <?php
                                foreach ($kriteria_list as $kode_kriteria) {
                                    $nilai = isset($kriteria_values[$kode_kriteria]) ? $kriteria_values[$kode_kriteria] : 0;
                                    echo "<td>$nilai</td>";
                                }
                                ?>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='100%' class='text-center'>Pilih tahun terlebih dahulu.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <?php if ($tahun_filter) { ?>
                <nav aria-label="Page navigation example" style="margin-top: 20px;">
                    <ul class="pagination justify-content-center">
                        <?php
                        $total_pages = ceil($total_data / $limit);
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $active = ($i == $page) ? 'active' : '';
                            echo "<li class='page-item $active'><a class='page-link' href='?tahun=$tahun_filter&search=$search_query&page=$i'>$i</a></li>";
                        }
                        ?>
                    </ul>
                </nav>
            <?php } ?>
        </div>
    </div>
</div>

<?php include '../layout/footers.php'; ?>