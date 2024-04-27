<?php
session_start();

// Create connection
$conn = new mysqli("localhost", "root", "", "code");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variables and set to empty values
$username = $email = $student_id = $number = $password = $confirm_password = "";
$usernameError = $emailErr = $student_idErr = $numberErr = $passwordErr = $confirm_passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Function to sanitize input data
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate and sanitize inputs
    $username = test_input($_POST["username"]);
    $email = test_input($_POST["email"]);
    $student_id = test_input($_POST["student_id"]);
    $number = test_input($_POST["number"]);
    $password = test_input($_POST["password"]);
    $confirm_password = test_input($_POST["confirm_password"]);

    // Perform validation


    if (empty($username)) {
        $usernameError = "Username is required";
    }
   

    if (empty($email)) {
        $emailErr = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    if (empty($student_id)) {
        $student_idErr= "Student ID is required";
    }
    if (empty($number)) {
        $numberErr = "Phone number is required";
    }

    if (empty($password)) {
        $passwordErr = "Password is required";
    }

    if ($password !== $confirm_password) {
       $confirm_passwordErr= "Passwords do not match";
    }

    // If there are no errors, insert into database
    if (empty($errors)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO student (username, email, studentId, phoneNumber, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $email, $number, $hashed_password);

        if ($stmt->execute()) {
            // Registration successful, set session and redirect to login.php
            $_SESSION['username'] = $username;
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
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
        <?= $usernameError ?> 
    <?php endif; ?>

    <?php if (!empty($passwordError)) : ?>
        <?= $passwordError ?>
    <?php endif; ?>

    <div id="image-container">
        <img src="images/login picture.jpg" alt="image of the School">
    </div>

    <div id="form-container">
        <p>Already have an account? <a href="login.php">Sign in</a></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="registration-form">
            <h3>Student Account Creation</h3>
            <div class="input-container">
                <i class="fa-regular fa-user one" style="color: #d3d4d4;"></i>
                <input type="text" required placeholder="Username" name="username">
            </div>
            <div class="input-container">
                <i class="fa-regular fa-user one" style="color: #d3d4d4;"></i>
                <input type="email" required placeholder="Enter email" name="email">
            </div>
            <div class="input-container">
                <i class="fa-regular fa-user one" style="color: #d3d4d4;"></i>
                <input type="number" required placeholder="Student-ID" maxlength="9" name="student_id">
            </div>
            <div class="input-container">
                <i class="fa-regular fa-user one" style="color: #d3d4d4;"></i>
                <input type="tel" required placeholder="Enter phone number" name="number">
            </div>
            <div class="input-container">
                <i class="fa-solid fa-lock" style="color: #d3d4d4;"></i>
                <input type="password" required placeholder="Password" name="password">
                <i class="fa-regular fa-eye-slash" style="color: #d3d4d4;"></i>
            </div>
            <div class="input-container">
                <i class="fa-solid fa-lock" style="color: #d3d4d4;"></i>
                <input type="password" required placeholder="Confirm Password" name="confirm_password">
                <i class="fa-regular fa-eye-slash" style="color: #d3d4d4;"></i>
            </div>
            <div class="input-container">
                <button id="next" type="submit">Next</button>
            </div>
        </form>
    </div>
</div>

<!-- <div id="popup" class="/*//isset($registrationSuccess) && $registrationSuccess ? '' : 'hidden' ?>">
    <div class="popup-content">
        <p>You have successfully registered your details!</p>
        <p>Press "OK" to continue.</p>
        <button id="close-popup">OK</button>
    </div> -->
</div>
<script>
    const openBtn = document.getElementById("next");
    const popup = document.getElementById("popup");
    const closeBtn = document.getElementById("close-popup");

    openBtn.addEventListener("click", () => {
        popup.classList.remove("hidden");
        document.body.classList.add("blur");
    });

    closeBtn.addEventListener("click", () => {
        popup.classList.add("hidden");
        document.body.classList.remove("blur");
        // Redirect to pref.php
        window.location.href = 'login.php';
    });

    // Optional: Close popup when clicking outside the card
    window.addEventListener("click", (event) => {
        if (event.target === popup) {
            popup.classList.add("hidden");
            document.body.classList.remove("blur");
            // Redirect to pref.php
            window.location.href = 'login.php';
        }
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
