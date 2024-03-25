<?php
// Include the configuration file
require_once("php/configure.php");

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Error message (initialize as empty)
    $loginError = '';

    // Database connection (replace with your actual connection logic)
    $conn = mysqli_connect("localhost", "root", "", "CODE");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to retrieve user information based on username
    $sql = "SELECT * FROM student WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the username exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Password is correct, redirect to student home page or set session variables
            header("Location: stuhome.html");
            exit();
        } else {
            $loginError = '<p style="font-size: 0.7rem; color: red;">Invalid username or password.</p>';
        }
    } else {
        $loginError = '<p style="font-size: 0.7rem; color: red;">Invalid username or password.</p>';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <img src="images/UBotswana.png" alt="UB logo">
        <div id="form-container">
            <form action="" method="post">
                <h3>Log in</h3>
                <div class="input-container">
                    <input type="text" placeholder="Enter username" required name="username">
                </div>
                <div class="input-container">
                    <input type="password" placeholder="Enter password" required name="password">
                </div>
                <div class="input-container button">
                    <button type="submit">Log in</button></a>
                </div>
                <label for="checkbox">remember me</label>
                <input type="checkbox">
                <?php if (!empty($loginError)) : ?>
        <?= $loginError ?>
    <?php endif; ?>
                <p id="sign">dont have an account? <a href="stureg.php">Sign up</a></p>
                
            </form>
        </div>
        <div id="band"></div>
        <div id="image-container">
            <img src="images/students.jpg" alt="image of students">
        </div>
    </div>
    

</body>
</html>