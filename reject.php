<?php
// Assuming you have already established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the accept button was clicked and perform the update operation
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Perform database update operation here
    // For example, update the status of the student's application to 'accepted'
    // You'll need to replace 'your_table_name' with the actual name of your table
   
     $notificationTime = date('Y-m-d H:i:s');
     if(isset($_COOKIE['param'])){
        $studentID = $_COOKIE['param'];
    }  
    

    $sql = "UPDATE notifications SET status = 'rejected', timestamp = '$notificationTime' WHERE studentID = '$studentID' AND organisationID = '212102121' ";
    if ($conn->query($sql) === TRUE) {
        echo "status updateded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
