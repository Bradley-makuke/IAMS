PHP
<?php

// Include configuration file (replace with your database connection details)
include "configure.php";

$errors = array(); // Array to store any errors encountered

// Process form data
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $skills = array();
  if (isset($_POST["skills"])) {
    foreach ($_POST["skills"] as $skill) {
      $skills[] = $skill; // Add selected skills to an array
    }
  }

  $preferred_locations = trim($_POST["preferred_locations"]);
  $preferred_projects = trim($_POST["preferred_projects"]);

 

  // Validation
  if (empty($skills)) {
    $errors[] = "Please select at least 3 hard skills.";
  } else if (count($skills) < 3) {
    $errors[] = "You must select at least 3 hard skills.";
  }

  if (empty($preferred_locations)) {
    $errors[] = "Please enter your preferred locations.";
  }

 

  // If no errors, process and store data
  if (empty($errors)) {
    session_start();
    if (!isset($_SESSION["username"])) {
      $errors[] = "Session error: Username not found.";
    }
    else {
        $username = $_SESSION["username"];
      
    $skills_string = implode(",", $skills); // Join skills using comma
    $sql = "INSERT INTO student_preferences (username, skills, location, projects) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $skills_string, $preferred_locations, $preferred_projects);

    if ($stmt->execute()) {
      echo "<script>alert('Preferences submitted successfully!')</script>";
      echo "<script>window.location.href='login.php';</script>"; // Redirect to login page
      exit(); // Stop script execution after successful insertion and redirect
    } else {
      $errors[] = "Error inserting preferences: " . $stmt->error;
    }
  }
}
}

?>
