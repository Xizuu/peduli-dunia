<?php
session_start();

include "../utils/koneksi.php";
include "../utils/isLoggedIn.php";

$rootDirectory = "/peduli-dunia";

if (isset($_POST["submit"])) {
    $nama = htmlspecialchars($_POST["nama"]);
    $password = md5(htmlspecialchars($_POST["password"]));

    if (empty($nama) || empty($password)) {
        echo "<script>alert('Username atau password tidak boleh kosong')</script>";
        echo "<script>window.location.href = '" . $rootDirectory . "'</script>";
        exit;
    }

    $query = "SELECT * FROM admin WHERE nama = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "ss", $nama, $password);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows > 0) {
        $rows = mysqli_fetch_assoc($result);
        $_SESSION["isLoggedIn"] = true;
        $_SESSION["isAdmin"] = true;
        $_SESSION["nama"] = $nama;
        

        echo "<script>alert('Login berhasil!')</script>";
        echo "<script>window.location.href = '" . $rootDirectory . "'</script>";
    } else {

        echo "<script>alert('Nama atau password salah')</script>";
        echo "<script>window.location.href = '" . $rootDirectory . "'</script>";
    }

    mysqli_stmt_close($stmt);
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
        <div id="header">
            <h1>PEDULI DUNIA</h1>
            <p>Donasi dengan sesama</p>
        </div>

        <div id="content-wrapper">
            <div id="content">
                <h1 style="text-align: center;">Admin</h1>
                <form method="post" id="login-form">
                    <div class="form-group">
                        <label for="username">Nama:</label>
                        <input type="text" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Login" class="btn-submit">
                        <a href="<?= $rootDirectory ?>" class="btn-admin">Login Donatur</a>
                    </div>
                </form>
            </div>
        </div>
    </div>   
</body>
</html>