<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Applications</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    background-color:maroon;
    color: black;
    padding: 20px;
}

nav ul {
    list-style-type: none;
    padding: 0;
}

nav ul li {
    display: inline;
    margin-right: 20px;
}

nav ul li a {
    color: black;
    text-decoration: none;
}

main {
    padding: 20px;
}

.statistics {
    margin-bottom: 30px;
}

.stats-container {
    display: flex;
    justify-content: space-between;
}

.stat {
    background-color: #f4f4f4;
    padding: 20px;
    flex-basis: 30%;
}

.stat h3 {
    margin-top: 0;
}

.recent-activity {
    background-color: #f9f9f9;
    padding: 20px;
}

footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px;
    position: fixed;
    width: 100%;
    bottom: 0;
}
.nav button:hover [class="nav-list"] {
    background-color: black;
    transition: ease-in-out 0.5s;
  }
.logout-btn {
    display: flex;
    /* Adjust spacing between list items */
    justify-content: center; /* Center the list items */
    list-style: none; /* Remove default list styles */
    margin-left:80%;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
  }
  .dropbtn ,.li1, .li2{
    background-color:grey;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
  }
  
  .dropdown {
    position: relative;
    display: inline-block;
  }
  
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }
  
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  
  .lg{
   
    margin-left:500px;
    list-style: none;
    padding: 16px;
    background-color: grey;
    transition: all 0.5s;
    cursor: pointer;
 
  }
  .dropdown-content a:hover {background-color: #ddd;}
  
  .dropdown:hover .dropdown-content {display: block;}
    </style>
</head>
<header >
                <h1>Welcome Coordinator!</h1>
                <nav>
                    <ul>
                       <li><a href="admin.html" class = li1>Home</a></li>
                        <li><a href="applicant_management.php" class = li2>Manage Applications</a></li>
                        <li><div class="dropdown">
                            <button class="dropbtn">Settings</button>
                            <div class="dropdown-content">
                              <a href="view.html">Edit Profile</a>
                            </div>
                            </div></li>
                            <li>
                            <a href="occupation.html">
                               <button class = lg>Logout</button>
                            </a></li>
                    </ul>
                </nav>
            </header>
              
            
<body>
   

    <?php
    // PHP code to handle form submission and display search results
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "10.0.19.74";
        $username = "tsu00073";
        $password = "tsu00073";
        $dbname = "db_tsu00073";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the selected column name and search value from the form
        $column = $_POST['column'];
        $searchValue = $_POST['searchValue'];

        // Prepare and execute the SQL query, excluding the password field
        $sql = "SELECT studentId, firstname, lastname,status 
FROM applicant WHERE $column LIKE '%$searchValue%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row in a table
            echo "<h2>Search Results</h2>";
            echo "<table>";
            echo "<tr>";
            foreach ($result->fetch_fields() as $field) {
                // Output column headers excluding the password field
                if ($field->name !== 'password') {
                    echo "<th>$field->name</th>";
                }
            }
            echo "</tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    // Output table cells excluding the password field
                    if ($key !== 'password') {
                        echo "<td>$value</td>";
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No results found</p>";
        }

        $conn->close();
    }
    ?>
	<h2>Update Applicant Status</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="applicant_id">Applicant ID:</label>
        <input type="text" id="applicant_id" name="applicant_id">
        <br><br>
        <label for="status">Select Status:</label>
        <select name="status" id="status">
            <option value="accepted">Accepted</option>
            <option value="rejected">Rejected</option>
            <option value="waitlisted">Waitlisted</option>
        </select>
        <br><br>
        <input type="submit" value="Update Status">
    </form>

    <?php
    // PHP code to handle form submission and update status in the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "10.0.19.74";
        $username = "tsu00073";
        $password = "tsu00073";
        $dbname = "db_tsu00073";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the applicant ID and status from the form
        $applicant_id = $_POST['applicant_id'];
        $status = $_POST['status'];

        // Prepare and execute the SQL query to update status
        $sql = "UPDATE applicant SET status = '$status' WHERE studentId = '$applicant_id'";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Status updated successfully</p>";
        } else {
            echo "Error updating status: " . $conn->error;
        }

        $conn->close();
    }
    ?>

</body>
</html>
