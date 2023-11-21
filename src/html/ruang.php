<?php
session_start();
include 'koneksi.php';

// Pastikan pengguna sudah login sebelum mengakses halaman dashboard
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Ambil nama_user dari sesi
$nama_user = $_SESSION['nama_user'];

if (isset($_POST['submit'])) {
  $nama_ruang = $_POST['nama_ruang'];

  $query = "INSERT INTO m_ruang (nama_ruang) VALUES ('$nama_ruang')";


  $result = mysqli_query($conn, $query);
  if ($result) {
    // Eksekusi berhasil, arahkan ke URL yang diinginkan
    $baseDirectory = "ruang.php";
    header("Location: $baseDirectory");
  } else {
    echo '<script>alert("Terjadi Kesalahan: ' . mysqli_error($conn) . '");</script>';
  }
}

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
    $baseDirectory = "index.php";
    header("Location: $baseDirectory");
    exit();
  }
}

if (isset($_POST['update'])) {
  $id_ruang = $_POST['id_ruang'];
  $nama_ruang = $_POST['nama_ruang'];

  $queryupdate = "UPDATE m_ruang SET 
      nama_ruang = '$nama_ruang'
      WHERE id_ruang = '$id_ruang'";

  $resultupdate = mysqli_query($conn, $queryupdate);
  if ($resultupdate) {
    // Eksekusi berhasil, arahkan ke URL yang diinginkan
    $baseDirectory = "ruang.php";
    header("Location: $baseDirectory");
    exit();  // Add exit() to stop further execution
  } else {
    echo '<script>alert("Terjadi Kesalahan: ' . mysqli_error($conn) . '");</script>';
  }
}

if (isset($_POST['tambah'])) {
  $nama_user = $_POST['nama_user'];
  $username = $_POST['username'];
  $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

  $query = "INSERT INTO m_user (username, pass, nama_user) 
            VALUES ('$username', '$password', '$nama_user')";


  $result = mysqli_query($conn, $query);
  if ($result) {
    // Eksekusi berhasil, arahkan ke URL yang diinginkan
    $baseDirectory = "index.php";
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
  <title>Ruang</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .button-container {
      display: flex;
      gap: 5px;
      /* Jarak antara tombol */
    }
  </style>

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
              <span class="hide-menu">Data Master</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ruang" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Ruang</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./unit.php" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Unit</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" aria-expanded="false" data-bs-toggle="modal" data-bs-target="#tambahuser">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">New User</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./logout.php" aria-expanded="false">
                <span>
                  <i class="ti ti-logout"></i>
                </span>
                <span class="hide-menu">Logout</span>
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
        <button type="button" class="btn btn-primary py-8 fs-4 mb-4 rounded-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          Tambah
        </button>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Ruang</h5>
            <div class="table-responsive">
              <div class="table-container" id="tabelRuang">
                <!-- <div class="mb-3">
                    <input class="form-control" type="text" id="ruangSearch" placeholder="Search Ruang">
                  </div> -->
                <table id="pinjam" class="display" style="width:100%">
                  <thead class="text-dark fs-4">
                    <tr>
                      <!-- <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">id_ruang</h6>
                        </th> -->
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">No</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nama Ruang</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">#</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $query = mysqli_query($conn, "SELECT * FROM m_ruang");
                    $counter = 1;
                    ?>
                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                      <tr>
                        <!-- <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-0"></h6>
                          </td> -->
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0"><?php echo $counter; ?></h6>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1"><?php echo $row['nama_ruang'] ?></h6>
                        </td>
                        <td class="border-bottom-0">
                            <div class="button-container">
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $row['id_ruang']; ?>">
                                <i class="bi bi-pencil"></i> <!-- Ganti dengan ikon yang diinginkan -->
                              </button>
                              <a href="delete.php?delete_ruang=<?php echo $row['id_ruang']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                            </div>
                          </td>
                        
                        <?php $counter++; ?>
                      <?php endwhile; ?>
                      </tr>
                  </tbody>
                </table>
                <script>
                  $(document).ready(function() {
                    $('#pinjam').DataTable();
                  });
                </script>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Ruang</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="nama_ruang" class="form-label">Nama Ruang</label>
                  <input type="text" class="form-control" id="nama_ruang" name="nama_ruang">
                </div>
                <button type="submit" name="submit" value="Submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Submit</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <?php $query = mysqli_query($conn, "SELECT * FROM m_ruang"); ?>
      <?php while ($row = mysqli_fetch_assoc($query)) : ?>
        <div class="modal fade" id="updateModal<?php echo $row['id_ruang']; ?>" tabindex="-1" aria-labelledby="updateModalLabel<?php echo $row['id_ruang']; ?>" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Ruang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="" enctype="multipart/form-data">
                  <input type="hidden" name="id_ruang" value="<?php echo $row['id_ruang']; ?>">
                  <div class="mb-3">
                    <label for="nama_ruang" class="form-label">Nama Ruang</label>
                    <input type="text" class="form-control" id="nama_ruang" name="nama_ruang" value="<?php echo $row['nama_ruang']; ?>">
                  </div>
                  <button type="submit" name="update" value="update" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Update</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
      <div class="modal fade" id="tambahuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="post" enctype="multipart/form-data">
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
                <button type="submit" name="tambah" value="tambah" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Tambah User</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
</body>

</html>