<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="stylesheet" href="view_attachments.css" />
    <title>Attachments</title>
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
      <div class="searchbar">
          <form>
            <input type="text" name="text" class="searchbox" placeholder="Search">
            <i class="fa-solid fa-magnifying-glass" style="color: #2309ec;"></i>
          </form>
        </div>

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
  </div>


  <main>
    <p class="description">The following are the current organizations with open vacancies for student industrial attachment placement.
        Choose only one that you'd like to apply to so as to give others an opportunity.
    </p><br><br><br>

    <!-- The grid: three columns -->
    <div class="row">
      <div class="column" onclick="openTab('b1');"><img class="image" src="bihllogo.jpg" alt="bihl-logo"></div>
      <div class="column" onclick="openTab('b2');"><img class="image" src="bofinetlogo.jpg" alt="bofinet-logo"></div>
      <div class="column" onclick="openTab('b3');"><img class="image" src="bsb.png" alt="bsb-logo"></div>
    </div>

<!-- The expanding grid (hidden by default) -->
<div id="b1" class="containerTab" style="display:none;">
<!-- If you want the ability to close the container, add a close button -->
<span onclick="this.parentElement.style.display='none'" class="closebtn">x</span>
<h2>Botswana Insurance Holdings Limited (BIHL)</h2><br>
<p>Is looking for 3 Computer Science Department student attachees for placement in the IT Department</p><br><br>
<p>Applications will open from 7th May - 15th May 2024</p><br><br>
<p>Email your applications (CV, Transcript) to recruit@bihl.co.bw</p><br><br>

<div class="center-btn">
  <button class="apply-btn"><a class="apply-link" href="login.php">Apply</a></button>
</div>
</div>

<div id="b2" class="containerTab" style="display:none;">
<span onclick="this.parentElement.style.display='none'" class="closebtn">x</span>
<h2>Botswana Fibre Networks (BOFINET)</h2><br>
<p>Is looking for 1 Computer Science student attachee</p><br><br>
<p>Applications will open from 30th April - 20th May 2024</p><br><br>
<p>Email your applications (CV, Transcript) to lmonametsi@bfnt.co.bw</p><br><br>

<div class="center-btn">
  <button class="apply-btn"><a class="apply-link" href="login.php">Apply</a></button>
</div>
</div>

<div id="b3" class="containerTab" style="display:none;">
<span onclick="this.parentElement.style.display='none'" class="closebtn">x</span>
<h2>Botswana Savings Bank (BSB)</h2><br>
<p>Is looking for 5 Computer Science Department student attachees for placement in the IT Department</p><br><br>
<p>Applications will open from 25th April - 18th May 2024</p><br><br>
<p>Email your applications (CV, Transcript) to recruiter@bsb.co.bw</p><br><br>

<div class="center-btn">
  <button class="apply-btn"><a class="apply-link" href="login.php">Apply</a></button>
</div>
</div>
  </main>
  
    <footer>
      <div id="left-links">
        <i class="fa-solid fa-headset"></i>
        <h5>Contact Us</h5>
        <br />
        <h6>+267 XXX-XXX-XX</h6>
      </div>

      <div id="generic">
        <p>You are logged in as (#Userexample)</p>
        <br />
        <p><a href="login.html">Log out</a></p>
        <br />
        <hr />
        <p>&copy; Copyright 2024</p>
        <br />
      </div>
      <div id="right-links">
        <h5>Email</h5>
        <br />
        <span><i class="fa-solid fa-inbox"></i>info@cs.ub.bw</span>
      </div>
    </footer>

    <script>
      function dropIt() {
        var drop = document.getElementById("myDropdown");
        if (drop.style.display == "" || drop.style.display == "none") {
          drop.style.display = "block";
        } else {
          drop.style.display = "none";
        }
      }

      // Hide all elements with class="containerTab", except for the one that matches the clickable grid column
function openTab(tabName) {
  var i, x;
  x = document.getElementsByClassName("containerTab");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  document.getElementById(tabName).style.display = "block";
}
    </script>
  </body>
</html>
