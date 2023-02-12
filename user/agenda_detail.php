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
    <title>Detail Agenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body style="margin: 0px 50px 0px 50px;">
    <table align="center" class="table">
        <h3 align="center" style="margin: 30px;">Detail Data Agenda Rapat</h3>

        <?php
        include("../koneksi.php");

        if (isset($_GET['id_rapat'])) {
            $id_rapat = $_GET['id_rapat'];
        } else {
            echo "Gagal";
        }

        $detail = mysqli_query($koneksi, "SELECT agenda.id_rapat, agenda.hari, agenda.tanggal, agenda.waktu, agenda.ruangan, ruangan.tempat, agenda.acara, agenda.pimpinan_rapat, agenda.peserta, agenda.status FROM agenda INNER JOIN ruangan ON agenda.ruangan=ruangan.nama_ruangan WHERE id_rapat='$id_rapat'");
        $dataid = mysqli_fetch_array($detail);
        ?>
        <tr>
            <td>ID Rapat</td>
            <td width="1">:</td>
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
            <td>Status</td>
            <td>:</td>
            <td style="align-content: center;">
                <?php
                if ($dataid['status'] == "Belum Mulai") {
                    echo "<p class='badge text-bg-warning'>" . $dataid['status'] . "</p>";
                } elseif ($data['status'] == "Di Mulai") {
                    echo "<p class='badge text-bg-success'>" . $dataid['status'] . "</p>";
                } elseif ($data['status'] == "Selesai") {
                    echo "<p class='badge text-bg-secondary'>" . $dataid['status'] . "</p>";
                }
                ?>
            </td>
        </tr>
        </tr>
        <tr>
            <td colspan="3" align="center"><a href="agenda2.php" class="btn btn-success">Kembali</a></td>
        </tr>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>