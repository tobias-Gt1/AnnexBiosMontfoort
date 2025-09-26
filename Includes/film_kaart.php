<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Film Agenda</title>
  <style>
    body {
      background-color: black;
      color: white;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .header {
      font-size: 44px;
      font-weight: bold;
      color: #4596BA;
      margin: 100px 100px 30px;
      background-color: white;
      width: 28%;
   
    }

    /* Menu balk */
    .menu {
      display: flex;
      gap: 15px;
      margin: 0 100px 30px;
    }

    .menu button {
      background-color: #f2f6fc;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      font-weight: bold;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: 0.2s;
       justify-content: space-between
    }



    .menu button.active {
      background-color: #4596BA;
      color: black;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.4);
    }

    /* Grid container */
    .cards {
      display: none; 
      margin: 0 100px 30px;
      gap: 20px;
    }

    .cards.active {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }

    /* Kaarten */
    .card {
      background-color: white;
      color: black;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
      display: flex;
      flex-direction: column;
    }

    .card img {
      width: 100%;
      height: 350px;
      object-fit: cover;
    }

    .card .info {
      padding: 15px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      color: #333;
    }

    .card .info h3 {
      margin: 0 0 10px;
      font-size: 18px;
      color: #333;;
    }

    .card .info p {
      font-size: 14px;
      color: #333;
      margin: 0 0 10px;
    }

    .info .release {
      font-size: 14px;
      font-weight: bold;
      color: #666;
      margin: 5px 0 10px;
}


    .card .info button {
      margin-top: auto;
      background-color: #4a90e2;
      border: none;
      padding: 8px 12px;
      color: white;
      cursor: pointer;
      border-radius: 4px;
      transition: 0.2s;
    }

    .card .info button:hover {
      background-color: #357ABD;
    }

/* Dropdown container */
.dropdown {
  position: relative;
  display: inline-block;
}

/* De knop zelf */
.dropdown-btn {
  background-color: #f2f6fc;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  font-weight: bold;
  display: flex;
  align-items: center;
  gap: 8px;
}

/* Chevron-icoontje */
.dropdown-btn .chevron {
  width: 14px;
  height: 14px;
  transition: transform 0.2s;
}

/* Het menu (verstopt standaard) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 160px;
  box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
  z-index: 1000;
}

.dropdown-content a {
  color: black;
  padding: 10px 15px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #eee;
}

/* Als actief → zichtbaar maken */
.dropdown-content.show {
  display: block;
}

/* Draai het pijltje */
.dropdown-btn.active .chevron {
  transform: rotate(180deg);
}

.stars {
  display: flex;
  gap: 2px;
  margin-bottom: 5px;
}

.star {
  font-size: 18px;
  color: #ccc; /* standaard leeg */
}

.star.full {
  color: gold;
}

.star.half {
  background: linear-gradient(90deg, gold 50%, #ccc 50%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}


/* BKF-footer styling */
.bkf-footer {
  display: flex;
  justify-content: center;
  padding: 20px;
  margin-top: 40px;
}

.bkf-footer button {
  background-color: #4596BA;
  border: none;
  padding: 12px 24px;
  font-size: 16px;
  font-weight: bold;
  color: white;
  cursor: pointer;
  border-radius: 6px;
  transition: 0.3s;
}

.bkf-footer button:hover {
  background-color: #357ABD;
}


  </style>
</head>
<body>

  <div class="header">FILM AGENDA</div>

  <div class="menu">


    <button class="active" onclick="openTab('films')"> Films</button>
    <button onclick="openTab('week')"> Deze Week</button>
    <button onclick="openTab('vandaag')"> Vandaag</button>
<div class="dropdown">
  <button onclick="toggleDropdown()" class="dropdown-btn">
    Categorie    
    <img src="includes/images/down-chevron.png" alt="pijl omlaag" class="chevron">
  </button>
  <div id="dropdown-menu" class="dropdown-content">
    <a href="#">Actie</a>
    <a href="#">Komedie</a>
    <a href="#">Drama</a>
    <a href="#">Familie</a>
</div>

</div>



    
  </div>

  <!-- Containers (leeg, JS vult ze) -->
  <div id="films" class="cards active"></div>
  <div id="week" class="cards"></div>
  <div id="vandaag" class="cards"></div>
  <div id="categorie" class="cards"></div>

  <script>
    // Arrays met films
    const films = [
    { titel: "JURRASIC WORLD: FALLEN KINGDOM", 
        beschrijving: "Welkom in Jurassic World: Fallen Kingdom! Favoriete personages keren terug in dit 3D actiespektakel.", 
        poster: "includes/images/jurassic world (2).jpg",
        release: "7-06-2018",
          rating: 4.6
        
    },
    { titel: "DEADPOOL 2", 
        beschrijving: "Na het overleven van een bijna fatale runder ­aanval, worstelt een misvormde cafetaria-kok (Wade Wilson) om zijn droom.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018",
          rating: 4.5
    },
    { titel: "Solo: A Star Wars Story", 
        beschrijving: "Een compleet nieuw avontuur uit een ‘galaxy far, far away’, dat het verhaal vertelt over het verleden van de iconische smokkelaar.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018",
          rating: 3.8 
    },
    { titel: "Peter Rabbit", 
        beschrijving: "Verfilming van Beatrix Potter’s tijdloze verhaal over een eigenwijs konijn dat probeert de moestuin van een boer binnen te dringen.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018",
          rating: 3.2 
    },
 { titel: "Solo: A Star Wars Story", 
        beschrijving: "Een compleet nieuw avontuur uit een ‘galaxy far, far away’, dat het verhaal vertelt over het verleden van de iconische smokkelaar.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018",
          rating: 3.8 
    },
      { titel: "Peter Rabbit", 
        beschrijving: "Verfilming van Beatrix Potter’s tijdloze verhaal over een eigenwijs konijn dat probeert de moestuin van een boer binnen te dringen.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018",
          rating: 3.2 
    },
        { titel: "JURRASIC WORLD: FALLEN KINGDOM", 
        beschrijving: "Welkom in Jurassic World: Fallen Kingdom! Favoriete personages keren terug in dit 3D actiespektakel.", 
        poster: "includes/images/jurassic world (2).jpg",
        release: "7-06-2018",
          rating: 4.6
    },
    { titel: "DEADPOOL 2", 
        beschrijving: "Na het overleven van een bijna fatale runder ­aanval, worstelt een misvormde cafetaria-kok (Wade Wilson) om zijn droom.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018",
          rating: 4.5 
    },
 { titel: "Solo: A Star Wars Story", 
        beschrijving: "Een compleet nieuw avontuur uit een ‘galaxy far, far away’, dat het verhaal vertelt over het verleden van de iconische smokkelaar.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018",
          rating: 3.8 
    },
      { titel: "Peter Rabbit", 
        beschrijving: "Verfilming van Beatrix Potter’s tijdloze verhaal over een eigenwijs konijn dat probeert de moestuin van een boer binnen te dringen.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018",
          rating: 3.2 
    },
   { titel: "Solo: A Star Wars Story", 
        beschrijving: "Een compleet nieuw avontuur uit een ‘galaxy far, far away’, dat het verhaal vertelt over het verleden van de iconische smokkelaar.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018",
          rating: 3.8 
    },
     { titel: "Peter Rabbit", 
        beschrijving: "Verfilming van Beatrix Potter’s tijdloze verhaal over een eigenwijs konijn dat probeert de moestuin van een boer binnen te dringen.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018",
          rating: 3.2 
    },
    ];


 // Nieuw array WEEK films
   const weekFilms = [
   { titel: "JURRASIC WORLD: FALLEN KINGDOM", 
        beschrijving: "Welkom in Jurassic World: Fallen Kingdom! Favoriete personages keren terug in dit 3D actiespektakel.", 
        poster: "includes/images/jurassic world (2).jpg",
        release: "7-06-2018",
          rating: 4.6
        
    },
     { titel: "DEADPOOL 2", 
        beschrijving: "Na het overleven van een bijna fatale runder ­aanval, worstelt een misvormde cafetaria-kok (Wade Wilson) om zijn droom.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018",
          rating: 4.5
    },
 { titel: "Solo: A Star Wars Story", 
        beschrijving: "Een compleet nieuw avontuur uit een ‘galaxy far, far away’, dat het verhaal vertelt over het verleden van de iconische smokkelaar.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018",
          rating: 3.8 
    },
    { titel: "Peter Rabbit", 
        beschrijving: "Verfilming van Beatrix Potter’s tijdloze verhaal over een eigenwijs konijn dat probeert de moestuin van een boer binnen te dringen.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018",
          rating: 3.2 
    },
  { titel: "Solo: A Star Wars Story", 
        beschrijving: "Een compleet nieuw avontuur uit een ‘galaxy far, far away’, dat het verhaal vertelt over het verleden van de iconische smokkelaar.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018",
          rating: 3.8 
    },
     { titel: "Peter Rabbit", 
        beschrijving: "Verfilming van Beatrix Potter’s tijdloze verhaal over een eigenwijs konijn dat probeert de moestuin van een boer binnen te dringen.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018",
          rating: 3.2 
    },
        { titel: "JURRASIC WORLD: FALLEN KINGDOM", 
        beschrijving: "Welkom in Jurassic World: Fallen Kingdom! Favoriete personages keren terug in dit 3D actiespektakel.", 
        poster: "includes/images/jurassic world (2).jpg",
        release: "7-06-2018",
          rating: 4.6
    },
    { titel: "DEADPOOL 2", 
        beschrijving: "Na het overleven van een bijna fatale runder ­aanval, worstelt een misvormde cafetaria-kok (Wade Wilson) om zijn droom.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018",
          rating: 4.5
    },

    ];

const vandaagFilms = [
  { titel: "JURRASIC WORLD: FALLEN KINGDOM", 
        beschrijving: "Welkom in Jurassic World: Fallen Kingdom! Favoriete personages keren terug in dit 3D actiespektakel.", 
        poster: "includes/images/jurassic world (2).jpg",
        release: "7-06-2018",
          rating: 4.6
        
    },
      { titel: "DEADPOOL 2", 
        beschrijving: "Na het overleven van een bijna fatale runder ­aanval, worstelt een misvormde cafetaria-kok (Wade Wilson) om zijn droom.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018",
          rating: 4.5
    },
 { titel: "Solo: A Star Wars Story", 
        beschrijving: "Een compleet nieuw avontuur uit een ‘galaxy far, far away’, dat het verhaal vertelt over het verleden van de iconische smokkelaar.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018",
          rating: 3.8 
    },
      { titel: "Peter Rabbit", 
        beschrijving: "Verfilming van Beatrix Potter’s tijdloze verhaal over een eigenwijs konijn dat probeert de moestuin van een boer binnen te dringen.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018",
          rating: 3.2 
    },
    { titel: "DEADPOOL 2", 
        beschrijving: "Na het overleven van een bijna fatale runder ­aanval, worstelt een misvormde cafetaria-kok (Wade Wilson) om zijn droom.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018",
          rating: 4.5
    },
];

// nieuw array CATEGORIE films
    const categorieFilms = [
   { titel: "JURRASIC WORLD: FALLEN KINGDOM", 
        beschrijving: "Welkom in Jurassic World: Fallen Kingdom! Favoriete personages keren terug in dit 3D actiespektakel.", 
        poster: "includes/images/jurassic world (2).jpg",
        release: "7-06-2018",
          rating: 4.6
        
    },
    { titel: "DEADPOOL 2", 
        beschrijving: "Na het overleven van een bijna fatale runder ­aanval, worstelt een misvormde cafetaria-kok (Wade Wilson) om zijn droom.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018",
          rating: 4.5
    },
    { titel: "Film Titel 3", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018",
          rating: 3.8 
    },
    { titel: "Film Titel 4", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018",
          rating: 3.2 
    },
    { titel: "Film Titel 5", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "17-05-2018",
          rating: 3.8
    },
    { titel: "Film Titel 6", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018",
          rating: 3.2 
    },
   
    ];

function renderCards(array, containerId) {
  const container = document.getElementById(containerId);
  container.innerHTML = "";
  array.forEach(film => {
    const card = document.createElement("div");
    card.classList.add("card");
    card.innerHTML = `
      <img src="${film.poster}" alt="Film Poster">
      <div class="info">
        <h3>${film.titel}</h3>
        <p class="release">Release: ${film.release}</p>
        <p>${film.beschrijving}</p>
        <button>Meer info & tickets</button>
      </div>
    `;
    container.appendChild(card);
  });
}


function renderCards(array, containerId) {
  const container = document.getElementById(containerId);
  container.innerHTML = "";
  array.forEach(film => {
    const card = document.createElement("div");
    card.classList.add("card");
    card.innerHTML = `
      <img src="${film.poster}" alt="Film Poster">
      <div class="info">
        <h3>${film.titel}</h3>
        <div class="stars">${createStars(film.rating || 0)}</div>
        <p class="release">Release: ${film.release}</p>
        <p>${film.beschrijving}</p>
        <button>Meer info & tickets</button>
      </div>
    `;
    container.appendChild(card);
  });
}


//Categorie dropdown knop
function toggleDropdown() {
  const menu = document.getElementById("dropdown-menu");
  const btn = document.querySelector(".dropdown-btn");
  menu.classList.toggle("show");
  btn.classList.toggle("active");
}

// Sluit menu als je buiten klikt
window.onclick = function(event) {
  if (!event.target.closest('.dropdown')) {
    document.getElementById("dropdown-menu").classList.remove("show");
    document.querySelector(".dropdown-btn").classList.remove("active");
  }
}




    // Tabs switchen
    function openTab(tabId) {
      document.querySelectorAll('.cards').forEach(el => el.classList.remove('active'));
      document.querySelectorAll('.menu button').forEach(el => el.classList.remove('active'));
      document.getElementById(tabId).classList.add('active');
      event.target.classList.add('active');
    }

    // Bij laden alles vullen
    renderCards(films, "films");
    renderCards(weekFilms, "week");
    renderCards(vandaagFilms, "vandaag");
    renderCards(categorieFilms, "categorie");


function createStars(rating) {
  const stars = [];
  const fullStars = Math.floor(rating); // aantal volle sterren
  const halfStar = rating % 1 >= 0.25 && rating % 1 <= 0.75; // check halve ster
  const totalStars = 5;

  for (let i = 0; i < fullStars; i++) {
    stars.push('<span class="star full">★</span>');
  }

  if (halfStar) {
    stars.push('<span class="star half">★</span>');
  }

  while (stars.length < totalStars) {
    stars.push('<span class="star">★</span>');
  }

  return stars.join('');
}




  </script>

<div class="bkf-footer">
  <button onclick="openTab('films')">Bekijk alle films</button>
</div>


</body>
</html>
