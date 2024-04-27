<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Preferences.css">
    <title>Preferences</title>
</head>
<body>
    
    <div class="container">
        <img src="images/UBotswana.png" alt="UB logo">
        <div id="form-container">
            <form action="" method="post">
                <h3>Preferences</h3>
                <div class="select-container">
                    <label for="interest">Interest:</label>
                    <select id="interest" name="interest list"> 
                        <option value=>Students interest...</option>
                        <option value="networking">Networking</option>
                        <option value="cybersecurity">Cybersecurity</option>
                        <option value="web development">Web development</option>
                        <option value="data Analytics">Data Analytics</option>
                        <br>
                    </select>
                    <br>
                        <label for="role">Type of Role:</label>
                        <select id="role" name="roles"> 
                            <option value=>Roles...</option>
                            <option value="networking">Design and Implementation</option>
                            <option value="cybersecurity">Artificial intelligence</option>
                            <option value="web development">Developer</option>
                            <option value="data Analytics">Systems Engineering</option>
                        </select><br>

                        <label for="location" >Location of attachment:</label>
                        <select id="location" name="location list" > 
                            <option value=>Location...</option>
                            <option value="networking">Gaborone</option>
                            <option value="cybersecurity">Kanye</option>
                            <option value="web development">Palapye</option>
                            <option value="data Analytics">Atlanta</option>
                        </select><br>
                        <label for="kind of project">Kind of project:</label>
                        <select id="project" name="project list" > 
                            <option value=>Projects...</option>
                            <option value="networking">Documenting software and systems.</option>
                            <option value="cybersecurity">Maintaining and updating an existing application.</option>
                            <option value="web development">Research and development in a specific area of CS.</option>
                            <option value="data Analytics">Developing a new application or features  of apps.</option>
                        </select><br>

                        <label for="needs" >Special Needs:</label>
     <select id="needs" name="Special needs" > 
         <option value=>special needs...</option>
         <option value="networking">Extended time on tests and assignments</option>
         <option value="cybersecurity">Adaptive learning software.</option>
         <option value="web development"> Accessible workstations and workspaces.</option>
         <option value="data Analytics"> A quiet, low-distraction work environment.</option>
     </select><br>
                   

     <div class="select-container-button">
        <a href="stureg.php"><button type="submit" >Previous</button></a>
        <a href="stuhome.html"><button type="submit">Next</button></a>
    </div>
    
        </div>
               
                    
            </form>
        </div>
        <div id="band"></div>
        <div id="image-container">
            <img src="images/students.jpg" alt="image of students">
        </div>
    </div>
    

</body>
</html>