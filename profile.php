<?php
include 'functions.php';
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: login_register.php");
    exit();
}

$id = $_SESSION['id_user'];
$user = getUserById($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloom & Bliss</title>
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
    <style>
        body {
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
    <div class="container">
        <div class="page-inner">
            </div>
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Edit User Profile</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="updateprofile.php" method="post">
                                <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                <div class="row">
                                    <div class="col-lg-8">                            
                                        <div class="form-group mt-1">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="<?= $user['usn_user'] ?>" required/>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?= $user['nama_user'] ?>" required/>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="<?= $user['email_user'] ?>" required/>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="no_telp">No Telp</label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Enter No Telp" value="<?= $user['notelp_user'] ?>" required/>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="new_password">New Password</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password">
                                        </div>
                                        <div class="form-check mt-3">
                                            <input type="checkbox" class="form-check-input" id="change_password" name="change_password">
                                            <label class="form-check-label" for="change_password">Change Password</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- Kosong untuk tampilan responsif -->
                                    </div>
                                    <div class="col-lg-12 pt-5">
                                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
        // Tampilkan SweetAlert berdasarkan pesan success
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');
        const type = urlParams.get('type');

        if (message === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Profile updated successfully.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#fb6f92',
            }).then(() => {
                const newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
                window.history.replaceState({ path: newURL }, '', newURL);
            });
        } else if (message === 'error') {
            Swal.fire({
                icon: 'error',
                title: 'Error updating profile.',
                text: 'Profile update failed.',
                confirmButtonText: 'OK',
                confirmButtonColor: '#fb6f92',
            }).then(() => {
                const newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
                window.history.replaceState({ path: newURL }, '', newURL);
            });
        }
    });
    </script>
</body>
</html>