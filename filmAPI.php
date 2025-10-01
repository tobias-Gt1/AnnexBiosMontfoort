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
            padding: 10px;
        }

        /* Menu */
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
        }

        .menu button.active {
            background-color: #4596BA;
            color: black;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.4);
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
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

        .info h3 {
            margin: 0 0 10px;
            font-size: 18px;
            color: #333;
        }

        .info p {
            font-size: 14px;
            margin: 0 0 10px;
            color: #333;
        }

        .release {
            font-size: 14px;
            font-weight: bold;
            color: #666;
            margin: 5px 0 10px;
        }

        .info button {
            margin-top: auto;
            background-color: #4a90e2;
            border: none;
            padding: 8px 12px;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            transition: 0.2s;
        }

        .info button:hover {
            background-color: #357ABD;
        }

        /* Sterren */
        .stars {
            display: inline-block;
            font-size: 18px;
            line-height: 1;
            position: relative;
            color: #ccc;
        }

        .stars::before {
            content: "★★★★★";
            letter-spacing: 2px;
        }

        .stars::after {
            content: "★★★★★";
            letter-spacing: 2px;
            position: absolute;
            top: 0;
            left: 0;
            width: var(--percent, 0%);
            overflow: hidden;
            color: gold;
        }

        /* Dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }

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

        .chevron {
            width: 14px;
            height: 14px;
            transition: transform 0.2s;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
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

        .dropdown-content.show {
            display: block;
        }

        .dropdown-btn.active .chevron {
            transform: rotate(180deg);
        }
    </style>
</head>

<body>

    <div class="header">FILM AGENDA</div>

    <div class="menu">
        <button class="active" onclick="openTab('films', event)"> Films</button>
        <button onclick="openTab('week', event)"> Deze Week</button>
        <button onclick="openTab('vandaag', event)"> Vandaag</button>
        <div class="dropdown">
            <button onclick="toggleDropdown()" class="dropdown-btn">
                Categorie
                <img src="includes/images/down-chevron.png" alt="pijl omlaag" class="chevron">
            </button>
            <div id="dropdown-menu" class="dropdown-content">
                <a href="#" onclick="filterCategorie('Actie')">Actie</a>
                <a href="#" onclick="filterCategorie('Komedie')">Komedie</a>
                <a href="#" onclick="filterCategorie('Drama')">Drama</a>
                <a href="#" onclick="filterCategorie('Familie')">Familie</a>
            </div>
        </div>
    </div>

    <!-- Containers -->
    <div id="films" class="cards active"></div>
    <div id="week" class="cards"></div>
    <div id="vandaag" class="cards"></div>
    <div id="categorie" class="cards"></div>

    <script>
        let allFilms = [];

        async function fetchFilms() {
            try {
                const response = await fetch("api.php"); // jouw proxy


                if (!response.ok) {
                    throw new Error("HTTP error " + response.status);
                }

                const data = await response.json();
                console.log("API data:", data);

                allFilms = data.data || [];

                // Initieel vullen
                renderCards(allFilms, "films");
                renderWeekFilms();
                renderVandaagFilms();

            } catch (error) {
                console.error("API fout:", error);
            }
        }

        function renderCards(array, containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = "";
            array.forEach((film, index) => {
                const card = document.createElement("div");
                card.classList.add("card");
                card.innerHTML = `
          <img src="${film.poster || film.image || 'includes/images/placeholder.jpg'}" alt="Film Poster">
          <div class="info">
            <h3>${film.titel || film.title}</h3>
            <p class="release">Release: ${film.release || film.release_date || "Onbekend"}</p>
            <p>${film.beschrijving || film.overview || "Geen beschrijving beschikbaar."}</p>
            <a href="detail.php?id=${film.id || index + 1}" style="text-decoration: none;">
              <button>Meer info & tickets</button>
            </a>
          </div>
        `; 
                container.appendChild(card);
            });
        }

        // Tabs wisselen
        function openTab(tabId, evt) {
            document.querySelectorAll('.cards').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.menu button').forEach(el => el.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
            evt.target.classList.add('active');
        }

        // Dropdown
        function toggleDropdown() {
            const menu = document.getElementById("dropdown-menu");
            const btn = document.querySelector(".dropdown-btn");
            menu.classList.toggle("show");
            btn.classList.toggle("active");
        }
        window.onclick = function(event) {
            if (!event.target.closest('.dropdown')) {
                document.getElementById("dropdown-menu").classList.remove("show");
                document.querySelector(".dropdown-btn").classList.remove("active");
            }
        }

        // Filter categorie
        function filterCategorie(cat) {
            openTab("categorie", {
                target: document.querySelector(".dropdown-btn")
            });
            const filtered = allFilms.filter(f => (f.categorie || f.genre || "").includes(cat));
            renderCards(filtered, "categorie");
            document.getElementById("dropdown-menu").classList.remove("show");
            document.querySelector(".dropdown-btn").classList.remove("active");
        }

        // Filter films van deze week
        function renderWeekFilms() {
            const now = new Date();
            const nextWeek = new Date();
            nextWeek.setDate(now.getDate() + 7);

            const filtered = allFilms.filter(f => {
                const release = new Date(f.release_date || f.release);
                return release >= now && release <= nextWeek;
            });

            renderCards(filtered, "week");
        }

        // Filter films van vandaag
        function renderVandaagFilms() {
            const today = new Date().toISOString().split("T")[0];
            const filtered = allFilms.filter(f => {
                const release = (f.release_date || f.release || "").split("T")[0];
                return release === today;
            });

            renderCards(filtered, "vandaag");
        }

        // Init call
        fetchFilms();
    </script>

</body>

</html>