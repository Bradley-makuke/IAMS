<?php
$conn = new mysqli("localhost", "root", "", "code");

if($conn->connect_error){
    die(":Failed to Connect!:". $conn->connect_error);
}


?>