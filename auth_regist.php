<?php
// Mulai session jika diperlukan
session_start();

// Cek apakah form telah disubmit
if (isset($_POST['submit'])) {
    require 'koneksi.php'; // Pastikan koneksi ke DB

    $username = trim($_POST['user']);
    $password = $_POST['password'];
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);

    // Validasi sederhana
    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['user']) || empty($_POST['password'])) {
    header("Location: register.php?error=empty");
    exit();
}


    // Cek apakah username sudah digunakan
    $sql = "SELECT user_id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        // Username sudah ada
        header("Location: registrasi.php?error=exists");
        exit();
    }
    mysqli_stmt_close($stmt);

    // Hash password sebelum disimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Simpan user baru ke database
    $sql = "INSERT INTO users (username, password, firstname, lastname) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $username, $hashed_password, $firstname, $lastname);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: login.php?message=regist");
        exit();
    } else {
        header("Location: registrasi.php?error=failed");
        exit();
    }

    mysqli_stmt_close($stmt);
    mysqli_close($db);
} else {
    header("Location: registrasi.php");
    exit();
}
?>
