<?php
session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
  $nama_user = $_POST['nama_user'];
  $username = $_POST['username'];
  $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

  $query = "INSERT INTO m_user (username, pass, nama_user) 
            VALUES ('$username', '$password', '$nama_user')";


$result = mysqli_query($conn, $query);
if ($result) {
  // Eksekusi berhasil, arahkan ke URL yang diinginkan
  $baseDirectory = "http://localhost/modern/pinjam/src/html/";
  header("Location: $baseDirectory");
} else {
  echo '<script>alert("Terjadi Kesalahan");</script>';
}
}
?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah User</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <h5 class="text-center card-title fw-semibold mb-4">Tambah User</h5>
                <form action="tambah-user.php" method="post">
                  <div class="mb-3">
                    <label for="nama_user" class="form-label">Name</label>
                    <input type="text" class="form-control" id="nama_user" name="nama_user" aria-describedby="textHelp">
                  </div>
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="textHelp">
                  </div>
                  <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                  </div>
                  <!-- <div class="mb-3">
                    <label for="token" class="form-label">Token</label>
                    <input type="text" class="form-control" id="token" name="token">
                  </div> -->
                  <button type="submit" name="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Tambah User</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>