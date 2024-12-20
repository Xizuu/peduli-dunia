<?php
session_start();
include "../utils/isNotLoggedIn.php";
include "../utils/koneksi.php";

$rootDirectory = "/peduli-dunia";

$itemsPerPage = 10;
$totalItemsQuery = "SELECT COUNT(*) AS total FROM donasi";
$result = $conn->query($totalItemsQuery);
$totalItems = $result->fetch_assoc()['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$startItem = ($currentPage - 1) * $itemsPerPage;

$query = "
    SELECT 
    donasi.id AS id_donasi,
    donasi.nominal,
    donasi.tanggal_donasi,
    donasi.status,
    donatur.nama AS nama_donatur,
    donatur.email AS email_donatur,
    lembaga_sosial.nama AS nama_lembaga,
    lembaga_sosial.kategori AS kategori_lembaga
FROM 
    donasi
JOIN 
    donatur ON donasi.id_donatur = donatur.id
JOIN 
    lembaga_sosial ON donasi.id_lembaga_sosial = lembaga_sosial.id

    LIMIT $startItem, $itemsPerPage
";
$data = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peduli Dunia - Peduli dengan sesama</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="template">
        <div id="header">
            <h1>PEDULI DUNIA DASHBOARD</h1>
            <!-- <p>Kamu login sebagai: <?= $_SESSION["role"] ?></p> -->
        </div>
        <div id="menu">
            <ul>
                <li><a href="<?= $rootDirectory ?>">Beranda</a></li>
                <li><a href="daftar_lembaga.php">Daftar Lembaga</a></li>
                <li><a href="<?= $rootDirectory ?>/logout.php">Logout</a></li>
            </ul>
        </div>

        <div id="content-wrapper">
            <div id="content">
                <table>
                    <thead>
                        <tr>
                            <th>Donatur</th>
                            <th>Nominal</th>
                            <th>Lembaga</th>
                            <th>Kategori</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($data->num_rows > 0): ?>
                            <?php while ($row = $data->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $row['nama_donatur'] ?></td>
                                    <td><?= $row['nominal'] ?></td>
                                    <td><?= $row['nama_lembaga'] ?></td>
                                    <td><?= $row['kategori_lembaga'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No data found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=1">First</a>
                        <a href="?page=<?= $currentPage - 1 ?>">Previous</a>
                    <?php endif; ?>
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?= $currentPage + 1 ?>">Next</a>
                        <a href="?page=<?= $totalPages ?>">Last</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div id="footer">Copyright &copy; <?= date('Y') ?>. All rights reserved</div>
    </div>

    <?php

    $conn->close();
    ?>
</body>
</html>