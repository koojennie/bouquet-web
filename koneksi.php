<?php
$server = "localhost:3307";
$user = "root";
$pass = "";
$database = "bouquet_web1";

// membuat variabel untuk koneksi
$conn = mysqli_connect($server, $user, $pass, $database);

// cek koneksi disini 
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>