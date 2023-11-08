<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Modernize Free</title>
    <link
      rel="shortcut icon"
      type="image/png"
      href="../assets/images/logos/favicon.png"
    />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
  </head>
  <body>
    <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
  data-sidebar-position="fixed" data-header-position="fixed">
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
                    <h6 class="fw-semibold mb-0">Ruang dan Unit</h6>
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
                <tr>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">123</h6>
                  </td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-1">Adam</h6>
                  </td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-1">Sabtu, 12 Desember 2005</h6>
                  </td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-1">Ruang Makan</h6>
                    <span class="fw-normal">0001</span>
                  </td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-1">07:00 - 21:00</h6>
                  </td>
                  <td class="border-bottom-0">
                    <h6 class="fw-semibold mb-1">BEGITUUUuuu</h6>
                  </td>
                  <td class="border-bottom-0">
                    <button type="button" class="btn btn-primary m-1">Update</button>
                    <button type="button" class="btn btn-danger m-1">Delete</button>
                  </td>
                </tr>
                <tr>
                    <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">124</h6>
                    </td>
                    <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-1">Adam Lagi</h6>
                    </td>
                    <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-1">Minggu, 13 Desember 2005</h6>
                    </td>
                    <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-1">Ruang Tidur</h6>
                      <span class="fw-normal">0003</span>
                    </td>
                    <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-1">21:00 - 07:00</h6>
                    </td>
                    <td class="border-bottom-0">
                      <h6 class="fw-semibold mb-1">GGGGGGGG</h6>
                    </td>
                    <td class="border-bottom-0">
                    <button type="button" class="btn btn-primary m-1">Update</button>
                    <button type="button" class="btn btn-danger m-1">Delete</button>
                  </td>
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
