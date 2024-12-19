<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "peduli_dunia";

try {
    $conn = mysqli_connect($host, $user, $password, $database);
} catch (\Exception $e){
    echo "Kesalahan dalam database: " . $e->getMessage();
}