<?php
// Database connection and query
$servername = "10.0.19.74";
$username = "tsu00073";
$password = "tsu00073";
$dbname = "db_tsu00073";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM organisation";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Featured Companies</title>
    <link rel="stylesheet" href="append.css">
</head>
<body>
   

    <em><h2>FEATURED COMPANIES</h2></em>
    <div class="carousel">
        <div class="carousel-inner">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $companyName = $row["username"];
                    $logoSrc = "students.jpg";
                    $vacancy = $row["vacancies"];
                    echo "<div class='carousel-card'>
                            <h3>$companyName</h3>
                            <p>Is looking for $vacancy student attachees for industrial attachment</p>
                          </div>";  
                }
            } else {
                echo "No companies found.";
            }
            $conn->close();
            ?>

    <script src="append.js"></script>
</body>
</html>