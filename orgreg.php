
<?php

// Include configuration file (replace with your database connection details)
include "configure.php";

$errors = array(); // Array to store any errors encountered
$user_type = "organisation";

// Process form data
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $username = trim($_POST["company_name"]);
  $email = trim($_POST["email"]);
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];

  // Validation
  if (empty($username)) {
    $errors[] = "Please enter a username.";
  } else if (preg_match("/\s/", $username)) { // Check for whitespace
    $errors[] = "Username cannot contain whitespace.";
  }

  if (empty($email)) {
    $errors[] = "Please enter your email address.";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
  }

  if (empty($password)) {
    $errors[] = "Please enter a password.";
  } else if (strlen($password) < 8) {
    $errors[] = "Password must be at least 8 characters long.";
  } else if ($password !== $confirm_password) {
    $errors[] = "Passwords do not match.";
  }

  // If no errors, process and store data
  if (empty($errors)) {
    // Hash password
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute queries for both tables

    // Organization table
    $sql_org = "INSERT INTO organisation (username, email) VALUES (?, ?)";
    $stmt_org = $conn->prepare($sql_org);
    $stmt_org->bind_param("ss", $username, $email);

    // Users table
    $sql_user = "INSERT INTO user (username, email, user_type, password) VALUES (?, ?, ?, ?)";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("ssss", $username, $email, $user_type, $hashedpassword);

    // Execute both queries in a transaction
    $conn->begin_transaction();
    try {
      $stmt_org->execute();
      $stmt_user->execute();
      $conn->commit();
      echo "<script>alert('Registration successful!')</script>";
      echo "<script>window.location.href='pref.html';</script>"; // Redirect after success
      session_start();
      $_SESSION["username"] = $username;
      exit(); // Stop script execution after successful insertion and redirect
    } catch (Exception $e) {
      // Rollback transaction and display error message
      $conn->rollback();
      $errors[] = "Error registering user: " . $e->getMessage();
    }
  }
}

?>