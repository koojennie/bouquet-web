<?php

include 'functions.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btnLogin'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = login($email, $password);
        if ($user) {
            // session nya ganti pake id user sama username biar unik
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['usn_user'] = $user['usn_user'];

            // cek jika user admin
            if($user['usn_user'] == 'admin' & $user['nama_user'] == 'admin') {
                header("Location:admin/index.php");
                exit();
            } else {
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
    <!-- for icons  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- bootstrap  -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- for swiper slider  -->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">

    <!-- fancy box  -->
    <link rel="stylesheet" href="assets/css/jquery.fancybox.min.css">
    <!-- custom css  -->
    <link rel="stylesheet" href="style.css">
</head>

<body class="body-fixed">
    <!-- start of header  -->
    <style>
        body {
            background-image: url('assets/images/background-blur.jpg');
            background-size: cover; /* memastikan gambar memenuhi seluruh area */
            padding-top : 70px;
        }
    </style>
    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="index.html">
                            <img src="logo.png" width="50" height="50" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main-navigation">
                        <button class="menu-toggle"><span></span><span></span></button>
                        <nav class="header-menu">
                            <ul class="menu food-nav-menu">
                                <li><a href="index.html ">Home</a></li>
                                <li><a href="/#about">About</a></li>
                                <li><a href="/#catalouge">Catalouge</a></li>
                                <li><a href="/#review">Review</a></li>
                                <li><a href="/#contact">Contact</a></li>
                            </ul>
                        </nav>
                        <div class="header-right">
                            <a href="javascript:void(0)" class="header-btn header-cart">
                                <i class="uil uil-shopping-bag"></i>
                                <span class="cart-number">0</span>
                            </a>
                            <a href="login.html" class="header-btn">
                                <i class="uil uil-user-md"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="wrapper">
        <div class="form-box login">
            <h2>Login</h2>
            <form action="#" method="POST">
                <div class="input-box">
                    <span class="icon"><i class="uil uil-envelope"></i></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="uil uil-lock"></i></span>
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
                    <span class="icon"><i class="uil uil-at"></i></span>
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="uil uil-user"></i></span>
                    <input type="text" name="name" required>
                    <label>Name</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="uil uil-envelope"></i></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="uil uil-phone"></i></span>
                    <input type="text" name="notelp" required>
                    <label>No Telepon</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="uil uil-lock"></i></span>
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