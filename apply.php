<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <link rel="stylesheet" href="apply.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
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

              <h1 style="text-center">Attachment Program Application</h1>
   
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <!-- <fieldset> -->
    <form action="/submit_application" method="post" enctype="multipart/form-data">
      
        <label for="name">First Name:</label>
        <input type="text" id="name" name="fname" placeholder="fist name" required><br><br>
        
        <label for="name">Last Name:</label>
        <input type="text" id="name" name="lname" placeholder="last name"required><br><br>
        
        <label for="email">Email:</label>
        <input type="text" name="email" placeholder="name@email.com" required/></label><br><br>

        <h3>UPLOAD DOCUMENTS</h3><br>
          
          <h3>Upload a copy of your Resume:</h3><br>
          <p>Click the button and select the file you want to upload</p><br>
          <div class="upload-container">

              <label for="upld1">Resume</label>
              <input type="file" id="upld1" name="resume" accept=".pdf" required/>
              <br><br>
              
              <!-- name of file chosen -->
              <span id="file-chosen1">No file chosen</span>
              <br><br>
          </div><br><br>

          <h3>Upload your copy of the Cover Letter:</h3><br>
          <p>Click the button and select the file you want to upload</p><br>
          <div class="upload-container">

              <label for="upld2">Cover Letter</label>
              <input type="file" id="upld2" name="cover_letter" accept=".pdf" required />
              <br><br>
              
              <!-- name of file chosen -->
              <span id="file-chosen2">No file chosen</span>
              <br><br>
          </div><br><br>

          <h3>Upload your Academic Transcripts:</h3><br>
          <p>Click the button and select the file you want to upload</p><br>
          <div class="upload-container">

              <label for="upld3">Academic Transcripts</label>
              <input type="file" id="upld3" name="academic_transcript" accept=".pdf" required />
              <br><br>
              
              <!-- name of file chosen -->
              <span id="file-chosen3">No file chosen</span>
              <br><br>
          </div><br><br>

        <input class="submitbutton" type = "submit" name = "submit">
        <!-- </fieldset> -->
    </form>


    <script>

const actualBtn1 = document.getElementById('upld1');

const fileChosen1 = document.getElementById('file-chosen1');

actualBtn1.addEventListener('change', function(){
  fileChosen1.textContent = this.files[0].name
})


const actualBtn2 = document.getElementById('upld2');

const fileChosen2 = document.getElementById('file-chosen2');

actualBtn2.addEventListener('change', function(){
  fileChosen2.textContent = this.files[0].name
})


const actualBtn3 = document.getElementById('upld3');

const fileChosen3 = document.getElementById('file-chosen3');

actualBtn3.addEventListener('change', function(){
  fileChosen3.textContent = this.files[0].name
})
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
     //Collecting and Validating firstname
     if(empty($_POST['fname'])){
        echo  "<script>alert('firstname is required'); window.location='apply2.php';  </script>";
    }
    else{
        $first= $_POST['fname'];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $first)){
            echo  "<script>alert('Only letters and white space allowed for firstname'); window.location='apply2.php'; </script>";
        }
    }
    //Collecting and Validating lastname
    if(empty($_POST['lname'])){
        echo  "<script>alert('lastname is required'); window.location='apply2.php'; </script>";
    }
    else{
        $last = $_POST["lname"];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $last)){
            echo  "<script>alert('Only letters and white space allowed for lastname'); window.location='apply2.php'; </script>";
        }
    }
     if(empty($_POST['email'])){
         echo  "<script>alert('email is required'); window.location='apply2.php'; </script>";
     }
     else{
        $email = $_POST["email"];
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format'); window.location='apply2.php'; </script>";
          }
     }
 $transcript = $_POST["academic_transcript"];
 $cover_letter = $_POST["cover_letter"];
 $resume= $_POST["resume"];
    }

    $stmt = $conn->prepare("INSERT INTO game ( fname , lname, email, transcript ,cover_letter, resume)
     VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("ssssss", $first, $last,$email, $transcript, $cover_letter, $resume);
    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();

$conn->close();

?>