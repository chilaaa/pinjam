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

  $tanggal = $_POST['tanggal'];
  $jam_awal = $_POST['jam_awal'];
  $jam_akhir = $_POST['jam_akhir'];
  $nama_peminjam = $_POST['nama_peminjam'];
  $keterangan = $_POST['keterangan'];
  $id_ruang = $_POST['id_ruang'];
  $id_unit = $_POST['id_unit'];

  $query = "INSERT INTO jadwal_pinjam (tanggal, jam_awal, jam_akhir, nama_peminjam, keterangan, id_ruang, id_unit) 
            VALUES ('$tanggal', '$jam_awal', '$jam_akhir', '$nama_peminjam', '$keterangan', '$id_ruang', '$id_unit')";


  $result = mysqli_query($conn, $query);
  if ($result) {
    // Eksekusi berhasil, arahkan ke URL yang diinginkan
    $baseDirectory = "http://localhost/modern/pinjam/src/html/";
    header("Location: $baseDirectory");
  } else {
    echo '<script>alert("Terjadi Kesalahan: ' . mysqli_error($conn) . '");</script>';
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <!-- <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
            <!-- <select class="form-select">
              <option value="1">March 2023</option>
              <option value="2">April 2023</option>
              <option value="3">May 2023</option>
              <option value="4">June 2023</option>
            </select> -->
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Data Master</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./form-ruang.php" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Ruang</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./form-unit.php" aria-expanded="false">
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
      <div class="container-fluid">
        <div class="container-fluid">
          <button type="button" class="btn btn-primary py-8 fs-4 mb-4 rounded-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Tambah
          </button>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Tabel Pinjam</h5>
              <div class="table-responsive">
                <div class="table-container" id="tabelPinjam">
                  <!-- <div class="mb-3">
                    <input class="form-control" type="text" id="pinjamSearch" placeholder="Search Tabel Pinjam">
                  </div> -->

                  <table id="example" class="display" style="width:100%">
                    <thead class="text-dark fs-4">
                      <tr>
                        <!-- <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Id</h6>
                        </th> -->
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
                          <h6 class="fw-semibold mb-0">#</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">#</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $query = mysqli_query($conn, "SELECT * FROM jadwal_pinjam"); ?>
                      <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                        <tr>
                          <!-- <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-0"></h6>
                          </td> -->
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
                          <td class="border-bottom-0">
                            <a href="delete.php?delete_pinjam=<?php echo $row['id_pinjam']; ?>" class="btn btn-danger">Delete</a>
                          </td>
                        </tr>
                      <?php endwhile; ?>

                    </tbody>
                  </table>
                  <script>
                    $(document).ready(function() {
                      $('#example').DataTable();
                    });
                  </script>
                </div>
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
                  <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                  <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam">
                </div>
                <div class="mb-3">
                  <label for="id_ruang" class="form-label">Ruangan</label>
                  <select id="id_ruang" name="id_ruang" class="form-control">
                    <?php $query = mysqli_query($conn, "SELECT * FROM m_ruang"); ?>
                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                      <option value="<?php echo $row['id_ruang'] ?>"><?php echo $row['nama_ruang'] ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="id_unit" class="form-label">Unit</label>
                  <select id="id_unit" name="id_unit" class="form-control">
                    <?php $query = mysqli_query($conn, "SELECT * FROM m_unit"); ?>
                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                      <option value="<?php echo $row['id_unit'] ?>"><?php echo $row['nama_unit'] ?></option>
                    <?php endwhile; ?>
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
                <!-- <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Saya sudah menyetujui</label>
                  <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&pp=ygUIcmlja3JvbGw%3D">persyaratan dan ketentuan</a>
                  <label class="form-check-label" for="exampleCheck1">yang berlaku</label>
                </div> -->
                <button type="submit" name="submit" value="Submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Submit</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="tambahuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Ruang</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>

</html>