<?php
session_start();
include 'koneksi.php';


if (isset($_GET['delete_pinjam'])) {
    $id_pinjam = mysqli_real_escape_string($conn, $_GET['delete_pinjam']);
    // Proses DELETE ruang
    $querydelete = "DELETE FROM jadwal_pinjam WHERE id_pinjam = '$id_pinjam'";
    $resultdelete = mysqli_query($conn, $querydelete);

    if ($resultdelete) {
        $baseDirectory = "http://localhost/modern/pinjam/src/html/";
        header("Location: $baseDirectory");
    } else {
        echo '<script>alert("Terjadi Kesalahan saat menghapus data kegiatan.");</script>';
    }
}

if (isset($_GET['delete_ruang'])) {
    $id_ruang = mysqli_real_escape_string($conn, $_GET['delete_ruang']);
    // Proses DELETE ruang
    $querydelete = "DELETE FROM m_ruang WHERE id_ruang = '$id_ruang'";
    $resultdelete = mysqli_query($conn, $querydelete);

    if ($resultdelete) {
        $baseDirectory = "http://localhost/modern/pinjam/src/html/";
        header("Location: $baseDirectory");
    } else {
        echo '<script>alert("Terjadi Kesalahan saat menghapus data kegiatan.");</script>';
    }
}

if (isset($_GET['delete_unit'])) {
    $id_unit = mysqli_real_escape_string($conn, $_GET['delete_unit']);
    // Proses DELETE unit
    $querydelete = "DELETE FROM m_unit WHERE id_unit = '$id_unit'";
    $resultdelete = mysqli_query($conn, $querydelete);

  if ($resultdelete) {
      $baseDirectory = "http://localhost/modern/pinjam/src/html/";
      header("Location: $baseDirectory");
  } else {
      echo '<script>alert("Terjadi Kesalahan saat menghapus data kegiatan.");</script>';
  }
}

