
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

