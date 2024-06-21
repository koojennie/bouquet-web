<?php 
// membuat koneksi dengan database lewat file koneksi.php
include 'koneksi.php';

function register($username, $name, $email, $notelp, $password) {
    global $conn;

    // meloloskan input dari pengguna untuk menghindari SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $notelp = mysqli_real_escape_string($conn, $notelp);

    // algoritma hash untuk enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    // periksa email sudah ada atau belom
    $query = "SELECT email_user FROM tb_user WHERE email_user='$email'";
    $result = mysqli_query($conn, $query);
    if(mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Email kamu sudah ada!')</script>";
        return false;
    }

    // tambahkan userbaru ke database
    $query = "INSERT INTO tb_user (usn_user, nama_user, email_user, notelp_user, pw_user) VALUES ('$username', '$name', '$email', '$notelp', '$password')";
    mysqli_query($conn, $query);

    return true;
}

function login($email, $password) {
    global $conn;
    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT * FROM tb_user WHERE email_user='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['pw_user'])) {
            return $user;
        }
    }
    return false;
}

?>