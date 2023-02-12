<?php

include("../koneksi.php");
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
    header("location:../index.php");
} elseif (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

if (isset($_POST['simpan'])) {
    $id_absensi = $_POST['id_absensi'];
    $id_rapat = $_POST['id_rapat'];
    $pimpinan = $_POST['pimpinan_rapat'];
    $peserta = $_POST['peserta'];
    $alldata = implode(", ", $peserta);
    $waktu = $_POST['waktu'];
    $query = mysqli_query($koneksi, "INSERT INTO absensi VALUES ('$id_absensi', '$id_rapat', '$pimpinan', '$alldata', '$waktu')");
    if ($query) {
        header("location:absensi.php");
    } else {
        echo "<p class='alert alert-danger' role='alert'>ID Absensi sudah tersedia, Silahkan isi dengan ID berbeda!</p>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <form action="" method="POST" style="margin: 0px 50px 0px 50px;">
        <table align="center" class="table">
            <h3 align="center" style="margin: 30px;">Tambah Data Absensi</h3>
            <tr>
                <td>ID Absensi</td>
                <td width="1">:</td>
                <td><input type="text" class="form-control" name="id_absensi" placeholder="Masukkan ID Absensi"></td>
            </tr>
            <tr>
                <td>ID Rapat</td>
                <td>:</td>
                <td>
                    <select name="id_rapat" class="form-select">
                        <option value="">-- Pilih ID Rapat --</option>
                        <?php

                        $rapat = mysqli_query($koneksi, "SELECT * FROM agenda");
                        while ($data = mysqli_fetch_array($rapat)) {
                        ?>
                            <option value="<?php echo $data['id_rapat'] ?>"><?php echo $data['id_rapat'] ?></option>

                        <?php } ?>
                    </select>
                </td>
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
                            <input type="checkbox" class="form-check-input" name="peserta[]" value="<?php echo $datas['peserta']; ?>">
                            <?php echo $datas['peserta']; ?>
                        </label><br>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td>
                    <input type="datetime-local" class="form-control" name="waktu" required>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <button type="submit" class="btn btn-primary" name="simpan" value="Simpan">Simpan</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a href="absensi.php" class="btn btn-success">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>