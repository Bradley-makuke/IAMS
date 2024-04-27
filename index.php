<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Home Page</title>
</head>
<body>
    
    <header id="header">
        <img src="images/UBotswana.png" alt="logo of the school">
        <div class="searchbar">
            <input type="search" placeholder="Search by name or industry" id="searchInput">
           <a href="$" id="searchBtn"><i class="fa-solid fa-magnifying-glass" style="color: #5d5e5f;" id="searchIcon"></i> </a> 
        </div>
        <a href="About.html" class="nav-link">About</a>
        <a href="About.html" class="nav-link">Contact</a>
        <a href="view_attachments.php" class="nav-link">View Attachments</a>
        <button id="login"><a href="login.php" >Log in</a></button>
       
    </header>
    <div class="hero-section">
        <div class="hero-text">
           <h1>Connect Talent & Opportunites: <br></h1>
           <h3>Bridging the Gap in CS Attachements.</h3>
        </div>
   
        <div class="call-to-action">
           <h3>Sign Up Now!</h3>
         <button><a href="stureg.php">Student</a></button>
          <button> <a href="orgreg.php">Organisation</a></button>
        </div>
       </div>
    <main>
        <h2>Featured Companies</h2>
        <div class="partners">
            <div class="carousel">
            <div class="company-card comp1 Networking Cybersecurity" id="Bofinet">
              <div class="card-inner">
                <div class="card-front">
                  <div class="card-image">
                    <img src="bofinet.jpg" alt="card image">
                </div>
                <p class="company-name">Bofinet</p>
                </div>
                <div class="card-back">
                  <h1>Bofinet</h1>
                  <p>Industry: Networking/ Cybersecurity</p>
                  <p>Number of Branches: 4</p>
                  <p>Size: 200</p>
                </div>
              </div>
            </div>

            <div class="company-card comp2 Banking" id="BSB">
              <div class="card-inner">
                <div class="card-front">
                  <div class="card-image">
                    <img src="BSB-Logo-resized.webp" alt="card image">
                </div>
                <p class="company-name">Botswana Savings Bank</p>
                </div>
                <div class="card-back">
                  <h1>Botswana Savings Bank</h1>
                  <p>Industry: Banking</p>
                  <p>Number of Branches: 10</p>
                  <p>Size: 1000</p>
                </div>
              </div>
               
             </div>

             <div class="company-card comp3 Insurance" id="BIHL">
              <div class="card-inner">
                <div class="card-front">
                  <div class="card-image">
                    <img src="Bihl-Group-Logo.jpg" alt="card image">
                </div>
                <p class="company-name">BIHL Group</p>
                </div>
                <div class="card-back">
                  <h1>BIHL GROUP</h1>
                  <p>Industry: Insurance</p>
                  <p>Number of Branches: 5</p>
                  <p>Size: 500</p>
                </div>
              </div>
               
             </div>

             <div class="company-card comp4 Finance" itemref="CEDA">
              <div class="card-inner">
                <div class="card-front">
                  <div class="card-image">
                    <img src="CEDA.jpg" alt="card image">
                </div>
                <p class="company-name">Ceda</p>
                </div>
                <div class="card-back">
                  <h1>CEDA</h1>
                  <p>Industry: Finance</p>
                  <p>Number of Branches: 6</p>
                  <p>Size: 900</p>
                </div>
              </div>
                
             </div>
           
          
             <div class="company-card comp5 Banking" id="ABSA">
              <div class="card-inner">
                <div class="card-front">
                  <div class="card-image">
                    <img src="CEDA.jpg" alt="card image">
                </div>
                <p class="company-name">ABSA</p>
                </div>
                <div class="card-back">
                  <h1>ABSA</h1>
                  <p>Industry: Banking</p>
                  <p>Number of Branches: 25</p>
                  <p>Size: 2000</p>
                </div>
              </div>
           
           </div>

           <div class="company-card comp6 Mining" id="Debswana">
            <div class="card-inner">
              <div class="card-front">
                <div class="card-image">
                  <img src="CEDA.jpg" alt="card image">
              </div>
              <p class="company-name">Debswana</p>
              </div>
              <div class="card-back">
                <h1>Debswana</h1>
                <p>Industry: Mining</p>
                <p>Number of Branches: 2</p>
                <p>Size: 10000</p>
              </div>
            </div>
           
         </div>

         <div class="company-card comp7 Data-Analysis" id="Spectrum">
          <div class="card-inner">
            <div class="card-front">
              <div class="card-image">
                <img src="CEDA.jpg" alt="card image">
            </div>
            <p class="company-name">Spectrum Analytics</p>
            </div>
            <div class="card-back">
              <h1>Spectrum Analytics</h1>
              <p>Industry: Data Analysis</p>
              <p>Number of Branches: 2</p>
              <p>Size: 20</p>
            </div>
          </div>

          
       </div>
       <div class="company-card comp8 Cybersecurity" id="IT-IQ">
        <div class="card-inner">
          <div class="card-front">
            <div class="card-image">
              <img src="CEDA.jpg" alt="card image">
          </div>
          <p class="company-name">IT-IQ</p>
          </div>
          <div class="card-back">
            <h1>IT-IQ</h1>
            <p>Industry: Cybersecurity</p>
            <p>Number of Branches: 4</p>
            <p>Size: 50</p>
          </div>

          </div>
      
     </div>
      </div>

      <div class="navigation">
        <button class="prev">&#10094;</button>
        <button class="next">&#10095;</button>
      </div>
      <div class="dots-container"></div>
        </div>
             <div class="news">
                <h2>Site News</h2>
                    <div class="upload">
                        <h4 class="title">ABSA hackathon </h4>
                        <p class="post-details">by <a href="login.php">ABSA</a>- June 2022.</p>
                        <span class="profile"><img src="user-image.jpg" alt=""></span>
                    </div>
                       <div class="news-content">
                        <div class="news-image">
                            <img src="absa-hackathon.jpeg" alt="Image of News Displayed.">
                        </div>
                        <p class="description">During the winter semester of 2022. We held a hackathon focused on Sparking an interest <br> in computer science with Junior and Senior School students as a way of showing our <br> commitment to community engagement. Three University of Botswana students <br> who were attachees during that time participated not as competitors<br> but as mentors and fellow learners. The Hackathon themed<br> "Coding for Agriculture" aimed to introduce these young<br> minds to the 
                             potential of technology in revolutionizing<br> the agricutural landscape. For the University attachees,<br>
                              the experience proved to the a valuable opportunity<br> to solidify their own programming skills while<br> 
                               contributing to a cause close to Absa`s heart:<br> nurturing future generations of tech-savvy problem solvers. </p>
                   

                       </div>
                   
             </div>
    </main>

    <footer>
        <div class="footer-container">
          <div class="footer-section">
            <h3>Gaborone Campus <i class="fa-solid fa-location-pin" style="color: #890101;"></i></h3>
            <p>
              Plot 4776 Notwane Rd<br>
              Gaborone, Botswana<br>
              Private Bag UB 0022<br>
              Tel: +267 355 0000<br>
             
            </p>
          </div>
          <div class="footer-section sec-b">
            <h3>Social Meadia Links</h3>
            <p>
              <a href="https://www.facebook.com/ubcomputerscience"><i class="fa-brands fa-facebook"></i></a><br>
              <a href="https://twitter.com/UBBotswana"><i class="fa-brands fa-square-x-twitter"></i></a><br>
              <a href="https://www.youtube.com/channel/UCsAEy42oIwOMTEUC5_T8Z2w"><i class="fa-brands fa-youtube"></i></a><br>
              
              
            </p>
          </div>
          <div class="footer-section">
            <h3>Short Links</h3>
            <p><a href="#header">Back to Top.<i class="fa-solid fa-arrow-up" style="color: #6e0902;"></i></a></p><br>
            <p><a href="mailto:ubcomputerscience@mopipi.ub.bw">About Us</a></p><br>
            <p><a href=""></a>Contact us</p>
          </div>

        </div>
        <br>
        <hr>
        <br>
        &COPY;Copyright 2024 All Rights Reserved.
      </footer>
      <script>
        const carousel = document.querySelector('.carousel');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');
const dotsContainer = document.querySelector('.dots-container');

const slides = document.querySelectorAll('.company-card');
const totalSlides = slides.length;
const slidesPerView = 4;
let currentIndex = 0;

function updateNavigation() {
  prevButton.style.display = currentIndex === 0 ? 'none' : 'block';
  nextButton.style.display = currentIndex >= totalSlides - slidesPerView ? 'none' : 'block';
}

function updateDots() {
  const dots = Array.from(dotsContainer.children);
  dots.forEach((dot, index) => {
    if (index === currentIndex) {
      dot.classList.add('active');
    } else {
      dot.classList.remove('active');
    }
  });
}

function moveToSlide(index) {
  const slideWidth = slides[0].offsetWidth + parseInt(getComputedStyle(slides[0]).marginLeft) * 2;
  const offset = -index * slideWidth;
  carousel.style.transform = `translateX(${offset}px)`;
  currentIndex = index;
  updateNavigation();
  updateDots();
}

prevButton.addEventListener('click', () => {
  if (currentIndex > 0) {
    moveToSlide(currentIndex - 1);
  }
});

nextButton.addEventListener('click', () => {
  if (currentIndex < totalSlides - slidesPerView) {
    moveToSlide(currentIndex + 1);
  }
});

// Create dots
for (let i = 0; i < Math.ceil(totalSlides / slidesPerView); i++) {
  const dot = document.createElement('span');
  dot.classList.add('dot');
  dot.addEventListener('click', () => {
    moveToSlide(i * slidesPerView);
  });
  dotsContainer.appendChild(dot);
}

updateNavigation();
updateDots();

/*document.getElementById('searchInput').addEventListener('input', function() {
  const searchText = this.value.trim().toLowerCase(); // Convert input value to lowercase for case-insensitive comparison
  const companyCards = document.querySelectorAll('.company-card');

  companyCards.forEach(function(card) {
    const companyName = card.querySelector('.company-name').textContent.toLowerCase();
    const industries = card.classList;
    const cardId = card.id.toLowerCase();

    if (companyName.includes(searchText) || industries.contains(searchText) || cardId === searchText) {
      card.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });
});
*/
document.getElementById('searchInput').addEventListener('keyup', function(event) {
  if (event.key === 'Enter') {
    performSearch();
  }
});

document.getElementById('searchBtn').addEventListener('click', function(event) {
  event.preventDefault(); // Prevent default anchor behavior
  performSearch();
});

function performSearch() {
  const searchText = document.getElementById('searchInput').value.trim().toLowerCase();
  const companyCards = document.querySelectorAll('.company-card');

  companyCards.forEach(function(card) {
    const companyName = card.querySelector('.company-name').textContent.toLowerCase();

    if (companyName.includes(searchText)) {
      const cardId = card.id;
      document.getElementById('searchBtn').setAttribute('href', `#${cardId}`);
      return; // Exit loop early if a match is found
    }
  });
}


      </script>
</body>
</html>