<?php
session_start();

$isLoggedIn = isset($_SESSION['isLoggedIn']);
$rootDirectory = "/peduli-dunia";

if ($isLoggedIn) {
    session_destroy();
}

header('Location: ' . $rootDirectory);
exit;