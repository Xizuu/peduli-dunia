<?php
session_start();
include "../../utils/isNotLoggedIn.php";
include "../../utils/koneksi.php";

$rootDirectory = "/peduli-dunia";

if (isset($_GET["id"])) {
    $lembagaId = intval($_GET["id"]);

    $deleteQuery = "DELETE FROM lembaga_sosial WHERE id = $lembagaId";
    $deleteDonasiQuery = "DELETE FROM donasi WHERE id_lembaga_sosial = $lembagaId";
    if ($conn->query($deleteDonasiQuery) && $conn->query($deleteQuery)) {
        echo "<script>alert('Lembaga berhasil dihapus!'); window.location.href='" . $rootDirectory . "';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('ID Lembaga tidak ditemukan!'); window.location.href='" . $rootDirectory . "';</script>";
}