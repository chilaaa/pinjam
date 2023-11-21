<?php
session_start();
include 'koneksi.php';


if (isset($_GET['delete_pinjam'])) {
    $id_pinjam = mysqli_real_escape_string($conn, $_GET['delete_pinjam']);
    // Proses DELETE ruang
    $querydelete = "DELETE FROM jadwal_pinjam WHERE id_pinjam = '$id_pinjam'";
    $resultdelete = mysqli_query($conn, $querydelete);

    if ($resultdelete) {
        $baseDirectory = "index.php";
        header("Location: $baseDirectory");
    } else {
        echo '<script>alert("Terjadi Kesalahan saat menghapus data kegiatan.");</script>';
    }
}

if (isset($_GET['delete_ruang'])) {
    $id_ruang = mysqli_real_escape_string($conn, $_GET['delete_ruang']);

    $query_check_index = "SELECT * FROM jadwal_pinjam WHERE id_ruang = '$id_ruang'";
    $result_check_index = mysqli_query($conn, $query_check_index);

    if (mysqli_num_rows($result_check_index) > 0) {
        // Display a warning message
        echo '<script>alert("Data masih ada di Dashboard");</script>';
        header("Location: ruang.php");
        exit(); // Ensure that no other code is executed after the header redirection
    } else {
        // No dependencies, proceed with deletion
        $query_delete_ruang = "DELETE FROM m_ruang WHERE id_ruang = '$id_ruang'";
        $result_delete_ruang = mysqli_query($conn, $query_delete_ruang);

        if ($result_delete_ruang) {
            // Deletion successful, redirect or perform other actions
            header("Location: ruang.php");
            exit(); // Penting untuk mencegah eksekusi kode berikutnya setelah header
        } else {
            // Handle deletion error
            echo '<script>alert("Error deleting room: ' . mysqli_error($conn) . '");</script>';
        }
    }
}

if (isset($_GET['delete_unit'])) {
    $id_unit = mysqli_real_escape_string($conn, $_GET['delete_unit']);

    // Check for dependencies in the "index" table
    $query_check_index = "SELECT * FROM jadwal_pinjam WHERE id_unit = '$id_unit'";
    $result_check_index = mysqli_query($conn, $query_check_index);

    if (mysqli_num_rows($result_check_index) > 0) {
        // Display a warning message
        echo '<script>alert("Data masih ada di Dashboard");</script>';
        header("Location: unit.php");
        exit(); // Ensure that no other code is executed after the header redirection    } else {
        // No dependencies, proceed with deletion
        $query_delete_unit = "DELETE FROM m_unit WHERE id_unit = '$id_unit'";
        $result_delete_unit = mysqli_query($conn, $query_delete_unit);

        if ($result_delete_unit) {
            // Deletion successful, redirect or perform other actions
            header("Location: unit.php");
            exit(); // Penting untuk mencegah eksekusi kode berikutnya setelah header
        } else {
            // Handle deletion error
            echo '<script>alert("Error deleting unit: ' . mysqli_error($conn) . '");</script>';
        }
    }
}
