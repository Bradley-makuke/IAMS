<?php
// Include the database configuration file
//include "configure.php";

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
            $registrationSuccess = true;
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="registration-form">
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
                    <button id="next" type="submit">Next</button>
                </div>
            </form>
        </div>
    </div>
    <div id="popup" class="<?= isset($registrationSuccess) && $registrationSuccess ? '' : 'hidden' ?>">
        <div class="popup-content">
            <h2>Registration Successful!</h2>
            <p>Press "OK" to continue.</p>
            <button id="close-popup">OK</button>
        </div>
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
            window.location.href = 'pref.php';
        });

        // Optional: Close popup when clicking outside the card
        window.addEventListener("click", (event) => {
            if (event.target === popup) {
                popup.classList.add("hidden");
                document.body.classList.remove("blur");
                // Redirect to pref.php
                window.location.href = 'pref.php';
            }
        });
    </script>
</body>
</html>
