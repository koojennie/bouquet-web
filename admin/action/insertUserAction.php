<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // die;

    include ("../../koneksi.php");
    $id_user = $_POST['id_user'];
    $usn_user = $_POST['usn_user'];
    $nama_user = $_POST['nama_user'];
    $email_user = $_POST['email_user'];
    $notelp_user = $_POST['notelp_user'];

    // hash untuk password
    $pw_user = $_POST['pw_user'];
    $pw_user = password_hash($pw_user, PASSWORD_DEFAULT);

    // cek jika terdapat data yang sama atau data yang ada

    $query = "SELECT * FROM tb_user WHERE id_user = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $query = "INSERT INTO tb_user (id_user, usn_user, nama_user, email_user, notelp_user, pw_user) VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isssss", $id_user, $usn_user, $nama_user, $email_user, $notelp_user, $pw_user);
        $stmt->execute();
        $stmt->close();
        

        header("location:../user.php?message=success&type=adduser");
    } else {
        header("location:../addUserPage.php?message=error&reason=availableUser");
    }
} else {
    header('location:../user.php');
}