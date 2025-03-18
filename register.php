<?php

require 'function.php';  // Memanggil file koneksi

// Inisialisasi variabel untuk validasi
$username_error = false;
$registration_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Validasi input username dan password
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        echo '<script>alert("Username hanya boleh mengandung huruf dan angka!");</script>';
    } elseif (strlen($password) < 6) {
        echo '<script>alert("Password harus memiliki minimal 6 karakter!");</script>';
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password dengan password_hash

        // Cek apakah username sudah ada di database
        $result = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '$username'");

        if (mysqli_num_rows($result) > 0) {
            $username_error = true; // Tampilkan pesan error jika username sudah terdaftar
        } else {
            // Insert data baru ke database
            $insert = mysqli_query($koneksi, "INSERT INTO admin (username, password) VALUES ('$username', '$hashed_password')");

            if ($insert) {
                $registration_success = true;
                echo '<script>alert("Registrasi berhasil! Silakan login."); window.location.href="login.php";</script>';
            } else {
                echo '<script>alert("Terjadi kesalahan saat mendaftar. Silakan coba lagi.");</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/login.css">
    <title>Register</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">PWD MHS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Close Navbar -->

    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 text-center login" style="background-image: url('img/bg/memphis-colorful.png');">
                <h4 class="fw-bold">Register | Admin</h4>
                <!-- Error jika username sudah digunakan -->
                <?php if ($username_error) : ?>
                    <?php echo '<script>alert("Username sudah digunakan!");</script>'; ?>
                <?php endif; ?>
                
                <form action="" method="post">
                    <div class="form-group user">
                        <input type="text" class="form-control w-50" placeholder="Masukkan Username" name="username" autocomplete="off" required>
                    </div>
                    <div class="form-group my-5">
                        <input type="password" class="form-control w-50" placeholder="Masukkan Password" name="password" autocomplete="off" required>
                    </div>
                    <button class="btn btn-primary text-uppercase" type="submit" name="register">register</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
