<?php
include("../koneksi.php");

session_start();

if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
    header("location:../index.php");
} elseif (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

if (isset($_POST['ubah'])) {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama = $_POST['nama'];
    $bidang = $_POST['bidang'];
    $jabatan = $_POST['jabatan'];
    $level = $_POST['level'];
    $ubah = mysqli_query($koneksi, "UPDATE user SET username='$username', password='$password', nama='$nama', bidang='$bidang', jabatan='$jabatan', level='$level' WHERE id_user='$id_user'");
    if ($ubah) {
        header("location:datauser.php");
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
    <title>Ubah Data User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <form action="" method="POST" style="margin: 0px 50px 0px 50px;">
        <table align="center" class="table">
            <h3 align="center" style="margin: 30px;">Ubah Data User</h3>
            <tr>
                <?php
                $id = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$_GET[id_user]'");
                $dataid = mysqli_fetch_array($id);

                ?>
                <td>ID User</td>
                <td width="1">:</td>
                <td><input type="text" class="form-control" name="id_user" value="<?php echo $dataid['id_user']; ?>" placeholder="Masukkan ID User" readonly></td>
            </tr>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td>
                    <input type="text" class="form-control" name="username" value="<?php echo $dataid['username']; ?>" placeholder="Masukkan Username Baru" required>
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td>
                    <input type="password" class="form-control" name="password" value="<?php echo $dataid['password']; ?>" placeholder="Masukkan Password Baru" required>
                </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>
                    <input type="text" class="form-control" name="nama" value="<?php echo $dataid['nama']; ?>" placeholder="Masukkan Nama Baru" required>
                </td>
            </tr>
            <tr>
                <td>Bidang</td>
                <td>:</td>
                <td>
                    <input type="text" class="form-control" name="bidang" value="<?php echo $dataid['bidang']; ?>" placeholder="Masukkan Bidang Baru" required>
                </td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>
                    <input type="text" class="form-control" name="jabatan" value="<?php echo $dataid['jabatan']; ?>" placeholder="Masukkan Jabatan Baru" required>
                </td>
            </tr>
            <tr>
                <td>Level</td>
                <td>:</td>
                <td>
                    <select class="form-select" name="level" required>
                        <option value="<?php echo $dataid['level']; ?>"><?php echo $dataid['level']; ?></option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <button type="submit" class="btn btn-primary" name="ubah" value="Ubah">Ubah</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a href="datauser.php" class="btn btn-success">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>