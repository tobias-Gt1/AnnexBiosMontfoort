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
        release: "7-06-2018"
    },
    { titel: "DEADPOOL 2", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 3", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018" 
    },
    { titel: "Film Titel 4", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    },
    { titel: "Film Titel 5", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 6", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    },
        { titel: "JURRASIC WORLD: FALLEN KINGDOM", 
        beschrijving: "Welkom in Jurassic World: Fallen Kingdom! Favoriete personages keren terug in dit 3D actiespektakel.", 
        poster: "includes/images/jurassic world (2).jpg",
        release: "7-06-2018"
    },
    { titel: "DEADPOOL 2", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 9", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018" 
    },
    { titel: "Film Titel 10", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    },
    { titel: "Film Titel 11", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 12", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    }
    ];


 // Nieuw array WEEK films
   const weekFilms = [
   { titel: "JURRASIC WORLD: FALLEN KINGDOM", 
        beschrijving: "Welkom in Jurassic World: Fallen Kingdom! Favoriete personages keren terug in dit 3D actiespektakel.", 
        poster: "includes/images/jurassic world (2).jpg",
        release: "7-06-2018"
    },
    { titel: "DEADPOOL 2", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 3", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018" 
    },
    { titel: "Film Titel 4", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    },
    { titel: "Film Titel 5", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 6", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    },
        { titel: "JURRASIC WORLD: FALLEN KINGDOM", 
        beschrijving: "Welkom in Jurassic World: Fallen Kingdom! Favoriete personages keren terug in dit 3D actiespektakel.", 
        poster: "includes/images/jurassic world (2).jpg",
        release: "7-06-2018"
    },
    { titel: "DEADPOOL 2", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 9", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018" 
    },
    { titel: "Film Titel 10", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    },
    { titel: "Film Titel 11", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 12", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    }
];


// nieuw array VANDAAG films
const vandaagFilms = [
  { titel: "JURRASIC WORLD: FALLEN KINGDOM", 
        beschrijving: "Welkom in Jurassic World: Fallen Kingdom! Favoriete personages keren terug in dit 3D actiespektakel.", 
        poster: "includes/images/jurassic world (2).jpg",
        release: "7-06-2018"
    },
    { titel: "DEADPOOL 2", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 3", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018" 
    },
    { titel: "Film Titel 4", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    },
    { titel: "Film Titel 5", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 6", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    },
        { titel: "JURRASIC WORLD: FALLEN KINGDOM", 
        beschrijving: "Welkom in Jurassic World: Fallen Kingdom! Favoriete personages keren terug in dit 3D actiespektakel.", 
        poster: "includes/images/jurassic world (2).jpg",
        release: "7-06-2018"
    },
    { titel: "DEADPOOL 2", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 9", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018" 
    },
    { titel: "Film Titel 10", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    },
    { titel: "Film Titel 11", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 12", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    }
]



// nieuw array CATEGORIE films
    const categorieFilms = [
   { titel: "JURRASIC WORLD: FALLEN KINGDOM", 
        beschrijving: "Welkom in Jurassic World: Fallen Kingdom! Favoriete personages keren terug in dit 3D actiespektakel.", 
        poster: "includes/images/jurassic world (2).jpg",
        release: "7-06-2018"
        
    },
    { titel: "DEADPOOL 2", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 3", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018" 
    },
    { titel: "Film Titel 4", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    },
    { titel: "Film Titel 5", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 6", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    },
        { titel: "JURRASIC WORLD: FALLEN KINGDOM", 
        beschrijving: "Welkom in Jurassic World: Fallen Kingdom! Favoriete personages keren terug in dit 3D actiespektakel.", 
        poster: "includes/images/jurassic world (2).jpg",
        release: "7-06-2018"
    },
    { titel: "DEADPOOL 2", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/deadpool 2.webp",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 9", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "23-05-2018" 
    },
    { titel: "Film Titel 10", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    },
    { titel: "Film Titel 11", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/SOLO.jpg",
        release: "17-05-2018" 
    },
    { titel: "Film Titel 12", 
        beschrijving: "Korte beschrijving van de film.", 
        poster: "includes/images/pieter.jpg",
        release: "28-03-2018" 
    }
    ];

function renderCards(array, containerId) {
  const container = document.getElementById(containerId);
  container.innerHTML = "";
  array.forEach((film, index) => {
    const card = document.createElement("div");
    card.classList.add("card");
    card.innerHTML = `
      <img src="${film.poster}" alt="Film Poster">
      <div class="info">
        <h3>${film.titel}</h3>
        <p class="release">Release: ${film.release}</p>
        <p>${film.beschrijving}</p>
        <a href="detail.php?id=${index + 1}" style="text-decoration: none;">
          <button>Meer info & tickets</button>
        </a>
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






  </script>

</body>
</html>
