<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="Preferences.css">
    <title>Preferences</title>
</head>
<body>
    <header>
        <img src="logo.png" alt="website logo">
     
        <div class="profile-container">
            <a href="#"><i class="fa-solid fa-bell"></i></a>
            <a href="#"><i class="fa-solid fa-comment"></i></a>
             <span id="profile"><p>BM</p></span>
            <a href="#myDropDown"><i class="fa-solid fa-caret-down"  onclick="dropIt()"></i></a>
            <div class="profile-menu" id="myDropdown">
                <ul>
                    <br>
                    <li><a href="#">Accessibility</a></li><br>
                    <hr><br>
                    <li><a href="#">Profile</a></li><br>
                    <li><a href="#">Private files</a></li><br>
                    <hr><br>
                    <li><a href="#">Preferences</a></li><br>
                    <hr><br>
                    <li><a href="#">Logout</a></li><br>
                   
                </ul>
            </div>
        </div>
    </header>
    <nav id="navbar">
        <ul>
            <a href="home.html"><li><i class="fa-solid fa-house" ></i>Notifications</li></a>
            <a href="#"><li><i class="fa-solid fa-gauge" ></i>Messages</li></a>
            <a href="mycourses.html"><li><i class="fa-solid fa-book-open" ></i>Log Out</li></a>
            <a href="About.html"><li><i class="fa-solid fa-circle-info" ></i>About</li></a>
            <a href="#"><li><i class="fa-solid fa-circle-info" ></i>Contact US</li></a>
        </ul>
       </nav>
       <h2>Preferences</h2>
       <p>Students register for industrial attachment and indicate the kind of projects they wish to be engaged and they also set preferences on the location
        of the industrial attachment.<br>
        <label for="interest">Interest:</label>
        <select id="interest" name="interest list"> 
            <option value=>Students interest...</option>
            <option value="networking">Networking</option>
            <option value="cybersecurity">Cybersecurity</option>
            <option value="web development">Web development</option>
            <option value="data Analytics">Data Analytics</option>
        </select><br>
        
        <label for="role">Type of Role:</label>
        <select id="role" name="roles"> 
            <option value=>Roles...</option>
            <option value="networking">Design and Implementation</option>
            <option value="cybersecurity">Artificial intelligence</option>
            <option value="web development">Developer</option>
            <option value="data Analytics">Systems Engineering</option>
        </select><br>

        <label for="location">Location of attachment:</label>
        <select id="location" name="location list"> 
            <option value=>Location...</option>
            <option value="networking">Gaborone</option>
            <option value="cybersecurity">Kanye</option>
            <option value="web development">Palapye</option>
            <option value="data Analytics">Atlanta</option>
        </select><br>

        <label for="kind of project">Kind of project:</label>
        <select id="project" name="project list"> 
            <option value=>Projects...</option>
            <option value="networking">Documenting software and systems.</option>
            <option value="cybersecurity">Maintaining and updating an existing application.</option>
            <option value="web development">Performing research and development in a specific area of computer science.</option>
            <option value="data Analytics">Developing a new application or feature for an existing application.</option>
        </select><br>

        <label for="needs">Special Needs:</label>
        <select id="needs" name="Special needs"> 
            <option value=>special needs...</option>
            <option value="networking">Extended time on tests and assignments</option>
            <option value="cybersecurity">Adaptive learning software.</option>
            <option value="web development"> Accessible workstations and workspaces.</option>
            <option value="data Analytics"> A quiet, low-distraction work environment.</option>
        </select><br>
    </p>
       <table>
        <tr>
            <td Preferences ="2"></td>
        </tr>
        
        <input type="button" name="previous" value="Previous"> 
        </td>
                
        <input type="button" name="next" value="Next"><br>
        </td>
    </table>
       <footer>
        <div id="left-links">
            <i class="fa-solid fa-headset"></i>
          <h5>Contact Us</h5><br>
          <h6>+267 XXX-XXX-XX</h6>
        </div>

        <div id="generic">
    <p>You are logged in as (#Userexample)</p><br>
    <p><a href="login.html">Log out</a></p>
    <br/>
    <hr/>
    <p>&copy; Copyright 2024</p><br/>
        </div>
   <div id="right-links">
         <h5>Email</h5> <br>
         <span><i class="fa-solid fa-inbox"></i>info@cs.ub.bw</span>
   </div>
    </footer>
</body>
</html>