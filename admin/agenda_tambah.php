<?php
include("../koneksi.php");
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
    header("location:../index.php");
} elseif (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

if (isset($_POST['simpan'])) {
    $id_rapat = $_POST['id_rapat'];
    $hari = $_POST['hari'];
    $tgl = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $ruangan = $_POST['ruangan'];
    $acara = $_POST['acara'];
    $pimpinan = $_POST['pimpinan_rapat'];
    $peserta = $_POST['peserta'];
    $alldata = implode(", ", $peserta);
    $status = $_POST['status'];
    $query = mysqli_query($koneksi, "INSERT INTO agenda VALUES ('$id_rapat', '$hari', '$tgl', '$waktu', '$ruangan', '$acara', '$pimpinan', '$alldata', '$status')");
    if ($query) {
        echo header("location:agenda.php");
    } else {
        echo "<p class='alert alert-danger' role='alert'>ID Rapat sudah tersedia, Silahkan isi dengan ID berbeda!</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Agenda Rapat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>


    <form action="" method="POST" style="margin: 0px 50px 0px 50px;">
        <table align="center" class="table">
            <h3 align="center" style="margin: 30px;">Tambah Data Agenda Rapat</h3>
            <tr>
                <td>ID Rapat</td>
                <td>:</td>
                <td><input type="text" class="form-control" name="id_rapat" placeholder="Masukkan ID Rapat" required></td>
            </tr>
            <tr>
                <td>Hari</td>
                <td>:</td>
                <td>
                    <select name="hari" class="form-select">
                        <option value="">-- Pilih Hari --</option>
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
                <td><input type="date" class="form-control" name="tanggal" required></td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td><input type="time" class="form-control" name="waktu" required></td>
            </tr>
            <tr>
                <td>Ruangan</td>
                <td>:</td>
                <td>
                    <select name="ruangan" class="form-select">
                        <option value="">-- Pilih Tempat --</option>
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
                <td><textarea class="form-control" name="acara" cols="50%" rows="5" placeholder="Masukkan Acara Rapat" required></textarea></td>
            </tr>
            <tr>
                <td>Pimpinan Rapat</td>
                <td>:</td>
                <td>
                    <select name="pimpinan_rapat" class="form-select">
                        <option value="">-- Pilih Pimpinan Rapat --</option>
                        <?php
                        $pimpinan = mysqli_query($koneksi, "SELECT * FROM peserta");
                        while ($data = mysqli_fetch_array($pimpinan)) {
                        ?>
                            <option value="<?php echo $data['peserta']; ?>"> <?php echo $data['peserta']; ?></option>
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
                    while ($datas = mysqli_fetch_array($peserta)) {
                    ?>
                        <label>
                            <input class="form-check-input" type="checkbox" name="peserta[]" value="<?php echo $datas['peserta']; ?>">
                            <?php echo $datas['peserta']; ?>
                        </label><br>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td>
                    <select name="status" class="form-select">
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Mulai">Belum Mulai</option>
                        <option value="Di Mulai">Di Mulai</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <button type="submit" class="btn btn-primary" name="simpan" value="Simpan">Simpan</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a href="agenda.php" class="btn btn-success">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>