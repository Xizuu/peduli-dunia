<?php
session_start();
include "../../utils/isNotLoggedIn.php";
include "../../utils/koneksi.php";

$rootDirectory = "/peduli-dunia";
if (isset($_GET['id'])) {
    $lembagaId = mysqli_real_escape_string($conn, $_GET['id']);
    
    $query = "SELECT * FROM lembaga_sosial WHERE id = '$lembagaId'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $rows = mysqli_fetch_assoc($result);
        $nama_lembaga = $rows['nama'];
        $kategori = $rows['kategori'];
        $deskripsi = $rows['deskripsi'];
    }
} else {
    echo "<script>alert('ID Lembaga tidak ditemukan.'); window.location.href='" . $rootDirectory . "';</script>";
}

if (isset($_POST["submit"])) {
    $nama_lembaga = mysqli_real_escape_string($conn, $_POST['nama']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);

    $query = "UPDATE lembaga_sosial SET nama = '$nama_lembaga', kategori = '$kategori', deskripsi = '$deskripsi' WHERE id = '$lembagaId'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Lembaga berhasil diperbarui!'); window.location.href='" . $rootDirectory . "';</script>";
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
                <h1 style="text-align: center;">Edit Lembaga</h1>
                <form method="post" id="login-form">
                    <div class="form-group">
                        <label for="nama">Nama Lembaga:</label>
                        <input type="text" name="nama" value="<?php echo isset($nama_lembaga) ? $nama_lembaga: ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi:</label>
                        <input type="text" name="deskripsi" value="<?php echo isset($deskripsi) ? $deskripsi : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori:</label>
                        <select name="kategori" id="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <?php
                            $query = "SELECT * FROM lembaga_sosial";
                            $result = mysqli_query($conn, $query);

                            while($row = mysqli_fetch_assoc($result)) {
                                $selected = ($row["kategori"] == $kategori) ? "selected" : "";
                                echo '<option value="' . $row['kategori'] . '" ' . $selected . '>' . ucfirst($row['kategori']) . '</option>';
                            }
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