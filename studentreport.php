<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report</title>
    <link rel="stylesheet" href="usupervisor_assess.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>
<body>


<h2 class="heading">STUDENT ATTACHMENT FINAL REPORT</h2>
   
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   

    <fieldset>

        <h3>UPLOAD DOCUMENT</h3><br>

          <h3>Upload report:</h3><br>
          <p>Click the button and select the file you want to upload</p><br>
          <div class="upload-container">

              <label for="upld1">Report</label>
              <input type="file" id="upld1" name="report1" accept=".pdf" required/>
              <br><br>
              
              <!-- name of file chosen -->
              <span id="file-chosen1">No file chosen</span>
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

    </script>
</body>

</html>


<?php 
// Create the connection to the database
$servername = "10.0.19.74";
$username = "tsu00073";
$password = "tsu00073";
$dbname = "db_tsu00073";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connection successful!!";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 $report1 = $_POST["report1"];
    }

    $stmt = $conn->prepare("INSERT INTO reports (report1) VALUES(?)");
    $stmt->bind_param("s", $report1);
    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();

$conn->close();

?>