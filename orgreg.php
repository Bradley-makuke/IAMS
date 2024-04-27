<?php
// Include the database configuration file
include "configure.php";

 //error messages
 $companyNameError = '';
 $emailError = '';
 $passwordError = '';
 $confirm_passwordError = '';

 // variables set to empty values;
 $username = $email = $password = $confirm_password = "";
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Encoding the data with a function
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate username 
    if(empty($_POST['username'])){
        $companyNameError = "Username is required!!";
    }

    else{
            // Get form data
        $username = test_input($_POST['username']); 

    }

    if(!preg_match('/^[^\s]+$/', $username)){
        $companyNameError = "username shouldnt have numbers and white spaces";
    }

    // validate the email 
    if(empty($_POST['email'])){
        $emailError = "email is required!!";
    }
    else{
        $email = test_input($_POST['email']);

    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailError = "Invalid email format";
    }

      // validate the password 
      if(empty($_POST['password'])){
        $passwordError = "password is required!!";
    }
    else{
        $password = test_input($_POST['password']);

    }
    if(!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s])(?!.*\s).{8,}$/', $password)){
        $passwordError = "Password is not valid";
    }
      // validate the confirmation password
      if(empty($_POST['confirm_password'])){
        $confirmpasswordError = "Confirmation passowrd is required!!";
    }
    else{
        $confirm_password = test_input($_POST['confirm_password']);

    }
    if(!preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s])(?!.*\s).{8,}$/', $confirm_password)){
        $confirmpasswordError = "Password is not valid";
    }
   
    



    // Validate uniqueness of company name
    $sql = "SELECT * FROM organisation WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
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

    // If  the passwords match you can insert into the database;
    if ($password === $confirm_password) {
        $passwordError = $confirm_passwordError = "Passowrds do not match!";
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the database
        $sql = "INSERT INTO organisation (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss",$username, $email, $hashedPassword);

        if (mysqli_stmt_execute($stmt)) {
            // Registration successful
            $registrationSuccess = true;
        } else {
            // Error inserting data
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }

  
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
            <p>Already have an account? <a href="login.php">Sign in</a></p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="registration-form">
                <h3>Organization Account Creation</h3>

                <div class="input-container">
                    <i class="fa-regular fa-user one" style="color: #d3d4d4;"></i>
                       <input type="text"  placeholder="Company Name" name="username" id="username">
                       <span class="error" id="usernameError"><p><?php echo "$companyNameError"; ?></p></span>
                </div>
                <div class="input-container">
                    <i class="fa-regular fa-user one" style="color: #d3d4d4;"></i>
                       <input type="email" required placeholder="Email" name="email" id="email">
                       <span class="error" id="emailError"><p><?php echo "$emailError"; ?></p></span>
                </div>
                <div class="input-container">
                    <i class="fa-solid fa-lock" style="color: #d3d4d4;"></i>
                       <input type="password" required placeholder="Password" name="password" id="password">
                       <i class="fa-regular fa-eye-slash"></i>
                       <span class="error" id="passowrdError"><p><?php echo "$passwordError"; ?></p></span>
                </div>
                <div class="input-container">
                    <i class="fa-solid fa-lock" style="color: #d3d4d4;"></i>
                       <input type="password" required placeholder="Confirm Password" name="confirm_password" id="confirmPassword">
                       <i class="fa-regular fa-eye-slash"></i>
                       <span class="error" id="confirmPasswordError"><p><?php echo "$confirm_passwordError"; ?></p></span>
                </div>
                <div class="input-container">
                 <button id="next" type="submit">Next</button>
                </div>
            </form>
        </div>
        <div id="popup" class="<?= isset($registrationSuccess) && $registrationSuccess ? '' : 'hidden' ?>">
            <div class="popup-content">
                <h2>Registration Successful!</h2>
                <p>Press "OK" to continue.</p>
                <button id="close-popup">OK</button>
            </div>
        </div>
    </div>
    <script>
       /* const openBtn = document.getElementById("next");
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
                window.location.href = 'pref.php';
            }
        });*/

        document.addEventListener('DOMContentLoaded', function() {

            const form = document.getElementById("registration-form");
    
    const showError = (inputId, message) => {
        const errorElement = document.getElementById(inputId + "Error");
        errorElement.querySelector("p").textContent = message;
    };
    
    const validateForm = () => {
        let isValid = true;

        // Check each input field
        const usernameInput = document.getElementById("username");
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById("confirmPassword");
        
        if (usernameInput.value.trim() === "") {
            showError("username", "Username is required");
            isValid = false;
        } else {
            showError("username", "");
        }

        if (emailInput.value.trim() === "") {
            showError("email", "Email is required");
            isValid = false;
        } else {
            showError("email", "");
        }

        if (passwordInput.value.trim() === "") {
            showError("password", "Password is required");
            isValid = false;
        } else if (passwordInput.value.length < 8 || passwordInput.value.length > 25) {
            showError("password", "Password must be between 8 and 25 characters");
            isValid = false;
        } else {
            showError("password", "");
        }

        if (confirmPasswordInput.value.trim() === "") {
            showError("confirmPassword", "Please confirm your password");
            isValid = false;
        } else if (confirmPasswordInput.value !== passwordInput.value) {
            showError("confirmPassword", "Passwords do not match");
            isValid = false;
        } else {
            showError("confirmPassword", "");
        }

        return isValid;
    };
    
    form.addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
    
    // Show error messages when input fields are focused
    const inputFields = form.querySelectorAll("input");
    inputFields.forEach(input => {
        input.addEventListener("focus", function() {
            const errorElement = document.getElementById(input.id + "Error");
            if (errorElement) {
                showError(input.id, errorElement.querySelector("p").textContent);
            }
        });
    });
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
