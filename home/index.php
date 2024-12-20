<?php
session_start();
include "../utils/isNotLoggedIn.php";
include "../utils/koneksi.php";

$rootDirectory = "/peduli-dunia";

$itemsPerPage = 10;
$totalItemsQuery = "SELECT COUNT(*) AS total FROM lembaga_sosial";
$result = $conn->query($totalItemsQuery);
$totalItems = $result->fetch_assoc()['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$startItem = ($currentPage - 1) * $itemsPerPage;

$query = "
    SELECT * FROM lembaga_sosial

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
            <h1>PEDULI DUNIA</h1>
            <p>Peduli dengan sesama</p>
            <!-- <p>Kamu login sebagai: <?= htmlspecialchars($_SESSION["role"]) ?></p> -->
        </div>
        <div id="menu">
            <ul>
                <li><a href="<?= $rootDirectory ?>">Beranda</a></li>
                <li><a href="<?= $rootDirectory ?>/logout.php">Logout</a></li>
            </ul>
        </div>

        <div id="content-wrapper">
            <div id="content">
            <table>
                    <thead>
                        <tr>
                            <th>Nama Lembaga</th>
                            <th>Kategori Lembaga</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($data->num_rows > 0): ?>
                            <?php while ($row = $data->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['kategori'] ?></td>
                                    <td><?= $row['deskripsi'] ?>
                                    <td>
                                        <a class="edit" href="action/donasi.php?id=<?= $row["id"] ?>">Kirim Donasi</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">No data found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="footer">Copyright &copy; <?= date('Y') ?>. All rights reserved.</div>
    </div>

    <?php $conn->close(); ?>
</body>
</html> 