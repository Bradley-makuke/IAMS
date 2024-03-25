<?php
/*
// Check if the form has been submitted
if (isset($_POST['username']) && isset($_POST['password'])) {

    // Get the input values from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

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

    // Prepare the SQL statement to insert data
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

    // Prepare a statement object for secure insertion
    $stmt = $conn->prepare($sql);

    // Bind the parameters to the statement
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Data recorded successfully!";
    } else {
        // Error occurred
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
*/


// Check if the form has been submitted
if (isset($_POST['username_or_company_name']) && isset($_POST['password'])) {

    // Get the input values from the form
    $username_or_company_name = $_POST['username_or_company_name'];
    $password = $_POST['password'];

    // Connect to your database (replace placeholders with your credentials)
    $servername = "your_server_name";
    $username = "your_db_username";
    $password = "your_db_password";
    $dbname = "db-iams";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare separate SQL statements for students and companies (optional for better maintainability)
    $sql_students = "SELECT id, username, password FROM students WHERE username = ?";
    $sql_companies = "SELECT id, company_name, password FROM organizations WHERE company_name = ?";

    // You can choose one of the following approaches:

    // Approach 1: Separate queries for students and companies (more secure)
    $is_student = true; // Assuming student login by default
    $stmt = $conn->prepare($sql_students);
    $stmt->bind_param("s", $username_or_company_name);

    // Execute the student query first
    if ($stmt->execute()) {
        $result = $stmt->get_result(); // Get the result set
        if ($result->num_rows > 0) {
            $is_student = true; // Confirmed student login
            $row = $result->fetch_assoc(); // Get user data
        } else {
            $is_student = false; // Not a student, try company login
        }
        $stmt->close(); // Close the student statement
    } else {
        echo "Error: " . $stmt->error;
        $conn->close();
        exit(); // Terminate script execution
    }

    if (!$is_student) {
        // If not student, try company login using a separate query
        $stmt = $conn->prepare($sql_companies);
        $stmt->bind_param("s", $username_or_company_name);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); // Get user data
            } else {
                echo "Error: Invalid username or company name.";
                $conn->close();
                exit(); // Terminate script execution
            }
            $stmt->close(); // Close the company statement
        } else {
            echo "Error: " . $stmt->error;
            $conn->close();
            exit(); // Terminate script execution
        }
    }

    // Approach 2: Single query with conditional check (less secure, might be vulnerable to SQL injection)
    // $sql = "SELECT id, username, password FROM students WHERE username = ?
    //          UNION ALL
    //          SELECT id, company_name AS username, password FROM organizations WHERE company_name = ?";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("ss", $username_or_company_name, $username_or_company_name);
    // // Execute the single query
    // ... (rest of the code similar to Approach 1)

    // Verify password (using the retrieved data from either student or company query)
    if (isset($row) && password_verify($password, $row['password'])) {
        // Login successful!
        // You can store user data in a session (e.g., $_SESSION['user_id'] = $row['id'])
        // and redirect to the appropriate user dashboard based on user type (student or company)
        echo "Login successful!"; // Replace with redirection and session handling
    } else {
        echo "Error: Invalid username or company name, or incorrect password.";
    }

    $conn->close();
} else {
    // Form not submitted or missing data
    echo "Error: Please fill out the login form completely.";
}



?>
