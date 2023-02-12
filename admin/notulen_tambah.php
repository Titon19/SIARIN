<?php
include("../koneksi.php");

session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
    header("location:../index.php");
} elseif (!isset($_SESSION['username'])) {
    header("location:../index.php");
}


if (isset($_POST['simpan'])) {
    $id_notulen = $_POST['id_notulen'];
    $id_rapat = $_POST['id_rapat'];
    $id_absensi = $_POST['id_absensi'];
    $notulen = $_POST['notulen'];
    $query = mysqli_query($koneksi, "INSERT INTO notulen VALUES ('$id_notulen', '$id_rapat', '$id_absensi', '$notulen')");
    if ($query) {
        header("location:notulen.php");
    } else {
        echo "<p class='alert alert-danger' role='alert'>ID Notulen sudah tersedia, Silahkan isi dengan ID berbeda!</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Notulen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <form action="" method="POST" style="margin: 0px 50px 0px 50px;">
        <table align="center" class="table">
            <h3 align="center" style="margin: 30px;">Tambah Data Notulen</h3>
            <tr>
                <td>ID Notulen</td>
                <td width="1">:</td>
                <td><input type="text" class="form-control" name="id_notulen" placeholder="Masukkan ID Notulen" required></td>
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
                <td>ID Absensi</td>
                <td>:</td>
                <td>
                    <select name="id_absensi" class="form-select">
                        <option value="">-- Pilih ID Absensi --</option>
                        <?php

                        $rapat = mysqli_query($koneksi, "SELECT * FROM absensi");
                        while ($data = mysqli_fetch_array($rapat)) {
                        ?>
                            <option value="<?php echo $data['id_absensi'] ?>"><?php echo $data['id_absensi'] ?></option>

                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Notulen</td>
                <td>:</td>
                <td>
                    <textarea class="form-control" name="notulen" cols="30" rows="10" placeholder="Masukkan Notulen" required></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <button type="submit" class="btn btn-primary" name="simpan" value="Simpan">Simpan</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a href="notulen.php" class="btn btn-success">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>