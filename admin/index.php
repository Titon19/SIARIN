<?php
include("../koneksi.php");
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != "Admin") {
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b3f6ad813f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("menu-admin.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
<div class="bg-light bg-opacity-50">
    <h4 style=" padding:20px 0px 0px 20px;">Selamat Datang <b><?php echo $_SESSION['nama']; ?>!
            <br>
            <h5>Jabatan Anda: <?php echo $_SESSION['jabat']; ?></h5>
        </b>
    </h4>
    <h5 style=" padding:0px 0px 20px 20px;">Anda telah login sebagai
        <b>
            <?php
            if ($_SESSION['role'] == "Admin") {
                echo "<p class='badge rounded-pill text-bg-success'>" . $_SESSION['role'] . "</p>";
            } else {
                echo "<p class='badge rounded-pill text-bg-warning'>" . $_SESSION['role'] . "</p>";
            }
            ?>
        </b>
    </h5>
</div>


<h3 width="100%" style="padding:10px;padding-left:150px;"><b>Dashboard</b></h3>
<div class="container" style="justify-content:center;display:flex;">
    <div class="row">
        <div class="col-md">
            <div class="card text-bg-primary mb-3" style="min-width: 18rem;">
                <div class="card-header"><a href="agenda.php" class="btn btn-light">Lihat</a></div>
                <div class="card-body text-white">
                    <h5 class="card-title">Agenda Rapat</h5>
                    <p class="card-text">
                        <?php
                        $query_agenda = mysqli_query($koneksi, "SELECT * FROM agenda");
                        $jumlah_agenda = mysqli_num_rows($query_agenda);
                        echo "<h5 class='card-text'>" . $jumlah_agenda . "</h5>";

                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card text-bg-warning mb-3" style="min-width: 18rem;">
                <div class="card-header"><a href="notulen.php" class="btn btn-light">Lihat</a></div>
                <div class="card-body text-white">
                    <h5 class="card-title">Notulen</h5>
                    <p class="card-text">
                        <?php
                        $query_notulen = mysqli_query($koneksi, "SELECT * FROM notulen");
                        $jumlah_notulen = mysqli_num_rows($query_notulen);
                        echo "<h5 class='card-text'>" . $jumlah_notulen . "</h5>";

                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card text-bg-danger mb-3" style="min-width: 18rem;">
                <div class="card-header"><a href="absensi.php" class="btn btn-light">Lihat</a></div>
                <div class="card-body text-white">
                    <h5 class="card-title">Absensi</h5>
                    <p class="card-text">
                        <?php
                        $query_absensi = mysqli_query($koneksi, "SELECT * FROM absensi");
                        $jumlah_absensi = mysqli_num_rows($query_absensi);
                        echo "<h5 class='card-text'>" . $jumlah_absensi . "</h5>";

                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card text-bg-success mb-3" style="min-width: 18rem;">
                <div class="card-header"><a href="ruangan.php" class="btn btn-light">Lihat</a></div>
                <div class="card-body text-white">
                    <h5 class="card-title">Ruangan</h5>
                    <p class="card-text">
                        <?php
                        $query_ruangan = mysqli_query($koneksi, "SELECT * FROM ruangan");
                        $jumlah_ruangan = mysqli_num_rows($query_ruangan);
                        echo "<h5 class='card-text'>" . $jumlah_ruangan . "</h5>";

                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card text-bg-secondary mb-3" style="min-width: 18rem;">
                <div class="card-header"><a href="peserta.php" class="btn btn-light">Lihat</a></div>
                <div class="card-body text-white">
                    <h5 class="card-title">Peserta</h5>
                    <p class="card-text">
                        <?php
                        $query_peserta = mysqli_query($koneksi, "SELECT * FROM peserta");
                        $jumlah_peserta = mysqli_num_rows($query_peserta);
                        echo "<h5 class='card-text'>" . $jumlah_peserta . "</h5>";

                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card text-bg-info mb-3" style="min-width: 18rem;">
                <div class="card-header"><a href="datauser.php" class="btn btn-light">Lihat</a></div>
                <div class="card-body text-white">
                    <h5 class="card-title">User</h5>
                    <p class="card-text">
                        <?php
                        $query_user = mysqli_query($koneksi, "SELECT * FROM user");
                        $jumlah_user = mysqli_num_rows($query_user);
                        echo "<h5 class='card-text'>" . $jumlah_user . "</h5>";

                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>