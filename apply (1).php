<?php
$dbHost = 'localhost';
$dbUserername= 'root';
$dbPassword = '';
$dbName = 'code';
$conn = new mysqli($dbHost, $dbUserername, $dbPassword, $dbName);
if($conn-> connect_error){
    die("connection failed: " . $conn->connect_error);
}

//target directory
$targetDir= "uploads/";

//check if the file was uploaded
if(isset($_FILES['resume']) && $_FILES['resume']['error'] == 0 ){

  $resumeFileName = $_FILES['resume']['name'];
  $resumeTempName = $_FILES['resume']['tmp_name'];
  $transcriptFileName = $_FILES['academic_transcripts']['name'];
  $transcriptTempName = $_FILES['academic_transcripts']['tmp_name'];
  $coverFileName = $_FILES['cover_letter']['name'];
  $coverTempName = $_FILES['cover_letter']['tmp_name'];
  
  // Move uploaded files to desired directory
  $resumePath = "uploads/resumes/$resumeFileName";
  move_uploaded_file($resumeTempName, $resumePath);
  $resumeData = file_get_contents($resumePath);

  $transcriptPath = "uploads/transcripts/$transcriptFileName";
  move_uploaded_file($transcriptTempName, $transcriptPath);
  $transcriptData = file_get_contents($transcriptPath);

  $resumePath = "uploads/covers/$coverFileName";
  move_uploaded_file($coverTempName, $coverPath);
  $coverData = file_get_contents($rcoverPath);



//moving 
if(move_uploaded_file($_FILES["resume"]["tmp_name"], $targetPath)){
    $sql="INSERT INTO applicant (resume_path, resume) VALUES ('$resumePath', '$resumeTempName')";
    if($conn->query($sql) == true){
        echo "File uploaded and saved to db";
    }
    else{
         echo "Error: " .$sql. "Error Details: " .$conn->error;
    }
}
else{
    echo "Error moving the file";
}
}
else{
    echo "File not uploaded";
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data here

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    // Process other fields similarly

    // Redirect after form submission to prevent form resubmission on page refresh
    header("Location:view_attachments.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="apply.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <title>Attachment Program Application</title>
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

    <h1>Attachment Program Application</h1>
    <form action="/submit_application" method="post" enctype="multipart/form-data">
      
        <label for="name">First Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="name">Last Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="resume">Resume:</label>
        <input type="file" id="resume" name="resume" accept=".pdf" required><br><br>
        
        <label for="cover_letter">Cover Letter:</label>
        <input type="file" id="cover_letter" name="cover_letter" accept=".pdf,.doc,.docx" required><br><br>
        
        <label for="academic_transcripts">Academic Transcripts:</label>
        <input type="file" id="academic_transcripts" name="academic_transcripts" accept=".pdf" required><br><br>





       <div class="dropdown" style="float: left;">
          <label for="interest"> Skills:</label>
          <select id="interest" name="interest list"> 
    
            <option value="front-end">Frontend Development</option>
            <option value="backend">Backend Development</option>
            <option vale="data-analysis">Data Analysis</option>
            <option value="system admin">System Administration</option>
            <option value="software development">Software Development</option>
          </select>
          </div><br><br><br>

          <div class="center-btn">
            <button class="apply-btn"><a class="apply-link" href="home.html">Submit Application</a></button>
          </div>
          

        </div><br><br>

        <!--<div class="dropdown" style="float:right;">
          <label for="interest">Preffered Skills:</label>
          <select id="interest" name="interest list"> 
            <option value="cyber security">Cyber Security</option>
            <option value="web">Web Development</option>
            <option value="artificial">Artificial Intellegence</option>
            <option value="computer">Computer Networks</option>
          </div>
        </div><br><br>
 -->
    </form>
<!--     
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
      </footer> -->

      <!-- JAVASCRIPT -->

<script>
  function dropIt() {
    var drop = document.getElementById("myDropdown");
    if (drop.style.display == "" || drop.style.display == "none") {
      drop.style.display = "block";
    } else {
      drop.style.display = "none";
    }
  }


  const actualBtn = document.getElementById('upload');

  const fileChosen = document.getElementById('file-chosen');

  actualBtn.addEventListener('change', function(){
    fileChosen.textContent = this.files[0].name
  })


  var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
</script>

  
</body>
</html>