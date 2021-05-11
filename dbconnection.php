<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlydathang";

$conn = new mysqli($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    exit();
}

?>
