<?php
include("koneksi.php");

session_start();

// if (isset($_SESSION['username']) && $_SESSION['role'] != "Admin") {
//     header("location:../index.php");
// } elseif (!isset($_SESSION['username'])) {
//     header("location:../index.php");
// }

if (isset($_POST['daftar'])) {
    $id_notulen = $_POST['id_user'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama = $_POST['nama'];
    $bidang = $_POST['bidang'];
    $jabatan = $_POST['jabatan'];
    $level = $_POST['level'];
    $query = mysqli_query($koneksi, "INSERT INTO user VALUES ('$id_user', '$username', '$password', '$nama', '$bidang', '$jabatan', '$level')");
    if ($query) {
        header("location:index.php");
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
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <form action="" method="POST" style="margin: 0px 50px 0px 50px;" class="pt-2">
        <table align="center" class="table">

            <body class="bg-info bg-gradient">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 px-4 p-3 bg-white shadow p-3 mb-5 bg-body rounded" style="border-radius: 7px;">
                            <h4 class="fs-4 card-title fw-bold mb-1 p-3">Registrasi</h4>

                            <form action="" method="POST" class="px-3">
                                <div class="form-group mb-2">
                                    <label>ID User</label><br>
                                    <input type="text" name="id_user" class="form-control" placeholder="Masukkan ID User" readonly>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Username</label><br>
                                    <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Passowrd</label><br>
                                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Nama</label><br>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Bidang</label><br>
                                    <input type="text" name="bidang" class="form-control" placeholder="Masukkan Bidang" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Jabatan</label><br>
                                    <input type="text" name="jabatan" class="form-control" placeholder="Masukkan Jabatan" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Level</label><br>
                                    <select class="form-select" name="level" required>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                                <div class="form-goup pt-2 mb-3">
                                    <button type="submit" name="simpan" value="daftar" class="btn btn-primary d-grid gap-2 col-12 mx-auto">Daftar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </table>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>