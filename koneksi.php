<?php
$server = "localhost:3307";
$user = "root";
$pass = "";
$database = "bloom_bliss";

// membuat variabel untuk koneksi
$conn = mysqli_connect($server, $user, $pass, $database);

// cek koneksi disini 
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>