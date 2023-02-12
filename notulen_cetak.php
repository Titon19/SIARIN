<?php
include("koneksi.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
}

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
ob_start();
$id_notulen = $_GET['id_notulen'];
$sql = mysqli_query($koneksi, "SELECT notulen.id_notulen, notulen.id_rapat, absensi.id_absensi, absensi.pimpinan_rapat, absensi.peserta, notulen.notulen FROM notulen INNER JOIN agenda INNER JOIN ruangan INNER JOIN absensi ON notulen.id_rapat=agenda.id_rapat AND notulen.id_absensi=absensi.id_absensi WHERE id_notulen='$id_notulen'");
$data = mysqli_fetch_array($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Notulen Rapat</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12pt;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-left: 30px;margin-right:30px;margin-top:0;">
        <img style="padding-bottom: 20px;" width="30%" src="../agendarapat/gambar/logo.png" alt="Logo BPJS">
        <div align="center">Kantor Cabang Serang : Jl. Kolonel TB. Suwandi (Depan Gedung Graha Pena Radar Banten) - Serang - 42116 <br> T(0254) 200794, 205155 F(0254) 200031 Email:kacab.serang@bpjsketenagakerjaan.go.id</div>
        <hr>
        <div align="center"> <b>NOTULEN RAPAT</b></div>
        <hr>
        <table width=" 90%" align="center">

            <tr>
                <th align="left">ID Notulen</th>
                <th align="left" width="1">:</th>
                <td><?php echo $data['id_notulen']; ?></td>
            </tr>
            <tr>
                <th align="left">ID Rapat</th>
                <th align="left">:</th>
                <td><?php echo $data['id_rapat']; ?></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td colspan="3"> <b>Peserta yang hadir dalam rapat :</b> </td>
            </tr>
            <tr>
                <th align="left">ID Absensi</th>
                <th align="left">:</th>
                <td><?php echo $data['id_absensi']; ?></td>
            </tr>
            <tr>
                <th align="left">Pimpinan Rapat</th>
                <th align="left">:</th>
                <td><?php echo $data['pimpinan_rapat']; ?></td>
            </tr>
            <tr>
                <th align="left">Peserta</th>
                <th align="left">:</th>
                <td><?php echo $data['peserta']; ?></td>
            </tr>
            <tr>
                <th align="left">Notulen</th>
                <th align="left">:</th>
                <td><?php echo $data['notulen']; ?></td>
            </tr>
        </table>
    </div>
    <div style="margin-top: 100px;">
        <?php
        $tanggal = date('Y-m-d');
        // echo date('d F Y', strtotime($tanggal));
        function tgl_indo($tgl)
        {
            $bulan = array(
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tgl);

            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }



        ?>
        <p align="right">Serang, <?php echo tgl_indo($tanggal); ?></p>
        <br><br><br><br>
        <p align="right">Didin Haryono <br>Kepala Kantor Cabang </p>
    </div>
</body>

</html>

<?php

$tampil = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML($tampil);
$mpdf->Output("LaporanNotulenRapat.pdf", "I");

?>