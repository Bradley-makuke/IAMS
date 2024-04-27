<?php
$conn = mysqli_connect("localhost", "root", "", "code");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>