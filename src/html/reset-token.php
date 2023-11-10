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

if (isset($_POST['old_token']) && isset($_POST['new_token'])) {
    $old_token = $_POST['old_token'];
    $new_token = $_POST['new_token'];

    $stmt = $conn->prepare("SELECT * FROM token WHERE token = ?");
    $stmt->bind_param("s", $old_token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];

        $stmt_update = $conn->prepare("UPDATE token SET token = ? WHERE user_id = ?");
        $stmt_update->bind_param("si", $new_token, $user_id);
        $stmt_update->execute();

        echo "Token berhasil diganti!";

        $stmt_update->close();
    } else {
        echo "Token lama tidak benar. Gagal mengganti token.";
    }

    $stmt->close();
} else {
    echo "Token lama dan token baru harus diisi.";
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
                <h5 class="text-center card-title fw-semibold mb-4">Ganti Token</h5>
                <form action="reset-token.php" method="post">
                  <div class="mb-3">
                    <label for="old_token" class="form-label">Token Lama</label>
                    <input type="text" class="form-control" id="old_token" name="old_token" required>
                  </div>
                  <div class="mb-3">
                    <label for="new_token" class="form-label">Token Baru</label>
                    <input type="text" class="form-control" id="new_token" name="new_token" required>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Reset Token</button>
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