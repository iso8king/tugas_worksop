<?php
// Selalu mulai sesi di awal
session_start();

// Sertakan koneksi database
include "koneksi.php";

// Pastikan form disubmit
if (isset($_POST['submit'])) {

    $user = $_POST['user'];
    $pass = $_POST['password'];

    // Validasi dasar agar tidak kosong
    if (empty($user) || empty($pass)) {
        header("Location: login.php?error=empty");
        exit();
    }

    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // 1. KEAMANAN: Gunakan Prepared Statements untuk mencegah SQL Injection
    $sql = "update users set password = ? where username = ?";
    
    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $hashed_pass , $user);
        mysqli_stmt_execute($stmt);
       if (mysqli_stmt_affected_rows($stmt) > 0) {
        header("Location: login.php");
        } else {
        header("Location: login.php");
        }
exit();


        mysqli_stmt_close($stmt);
    }
    mysqli_close($db);

} else {
    // Jika file diakses langsung tanpa submit, kembalikan ke halaman login
    header("Location: login.php");
    exit();
}
?>