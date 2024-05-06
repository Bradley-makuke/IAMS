

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Review</title>
    <link rel="stylesheet" href="review.css">
</head>
<body>
    <div class="header">
        <input type="search" placeholder="Search...">
    </div>
    <div class="sidebar">
        <div class="profile">
            <img src="user-image.jpg" alt="Profile Picture">
            <p>John Doe</p>
        </div>
        <nav>
            <ul>
                <li>Notifications</li>
                <li>Messages</li>
                <li>Log Out</li>
                <li>About</li>
                <li>Contact Us</li>
            </ul>
        </nav>
    </div>
             
    <div class="main-content">
        <h2>Applications</h2>
        <div class="offers-section">
       
        <div class="card">
          <h2>Review</h2>
          <?php 
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "lab";
          
          $conn = new mysqli($servername, $username, $password, $dbname);
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          
          $sql = "SELECT prefrance FROM org WHERE organisationID = '212102121'";
          $result = $conn->query($sql);
          $pref = "";
          if($result->num_rows > 0){
            $row = $result-> fetch_assoc();
            $pref = $row["prefrance"];}

            $sql = "SELECT * FROM stu WHERE prefrance = '$pref'";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while($row = $result-> fetch_assoc()){
                    echo "<table id ='mT'>";
                    echo "<tr><td>Name:</td><td>". $row["name"]."</td><td>Surname:</td><td>".$row["surname"]."</td><td>Student ID: </td><td>".$row["studentID"]."</td> <td><button id='expandButton".$row["studentID"]."' onclick='toggleExpand".$row["studentID"]."()'> Expand ▼</button></td></tr>"; 
                     echo "</table>";
                         
                echo "<div class='expandableContent' id='expandableContent".$row["studentID"]."' style='display: none;''>";
                echo "<table id = 'mT'>";
                    echo "<tr><td>GPA</td><td>".$row["GPA"]."</td><td>Program</td><td>".$row["program"]."</td><td>Skills</td><td><ol><li>".$row["skills"]."</li></ol></td>";
                    echo "<td>
                    <button type='button'";// Assuming you have already established a database connection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "lab";
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    // Check if the accept button was clicked and perform the update operation
                    if ($_SERVER["REQUEST_METHOD"] === "POST") {
                        // Perform database update operation here
                        // For example, update the status of the student's application to 'accepted'
                        // You'll need to replace 'your_table_name' with the actual name of your table
                      
                         $notificationTime = date('Y-m-d H:i:s');
                         $studentID = $row["studentID"];  
                        
                    
                        $sql = "UPDATE notifications SET status = 'accepted', timestamp = '$notificationTime' WHERE studentID = '$studentID' AND organisationID = '212102121' ";
                        if ($conn->query($sql) === TRUE) {
                            echo "status updateded successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                    $conn->close();
                    echo "
                     class='accept'>Accept</button>
                    <button type='button' ";// Assuming you have already established a database connection
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "lab";
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    
                    // Check if the accept button was clicked and perform the update operation
                    if ($_SERVER["REQUEST_METHOD"] === "POST") {
                        // Perform database update operation here
                        // For example, update the status of the student's application to 'accepted'
                        // You'll need to replace 'your_table_name' with the actual name of your table
                      
                         $notificationTime = date('Y-m-d H:i:s');
                         $studentID = $row["studentID"];  
                        
                    
                        $sql = "UPDATE notifications SET status = 'accepted', timestamp = '$notificationTime' WHERE studentID = '$studentID' AND organisationID = '212102121' ";
                        if ($conn->query($sql) === TRUE) {
                            echo "status updateded successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                    $conn->close();
                echo " class='reject'>Reject</button>
                </td></tr>";
                  echo "</table>";
            echo "</div>";
            echo "<script>
            function toggleExpand".$row["studentID"]."() {
                var expandableContent = document.getElementById('expandableContent".$row["studentID"]."');
                var button = document.getElementById('expandButton".$row["studentID"]."');
    
                if (expandableContent.style.display === 'none') {
                    expandableContent.style.display = 'block';
                    button.textContent = 'Collapse ▲';
                } else {
                    expandableContent.style.display ='none';
                    button.textContent = 'Expand ▼';
                }
            } 
                      
        </script>";
                }
            }



 ?>
        <h2>Accepted Applicants</h2>
        <?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lab";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM notifications WHERE status = 'accepted'";
$result = $conn->query($sql);
          if($result->num_rows > 0){
        echo "<table>";
        echo "<tr><td>Student ID</td><td>name</td></tr>"; 

        while($row = $result-> fetch_assoc()){
            echo "<tr>";
            echo"<td>" . $row['studentID'] . "</td>"; 
            echo"<td>" . $row['stuname'] . "</td>"; 
            echo "</tr>";
        }
         echo "</table>";
        
        } else {
            echo" No students have been accepted ";
        }
        $conn->close();
    ?>

  </div>
       



    </div>
    </div>
</body><script>
function accept() {
            // Get the parent <tr> element of the clicked button
                var row = button.closest('tr');

// Replace the content of the last <td> with 'Accepted'
                row.cells[row.cells.length - 1].innerHTML = 'Accepted';
            // Make an AJAX request to accept.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "accept.php", true);
            

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Request was successful
                        console.log(xhr.responseText);
                        // Handle success response if needed
                    } else {
                        // Handle errors
                        console.error("Request failed");
                    }
                }
            };
            xhr.send();
             
        }
        function reject() {

var table = document.getElementById('mT');
table.style.display = 'none'}
function accept() {

var table = document.getElementById('mT');
table.style.display = 'none'}

function accept() {
            // Get the parent <tr> element of the clicked button
            
            // Make an AJAX request to accept.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "accept.php", true);
            

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Request was successful
                        console.log(xhr.responseText);
                        // Handle success response if needed
                    } else {
                        // Handle errors
                        console.error("Request failed");
                    }
                }
            };
            xhr.send();
             
        }

        function reject() {

        
            // Make an AJAX request to reject.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "reject.php", true);
       
        }
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Request was successful
                        console.log(xhr.responseText);
                        // Handle success response if needed
                    } else {
                        // Handle errors
                        console.error("Request failed");
                    }
                }
            };
            xhr.send();
            </script>
</html>

