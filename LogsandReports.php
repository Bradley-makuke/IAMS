<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="stylesheet" href="LogsandReports.css" />
    <title>LogsandReports</title>
  </head>
  <body>
    <div class="row">
      <div class="column1">
        <div class="nav">
          <img src="UBlogo.png" alt="website logo" /><br><br><br>
          <a href="LogsandReports.php"><i class="fa-solid fa-bell"></i>Reports</a><br />
          <a href="messages.html"><i class="fa-solid fa-envelope"></i>Messages</a
          ><br />
          <a href="About.html"><i class="fa-solid fa-circle-info"></i>About</a
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
           
            <hr />
            <br />
            <li><a href="s_profile.php">Profile</a></li>
            <hr />
            <li><a href="login.php">Logout</a></li>
            <br />
          </ul>
        </div>
      </div>
    </header>
    
    <h1>Organization Supervisor Assess</h1>
    <main>
      <div class="dash-cards">
        <br><br><br><br><br>
        
        <a href="browse.html"><i class="fa-solid fa-cloud"></i><h2>Upload Files</h2></a>
        <br><br><br><br>
        <p>Choose a file or drag and drop it here</p>
        <p class="spec"> JPEG, PNG, PDG and MP4 formats. Up to 50MB</p>
        <br><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <input type="file" id="myFile" name="filename" accept="dox., docx., pdf"><br><br><br><br><br>
          <input type="submit">
        </form>
      </div>

    </main>
  </div>

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

else{
  echo "Connection successful!!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

     //Collecting and Validating firstname
     session_start();
     if(!isset($_SESSION['username'])){
       echo 'Session error: User not found';
     }
     else{
       $organisation = $_SESSION['username'];
     }
       
 $report= $_POST["report"];

    }
 
    $stmt = $conn->prepare("INSERT INTO organisation (report) WHERE username= $organisation VALUES(?)");
    
    $stmt->bind_param("s", $report);
    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
  
    $stmt->close();
$conn->close();

?>
