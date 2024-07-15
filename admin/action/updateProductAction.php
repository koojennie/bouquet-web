<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // var_dump($_POST);
    // die;

    include ("../../koneksi.php");
    $bouquet_id = $_POST['bouquet_id'];
    $bouquet_code = $_POST['bouquet_code'];
    $bouquet_name = $_POST['bouquet_name'];
    $bouquet_description = $_POST['bouquet_description'];
    $bouquet_type = $_POST['bouquet_type'];
    $bouquet_price = $_POST['bouquet_price'];
    $bouquet_ratings = $_POST['bouquet_ratings'];
    $bouquet_category = $_POST['bouquet_category'];
    $bouquet_image = $_FILES['bouquet_image']['name'];

    // cek apakah user input image  
    if ($bouquet_image != "") {
        $image_size = $_FILES['bouquet_image']['size'];
        $image_temp = $_FILES['bouquet_image']['tmp_name'];
        $error = $_FILES['bouquet_image']['error'];

        // cek apakah error
        if ($error === 0) {
            $image_ex = pathinfo($bouquet_image, PATHINFO_EXTENSION);
            $image_ex = strtolower($image_ex);
            $allowed_exs = array('jpg', 'jpeg', 'png');

            // cek file yang input user apakah extension pada variabel alllow_exs 
            if (in_array($image_ex, $allowed_exs)) {
                $image_path = '../../assets/images/flowers/' . $bouquet_image;
                move_uploaded_file($image_temp, $image_path);

                $query = "UPDATE tb_produk SET bouquet_code = ?, bouquet_name = ?, bouquet_image = ?, bouquet_description = ?, bouquet_type = ?, bouquet_price = ?, bouquet_ratings = ?, bouquet_category = ? WHERE bouquet_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sssssidsi", $bouquet_code, $bouquet_name, $bouquet_image, $bouquet_description, $bouquet_type, $bouquet_price, $bouquet_ratings, $bouquet_category, $bouquet_id);
                $stmt->execute();
                $stmt->close();

                header("location:../product.php?message=success");

            } else {
                header("location:../product.php?message=$error");
            }
        }
    } else {
        $query = "UPDATE tb_produk SET bouquet_code = ?, bouquet_name = ?, bouquet_description = ?, bouquet_type = ?, bouquet_price = ?, bouquet_ratings = ?, bouquet_category = ? WHERE bouquet_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssidsi", $bouquet_code, $bouquet_name, $bouquet_description, $bouquet_type, $bouquet_price, $bouquet_ratings, $bouquet_category, $bouquet_id);
        $stmt->execute();
        $stmt->close();

        header("location:../product.php?message=success&type=updateproduct");
    }


} else {
    header('location:../product.php');
}