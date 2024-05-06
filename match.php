<?php
include "configure.php";
session_start(); 
if (!isset($_SESSION["username"])) {
      $errors[] = "Session error: Username not found.";
    }
else{
    $username = $_SESSION["username"];
}

// Get the username of the logged-in user (replace this with your actual logic)
$logged_in_username = $username;

// Fetch data from student_preferences for the logged-in user
$student_preferences_query = "SELECT * FROM student_preferences WHERE username = ?";
$student_preferences_stmt = $conn->prepare($student_preferences_query);
$student_preferences_stmt->bind_param("s", $logged_in_username);
$student_preferences_stmt->execute();
$student_preferences_result = $student_preferences_stmt->get_result();

if ($student_preferences_result->num_rows > 0) {
    // Fetch skills of the logged-in student
    $student_row = $student_preferences_result->fetch_assoc();
    $student_skills = explode(",", $student_row['skills']);
    $student_locations = explode(",", $student_row['locations']);
    $student_projects = explode(",", $student_row['projects']);

    // Fetch data from company_preferences table
    $company_preferences_query = "SELECT * FROM company_preferences";
    $company_preferences_result = $conn->query($company_preferences_query);
      // Fetch existing matches from the matches table
      $existing_matches_query = "SELECT * FROM matches WHERE student = ?";
      $existing_matches_stmt = $conn->prepare($existing_matches_query);
      $existing_matches_stmt->bind_param("s", $logged_in_username);
      $existing_matches_stmt->execute();
      $existing_matches_result = $existing_matches_stmt->get_result();
      $existing_matches = array();
      while ($match_row = $existing_matches_result->fetch_assoc()) {
          $existing_matches[$match_row['company']] = true;
      }

    if ($company_preferences_result->num_rows > 0) {
        // Initialize a flag to track successful insertion
        $inserted = false;
        
        while ($company_row = $company_preferences_result->fetch_assoc()) {
            // Check if company skills match student skills
            $company_skills = explode(",", $company_row['skills']);
            $company_locations = explode(",", $company_row['locations']);
            $company_projects = explode(",", $company_row['projects']);

            $matched_skills = array_intersect($student_skills, $company_skills);
            $matched_locations = array_intersect($student_locations, $company_locations);
            $matched_projects = array_intersect($student_projects, $company_projects);

            $company_name = $company_row['company_name'];
            $student_username = $logged_in_username;
            $matched_skills_imploded = implode(",", $matched_skills);
            $matched_locations_imploded = implode(",", $matched_locations);
            $matched_projects_imploded = implode(",", $matched_projects);
        

            if (!isset($existing_matches[$company_name]) && !empty($matched_skills) || !empty($matched_locations) || !empty($matched_projects)) {
                // Insert the match into the matches table
                $mt = "INSERT INTO matches (company, student, skills, locations, projects) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($mt);
                $stmt->bind_param("sssss", $company_name, $student_username, 
                                  $matched_skills_imploded, $matched_locations_imploded, 
                                  $matched_projects_imploded);


                if ($stmt->execute()) {
                    // Set the flag to true if at least one match is inserted successfully
                    $inserted = true;
                    //echo "<script>alert('Match found and inserted: Company: " . $company_row['company_name'] . ", Student: " . $logged_in_username . "')</script>";
                } else {
                    $errors[] = "Error inserting Matches: " . $stmt->error;
                }
            }
            else{
                //echo "<script>alert('Existing  found for Company: " . $company_row['company_name'] . " and Student: " . $logged_in_username . "')</script>";
            
            }
        }
        
        // Redirect if at least one match is inserted successfully
        if ($inserted) {
            echo "<script>alert('Matches submitted successfully!')</script>";
            echo "<script>window.location.href='index.html';</script>"; // Redirect to login page
            exit(); // Stop script execution after successful insertion and redirect
        }
    } else {
        $errors[] = "No company preferences found.";
    }
} else {
    $errors[] = "No student preferences found for the logged-in user.";
}

?>
