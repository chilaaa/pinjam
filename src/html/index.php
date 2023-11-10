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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>
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
      <div class="container-fluid">
        <div class="container-fluid">
          <a href="logout.php" class="btn btn-primary py-8 fs-4 mb-4 rounded-2"><?php echo $nama_user; ?></a>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Tabel Pinjam</h5>
              <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Id</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nama Peminjam</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Tanggal</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Ruangan</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Unit</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Jam Peminjaman</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Keterangan</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0"></h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0"></h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $query = mysqli_query($conn, "SELECT * FROM jadwal_pinjam"); ?>
                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                      <tr>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0"><?php echo $row['id_pinjam'] ?></h6>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1"><?php echo $row['nama_peminjam'] ?></h6>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1"><?php echo $row['tanggal'] ?></h6>
                        </td>
                        <td class="border-bottom-0">
                          <?php
                          $ruangan_id = $row['id_ruang'];
                          $ruangan_query = mysqli_query($conn, "SELECT nama_ruang FROM m_ruang WHERE id_ruang = '$ruangan_id'");
                          $ruangan_data = mysqli_fetch_assoc($ruangan_query);
                          $ruangan_nama = $ruangan_data['nama_ruang'];
                          echo '<h6 class="fw-semibold mb-1">' . $ruangan_nama . '</h6>';
                          echo '<span class="fw-normal">' . $row['id_ruang'] . '</span>';
                          ?>
                        </td>

                        <td class="border-bottom-0">
                          <?php
                          $unit_id = $row['id_unit'];
                          $unit_query = mysqli_query($conn, "SELECT nama_unit FROM m_unit WHERE id_unit = '$unit_id'");
                          $unit_data = mysqli_fetch_assoc($unit_query);
                          $unit_nama = $unit_data['nama_unit'];
                          echo '<h6 class="fw-semibold mb-1">' . $unit_nama . '</h6>';
                          echo '<span class="fw-normal">' . $row['id_unit'] . '</span>';
                          ?>
                        </td>

                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1"><?php echo $row['jam_awal'] ?> - <?php echo $row['jam_akhir'] ?></h6>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1"><?php echo $row['keterangan'] ?></h6>
                        </td>
                        <td class="border-bottom-0">
                          <a href="form-update.php?id_pinjam=<?php echo $row['id_pinjam'] ?>" class="btn btn-primary m-1">Update</a>
                        </td>
                      </tr>
                    <?php endwhile; ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Tabel Ruang</h5>
              <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">id_ruang</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nama Ruang</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $query = mysqli_query($conn, "SELECT * FROM m_ruang"); ?>
                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                      <tr>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0"><?php echo $row['id_ruang'] ?></h6>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1"><?php echo $row['nama_ruang'] ?></h6>
                        </td>
                        <td class="border-bottom-0">
                          <a href="form-update-ruang.php?id_ruang=<?php echo $row['id_ruang'] ?>" class="btn btn-primary m-1">Update</a>
                        </td>
                      <?php endwhile; ?>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Tabel Unit</h5>
              <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                  <thead class="text-dark fs-4">
                    <tr>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">id_unit</h6>
                      </th>
                      <th class="border-bottom-0">
                        <h6 class="fw-semibold mb-0">Nama Unit</h6>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $query = mysqli_query($conn, "SELECT * FROM m_unit"); ?>
                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                      <tr>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0"><?php echo $row['id_unit'] ?></h6>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-1"><?php echo $row['nama_unit'] ?></h6>
                        </td>
                        <td class="border-bottom-0">
                          <a href="form-update-unit.php?id_unit=<?php echo $row['id_unit'] ?>" class="btn btn-primary m-1">Update</a>
                        </td>
                      <?php endwhile; ?>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</body>

</html>