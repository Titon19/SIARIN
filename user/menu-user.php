<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu-Admin</title>

</head>

<body>
    <nav class=" navbar navbar-expand-lg bg-info bg-gradient shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><b>SIARIN</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="agenda2.php">Agenda Rapat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="notulen2.php">Notulen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="absensi2.php">Absensi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="ruangan2.php">Ruangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="peserta2.php">Peserta</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex justify-content-between me-2">
                <i class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"> <img src="../gambar/logout.png" alt="logout"> </i>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Logout</h1>
                                <button type="button" class="btn-close me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda Yakin Ingin Logout Dari Aplikasi?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <a href="../logout.php" class="btn btn-danger">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>