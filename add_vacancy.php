<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="stylesheet" href="add_vacancy.css" />
    <title>Add Vacancies</title>
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
            <li><a href="#">Profile</a></li>
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

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label>Organization Username:</label> <input type="text" name="name" value="<?php echo $organisation;?>" placeholder="Enter Name"/><br><br>
      <label>Number of vacancies:</label> <input type="number" name="no_of_vacancies" placeholder="Enter Number" required/><br><br>
      <input type="submit" name="Submit"/>
    </form>
    
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

// Create the connection to the database
$servername = "10.0.19.74";
$username = "tsu00073";
$password = "tsu00073";
$dbname = "db_tsu00073";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connection successful!!";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_start();
  if(!isset($_SESSION['username'])){
    echo 'Session error: User not found';
  }
  else{
    $organisation = $_SESSION['username'];

 
     //Collecting and Validating vacancies
     $vacancy = $_POST["vacancies"];

     $stmt = $conn->prepare("INSERT INTO organisation (vacancies) WHERE username= $organisation VALUES(?)");

$stmt->bind_param("s",$vacancy);

if ($stmt->execute()) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . $conn->error;
}
    }
}




$stmt->close();

$conn->close();
?>
