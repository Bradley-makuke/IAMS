<?php
// include configuration code
include "configure.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to clean and validate input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clean and validate input
    $languages = sanitize_input($_POST["languages"]);
    $location = sanitize_input($_POST["location"]);
    $projects = sanitize_input($_POST["projects"]);
    $softSkills = array();
    for ($i = 1; $i <= 3; $i++) {
        $softSkills[$i] = sanitize_input($_POST["softSkill$i"]);
    }
    // Get the text values of the checked checkboxes
    $skills = "";
    if(isset($_POST["skill"])) {
        $skillLabels = $_POST["skill"];
        foreach($skillLabels as $skillLabel) {
            $skills .= sanitize_input($skillLabel) . ", ";
        }
        // Remove the trailing comma and space
        $skills = rtrim($skills, ", ");
    }

    // Prepare and bind statement for inserting data into the database
    $stmt = $conn->prepare("INSERT INTO preference (languages, location, projects, soft_skill_1, soft_skill_2, soft_skill_3, skills) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $languages, $location, $projects, $softSkills[1], $softSkills[2], $softSkills[3], $skills);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
