<?php
session_start();
include("koneksi.php");
$msg = "";

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password = md5($password);
  $level = $_POST['level'];

  $sql = "SELECT * FROM user WHERE username=? AND password=? AND level=?";
  $stmt = $koneksi->prepare($sql);
  $stmt->bind_param("sss", $username, $password, $level);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  // session_regenerate_id();
  if ($row) {
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['level'];
    $_SESSION['nama'] = $row['nama'];
    $_SESSION['jabat'] = $row['jabatan'];
  }

  // session_write_close();

  if ($result->num_rows == 1 && $_SESSION['role'] == "Admin") {
    header("location:admin");
  } elseif ($result->num_rows == 1 && $_SESSION['role'] == "User") {
    header("location:user");
  } else {
    echo "<h6 class='alert alert-danger' role='alert'> Username atau Password Anda Salah!</h6>";
  }
}


if (isset($_SESSION['username']) && $_SESSION['role'] == "Admin") {
  header("location:admin");
} elseif (isset($_SESSION['username']) && $_SESSION['role'] == "User") {
  header("location:user");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Halaman Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    body {
      background-color: salmon;
    }
  </style>
</head>

<body class="bg-info bg-gradient">
  <div class="container">
    <div class="row justify-content-center">
      <h3 align="center" class="m-5 fw-bold">
        Sistem Informasi
        Agenda Rapat Internal
      </h3>
      <div class="col-lg-4 px-4 p-3 bg-white shadow p-3 mb-5 bg-body rounded" style="border-radius: 7px;">
        <?php echo $msg; ?>
        <h4 class="fs-4 card-title fw-bold mb-1 p-3">Login</h4>


        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="px-3">
          <div class="form-group mb-2">
            <label>Username</label><br>
            <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
          </div>
          <div class="form-group mb-2">
            <label>Passowrd</label><br>
            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
          </div>
          <div class="form-group mb-2">
            <label>Level</label><br>
            <select class="form-select" name="level" required>
              <option value="Admin">Admin</option>
              <option value="User">User</option>
            </select>
          </div>
          <div class="form-goup pt-2 mb-3">
            <button type="submit" name="login" value="Login" class="btn btn-primary d-grid gap-2 col-12 mx-auto">Login</button>
            <!-- Belum Punya Akun? <a href="registrasi.php">Registrasi</a> -->
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>