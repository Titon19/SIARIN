<?php

include("../koneksi.php");

session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
    header("location:../index.php");
} elseif (!isset($_SESSION['username'])) {
    header("location:../index.php");
}


$id_notulen = $_GET['id_notulen'];
$hapus = mysqli_query($koneksi, "DELETE FROM notulen WHERE id_notulen='$id_notulen'");

if ($hapus) {
    header("location:notulen.php");
} else {
    echo "Gagal";
}
