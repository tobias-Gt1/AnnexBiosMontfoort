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
      font-size: 32px;
      font-weight: bold;
      color: #4a90e2;
      margin: 20px;
    }

    /* Menu balk */
    .menu {
      display: flex;
      gap: 15px;
      margin: 0 20px 30px;
    }

    .menu button {
      background-color: #f2f6fc;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: 0.2s;
    }

    .menu button.active {
      background-color: #4a90e2;
      color: white;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.4);
    }

    .cards {
      display: none; /* verborgen standaard */
      gap: 20px;
      margin: 0 20px;
      flex-wrap: wrap;
    }

    .cards.active {
      display: flex; /* alleen actieve tab zichtbaar */
    }

    .card {
      background-color: white;
      color: black;
      width: 250px;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    .card img {
      width: 100%;
      height: 350px;
      object-fit: cover;
    }

    .card .info {
      padding: 15px;
    }

    .card .info h3 {
      margin: 0 0 10px;
      font-size: 18px;
    }

    .card .info p {
      font-size: 14px;
      color: #333;
    }

    .card .info button {
      margin-top: 10px;
      background-color: #4a90e2;
      border: none;
      padding: 8px 12px;
      border-radius: 6px;
      color: white;
      cursor: pointer;
    }

    .card .info button:hover {
      background-color: #357ABD;
    }
  </style>
</head>
<body>

  <div class="header">FILM AGENDA</div>

  <div class="menu">
    <button class="active" onclick="openTab('films')">🎬 Films</button>
    <button onclick="openTab('week')">📅 Deze Week</button>
    <button onclick="openTab('vandaag')">📅 Vandaag</button>
    <button onclick="openTab('categorie')">🎭 Categorie 🔽 </button>
  </div>

  <!-- Films -->
  <div id="films" class="cards active">
    <div class="card">
      <img src="images/Jurassic world.jpg" alt="Film Poster">
      <div class="info">
        <h3>Film Titel 1</h3>
        <p>Korte beschrijving van de film.</p>
        <button>Meer info</button>
      </div>
    </div>
    <div class="card">
      <img src="https://via.placeholder.com/250x350" alt="Film Poster">
      <div class="info">
        <h3>Film Titel 2</h3>
        <p>Korte beschrijving van de film.</p>
        <button>Meer info</button>
      </div>
    </div>
  </div>

  <!-- Deze week -->
  <div id="week" class="cards">
    <div class="card">
      <img src="https://via.placeholder.com/250x350" alt="Film Poster">
      <div class="info">
        <h3>Week Film 1</h3>
        <p>Film die deze week draait.</p>
        <button>Meer info</button>
      </div>
    </div>
  </div>

  <!-- Vandaag -->
  <div id="vandaag" class="cards">
    <div class="card">
      <img src="https://via.placeholder.com/250x350" alt="Film Poster">
      <div class="info">
        <h3>Vandaag Film</h3>
        <p>Film die vandaag draait.</p>
        <button>Meer info</button>
      </div>
    </div>
  </div>

  <!-- Categorie-->
  <div id="categorie" class="cards">
    <div class="card">
      <img src="https://via.placeholder.com/250x350" alt="Film Poster">
      <div class="info">
        <h3>Actie Film</h3>
        <p>Beschrijving van categorie film.</p>
        <button>Meer info</button>
      </div>
    </div>
  </div>

  <script>
    function openTab(tabId) {
      // verberg alle tabbladen
      document.querySelectorAll('.cards').forEach(el => el.classList.remove('active'));
      // haal active class van knoppen
      document.querySelectorAll('.menu button').forEach(el => el.classList.remove('active'));
      // toon gekozen tab
      document.getElementById(tabId).classList.add('active');
      // highlight juiste knop
      event.target.classList.add('active');
    }
  </script>

</body>
</html>
