<?php
include 'functions.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_user'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $notelp = $_POST['no_telp']; // perbaikan di sini, mengubah dari 'notelp' menjadi 'no_telp'
    $new_password = $_POST['new_password'];
    $change_password = isset($_POST['change_password']);

    global $conn; // pastikan variabel koneksi global $conn tersedia

    if ($change_password) {
        $password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE tb_user SET usn_user = ?, nama_user = ?, email_user = ?, notelp_user = ?, pw_user = ? WHERE id_user = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $username, $name, $email, $notelp, $password, $id);
    } else {
        $query = "UPDATE tb_user SET usn_user = ?, nama_user = ?, email_user = ?, notelp_user = ? WHERE id_user = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $username, $name, $email, $notelp, $id);
    }

    if ($stmt->execute()) {
        header("location: profile.php?message=success");
    } else {
        header("location: profile.php?message!=success");
    }

    $stmt->close(); // pastikan untuk menutup statement setelah selesai
}
?>
