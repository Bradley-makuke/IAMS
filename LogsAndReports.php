<?php
$servername = "10.0.19.74";
$username = "tsu00073";
$password = "tsu00073";
$dbname = "db_tsu00073";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}
else{
"Connection Sucessful!!"
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = $_POST["date"];

    session_start();
    if (!isset($_SESSION["username"])) {
      $errors[] = "Session error: Username not found.";
    }
    else{

        $studentName = $_SESSION["username"];
    }
    
    $industrialSupervisor = $_POST["industrialSupervisor"];
    $organization = $_POST["organization"];
    $description = $_POST["description"];


    // // SQL query to insert data
    // $sql = "INSERT INTO logs (date, industrialSupervisor, organization, description) VALUES ('$date', '$industrialSupervisor', '$organization', '$description')";

    // if ($conn->query($sql) === TRUE) {
    //     echo "Data inserted successfully!";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }

    // $stmt = $conn->prepare("INSERT INTO logs (date, industrialSupervisor, organization, description) 
    // VALUES(?,?,?,?)");
    // $stmt->bind_param("ssss", ($date, $industrialSupervisor, $organization, $description) );

    // if ($stmt->execute()) {
    //     echo "Data inserted successfully!";
    // } else {
    //     echo "Error: " . $conn->error;
    // }
}

$stmt = $conn->prepare("INSERT INTO logs (date, studentName,industrialSupervisor, organization, description) VALUES(?,?,?,?,?)");
$stmt->bind_param("sssss", ($date, $studentName ,$industrialSupervisor, $organization, $description) );

    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }




   
$stmt->close();
$conn->close();


if (isset($_POST['submit'])) {
    
    session_start();
    if (!isset($_SESSION["username"])) {
      $errors[] = "Session error: Username not found.";
    }
    else{
        $studentName = $_SESSION["username"];
    }

    $pdfFileName = $_FILES['pdfFile']['name'];

//     // Insert data into the 'pdf_data' table
//     $insertQuery = "INSERT INTO pdfData (username, fileName) VALUES ('$studentName', '$pdfFileName')";
//     mysqli_query($con, $insertQuery);
}

$stmt = $conn->prepare("INSERT INTO logs (studentName, file) VALUES(?,?)");
    $stmt->bind_param("ss", ($studentName ,$pdfFileName) );

    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
   
$stmt->close();
$conn->close();

/**if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    session_start();
    if (!isset($_SESSION["username"])) {
      $errors[] = "Session error: Username not found.";
    }
    else{
        $studentName = $_SESSION["username"];
    }


    // SQL query to insert data
    $sql = "INSERT INTO reports (studentName) VALUES ('$studentName')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}*/



?>