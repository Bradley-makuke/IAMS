<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <link rel="stylesheet" href="apply2.css">
    <link rel="stylesheet" href="apply">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
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

              <h1 style="text-center">Attachment Program Application</h1>
   
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <fieldset>
    <form action="/submit_application" method="post" enctype="multipart/form-data">
      
        <label for="name">First Name:</label>
        <input type="text" id="name" name="name" placeholder="fist name" required><br><br>
        
        <label for="name">Last Name:</label>
        <input type="text" id="name" name="name" placeholder="last name"required><br><br>
        
        <label for="email">Email:</label>
        <label>Email: <input class="email" type="text" name="email" placeholder="name@email.com" required/></label><br><br>

        <h3>UPLOAD DOCUMENTS</h3><br>
          
          <h3>Upload a copy of your Resume:</h3><br>
          <p>Click the button and select the file you want to upload</p><br>
          <div class="upload-container">

              <label for="upld1">Resume</label>
              <input type="file" id="upld1" name="transcript" accept=".pdf" required/>
              <br><br>
              
              <!-- name of file chosen -->
              <span id="file-chosen1">No file chosen</span>
              <br><br>
          </div><br><br>

          <h3>Upload your copy of the Cover Letter:</h3><br>
          <p>Click the button and select the file you want to upload</p><br>
          <div class="upload-container">

              <label for="upld2">Cover Letter</label>
              <input type="file" id="upld2" name="id_copy" accept=".pdf" required />
              <br><br>
              
              <!-- name of file chosen -->
              <span id="file-chosen2">No file chosen</span>
              <br><br>
          </div><br><br>

          <h3>Upload your Academic Transcripts:</h3><br>
          <p>Click the button and select the file you want to upload</p><br>
          <div class="upload-container">

              <label for="upld3">Academic Transcripts</label>
              <input type="file" id="upld3" name="pop" accept=".pdf" required />
              <br><br>
              
              <!-- name of file chosen -->
              <span id="file-chosen3">No file chosen</span>
              <br><br>
          </div><br><br>

        <input class="submitbutton" type = "submit" name = "submit">
        </fieldset>
    </form>


    <script>

const actualBtn1 = document.getElementById('upld1');

const fileChosen1 = document.getElementById('file-chosen1');

actualBtn1.addEventListener('change', function(){
  fileChosen1.textContent = this.files[0].name
})


const actualBtn2 = document.getElementById('upld2');

const fileChosen2 = document.getElementById('file-chosen2');

actualBtn2.addEventListener('change', function(){
  fileChosen2.textContent = this.files[0].name
})

const actualBtn3 = document.getElementById('upld3');

const fileChosen3 = document.getElementById('file-chosen3');

actualBtn3.addEventListener('change', function(){
  fileChosen3.textContent = this.files[0].name
})
    </script>
</body>

</html>
<?php 
// Create the connection to the database
$servername = "10.0.19.74";
$username = "mac01590";
$password = "mac01590";
$dbname = "db_mac01590";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connection successful!!";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     //Collecting and Validating firstname
     if(empty($_POST['fname'])){
        echo  "<script>alert('firstname is required'); window.location='apply2.php';  </script>";
    }
    else{
        $first= $_POST['fname'];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $first)){
            echo  "<script>alert('Only letters and white space allowed for firstname'); window.location='apply2.php'; </script>";
        }
    }

    //Collecting and Validating lastname
    if(empty($_POST['lname'])){
        echo  "<script>alert('lastname is required'); window.location='apply2.php'; </script>";
    }
    else{
        $last = $_POST["lname"];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $last)){
            echo  "<script>alert('Only letters and white space allowed for lastname'); window.location='apply2.php'; </script>";
        }
    }

    //Collecting and Validating id
    // if(empty($_POST['nationalid'])){
    //     echo  "<script>alert('nationalid is required'); window.location='apply2.php'; </script>";
    // }
    // else{
    //     $nationalid = $_POST["nationalid"];
    //     if(!preg_match(("/^[0-9]$/", $nationalid))){
    //         echo  "<script>alert('ID number must be exactly  9 digits'); window.location='apply2.php'; </script>";
    //     }
    // }

    if(empty($_POST['address'])){
        echo  "<script>alert('address is required'); window.location='apply2.php'; </script>";
    }
    else{
        $address = $_POST["address"];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $address)){
        echo  "<script>alert('Only letters and white space allowed for address'); window.location='apply2.php'; </script>";
        }
    }

    if(empty($_POST['city'])){
        echo  "<script>alert('city is required'); window.location='apply2.php'; </script>";
    }
    else{
        $city = $_POST["city"];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $city)){
            echo  "<script>alert('Only letters and white space allowed for city'); window.location='apply2.php'; </script>";
        }
    }

    if(empty($_POST['region'])){
        echo  "<script>alert('region is required'); window.location='apply2.php'; </script>";
    }
    else{
        $region = $_POST["region"];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $last)){
            echo  "<script>alert('Only letters and white space allowed for region'); window.location='apply2.php'; </script>";
        }
    }

     if(empty($_POST['email'])){
         echo  "<script>alert('email is required'); window.location='apply2.php'; </script>";
     }
     else{
        $email = $_POST["email"];
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format'); window.location='apply2.php'; </script>";
          }
     }

    if(empty($_POST['fnok'])){
        echo  "<script>alert('Next of kin first name is required'); window.location='apply2.php'; </script>";
    }
    else{
        $fnok = $_POST["fnok"];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $fnok)){
            echo  "<script>alert('Only letters and white space allowed for Next of Kin first name'); window.location='apply2.php'; </script>";
        }
    }

    if(empty($_POST['lnok'])){
        echo  "<script>alert('Next of kin last name is required'); window.location='apply2.php'; </script>";
    }
    else{
        $lnok = $_POST["lnok"];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $lnok)){
            echo  "<script>alert('Only letters and white space allowed for Next of Kin last name'); window.location='apply2.php'; </script>";
        }
    }

    if(empty($_POST['reltn'])){
        echo  "<script>alert('Relationship is required'); window.location='apply2.php'; </script>";
    }
    else{
        $reltn = $_POST["reltn"];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $reltn)){
            echo  "<script>alert('Only letters and white space allowed for relationship'); window.location='apply2.php'; </script>";
        }
    }  
    
    if(empty($_POST['opt1-fac'])){
        echo  "<script>alert('Faculty is required'); window.location='apply2.php'; </script>";
    }
    else{
        $opt1_fac = $_POST["opt1-fac"];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $opt1_fac)){
            echo  "<script>alert('Only letters and white space allowed for faculty'); window.location='apply2.php'; </script>";
        }
    }

    if(empty($_POST['opt1-pro'])){
        echo  "<script>alert('Programme is required'); window.location='apply2.php'; </script>";
    }
    else{
        $opt1_pro = $_POST["opt1-pro"];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $opt1_pro)){
            echo  "<script>alert('Only letters and white space allowed for programme'); window.location='apply2.php'; </script>";
        }
    }

    if(empty($_POST['opt2-fac'])){
        echo  "<script>alert('Faculty is required'); window.location='apply2.php'; </script>";
    }
    else{
        $opt2_fac = $_POST["opt2-fac"];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $opt2_fac)){
            echo  "<script>alert('Only letters and white space allowed for faculty'); window.location='apply2.php'; </script>";
        }
    }

    if(empty($_POST['opt2-pro'])){
        echo  "<script>alert('Programme is required'); window.location='apply2.php'; </script>";
    }
    else{
        $opt2_pro = $_POST["opt2-pro"];
        if(!preg_match("/^[a-zA-Z-' ]*$/", $opt2_pro)){
            echo  "<script>alert('Only letters and white space allowed for programme'); window.location='apply2.php'; </script>";
        }
    }
    
    $nationalid = $_POST["nationalid"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $postalcode = $_POST["postalcode"];
    $country = $_POST["country"];
 $phone = $_POST["phone"];
 $nokphone = $_POST["nokphone"];
 $points = $_POST["points"];
 $transcript = $_POST["transcript"];
 $id_copy = $_POST["id_copy"];
 $pop = $_POST["pop"];
    }

    $stmt = $conn->prepare("INSERT INTO applicant ( fname , lname, nationalid, gender, dob, address, city, region, postalcode,
    country, phone, email, fnok, lnok, reltn, nokphone, points, opt1_fac, opt1_pro, opt2_fac, opt2_pro, transcript, id_copy, pop)
     VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssssssssssssssssssss", $first, $last, $nationalid, $gender, $dob, $address, $city, $region, $postalcode,
    $country, $phone, $email, $fnok, $lnok, $reltn, $nokphone, $points, $opt1_fac, $opt1_pro, $opt2_fac, $opt2_pro, $transcript, 
    $id_copy, $pop);
    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();

$conn->close();

?>