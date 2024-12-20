<?php
session_start();
include "../../utils/isNotLoggedIn.php";
include "../../utils/koneksi.php";

$rootDirectory = "/peduli-dunia";
$sessionId = $_SESSION["session_id"];
if (isset($_GET['id'])) {
    $lembagaId = mysqli_real_escape_string($conn, $_GET['id']);
    
    $query = "SELECT * FROM lembaga_sosial WHERE id = '$lembagaId'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $rows = mysqli_fetch_assoc($result);
        $nama_lembaga = $rows['nama'];
    }
} else {
    echo "<script>alert('ID Lembaga tidak ditemukan.'); window.location.href='" . $rootDirectory . "';</script>";
}

if (isset($_POST["submit"])) {
    // $nama_lembaga = mysqli_real_escape_string($conn, $_POST['nama']);
    $nominal = $_POST["nominal"];

    if (empty($nominal) || !is_numeric($nominal) || $nominal <= 0) {
        echo "<script>alert('Nominal tidak boleh kosong'); window.location.href='" . $rootDirectory . "';</script>";
        exit;
    }

    $query = "INSERT INTO donasi (id_donatur, id_lembaga_sosial, nominal, status) VALUES (
        '$sessionId', '$lembagaId', '$nominal', 'success');";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Berhasil mengirim donasi! Terima kasih'); window.location.href='" . $rootDirectory . "';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peduli Dunia - Peduli dengan sesama</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Devanagari:wght@100..800&family=Play:wght@400;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="template">

        <div id="content-wrapper">
            <div id="content">
                <h1 style="text-align: center;">Kirim Donasi</h1>
                <form method="post" id="login-form">
                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="text" name="nominal">
                    </div>
                    <div class="form-group">
                        <label for="password">Lembaga Sosial:</label>
                        <input type="text" value="<?= $nama_lembaga ?>" disabled>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>   
</body>
</html>