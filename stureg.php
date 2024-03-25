<?php
// Include the configuration file
require_once("php/configure.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Get form data
  $username = trim($_POST['username']);
  $studentId = trim($_POST['student-id']);
  $password = trim($_POST['password']);
  $confirmPassword = trim($_POST['confirm-password']);

  // Error messages
  $usernameError = '';
  $passwordError = '';

  // Database connection (replace with your actual connection logic)
  $conn = mysqli_connect("localhost", "root", "", "CODE");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Validate username (assuming username is unique identifier)
  $sql = "SELECT username FROM student WHERE username = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) > 0) {
    $usernameError = '<p style="font-size: 0.7rem; color: red;">Username already exists. Please choose a new one.</p>';
  }

  mysqli_stmt_close($stmt);

  // Validate password (basic example, consider password hashing)
  if (strlen($password) < 8) {
    $passwordError = '<p style="font-size: 0.7rem; color: red;">Password must be at least 8 characters.</p>';
  } elseif ($password !== $confirmPassword) {
    $passwordError = '<p style="font-size: 0.7rem; color: red;">Passwords do not match.</p>';
  }

  // If no errors, insert data into database (replace with your actual query)
  if (empty($usernameError) && empty($passwordError)) {
    $sql = "INSERT INTO student (username, studentid, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash password before storing
    mysqli_stmt_bind_param($stmt, "sss", $username, $studentId, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
      echo "Registration successful!"; // Replace with success message/redirection
    } else {
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
    <link rel="stylesheet" href="stureg.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Registration page</title>
</head>
   <body>
    
    <div class="container">
    <?php if (!empty($usernameError)) : ?>
      <?= $usernameError ?> <?php endif; ?>

    <?php if (!empty($passwordError)) : ?>
      <?= $passwordError ?>
    <?php endif; ?>


        <div id="image-container">
            <img src="images/login picture.jpg" alt="image of the School">
        </div>

        <div id="form-container">
            <p>Already have an account? <a href="index.php">Sign in</a></p>
            <form action="" method="post" id="registration-form">
                <h3>Student Account Creation</h3>
                <div class="input-container">
                    <i class="fa-regular fa-user one" style="color: #d3d4d4;"></i>
                       <input type="text" required placeholder="Username" name="username">
                </div>
                <div class="input-container">
                    <i class="fa-regular fa-user one" style="color: #d3d4d4;"></i>
                       <input type="number" required placeholder="Student-ID" maxlength="9" name="student-id">
                </div>
                <div class="input-container">
                    <i class="fa-solid fa-lock" style="color: #d3d4d4;"></i>
                       <input type="password" required placeholder="Password" name="password">
                       <i class="fa-regular fa-eye-slash" style="color: #d3d4d4;"></i>
                </div>
                <div class="input-container">
                    <i class="fa-solid fa-lock" style="color: #d3d4d4;"></i>
                       <input type="password" required placeholder="Confirm Password" name="confirm-password">
                       <i class="fa-regular fa-eye-slash" style="color: #d3d4d4;"></i>
                </div>
                <div class="input-container">
                <button id="next" type="submit">Next</button>
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