<?php
include 'functions.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btnLogin'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = login($email, $password);
        if ($user) {
            // Cek apakah user berasal dari tabel admin atau user
            if (isset($user['id_admin'])) {
                // Jika dari tabel admin, gunakan id_admin dan email_admin
                $_SESSION['id_user'] = $user['id_admin'];
                $_SESSION['usn_user'] = 'admin';

                header("Location: admin/index.php");
                exit();
            } else {
                // Jika dari tabel user, gunakan id_user dan usn_user
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['usn_user'] = $user['usn_user'];

                header("Location: home.php");
                exit();
            }
        } else {
            echo "<script>alert('Login failed. Please check your email and password.');</script>";
        }
    } elseif (isset($_POST['btnRegister'])) {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $notelp = $_POST['notelp'];
        $password = $_POST['password'];

        // cek register 
        $Cekregister = register($username, $name, $email, $notelp, $password);

        if ($Cekregister) {
            echo "<script>alert('Registration successful! Please login.');</script>";
        } else {
            echo "<script>alert('Registration failed. Please try again.');</script>";
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
    <title>Account - Bloom & Bliss</title>
    <!-- for icons (font awesome) -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">
    <!-- bootstrap  -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- for swiper slider  -->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <!-- fancy box  -->
    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
    <!-- custom css  -->
    <link rel="stylesheet" href="style.css">
    <!-- favicon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon"/>
</head>

<body class="body-fixed">
    <!-- start of header  -->
    <style>
        body {
            background-image: url('assets/images/background-blur.jpg');
            background-size: cover; /* memastikan gambar memenuhi seluruh area */
        }
    </style>

    <div class="wrapper">
        <div class="form-box login">
            <h2>Login</h2>
            <form action="#" method="POST">
                <div class="input-box">
                    <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-regular fa-lock"></i></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <button type="submit" name="btnLogin" class="btn">Login</button>
                <div class="login-register">
                    <p>Didn't have an account? <a href="javascript:void(0)" class="register-link">Register</a></p>
                </div>
            </form>
        </div>

        <div class="form-box register">
            <h2>Registration</h2>
            <form action="#" method="POST">
                <div class="input-box">
                    <span class="icon"><i class="fa-regular fa-at"></i></span>
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-regular fa-user"></i></span>
                    <input type="text" name="name" required>
                    <label>Name</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-regular fa-phone"></i></span>
                    <input type="text" name="notelp" required>
                    <label>No Telepon</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-regular fa-lock"></i></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <button type="submit" name="btnRegister" class="btn">Register</button>
                <div class="login-register">
                    <p>Already have an account? <a href="javascript:void(0)" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>

</body>
</html>