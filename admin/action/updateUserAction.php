<?php
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $new_password = $_POST['new_password'];
    $change_password = isset($_POST['change_password']);

    if ($change_password && !empty($new_password)) {
        // Mengubah password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE tb_user SET nama_user = ?, usn_user = ?, email_user = ?, notelp_user = ?, pw_user = ? WHERE id_user = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $name, $username, $email, $no_telp, $hashed_password, $id_user);
    } else {
        // Tidak mengubah password
        $query = "UPDATE tb_user SET nama_user = ?, usn_user = ?, email_user = ?, notelp_user = ? WHERE id_user = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $name, $username, $email, $no_telp, $id_user);
    }

    if ($stmt->execute()) {
        header("Location: ../user.php?message=success&type=updateuser");
        exit();
    } else {
        header("Location: ../user.php?message=error&reason=userNoChanged");
    }
}
?>
