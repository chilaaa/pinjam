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

if (isset($_GET['id_ruang'])) {
    $id_ruang = $_GET['id_ruang'];

    $query = "SELECT * FROM m_ruang WHERE id_ruang = '$id_ruang'";
    $result = mysqli_query($conn, $query);

    // Cek apakah data kegiatan ditemukan
    if (mysqli_num_rows($result) > 0) {
        $m_ruang = mysqli_fetch_assoc($result);
        // Ambil nilai dari setiap kolom
        $id_ruang = $m_ruang['id_ruang'];
        $nama_ruang = $m_ruang['nama_ruang'];
    } else {
        // echo '<script>alert("Data kegiatan tidak ditemukan.");</script>';
        $baseDirectory = "http://localhost/modern/pinjam/src/html/";
        header("Location: $baseDirectory");
        exit();
    }
}

if (isset($_POST['delete'])) {
    $id_ruang = $_GET['id_ruang'];

    // Pastikan $id_pinjam adalah nilai yang sesuai, dan lakukan operasi DELETE.

    // Prepare the DELETE statement
    $querydelete = "DELETE FROM m_ruang WHERE id_ruang = '$id_ruang'";

    // Execute the statement
    $resultdelete = mysqli_query($conn, $querydelete);

    if ($resultdelete) {
        $baseDirectory = "http://localhost/modern/pinjam/src/html/";
        header("Location: $baseDirectory");
    } else {
        echo '<script>alert("Terjadi Kesalahan saat menghapus data kegiatan.");</script>';
    }
}




if (isset($_POST['submit'])) {
    // $id_ruang = $_POST['id_ruang'];
    $nama_ruang = $_POST['nama_ruang'];

    $queryupdate = "UPDATE m_ruang SET 
  id_ruang = '$id_ruang',
  nama_ruang = '$nama_ruang'
  WHERE id_ruang = '$id_ruang'";

    $resultupdate = mysqli_query($conn, $queryupdate);
    if ($resultupdate) {
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
    <title>Form Update Ruang</title>
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
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./form-ruang.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-description"></i>
                                </span>
                                <span class="hide-menu">Form Tambah Ruang</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./form-unit.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-description"></i>
                                </span>
                                <span class="hide-menu">Form Tambah Unit</span>
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
                            <h5 class="card-title fw-semibold mb-4">Form Tambah Ruang</h5>
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                        <fieldset disabled="disabled">
                                            <div class="mb-3">
                                                <label for="id_ruang" class="form-label">id_ruang</label>
                                                <input type="text" class="form-control" id="id_ruang" name="id_ruang" value="<?php echo $id_ruang; ?>">
                                            </div>
                                        </fieldset>
                                        <div class="mb-3">
                                            <label for="nama_ruang" class="form-label">Nama Ruang</label>
                                            <input type="text" class="form-control" id="nama_ruang" name="nama_ruang" value="<?php echo $nama_ruang; ?>">
                                        </div>
                                        <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
                                        <button type="submit" name="delete" value="Delete" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>