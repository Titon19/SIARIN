<?php

include("../koneksi.php");
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
    header("location:../index.php");
} elseif (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

$id_user = $_GET['id_user'];
$hapus = mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id_user'");

if ($hapus) {
    header("location:datauser.php");
} else {
    echo "Gagal";
}
