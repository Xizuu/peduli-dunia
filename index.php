<?php
session_start();

$isLoggedIn = isset($_SESSION['isLoggedIn']);
$rootDirectory = "/peduli-dunia";

if (!$isLoggedIn) {
    header("Location: " . $rootDirectory . "/auth/login.php");
    exit;
}

include "utils/isLoggedIn.php";