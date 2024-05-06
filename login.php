<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "code");
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variables and set to empty values
$username = $password = "";
$errors = array();

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
    $password = test_input($_POST["password"]);
    

    // Retrieve user data from database
    //$stmt = $conn->prepare("SELECT username, password FROM student WHERE username = ?");
    $stmt = $conn->prepare("SELECT username,user_type, password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row["password"])) {
            // Set session variables and redirect to index.php
            $_SESSION['loggedin'] = $row["username"];
            $user_type = $row["user_type"];

            switch ($user_type) {
                case "student":
                    header("Location: s_profile.html");
                    exit;
                    break;
                case "organisation":
                    header("Location: profile.html");
                    exit;
                    break;
                case "coordinator":
                    header("Location: coordinator.php");
                    exit;
                    break;
                default:
                    // Handle invalid user type (optional)
                    $errors["general"] = "Invalid user type";
                    break;
            }
        
            
        } else {
            $errors["password"] = "Incorrect username or password";
        }
    } else {
        $errors["password"] = "Incorrect username or password";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <img src="images/UBotswana.png" alt="UB logo">
        <div id="form-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="login-form">
                <h3>Log in</h3>
                <div class="input-container">
                    <input type="text" placeholder="Enter username" required name="username">
                </div>
                <div class="input-container">
                    <input type="password" placeholder="Enter password" required name="password">
                    <i class="fa-regular fa-eye-slash" style="color: #d3d4d4; display:block" ></i>
                </div>
                <div class="input-container button">
                    <button type="submit">Log in</button>
                </div>
                <label for="checkbox">remember me</label>
                <input type="checkbox">
                <?php if (!empty($loginError)) : ?>
                    <?= $loginError ?>
                <?php endif; ?>
                <p id="sign">Don't have an account? <a href="#" id="sign-up">Sign up</a></p>
            </form>

            <!-- Student Registration Form  link-->
            <div id="student-registration-form" style="display: none;" class="choice-wrap">
                <!-- Include student registration form fields here -->
                <h3>Student Registration</h3>
                
                <div class="button-container ">
                   <a href="stureg.php"><button type="submit" class="choice">Sign up as Student</button></a> 
                </div>
                </div>

            <!-- Organization Registration Form link -->
            <div  id="organization-registration-form" style="display: none;" class="choice-wrap">
                <!-- Include organization registration form fields here -->
                <h3>Organization Registration</h3>
               
               
                <div class="button-container">
                    <a href="orgreg.php"><button class="choice">Sign up as Organization</button></a>
                </div>
                </div>
        </div>
        <div id="band"></div>
        <div id="image-container">
            <img src="images/students.jpg" alt="image of students">
        </div>
            
    </div>

    <script>
        // JavaScript code to toggle between login and registration forms
        document.getElementById('sign-up').addEventListener('click', function() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('student-registration-form').style.display = 'block';
            document.getElementById('organization-registration-form').style.display = 'block';
        });
    
    
    document.addEventListener('DOMContentLoaded', function() {
        // Get the password input and the eye icon
        var passwordInput = document.querySelector('input[type="password"]');
        var eyeIcon = document.querySelector('.fa-eye-slash');

        // Add click event listener to the eye icon
        eyeIcon.addEventListener('click', function() {
            // Toggle the type attribute of the password input between "password" and "text"
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
                eyeIcon.style.color = 'blue';
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
                eyeIcon.style.color = ''; // Reset color to default
            }
        });
    });
</script>

</body>
</html>
