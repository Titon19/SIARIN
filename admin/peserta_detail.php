<?php
include("../koneksi.php");
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
    header("location:../index.php");
} elseif (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body style="margin: 0px 50px 0px 50px;">
    <div class="container">
        <table align="center" class="table">
            <h3 align="center" style="margin: 30px;">Detail Data Peserta</h3>

            <?php

            if (isset($_GET['no'])) {
                $no = $_GET['no'];
            } else {
                echo "Gagal";
            }

            $detail = mysqli_query($koneksi, "SELECT * FROM peserta WHERE no='$_GET[no]'");
            $dataid = mysqli_fetch_array($detail);
            ?>

            <tr>
                <td>No</td>
                <td width="1">:</td>
                <td><?php echo $dataid['no']; ?></td>
            </tr>
            <tr>
                <td>Peserta</td>
                <td>:</td>
                <td><?php echo $dataid['peserta']; ?></td>
            </tr>
            <tr>
                <td colspan="3" align="center"><a href="peserta.php" class="btn btn-success">Kembali</a></td>
            </tr>

        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>