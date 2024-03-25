<?php
// Include the database configuration file
require_once("php/configure.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $company_name = trim($_POST['company_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    //error messages
    $companyNameError = '';
    $emailError = '';
    $passwordError = '';

    //connection to the database
    $conn = mysqli_connect("localhost", "root", "", "CODE");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Validate uniqueness of company name
    $sql = "SELECT * FROM organisation WHERE company_name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $company_name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $companyNameError = '<p style="font-size: 0.7rem; color: red;">Company name already exists. Please choose a different one.</p>';
    }

    mysqli_stmt_close($stmt);

    // Validate uniqueness of email
    $sql = "SELECT * FROM organisation WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $emailError = '<p style="font-size: 0.7rem; color: red;">Email already exists. Please use a different one.</p>';
    }

    mysqli_stmt_close($stmt);

    // If there are no errors, insert data into the database
    if (empty($companyNameError) && empty($emailError)) {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the database
        $sql = "INSERT INTO organisation (company_name, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $company_name, $email, $hashedPassword);

        if (mysqli_stmt_execute($stmt)) {
            // Registration successful
            echo "Registration successful!";
            // Redirect to a success page or perform other actions as needed
        } else {
            // Error inserting data
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="orgreg.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Registration Page</title>
</head>
<body>
    <div class="container">
        <div id="image-container">
            <img src="images/login picture.jpg" alt="image of the School">
        </div>
        <div id="form-container">
            <p>Already have an account? <a href="index.php">Sign in</a></p>
            <form action="" method="post" id="registration-form">
                <h3>Organization Account Creation</h3>
                <div class="input-container">
                    <i class="fa-regular fa-user one" style="color: #d3d4d4;"></i>
                       <input type="text" required placeholder="Company Name" name="company_name">
                </div>
                <div class="input-container">
                    <i class="fa-regular fa-user one" style="color: #d3d4d4;"></i>
                       <input type="email" required placeholder="Email" name="email">
                </div>
                <div class="input-container">
                    <i class="fa-solid fa-lock" style="color: #d3d4d4;"></i>
                       <input type="password" required placeholder="Password" name="password">
                       <i class="fa-regular fa-eye-slash"></i>
                </div>
                <div class="input-container">
                    <i class="fa-solid fa-lock" style="color: #d3d4d4;"></i>
                       <input type="password" required placeholder="Confirm Password" name="confirm_password">
                       <i class="fa-regular fa-eye-slash"></i>
                </div>
                <div class="input-container">
                 <a href="pref.html"><button id="next" type="button">Next</button></a>
                </div>
            </form>
        </div>
    </div>
    <script>

        // Add event listener to form submission
 document.getElementById('registration-form').addEventListener('submit', function(event) {
            // Prevent default form submission behavior
            event.preventDefault();
            // Manually navigate to Preferences.php
            window.location.href = 'Preferences.php';
        });



    document.addEventListener('DOMContentLoaded', function() {
        // Get all password inputs and their corresponding eye icons
        var passwordInputs = document.querySelectorAll('form input[type="password"]');
        var eyeIcons = document.querySelectorAll('.fa-eye-slash');

        // Add click event listener to each eye icon
        eyeIcons.forEach(function(eyeIcon, index) {
            eyeIcon.addEventListener('click', function() {
                // Toggle the type attribute of the corresponding password input between "password" and "text"
                if (passwordInputs[index].type === 'password') {
                    passwordInputs[index].type = 'text';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                    eyeIcon.style.color = 'blue';
                } else {
                    passwordInputs[index].type = 'password';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                    eyeIcon.style.color = '#d3d4d4'; // Reset color to default
                }
            });
        });
    });
</script>


</body>
</html>