<?php
$isLoggedIn = isset($_SESSION["isLoggedIn"]);
if ($isLoggedIn) {
    $role = $_SESSION["role"];

    match($role) {
        "admin" => header("Location: " . $rootDirectory . "/dashboard/admin/index.php"),
        "lembaga" => header("Location: " . $rootDirectory . "/dashboard/ketua/index.php"),
        "donatur" => header("Location: " . $rootDirectory . "/home/index.php"),
        default => header("Location: " . $rootDirectory . "/auth/login.php")
    };
}