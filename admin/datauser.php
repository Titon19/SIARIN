<?php
include('../koneksi.php');

session_start();
if (isset($_SESSION['username']) != "Admin") {
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
    <title>Data User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b3f6ad813f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("menu-admin.php"); ?>
    <div class="table-responsive px-4">
        <h3 align="left" class="pt-4">Data User</h3>
        <form action="datauser.php" method="get">
            <table align="right">
                <tr>
                    <a href="datauser_tambah.php" class="btn btn-primary" style="margin: 10px; margin-left:0px;">Tambah Data +</a>
                </tr>
                <tr>
                    <td>Cari</td>
                    <td>:</td>
                    <td><input class="form-control" type="text" name="cari" placeholder="Cari Data"></td>
                    <td><input class="btn btn-primary" type="submit" value="Cari"></td>
                </tr>
            </table>
        </form>
        <table class="table table-bordered">
            <tr class="table-light" style="text-align:center;">
                <th width="1">ID User</th>
                <th>Username</th>
                <th>Password</th>
                <th>Nama</th>
                <th>Bidang</th>
                <th>Jabatan</th>
                <th>Level</th>
                <th>Aksi</th>
            </tr>
            <?php


            $halaman        = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $halaman_awal   = ($halaman > 1) ? ($halaman * 4) - 4 : 0;

            $sebelum        = $halaman - 1;
            $setelah        = $halaman + 1;

            $datas           = mysqli_query($koneksi, "select * from user");
            $jumlah_data    = mysqli_num_rows($datas);
            $total_halaman  = ceil($jumlah_data / 5);

            if (isset($_GET['cari'])) {
                $cari = $_GET['cari'];
                $sql = mysqli_query($koneksi, "SELECT * from user where nama like '%" . $cari . "%'");
            } else {
                $sql   = mysqli_query($koneksi, "select * from user limit $halaman_awal, 4");
            }
            $nomor = $halaman_awal + 1;
            $no = 1;

            while ($data = mysqli_fetch_array($sql)) {
            ?>
                <tr class="bg-white">
                    <td width="1" align="center"><?php echo $no++; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['password']; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['bidang']; ?></td>
                    <td><?php echo $data['jabatan']; ?></td>
                    <td width="1" align="center">

                        <?php
                        if ($data['level'] == "Admin") {
                            echo "<p class='badge text-bg-success'>" . $data['level'] . "</p>";
                        } else {
                            echo "<p class='badge text-bg-warning'>" . $data['level'] . "</p>";
                        }

                        ?>
                    </td>
                    <td width="1" align="center">
                        <a href="datauser_ubah.php?id_user=<?php echo $data['id_user']; ?>" class="btn btn-info"> <img src="../gambar/edit.png" alt="edit"> </a></a><br>
                        <a href="datauser_hapus.php?id_user=<?php echo $data['id_user']; ?>" class="btn btn-danger" style="align-content: center;padding-left:8px;padding-right:8px;"> <img src="../gambar/hapus.png" alt="print"> </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <nav>
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman > 1) {
                                                echo "href='?halaman=$sebelum'";
                                            } ?>>Previous</a>
                </li>
                <?php
                for ($x = 1; $x <= $total_halaman; $x++) {
                ?>
                    <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"> <?php echo $x; ?></a></li>
                <?php
                }
                ?>
                <li class="page-item">
                    <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                echo "href='?halaman=$setelah'";
                                            } ?>>Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>