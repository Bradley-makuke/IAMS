<?php
// Database connection and coordinator details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "code";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$coordinatorId = "Coordinat0r"; // Replace with actual coordinator ID

$sql = "SELECT * FROM coordinator";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $coodinatorFname = $row["firstname"];
    $coordniatorSname = $row["surname"];
    $coordinatorEmail = $row["email"];
    $coordinatorNumber = $row["phone_number"];
} else {
    $coodinatorFname = "";
    $coordniatorSname = "";
    $coordinatorEmail = "";
    $coordinatorNumber = "";
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Coordinator Dashboard</title>
    <link rel="stylesheet" href="profile.css">
    <script src="script.js"></script>
</head>
<body>
    <header>
        <div class="logo">website logo</div>
        <nav>
            <ul>
                <li><a href="#" >View Students</a></li>
                <li><a href="#" >View Companies</a></li>
                <li><a href="#" >Make Matches</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Log Out</a></li>
            </ul>
        </nav>
       
    </header>
    <main>
    <div class="user-info">
            <span class="username"> </span>
            <div class="personal-info">
                <p>Personal Information:</p>
                <p>Email Address: </p>
                <p>Contact Number: </p>
            </div>
        </div>
        <div id="content"></div>
    </main>
</body>
</html>