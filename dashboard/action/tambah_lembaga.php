<?php
session_start();
include "../../utils/isNotLoggedIn.php";
include "../../utils/koneksi.php";

$rootDirectory = "/peduli-dunia";

if (isset($_POST["submit"])) {
    $nama_lembaga = htmlspecialchars($_POST["nama"]);
    $deskripsi = htmlspecialchars($_POST["deskripsi"]);
    $kategori = htmlspecialchars($_POST["kategori"]);

    if (empty($nama_lembaga) || empty($deskripsi) || empty($kategori)) {
        echo "<script>alert('Data tidak boleh kosong!'); window.location.href='tambah_lembaga.php';</script>";
        exit;
    }

    $query = "INSERT INTO lembaga_sosial (nama, kategori, deskripsi) VALUES (
        '$nama_lembaga', '$kategori', '$deskripsi');";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Berhasil menambahkan lembaga!'); window.location.href='" . $rootDirectory . "';</script>";
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
                <h1 style="text-align: center;">Tambah Lembaga</h1>
                <form method="post" id="login-form">
                    <div class="form-group">
                        <label for="username">Nama Lembaga:</label>
                        <input type="text" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="password">Deskripsi:</label>
                        <input type="text" name="deskripsi">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori:</label>
                        <select name="kategori" id="kategori">
                            <option value="">Pilih kategori</option>
                            <option value="pendidikan">Pendidikan</option>
                            <option value="kesehatan">Kesehatan</option>
                            ?>
                        </select>
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