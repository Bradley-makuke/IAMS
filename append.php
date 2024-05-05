<?php
// Database connection and query
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "code";

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
   

    <h2>Featured Companies</h2>
    <div class="carousel">
        <div class="carousel-inner">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $companyName = $row["username"];
                    $logoSrc = "students.jpg";
                    echo "<div class='carousel-card'>
                            <img src='$logoSrc' alt='$companyName Logo'>
                            <h3>$companyName</h3>
                          </div>";
                }
            } else {
                echo "No companies found.";
            }
            $conn->close();
            ?>
        </div>
        <a class="prev" onclick="plusSlides(-4)">&#10094;</a>
        <a class="next" onclick="plusSlides(4)">&#10095;</a>
    </div>

    <script src="append.js"></script>
</body>
</html>