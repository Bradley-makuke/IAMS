<?php
// Include configuration file (replace with your database connection details)
include "configure.php";

$errors = array(); // Array to store any errors encountered

// Process form data
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    session_start();
    if (!isset($_SESSION["username"])) {
      $errors[] = "Session error: Username not found.";
    }
    else{
        $username = $_SESSION["username"];
   
    // Validate and sanitize input
    $skills = isset($_POST["skills"]) ? implode(",", $_POST["skills"]) : "";
    $preferred_locations = isset($_POST["locations"]) ? implode(",", $_POST["locations"]) : "";
    $preferred_projects = isset($_POST["preferred_projects"]) ? $_POST["preferred_projects"] : "";

    // Insert into database
    $sql = "INSERT INTO company_preferences (username, skills, locations, projects) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss",$username, $skills, $preferred_locations, $preferred_projects);

    if ($stmt->execute()) {
        // Success - redirect to login page
        echo "<script>alert('Preferences submitted successfully!')</script>";
        echo "<script>window.location.href='login.html';</script>";
        exit();
    } else {
        // Error - display error message
        $errors[] = "Error inserting preferences: " . $stmt->error;
    }
}
}

// If there are errors, display them and redirect back to the form
if (!empty($errors)) {
    $error_message = implode("<br>", $errors);
    echo "<script>alert('$error_message')</script>";
    echo "<script>window.location.href='your_form_page.php';</script>";
    exit();
}


?>
