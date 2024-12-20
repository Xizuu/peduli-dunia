<?php
$isLoggedIn = isset($_SESSION["isLoggedIn"]);
if ($isLoggedIn) {
    $isAdmin = $_SESSION["isAdmin"];

    if ($isAdmin) {
        header("Location: " . $rootDirectory . "/dashboard/index.php");
        exit;
    }
    header("Location: " . $rootDirectory . "/home/index.php");
}