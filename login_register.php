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
            header("location: login_register.php?message=error&type=errorlogin");
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
            header("location: login_register.php?message=success&type=successregister");
        } else {
            header("location: login_register.php?message=error&type=errorregister");
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
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="body-fixed">
    <!-- start of header  -->
    <style>
        body {
            background-image: url('assets/images/background-blur.jpg');
            background-size: cover; /* memastikan gambar memenuhi seluruh area */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .body-fixed {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body, html {
            overflow-x: visible;
        }
    </style>

    <div class="wrapper">
        <div class="form-box login">
            <h2>Login</h2>
            <form action="" method="POST">
                <div class="input-box">
                    <span class="icon"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email" required oninvalid="this.setCustomValidity('Please enter your email 💌');" 
                    onchange="try{setCustomValidity('')}catch(e){};" x-moz-errormessage="Please enter your email 💌">
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><i class="fa-regular fa-lock"></i></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <button type="submit" name="btnLogin" class="btn btnLogin">Login</button>
                <div class="login-register">
                    <p>Didn't have an account? <a href="javascript:void(0)" class="register-link">Register</a></p>
                </div>
            </form>
        </div>

        <div class="form-box register">
            <h2>Registration</h2>
            <form action="" method="POST">
                <div class="input-box">
                    <span class="icon"><i class="fa-regular fa-at"></i></span>
                    <input type="text" name="username" required oninvalid="this.setCustomValidity('Please enter your username 💗');" 
                    onchange="try{setCustomValidity('')}catch(e){};" x-moz-errormessage="Please enter your username 💗">
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
                <button type="submit" name="btnRegister" class="btn btnRegister">Register</button>
                <div class="login-register">
                    <p>Already have an account? <a href="javascript:void(0)" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Tampilkan SweetAlert berdasarkan pesan success
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');
        const type = urlParams.get('type');

        if (message === 'error') {
            if (type === 'errorlogin') {
                Swal.fire({
                    icon: 'error',
                    title: 'Login failed',
                    text: 'Please check your email or password.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#fb6f92',
                }).then(() => {
                    const newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
                    window.history.replaceState({ path: newURL }, '', newURL);
                });
            } else if(type=='errorregister'){
                Swal.fire({
                    icon: 'error',
                    title: 'Registration failed',
                    text: 'Please try again.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#fb6f92',
                }).then(() => {
                    const newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
                    window.history.replaceState({ path: newURL }, '', newURL);
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: `There's an error occured.`,
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#fb6f92',
                });
            }
        }
        else if (message === 'success') {
            if (type === 'successregister') {
                Swal.fire({
                    icon: 'success',
                    title: 'Registration successful!',
                    text: 'Please login again to enter your account.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#fb6f92',
                });
            }
        }
    });
    </script>
</body>
</html>