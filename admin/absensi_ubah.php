<?php
include("../koneksi.php");
session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
    header("location:../index.php");
} elseif (!isset($_SESSION['username'])) {
    header("location:../index.php");
}


if (isset($_POST['ubah'])) {
    $id_absensi = $_GET['id_absensi'];
    $id_rapat = $_POST['id_rapat'];
    $pimpinan = $_POST['pimpinan_rapat'];
    $peserta = $_POST['peserta'];
    $alldata = implode(", ", $peserta);
    $waktu = $_POST['waktu'];
    $ubah = mysqli_query($koneksi, "UPDATE absensi SET id_rapat='$id_rapat', pimpinan_rapat='$pimpinan', peserta='$alldata', waktu='$waktu' WHERE id_absensi='$id_absensi'");
    if ($ubah) {
        header("location:absensi.php");
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
    <title>Ubah Data Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <form action="" method="POST" style="margin: 0px 50px 0px 50px;">
        <table align="center" class="table">
            <h3 align="center" style="margin: 30px;">Ubah Data Absensi</h3>
            <tr>
                <?php
                $id = mysqli_query($koneksi, "SELECT * FROM absensi WHERE id_absensi='$_GET[id_absensi]'");
                $dataid = mysqli_fetch_array($id);

                ?>
                <td>ID Absensi</td>
                <td width="1">:</td>
                <td><input type="text" class="form-control" name="id_absensi" value="<?php echo $dataid['id_absensi']; ?>" placeholder="Masukkan ID Absensi" readonly></td>
            </tr>
            <tr>
                <td>ID Rapat</td>
                <td>:</td>
                <td>
                    <select name="id_rapat" class="form-select">
                        <option value="<?php echo $dataid['id_rapat']; ?>"><?php echo $dataid['id_rapat']; ?></option>
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
                        <option value="<?php echo $dataid['pimpinan_rapat']; ?>"><?php echo $dataid['pimpinan_rapat']; ?></option>
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
                    $cheked1 = $dataid['peserta'];
                    $checked = explode(', ', $cheked1);
                    if (in_array($dataid, $checked)) {
                        echo "checked";
                    }
                    while ($datas = mysqli_fetch_array($peserta)) {
                    ?>
                        <label>
                            <input type="checkbox" class="form-check-input" name="peserta[]" <?php in_array($datas['peserta'], $checked) ? print "checked" : "" ?> value="<?php echo $datas['peserta']; ?>">
                            <?php echo $datas['peserta']; ?>
                        </label><br>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td>
                    <input type="datetime-local" value="<?php echo $dataid['waktu']; ?>" class="form-control" name="waktu" required>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <button type="submit" class="btn btn-primary" name="ubah" value="Ubah">Ubah</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a href="absensi.php" class="btn btn-success">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>