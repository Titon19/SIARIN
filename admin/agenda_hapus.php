<?php

include("../koneksi.php");
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
    header("location:../index.php");
} elseif (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

$id_rapat = $_GET['id_rapat'];

$hapus = mysqli_query($koneksi, "DELETE FROM agenda WHERE id_rapat='$id_rapat'");

if ($hapus) {
    header("location:agenda.php");
} else {
    echo "Gagal";
}
