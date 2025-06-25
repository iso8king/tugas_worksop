<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Digital Library</title>
    
    <link rel="stylesheet" href="style.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .success-message {
 background: rgba(76, 175, 80, 0.2); 
  color: #fffff;
  padding: 10px 15px;
  border-radius: 5px;
  text-align: center;
  margin-bottom: 20px;
  border: 1px solid rgba(76, 175, 80, 0.2);;
}
    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <form action="auth_login.php" method="post">
                <h2>Selamat Datang</h2>
                <p class="subtitle">Silakan masuk untuk melanjutkan</p>

                <?php
                // Tampilkan pesan error jika ada dari auth_login.php
                if (isset($_GET['error'])) {
                    $message = 'Username atau password salah!';
                    if ($_GET['error'] == 'empty') {
                        $message = 'Username dan password tidak boleh kosong!';
                    } else
                    echo '<div class="error-message">' . htmlspecialchars($message) . '</div>';
                }

                else if(isset($_GET['message'])){
                     if ($_GET['message'] == 'regist') {
                         $message = "Akun Anda Berhasil Dibuat!";
                    }else if ($_GET['message'] == 'forgot') {
                         $message = "Password Akun Anda Berhasil Di ubah!";
                    }
                   
                     echo '<div class="success-message">' . htmlspecialchars($message) . '</div>';
                }
                ?>

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="user" placeholder="Username" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="options">
                    <label>
                        <input type="checkbox" name="remember"> Ingat saya
                    </label>
                    <a href="forgot.php">Lupa Password?</a>
                </div>

                <button type="submit" name="submit" class="login-btn">Login</button>

                <div class="register-link">
                    <p>Belum punya akun? <a href="registrasi.php">Daftar sekarang</a></p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>