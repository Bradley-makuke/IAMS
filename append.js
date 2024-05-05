let slideIndex = 4;
let cardsPerSlide = 1; // Number of cards to display per slide
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function showSlides(n) {
  let slides = document.getElementsByClassName("carousel-inner")[0].children;
  let slideCount = Math.ceil(slides.length / cardsPerSlide);

  if (n > slideCount) {
    slideIndex = 1;
  }
  if (n < 1) {
    slideIndex = slideCount;
  }

  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  let startIndex = (slideIndex - 1) * cardsPerSlide;
  let endIndex = startIndex + cardsPerSlide;

  for (let i = startIndex; i < endIndex; i++) {
    if (slides[i]) {
      slides[i].style.display = "block";
    }
  }
}
// Function to add a new company card to the carousel
function addCompanyCard(companyName, logoSrc) {
  let carouselInner = document.getElementsByClassName("carousel-inner")[0];
  let newCard = document.createElement("div");
  newCard.classList.add("carousel-card");
  newCard.innerHTML = `
    <img src="${logoSrc}" alt="${companyName} Logo">
    <h3>${companyName}</h3>
  `;
  carouselInner.appendChild(newCard);
}

// Example usage: Add a new company card when a new company registers
addCompanyCard("New Company", "new-company-logo.png");
let i = 1;
while(i < 40){
    let comname = "Company number" + i;
    addCompanyCard(comname, "students.jpg");
    i++;
}