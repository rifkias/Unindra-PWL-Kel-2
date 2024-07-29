<?php 
// isi nama host, username mysql, dan password mysql anda
$conn = mysqli_connect("localhost","root","[password]","inventory");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>