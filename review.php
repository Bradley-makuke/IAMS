<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "code";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Accept/Reject actions
if (isset($_POST['action']) && $_POST['action'] === 'accept') {
    // Create a new table under "Accepted Applications"
    $accepted_table_name = "accepted_" . strtolower($first_name) . "_" . strtolower($last_name);
    $sql_create_table = "CREATE TABLE IF NOT EXISTS $accepted_table_name (
                          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                          first_name VARCHAR(30) NOT NULL,
                          last_name VARCHAR(30) NOT NULL,
                          email VARCHAR(50),
                          skills TEXT,
                          resume_path VARCHAR(255)
                        )";
    if ($conn->query($sql_create_table) === TRUE) {
        // Insert data into the accepted table
        $sql_insert_accepted = "INSERT INTO $accepted_table_name (first_name, last_name, email, skills, resume_path)
                                VALUES ('$first_name', '$last_name', '$email', '$skills_list', '$resume_path')";
        if ($conn->query($sql_insert_accepted) === TRUE) {
            echo "Record accepted successfully";
        } else {
            echo "Error accepting record: " . $conn->error;
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }
} elseif (isset($_POST['action']) && $_POST['action'] === 'reject') {
    // Remove the record from display
    // This can be handled client-side using JavaScript, but for demonstration purposes, we'll echo a message here
    echo "Record rejected successfully";
}


$sql = "SELECT  firstname AS Firstname, lastname AS Surname, email AS EMAIL, resume, academic_transcript as Transcript, skills AS Skills FROM applicant";
$result = $conn->query($sql);


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Review</title>
    <link rel="stylesheet" href="review.css">
</head>
<body>
    <div class="header">
        <input type="search" placeholder="Search...">
    </div>
    <div class="sidebar">
        <div class="profile">
            <img src="user-image.jpg" alt="Profile Picture">
            <p>John Doe</p>
        </div>
        <nav>
            <ul>
                <li>Notifications</li>
                <li>Messages</li>
                <li>Log Out</li>
                <li>About</li>
                <li>Contact Us</li>
            </ul>
        </nav>
    </div>
             
    <div class="main-content">
        <h2>Applications</h2>
        <div class="offers-section">
       
        <div class="card">
          <h2>Review</h2>
            <?php
            if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Firstname</th><th>Lastname</th><th>Email</th><th>Resume</th><th>Transcript</th><th>Skills</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Firstname"]."</td><td>".$row["lastname"]."</td><td>".$row["email"]."</td><td>".$row["resume"]."</td><td>".$row["transcript"]."</td><td>".$row["Skills"]."</td>";
        echo "<td><button class='accept'>Accept</button><button class='reject'>Reject</button></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
} ?>
      
        </div>
        
        <h2>Accepted Applicants</h2>
    </div>
    </div>
</body>
</html>
