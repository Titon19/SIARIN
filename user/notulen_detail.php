<?php
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "User") {
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
    <title>Detail Data Notulen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body style="margin: 0px 50px 0px 50px;">
    <div class="container">
        <table align="center" class="table">
            <h3 align="center" style="margin: 30px;">Detail Data Notulen</h3>

            <?php
            include("../koneksi.php");

            if (isset($_GET['id_notulen'])) {
                $id_notulen = $_GET['id_notulen'];
            } else {
                echo "Gagal";
            }

            $detail = mysqli_query($koneksi, "SELECT notulen.id_notulen, notulen.id_rapat, agenda.hari, agenda.tanggal, agenda.waktu, agenda.ruangan, ruangan.tempat, agenda.acara, absensi.id_absensi, absensi.pimpinan_rapat, absensi.peserta, notulen.notulen FROM notulen INNER JOIN agenda INNER JOIN ruangan INNER JOIN absensi ON notulen.id_rapat=agenda.id_rapat AND agenda.ruangan=ruangan.nama_ruangan AND notulen.id_absensi=absensi.id_absensi WHERE id_notulen='$_GET[id_notulen]'");
            $dataid = mysqli_fetch_array($detail);
            ?>

            <tr>
                <td>ID Notulen</td>
                <td width="1">:</td>
                <td><?php echo $dataid['id_notulen']; ?></td>
            </tr>
            <tr>
                <td>ID Rapat</td>
                <td>:</td>
                <td><?php echo $dataid['id_rapat']; ?></td>
            </tr>
            <tr>
                <td>Hari</td>
                <td>:</td>
                <td><?php echo $dataid['hari']; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><?php echo $dataid['tanggal']; ?></td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td><?php echo $dataid['waktu']; ?></td>
            </tr>
            <tr>
                <td>Ruangan</td>
                <td>:</td>
                <td><?php echo $dataid['ruangan']; ?></td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td>:</td>
                <td><?php echo $dataid['tempat']; ?></td>
            </tr>
            <tr>
                <td>Acara</td>
                <td>:</td>
                <td><?php echo $dataid['acara']; ?></td>
            </tr>
            <tr>
                <td>ID Absensi</td>
                <td>:</td>
                <td><?php echo $dataid['id_absensi']; ?></td>
            </tr>
            <tr>
                <td>Pimpinan Rapat</td>
                <td>:</td>
                <td><?php echo $dataid['pimpinan_rapat']; ?></td>
            </tr>
            <tr>
                <td>Peserta</td>
                <td>:</td>
                <td><?php echo $dataid['peserta']; ?></td>
            </tr>
            <tr>
                <td>Notulen</td>
                <td>:</td>
                <td><?php echo $dataid['notulen']; ?></td>
            </tr>
            <tr>
                <td colspan="3" align="center"><a href="notulen2.php" class="btn btn-success">Kembali</a></td>
            </tr>

        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>