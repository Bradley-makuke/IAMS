<?php
// Database connection and coordinator details
$servername = "10.0.19.74";
$username = "tsu00073";
$password = "tsu00073";
$dbname = "db_tsu00073";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$initials = "MO"; // Replace with actual coordinator ID

$sql = "SELECT * FROM coordinator";
$result = $conn->query($sql);



if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $coodinatorFname = $row["firstname"];
    $coordniatorSname = $row["surname"];
    $coordinatorEmail = $row["email"];
    $coordinatorNumber = $row["phone_number"];
} else {
    $coodinatorFname = "";
    $coordniatorSname = "";
    $coordinatorEmail = "";
    $coordinatorNumber = "";
}

$sql2 = "SELECT email, firstname, surname,  phone_number FROM student";
$result2 = $conn->query($sql2);

$sql3 = "SELECT company_name, email, available_slots, skills, locations, projects FROM company_preferences";
$result3 = $conn->query($sql3);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve input data
  $companyName = $_POST["company_name"];
  $skills = explode(",", $_POST["skills"]);
  $location = explode(",", $_POST["location"]);
  $projects = explode(",", $_POST["projects"]);

  // Retrieve student preferences
  $studentPreferencesQuery = "SELECT * FROM student_preferences";
  $studentPreferencesResult = $conn->query($studentPreferencesQuery);
  
// Retrieve matches from the database
  $matchesQuery = "SELECT * FROM matches WHERE company = ?";
$matchesStmt = $conn->prepare($matchesQuery);
$matchesStmt->bind_param("s", $companyName);
$matchesStmt->execute();
$matchesResult = $matchesStmt->get_result();

  // Match students with company
  while ($studentRow = $studentPreferencesResult->fetch_assoc()) {
      $studentSkills = explode(",", $studentRow['skills']);
      $studentLocations = explode(",", $studentRow['locations']);
      $studentProjects = explode(",", $studentRow['projects']);

      $matchedSkills = array_intersect($skills, $studentSkills);
      $matchedLocations = array_intersect($location, $studentLocations);
      $matchedProjects = array_intersect($projects, $studentProjects);

      // Insert matches into database
      if (!empty($matchedSkills) && !empty($matchedLocations) && !empty($matchedProjects)) {
          $insertMatchQuery = "INSERT INTO matches (company, student, skills, locations, projects) VALUES (?, ?, ?, ?, ?)";
          $insertMatchStmt = $conn->prepare($insertMatchQuery);
          $insertMatchStmt->bind_param("sssss", $companyName, $studentRow['username'], implode(",", $matchedSkills), implode(",", $matchedLocations), implode(",", $matchedProjects));

          if ($insertMatchStmt->execute()) {
              echo "<p>Match created for student: " . $studentRow['username'] . "</p>";
          } else {
              echo "<p>Error creating match for student: " . $studentRow['username'] . "</p>";
          }
      }
  }
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="stylesheet" href="coordinator.css" />
    <title>My Profile</title>
  </head>
  <body>
    <div class="row">
      <div class="column1">
        <div class="nav">
          <img src="UBlogo.png" alt="website logo" /><br><br><br>
          <a href="" onclick="viewStudents()" id="view-students"><i class="fa-solid fa-users"></i>View Students</a><br />
          <a href="" onclick="viewCompanies()" id="view-companies"><i class="fa-solid fa-building"></i>View Companies</a
          ><br />
          <a href="" onclick="makeMatches()" id="make-matches"><i class="fa-solid fa-link"></i>Make Matches</a
          ><br />
          <a href=""><i class="fa-solid fa-gear"></i>Settings</a
          ><br />
          <a href="index.php"
            ><i class="fa-solid fa-user"></i>Log Out</a
          >
        </div>
      </div>

      <div class="column2">
    <header>
      <!--<div class="searchbar">
          <form>
            <input type="text" name="text" class="searchbox" placeholder="Search">
            <i class="fa-solid fa-magnifying-glass" style="color: #2309ec;"></i>
          </form>
        </div>-->

      <div class="profile-container">
        
        <a href="#"><i class="fa-solid fa-bell"></i></a>
        <a href="#"><i class="fa-solid fa-comment"></i></a>
        <span id="profile"><p><?php echo $initials; ?></p></span>
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
  <div id="user-info">
    <div id="user-icon">
      <i class="fa-regular fa-user"></i>
    </div>
    <h2><?php echo  $coodinatorFname . " ". $coordniatorSname;?></h2><br><br>
    <div class="p-info">
    <p><em><b>Personal Information: </b></em></p><br><br>
    <p>Email Address: <?php echo $coordinatorEmail; ?> </p><br><br>
    <p>Contact Number: <?php echo  "+267 - ".$coordinatorNumber; ?> </p><br><br>
    </div>
    </div>

      
    <div id="students" style="display: none;">
    <table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>More</th>
    </tr>
    <?php
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["firstname"] . "</td>";
            echo "<td>" . $row["surname"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["phone_number"] . "</td>";
            echo "<td><a href='#'>View More</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No students found</td></tr>";
    }
    ?>
    </table>
    </div>
    <div id="companies" style="display: none;"><table>
    <tr>
        <th>Company Name</th>
        <th>Email</th>
        <th>Available Slots</th>
        <th>Skills</th>
        <th>Location</th>
        <th>Projects</th>
    </tr>
    <?php
    if ($result3->num_rows > 0 ) {
        while ($row = $result3->fetch_assoc() ) {
            echo "<tr>";
            echo "<td>" . $row["company_name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["available_slots"] . "</td>";
            echo "<td>" . $row["skills"] . "</td>";
            echo "<td>" . $row["locations"] . "</td>";
            echo "<td>" . $row["projects"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No companies found</td></tr>";
    }
    ?>
    </table>
</div>
    <div id="matches" style="display: none;">
    <h2>Create Matches</h2>
                    <form id="match-form">
                        <label for="company-name">Company Name:</label>
                        <input type="text" id="company-name" name="company-name" required><br><br>

                        <label for="skills">Skills:</label>
                        <input type="text" id="skills" name="skills" required><br><br>

                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" required><br><br>

                        <label for="projects">Projects:</label>
                        <input type="text" id="projects" name="projects" required><br><br>

                        <button type="button" onclick="createMatches()">Create Match</button>
                    </form>

                    <div id="match-results" style="display: none;">
                    <!-- Include a div to display match results -->
                    <h2>Matches for <?php echo $companyName; ?></h2>

<?php if ($matchesResult->num_rows > 0): ?>
    <table>
        <tr>
            <th>Company Name</th>
            <th>Student Name</th>
            <th>Skills</th>
            <th>Location</th>
            <th>Projects</th>
        </tr>
        <?php while ($row = $matchesResult->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row["company"]; ?></td>
                <td><?php echo $row["student"]; ?></td>
                <td><?php echo $row["skills"]; ?></td>
                <td><?php echo $row["locations"]; ?></td>
                <td><?php echo $row["projects"]; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No matches found for <?php echo $companyName; ?></p>
<?php endif; ?>
                </div>
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
        function viewStudents() {
          event.preventDefault();
            document.getElementById("user-info").style.display = "none";
            document.getElementById("students").style.display = "block";
            document.getElementById("companies").style.display = "none";
            document.getElementById("matches").style.display = "none";
        }

        function viewCompanies() {
          event.preventDefault();
            document.getElementById("user-info").style.display = "none";
            document.getElementById("students").style.display = "none";
            document.getElementById("companies").style.display = "block";
            document.getElementById("matches").style.display = "none";
        }

        function makeMatches() {
          event.preventDefault();
            document.getElementById("user-info").style.display = "none";
            document.getElementById("students").style.display = "none";
            document.getElementById("companies").style.display = "none";
            document.getElementById("matches").style.display = "block";
        }

        
        function createMatches() {
            var companyName = document.getElementById("company-name").value;
            var skills = document.getElementById("skills").value;
            var location = document.getElementById("location").value;
            var projects = document.getElementById("projects").value;

            // Send AJAX request to create matches
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "create_matches.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("match-results").innerHTML = xhr.responseText;
                    document.getElementById("match-results").style.display = "block";
                }
            };
            xhr.send("company_name=" + companyName + "&skills=" + skills + "&location=" + location + "&projects=" + projects);
        }
    </script>
  </body>
</html>

<?php

?>
