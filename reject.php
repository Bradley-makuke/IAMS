<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "code";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Accept/Reject actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && isset($_POST['id'])) {
        $action = $_POST['action'];
        $id = $_POST['id'];
        if ($action === 'accept') {
            // Handle accept action
            // Here, you would move the record to the accepted table or perform any other action
            // For demonstration, I'm just echoing a message.
            echo "Record accepted successfully";
        } elseif ($action === 'reject') {
            // Handle reject action
            // Here, you would remove the record from display or perform any other action
            // For demonstration, I'm just echoing a message.
            echo "Record rejected successfully";
        }
    }
    exit; // Stop further execution after handling the action
}

// Retrieve applicants from database
$sql = "SELECT id, firstname AS Firstname, lastname AS Surname, email AS EMAIL, resume, academic_transcript as Transcript, skills AS Skills FROM applicant";
$result = $conn->query($sql);

                 // Retrieve accepted applicants from the database
                 $sql_accepted = "SELECT firstname AS Firstname, surname AS Surname, email AS EMAIL, skills AS Skills FROM accepted_applicants";
                 $result_accepted = $conn->query($sql_accepted);
                 

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Review</title>
    <link rel="stylesheet" href="review.css">

    <style>
        /* Hide the second table by default */
        #acceptedTable {
            display: none;
        }
    </style>
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
                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>Firstname</th><th>Lastname</th><th>Email</th><th>Resume</th><th>Transcript</th><th>Skills</th><th>Actions</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["Firstname"]."</td><td>".$row["Surname"]."</td><td>".$row["EMAIL"]."</td><td>".$row["resume"]."</td><td>".$row["Transcript"]."</td><td>".$row["Skills"]."</td>";
                        echo "<td><button class='accept' data-id='".$row["id"]."'>Accept</button><button class='reject' data-id='".$row["id"]."'>Reject</button></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }
                ?>
            </div>
             <!-- Second table for accepted applications -->
        <div id="acceptedTable">
            <h2>Accepted Applications</h2>
            <div class="offers-section">
                <div class="card">
                    <h2>Review (Accepted)</h2>
                    <?php
  
if ($result_accepted->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Firstname</th><th>Lastname</th><th>Email</th><th>Resume</th><th>Transcript</th><th>Skills</th></tr>";
    while ($row_accepted = $result_accepted->fetch_assoc()) {
        echo "<tr><td>" . $row_accepted["Firstname"] . "</td><td>" . $row_accepted["Surname"] . "</td><td>" . $row_accepted["EMAIL"] . "</td><td>" . $row_accepted["resume"] . "</td><td>" . $row_accepted["Transcript"] . "</td><td>" . $row_accepted["Skills"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 accepted results";
}
                    ?>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to handle Accept/Reject actions
    document.querySelectorAll('.accept, .reject').forEach(button => {
        button.addEventListener('click', () => {
            console.log('Button clicked'); // Check if the button click event is triggered
            const action = button.classList.contains('accept') ? 'accept' : 'reject';
            const id = button.dataset.id;
            console.log('Action:', action); // Check the action value
            console.log('ID:', id); // Check the ID value
            const formData = new FormData();
            formData.append('action', action);
            formData.append('id', id);

            fetch(window.location.href, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    // Reload the page to reflect changes
                    window.location.reload();
                } else {
                    console.error('Error:', response.statusText);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
      // JavaScript to handle Accept/Reject actions
      document.querySelectorAll('.accept, .reject').forEach(button => {
            button.addEventListener('click', () => {
                const action = button.classList.contains('accept') ? 'accept' : 'reject';
                const id = button.dataset.id;
                const formData = new FormData();
                formData.append('action', action);
                formData.append('id', id);

                fetch(window.location.href, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        // Reload the page to reflect changes
                        window.location.reload();
                    } else {
                        console.error('Error:', response.statusText);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });

        // JavaScript to show the second table when an application is accepted
        // You need to call this function when an application is accepted
        function showAcceptedTable() {
            document.getElementById('acceptedTable').style.display = 'block';
        }

    </script>
</body>
</html>
