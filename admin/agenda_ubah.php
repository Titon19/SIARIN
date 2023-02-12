<?php
include("../koneksi.php");

session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
    header("location:../index.php");
} elseif (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

if (isset($_POST['ubah'])) {
    $id_rapat = $_GET['id_rapat'];
    $hari = $_POST['hari'];
    $tgl = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $ruangan = $_POST['ruangan'];
    $acara = $_POST['acara'];
    $pimpinan = $_POST['pimpinan_rapat'];
    $peserta = $_POST['peserta'];
    $alldata = implode(", ", $peserta);
    $status = $_POST['status'];
    $ubah = mysqli_query($koneksi, "UPDATE agenda SET hari='$hari', tanggal='$tgl', waktu='$waktu', ruangan='$ruangan', acara='$acara', pimpinan_rapat='$pimpinan', peserta='$alldata', status='$status' WHERE id_rapat='$id_rapat'");
    if ($ubah) {
        header("location:agenda.php");
    } else {
        echo "Gagal";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Agenda Rapat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <form action="" method="POST" style="margin: 0px 50px 0px 50px;">
        <table align="center" class="table">
            <h3 align="center" style="margin: 30px;">Ubah Data Agenda Rapat</h3>
            <tr>
                <?php
                $id = mysqli_query($koneksi, "SELECT agenda.id_rapat, agenda.hari, agenda.tanggal, agenda.waktu, agenda.ruangan, ruangan.nama_ruangan, agenda.acara, agenda.pimpinan_rapat, agenda.peserta, agenda.status FROM agenda INNER JOIN ruangan ON agenda.ruangan=ruangan.nama_ruangan WHERE id_rapat='$_GET[id_rapat]'");
                $dataid = mysqli_fetch_array($id);

                ?>
                <td>ID Rapat</td>
                <td>:</td>
                <td><input type="text" class="form-control" name="id_rapat" value="<?php echo $dataid['id_rapat']; ?>" placeholder="Masukkan ID Rapat" readonly></td>
            </tr>
            <tr>
                <td>Hari</td>
                <td>:</td>
                <td>
                    <select name="hari" class="form-select">
                        <option value="<?php echo $dataid['hari']; ?>"><?php echo $dataid['hari']; ?></option>
                        <?php

                        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                        foreach ($hari as $value) {
                            echo "<option value=$value>$value</option>";
                        }

                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><input type="date" class="form-control" name="tanggal" value="<?php echo $dataid['tanggal']; ?>" required></td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td><input type="time" class="form-control" name="waktu" value="<?php echo $dataid['waktu']; ?>" required></td>
            </tr>
            <tr>
                <td>Ruangan</td>
                <td>:</td>
                <td>
                    <select name="ruangan" class="form-select">
                        <option value="<?php echo $dataid['nama_ruangan']; ?>"><?php echo $dataid['nama_ruangan']; ?></option>
                        <?php
                        $ruangan = mysqli_query($koneksi, "SELECT * FROM ruangan");
                        while ($data = mysqli_fetch_array($ruangan)) {
                        ?>
                            <option value="<?php echo $data['nama_ruangan']; ?>"> <?php echo $data['nama_ruangan']; ?> / <?php echo $data['tempat']; ?> / <?php echo $data['kapasitas']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Acara</td>
                <td>:</td>
                <td><textarea name="acara" value="<?php echo $dataid['acara']; ?>" class="form-control" cols=" 50%" rows="5" placeholder="Masukkan Acara Rapat" required><?php echo $dataid['acara']; ?></textarea></td>
            </tr>
            <tr>
                <td>Pimpinan Rapat</td>
                <td>:</td>
                <td>

                    <select name="pimpinan_rapat" class="form-select">
                        <option value="<?php echo $dataid['pimpinan_rapat']; ?>"><?php echo $dataid['pimpinan_rapat']; ?></option>
                        <?php
                        $pimpinan = mysqli_query($koneksi, "SELECT * FROM peserta");
                        while ($data = mysqli_fetch_array($pimpinan)) {
                        ?>
                            <option value=" <?php echo $data['peserta']; ?>"> <?php echo $data['peserta']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Peserta</td>
                <td>:</td>
                <td>
                    <?php
                    $peserta = mysqli_query($koneksi, "SELECT * FROM peserta");
                    // $datap = mysqli_fetch_array($peserta);
                    $cheked1 = $dataid['peserta'];
                    $checked = explode(', ', $cheked1);
                    // foreach ($datapesertas as $row) {
                    if (in_array($dataid, $checked)) {
                        echo "checked";
                    }
                    while ($datap = mysqli_fetch_array($peserta)) {
                    ?>
                        <label>
                            <input class="form-check-input" type="checkbox" <?php in_array($datap['peserta'], $checked) ? print "checked" : "" ?> name="peserta[]" value="<?php echo $datap['peserta']; ?>">
                            <?php echo $datap['peserta']; ?>
                        </label><br>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td>
                    <select name="status" class="form-select">
                        <option value="<?php echo $dataid['status']; ?>"><?php echo $dataid['status']; ?></option>
                        <option value="Belum Mulai">Belum Mulai</option>
                        <option value="Di Mulai">Di Mulai</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <button type="submit" class="btn btn-primary" name="ubah" value="Ubah">Ubah</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a href="agenda.php" class="btn btn-success">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>