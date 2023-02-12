<?php

include("../koneksi.php");
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
    header("location:../index.php");
} elseif (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

$id_absensi = $_GET['id_absensi'];
$hapus = mysqli_query($koneksi, "DELETE FROM absensi WHERE id_absensi='$id_absensi'");

if ($hapus) {
    header("location:absensi.php");
} else {
    echo "Gagal";
}
