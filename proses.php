
<?php
// mengaktifkan session pada php

session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = md5($_POST['password']);


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

if (isset($_SESSION['username'])) {
    header("location:admin");
}

// cek apakah username dan password di temukan pada database
if ($cek > 0) {

    $data = mysqli_fetch_assoc($login);

    // cek jika user login sebagai admin
    if ($data['level'] == "Admin") {

        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['level'] = "Admin";
        // alihkan ke halaman dashboard admin
        header("location:admin");

        // cek jika user login sebagai user
    } else if ($data['level'] == "User") {
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['level'] = "User";
        // alihkan ke halaman dashboard user
        header("location:user");
    } else {
        header("location:login.php?pesan=gagal");
    }
} else {
    header("location:login.php?pesan=gagal");
}

?>