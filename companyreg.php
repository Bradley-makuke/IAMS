<?php

// Check if the form has been submitted
if (isset($_POST['company_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {

    // Get the input values from the form
    $company_name = $_POST['company_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Connect to your database (replace placeholders with your credentials)
    $servername = "your_server_name";
    $username = "your_db_username";
    $password = "your_db_password";
    $dbname = "your_database_name";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Validate passwords
    if ($password !== $confirm_password) {
        echo "Error: Passwords do not match.";
        $conn->close();
        exit(); // Terminate script execution
    }

    // Hash the password for security (recommended)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);  // Use a strong hashing algorithm

    // Prepare the SQL statement to insert data
    $sql = "INSERT INTO organizations (company_name, email, password) VALUES (?, ?, ?)";

    // Prepare a statement object for secure insertion
    $stmt = $conn->prepare($sql);

    // Bind the parameters to the statement
    $stmt->bind_param("sss", $company_name, $email, $hashed_password); // Use hashed password

    // Execute the statement
    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Registration successful!";
        // Optionally, redirect to a success page or provide further instructions
    } else {
        // Error occurred
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Form not submitted or missing data
    echo "Error: Please fill out the registration form completely.";
}

?>
