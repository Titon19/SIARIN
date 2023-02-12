<?php

include("../koneksi.php");
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
    header("location:../index.php");
} elseif (!isset($_SESSION['username'])) {
    header("location:../index.php");
}


$no = $_GET['no'];
$hapus = mysqli_query($koneksi, "DELETE FROM ruangan WHERE no='$no'");

if ($hapus) {
    header("location:ruangan.php");
} else {
    echo "Gagal";
}
