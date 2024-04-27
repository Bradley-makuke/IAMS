<?php
$dbHost = 'localhost';
$dbUserername= 'root';
$dbPassword = '';
$dbName = 'code';
$conn = new mysqli($dbHost, $dbUserername, $dbPassword, $dbName);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the form data here
        $organization = $_POST["organization"];
        $contactPerson = $_POST["contactPerson"];
        $fieldOfStudy = $_POST["fieldOfStudy"];
        $preferredSkills = isset($_POST["skills"]) ? $_POST["skills"] : [];
        $desiredIndustry = isset($_POST["industry"]) ? $_POST["industry"] : [];

        // Example: Print submitted data
        echo "<h2>Submitted Data:</h2>";
        echo "<p>Organization Name: $organization</p>";
        echo "<p>Contact Person: $contactPerson</p>";
        echo "<p>Preferred Field of Study: $fieldOfStudy</p>";
        echo "<p>Preferred Skills: " . implode(", ", $preferredSkills) . "</p>";
        echo "<p>Desired Industry: " . implode(", ", $desiredIndustry) . "</p>";
    }
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="organization.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <title>Organization Attachment Preference Form</title>
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
              ><i class="fa-solid fa-user"></i>Log Out</a>
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
      <!-- <body> -->
        <form id="attachmentForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Organization Attachment Preference Form</h1><br><br>

        <label for="organization">Organization Name:</label>
        <input type="text" id="organization" name="organization" required><br><br>
      
        <label for="contactPerson">Contact Person:</label>
        <input type="text" id="contactPerson" name="contactPerson" required><br><br>
      
        <label for="fieldOfStudy">Preferred Field of Study:</label>
        <input type="text" id="fieldOfStudy" name="fieldOfStudy" required><br><br>
        <div class="row">

        <div class="column" style="background-color:#eee;">
        
        <form id="preferenceForm">

        <legend><h2><em>Preffered Skills:</em></h2></legend><br>
        <div class="checkbox-list"><br>
       <label><input type="checkbox" name="skills" value="Programming"> Frontend Development</label>
       <label><input type="checkbox" name="skills" value="Web Development"> Backend Development</label>
       <label><input type="checkbox" name="skills" value="Data Analysis"> Data Analysis</label>
        <label><input type="checkbox" name="skills" value="Web Development"> System Administration</label>
        <label><input type="checkbox" name="skills" value="Web Development"> Software Development</label>
        </div>
    </form>
    

  </div>
  <div class="column" style="background-color:#eee;">
    <form id="preferenceForm">

        <legend><h2><em>Desired Industry:</em></h2></legend><br>

        <div class="checkbox-list"><br>
        <label><input type="checkbox" name="skills" value="Programming"> Cyber Security</label>
        <label><input type="checkbox" name="skills" value="Web Development"> Web Developmentd</label>
        <label><input type="checkbox" name="skills" value="Data Analysis"> Artificial Intellegence</label>
        <label><input type="checkbox" name="skills" value="Web Development"> Computer Networks</label>
        </div>
    </form>
  </div>
</div>


       <input type="submit" value="Submit Application">

      <footer>
        <div id="left-links">
          <i class="fa-solid fa-headset"></i>
          <h5>Contact Us</h5>
          <br>
          <h6>+267 XXX-XXX-XX</h6>
        </div>
      
        <div id="generic">
          <p>You are logged in as (#Userexample)</p><br>
          <p><a href="login.html">Log Out</a></p><br><hr>
          <p>&copy; Copyright 2024</p><br>
        </div>
        <div id="right-links">
          <h5>Email</h5><br>
          <span><i class="fa-solid fa-inbox"></i>admissions@ub.bw</span>
        </div>
      </footer>
      
</html>