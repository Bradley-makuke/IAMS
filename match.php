<?php
include "configure.php";

// Get the username of the logged-in user (replace this with your actual logic)
$logged_in_username = "thabang2";

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

    // Fetch data from company_preferences table
    $company_preferences_query = "SELECT * FROM company_preferences";
    $company_preferences_result = $conn->query($company_preferences_query);

    if ($company_preferences_result->num_rows > 0) {
        // Initialize a flag to track successful insertion
        $inserted = false;
        
        while ($company_row = $company_preferences_result->fetch_assoc()) {
            // Check if company skills match student skills
            $company_skills = explode(",", $company_row['skills']);
            $matched_skills = array_intersect($student_skills, $company_skills);

            if (!empty($matched_skills)) {
                // Insert the match into the matches table
                $mt = "INSERT INTO matches (company, student, skills) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($mt);
                $stmt->bind_param("sss", $company_row['company_name'], $logged_in_username, implode(",", $matched_skills));

                if ($stmt->execute()) {
                    // Set the flag to true if at least one match is inserted successfully
                    $inserted = true;
                } else {
                    $errors[] = "Error inserting Matches: " . $stmt->error;
                }
            }
        }
        
        // Redirect if at least one match is inserted successfully
        if ($inserted) {
            echo "<script>alert('Matches submitted successfully!')</script>";
            echo "<script>window.location.href='index.php';</script>"; // Redirect to login page
            exit(); // Stop script execution after successful insertion and redirect
        }
    } else {
        $errors[] = "No company preferences found.";
    }
} else {
    $errors[] = "No student preferences found for the logged-in user.";
}

?>