<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="stylesheet" href="s_profile.css" />
    <title>My Profile</title>
  </head>
  <body>
    <div class="row">
      <div class="column1">
        <div class="nav">
          <img src="UBlogo.png" alt="website logo" /><br><br><br>
          <a href="notifications.html"><i class="fa-solid fa-bell"></i>Notifications</a><br />
          <a href="messages.html"><i class="fa-solid fa-envelope"></i>Messages</a
          ><br />
          <a href="About.html"><i class="fa-solid fa-circle-info"></i>About</a
          ><br />
          <a href="contactus.html"><i class="fa-solid fa-phone"></i>Contact Us</a
          ><br />
          <a href="index.php"
            ><i class="fa-solid fa-user"></i>Log Out</a
          >
        </div>
      </div>

      <div class="column2">
    <header>
      <div class="searchbar">
          <form>
            <input type="text" name="text" class="searchbox" placeholder="Search">
            <i class="fa-solid fa-magnifying-glass" style="color: #2309ec;"></i>
          </form>
        </div>

      <div class="profile-container">
        
        <a href="#"><i class="fa-solid fa-bell"></i></a>
        <a href="#"><i class="fa-solid fa-comment"></i></a>
        <span id="profile"><p>BM</p></span>
        <a href="#myDropDown"
          ><i class="fa-solid fa-caret-down" onclick="dropIt()"></i
        ></a>
        <div class="profile-menu" id="myDropdown">
          <ul>
            <br />
            <li><a href="#">Accessibility</a></li>
            <br />
            <hr />
            <br />
            <li><a href="#">Profile</a></li>
            <br />
            <li><a href="#">Private files</a></li>
            <br />
            <hr />
            <br />
            <li><a href="#">Preferences</a></li>
            <br />
            <hr />
            <br />
            <li><a href="#">Logout</a></li>
            <br />
          </ul>
        </div>
      </div>
    </header>
  </div>

  <main>
    <div class="user-icon">
      <i class="fa-regular fa-user"></i>
    </div>
    <h2>@Username</h2><br><br>
    <div class="p-info">
    <p><em><b>Personal Information: </b></em></p><br><br>
    <p>Email Address: </p><br><br>
    <p>Contact Number: </p><br><br>
    </div>

    
  </main>


    <footer>
      <div id="left-links">
        <i class="fa-solid fa-headset"></i>
        <h5>Contact Us</h5>
        <br />
        <h6>+267 XXX-XXX-XX</h6>
      </div>

      <div id="generic">
        <p>You are logged in as (#Userexample)</p>
        <br />
        <p><a href="login.html">Log out</a></p>
        <br />
        <hr />
        <p>&copy; Copyright 2024</p>
        <br />
      </div>
      <div id="right-links">
        <h5>Email</h5>
        <br />
        <span><i class="fa-solid fa-inbox"></i>info@cs.ub.bw</span>
      </div>
    </footer>

    <script>
      function dropIt() {
        var drop = document.getElementById("myDropdown");
        if (drop.style.display == "" || drop.style.display == "none") {
          drop.style.display = "block";
        } else {
          drop.style.display = "none";
        }
      }
    </script>
  </body>
</html>

<?php
  $dbhost= 'localhost';
  $dbuser= 'root';
  $dbpass= '';
  $dbname= 'code';

  $conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// update data in the database
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $testname = $_POST["name"];

    $stmt = $conn->prepare("UPDATE test SET name=? WHERE id=?");
    if ($stmt) {
        $stmt->bind_param("ss", $testname, $id);
        if ($stmt->execute()) {
            echo "Record successfully updated";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing update statement: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
