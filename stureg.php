<?php
//Include configuration file
include "configure.php";

$firstname = $surname = $username = $email = $student_id = $phone_number = $password = $confirm_password = "";
 $user_type = "student";
if($_SERVER ["REQUEST_METHOD"] === "POST"){

    // function to  clean data from the form
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validating form data
     //Names
     if(empty($_POST["firstname"])){
         echo "<script>alert('First name is empty. Must Enter FirstName)</script>";

     }
     else{
        $firstname = test_input($_POST["firstname"]);
     }
     if(!preg_match("/^[a-zA-Z]*$/", $firstname)){
        echo "<script>alert('Only letters allowed.')</script>";
     }

     if(empty($_POST["surname"])){
        echo "<script>alert('Surname is empty. Must Enter Surname)</script>";

    }
    else{
       $surname = test_input($_POST["surname"]);
    }
    if(!preg_match("/^[a-zA-Z]*$/", $surname)){
       echo "<script>alert('Only letters allowed.')</script>";
    }
   
    // Username field validation
    if(empty($_POST["username"])){
        echo "<script>alert('Username is empty. Must Enter Username)</script>";

    }
    else{
       $username = test_input($_POST["username"]);
    }
    if(!preg_match("/^\w+$/", $username)){
       echo "<script>alert('No white spaces allowed.')</script>";
    }
     
    //email validation
    if(empty($_POST["email"])){
        echo "<script>alert('Email is empty. Must Enter email)</script>";

    }
    else{
       $email = test_input($_POST["email"]);
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
       echo "<script>alert('Invalid email format.')</script>";
    }

    // student ID
    if(empty($_POST["student_id"])){
        echo "<script>alert('Student ID is empty. Must Enter Student ID)</script>";

    }
    else{
       $student_id = test_input($_POST["student_id"]);
    }
    if(!preg_match("/^[0-9]{9}$/", $student_id)){
       echo "<script>alert('Only numbers allowed.')</script>";
    }

    // phone number
    if(empty($_POST["phone_number"])){
        echo "<script>alert('Phone number is empty. Must Enter Phone number)</script>";

    }
    else{
       $phone_number = test_input($_POST["phone_number"]);
    }
    if(!preg_match("/^[0-9]{8}$/", $phone_number)){
       echo "<script>alert('Only numbers allowed.')</script>";
    }

    // Passwords
    if(empty($_POST["password"])){
        echo "<script>alert('Password is empty. Must Enter Password)</script>";

    }
    else{
       $password = test_input($_POST["password"]);
    }
    if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\S).{9,}$/", $password)){
       echo "<script>alert('Invalid Password format.')</script>";
    }

    if(empty($_POST["confirm_password"])){
        echo "<script>alert('Password is empty. Must Enter Password)</script>";

    }
    else{
       $confirm_password = test_input($_POST["confirm_password"]);
    }
    if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\S).{9,}$/", $password)){
       echo "<script>alert('Invalid  Password format.')</script>";
    }

     // Password Confirmation 
     if(!($confirm_password === $password)){
        echo "<script>alert('Passwords Do not match.')</script>";

     }

     else{
         // hash password
         $hashedpassword =  password_hash($password, PASSWORD_DEFAULT);

        
         
     }

     $stmt = $conn->prepare("INSERT INTO student(username,email, firstname, surname, studentid, phone_number) VALUES(?,?,?,?,?,?)");
         
     $stmt->bind_param("ssssss", $username, $email, $firstname, $surname, $student_id, $phone_number);


     $use = $conn->prepare("INSERT INTO user(username, email, user_type, password) VALUES(?,?,?,?)");
     $use->bind_param("ssss",$username, $email, $user_type, $hashedpassword);

     if($stmt->execute() && $use->execute()){
      echo "<script>alert('Record inserted successfully')</script>";
      echo "<script>window.location.href='preference.html';</script>";
      session_start();
      $_SESSION["username"] = $username;
      exit();
     }
     else{
      echo "<script>alert('Error inserting record: " . $stmt->error . "')</script>";
     }

    
}



?>