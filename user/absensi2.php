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
    <title>Data Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b3f6ad813f.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("menu-user.php"); ?>
    <div class="table-responsive px-4">
        <h3 align="left" class="pt-4">Data Absensi</h3>
        <form action="absensi2.php" method="get">
            <table align="right">
                <tr>
                    <td>Cari</td>
                    <td>:</td>
                    <td><input class="form-control " type="text" name="cari" placeholder="Cari Data"></td>
                    <td><input class="btn btn-primary" type="submit" value="Cari"></td>
                </tr>
            </table>
        </form>
        <table class="table table-bordered">
            <tr class="table-light" style="text-align:center;">
                <th width="1">ID Abesnsi</th>
                <th width="1">ID Rapat</th>
                <th>Pimpinan Rapat</th>
                <th>Peserta</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
            <?php
            include('../koneksi.php');
            $halaman        = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $halaman_awal   = ($halaman > 1) ? ($halaman * 4) - 4 : 0;

            $sebelum        = $halaman - 1;
            $setelah        = $halaman + 1;

            $datas           = mysqli_query($koneksi, "select * from absensi");
            $jumlah_data    = mysqli_num_rows($datas);
            $total_halaman  = ceil($jumlah_data / 5);

            if (isset($_GET['cari'])) {
                $cari = $_GET['cari'];
                $sql = mysqli_query($koneksi, "SELECT * from absensi where id_absensi like '%" . $cari . "%'");
            } else {
                $sql   = mysqli_query($koneksi, "select * from absensi limit $halaman_awal, 4");
            }

            $nomor          = $halaman_awal + 1;

            while ($data = mysqli_fetch_array($sql)) {
            ?>
                <tr width="1" align="center">
                    <td><?php echo $data['id_absensi']; ?></td>
                    <td><?php echo $data['id_rapat']; ?></td>
                    <td><?php echo $data['pimpinan_rapat']; ?></td>
                    <td><?php echo $data['peserta']; ?></td>
                    <td><?php echo $data['waktu']; ?></td>
                    <td width="1">
                        <a href="absensi_detail.php?id_absensi=<?php echo $data['id_absensi']; ?>" class="btn btn-warning" style="align-content: center;padding-left:8px;padding-right:8px;"> <img src="../gambar/detail.png" alt="detail"> </a>
                        <a target="_blank" href="../absensi_cetak.php?id_absensi=<?php echo $data['id_absensi']; ?>" class="btn btn-success" style="align-content: center;padding-left:8px;padding-right:8px;"> <img src="../gambar/print.png" alt="print"> </a>
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