<?php
include("../koneksi.php");
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
    header("location:../index.php");
} elseif (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

if (isset($_POST['ubah'])) {
    $no = $_GET['no'];
    $peserta = $_POST['peserta'];
    $ubah = mysqli_query($koneksi, "UPDATE peserta SET peserta='$peserta' WHERE no='$no'");
    if ($ubah) {
        header("location:peserta.php");
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
    <title>Ubah Data Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <form action="" method="POST" style="margin: 0px 50px 0px 50px;">
        <table align="center" class="table">
            <h3 align="center" style="margin: 30px;">Ubah Data Peserta</h3>
            <?php
            $peserta = mysqli_query($koneksi, "SELECT * FROM peserta WHERE no='$_GET[no]'");
            $data = mysqli_fetch_array($peserta);

            ?>
            <tr>
                <td>No</td>
                <td width="1">:</td>
                <td><input type="text" class="form-control" name="no" value="<?php echo $data['no']; ?>" placeholder="Masukkan No" readonly></td>
            </tr>
            <tr>
                <td>Peserta</td>
                <td>:</td>
                <td>
                    <input type="text" class="form-control" name="peserta" value="<?php echo $data['peserta']; ?>" placeholder="Masukkan Peserta">
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <button type="submit" class="btn btn-primary" name="ubah" value="Ubah">Ubah</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a href="peserta.php" class="btn btn-success">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>