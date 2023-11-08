<?php
require 'koneksi.php';
session_start();
// if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
//     $currentDomain = $_SERVER['HTTP_HOST'];
//     $newBaseDirectory = "https://" . $currentDomain;
//     $baseDirectory = $newBaseDirectory;
//     $targetUrl = "$baseDirectory/login.php";
//     header("Location: $targetUrl");
//     exit();
// }



if (isset($_POST['submit'])) {
  // Generate ID acak
  function generateRandomID($length)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $id = '';
    $charactersLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
      $id .= $characters[rand(0, $charactersLength - 1)];
    }

    return $id;
  }

  $id_pinjam = generateRandomID(5);

  $tanggal = $_POST['tanggal'];
  $jam_awal = $_POST['jam_awal'];
  $jam_akhir = $_POST['jam_akhir'];
  $nama_peminjam = $_POST['nama_peminjam'];
  $keterangan = $_POST['keterangan'];
  $id_ruang = $_POST['id_ruang'];
  $id_unit = $_POST['id_unit'];

  $query = "INSERT INTO jadwal_pinjam (id_pinjam, tanggal, jam_awal, jam_akhir, nama_peminjam, keterangan, id_ruang, id_unit) 
            VALUES ('$id_pinjam', '$tanggal', '$jam_awal', '$jam_akhir', '$nama_peminjam', '$keterangan', '$id_ruang', '$id_unit')";

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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Forms</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./form-pinjam.php" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Form Pinjam-Pinjam</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./login.php" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Login</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./tambah-user.php" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">New User</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <!--  Header End -->
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Pinjam-Pinjam</h5>
              <div class="card">
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                      <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam">
                    </div>
                    <div class="mb-3">
                      <label for="id_ruang" class="form-label">Ruangan</label>
                      <select id="id_ruang" name="id_ruang" class="form-control">
                        <option value="0001">Ruang Makan</option>
                        <option value="0002">Ruang Keluarga</option>
                        <option value="0003">Ruang Bermain</option>
                        <option value="0004">Ruang Tidur</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="id_unit" class="form-label">Unit</label>
                      <select id="id_unit" name="id_unit" class="form-control">
                        <option value="0011">Primary</option>
                        <option value="0012">Secondary</option>
                        <option value="0013">Tertiary</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="tanggal" class="form-label">Tanggal</label>
                      <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="mb-3">
                      <label for="jam_awal" class="form-label" aria-describedby="Dari">Jam Peminjaman</label>
                      <div id="Dari" class="form-text">Dari</div>
                      <input type="time" class="form-control" id="jam_awal" name="jam_awal" aria-describedby="Sampai">
                      <div id="Sampai" class="form-text">Sampai</div>
                      <input type="time" class="form-control" id="jam_akhir" name="jam_akhir">
                    </div>
                    <div class="mb-3">
                      <label for="keterangan" class="form-label">Keterangan</label>
                      <input type="text" class="form-control" id="keterangan" name="keterangan">
                    </div>
                    <div class="mb-3 form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Saya sudah menyetujui</label>
                      <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&pp=ygUIcmlja3JvbGw%3D">persyaratan dan ketentuan</a>
                      <label class="form-check-label" for="exampleCheck1">yang berlaku</label>
                    </div>
                    <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</body>

</html>