<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bestel.css" defer>
    <script src="bestelpagina.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@
    0,100;0,300;0,400;0,700;0,900;
    1,100;1,300;1,400;1,700;1,900
  &display=swap"
        rel="stylesheet">

</head>

<body>
    <main>
        <div class="date">
            <h1 style="background-color: white; font-size: 50px; padding: 20px">TICKETS BESTELLEN</h1>
            <div class="datePicker">
                <p class="filmName">FILM NAAM</p>
                <div class="dates">
                </div>
                <div class="times">
                    <p class="toggleBtn">9:00</p>
                    <p class="toggleBtn">10:00</p>
                    <p class="toggleBtn">11:00</p>
                    <p class="toggleBtn">12:00</p>
                    <p class="toggleBtn">13:00</p>
                    <p class="toggleBtn">14:00</p>
                    <p class="toggleBtn">15:00</p>
                    <p class="toggleBtn">16:00</p>
                </div>
            </div>
            <script>
                const dagen = 7;
                const container = document.querySelector(".dates");
                const vandaag = new Date();

                for (let i = 0; i < dagen; i++) {
                    const datum = new Date(vandaag);
                    datum.setDate(vandaag.getDate() + i);

                    const opties = {
                        weekday: 'short',
                        day: 'numeric',
                        month: 'short'
                    };
                    let label = datum.toLocaleDateString('nl-NL', opties);
                    label = label.toUpperCase();
                    label = label.replace(/ /g, "<br>");
                    label = label.slice(0, 2) + "." + label.slice(2);

                    if (i === 0) label = "Vandaag";
                    if (i === 1) label = "Morgen";

                    // Maak een button voor elke datum
                    const btn = document.createElement("button");
                    btn.classList.add("toggleBtn");
                    btn.innerHTML = label;
                    btn.dataset.date = datum.toISOString().split("T")[0]; // opslaan als data attribuut
                    container.appendChild(btn);
                }
            </script>

            <script>
                const btns = document.querySelectorAll(".toggleBtn");
                btns.forEach(btn => {
                    btn.addEventListener("click", () => {
                        if (btn.classList.contains("active")) {
                            console.log("button pressed is active")
                            btns.forEach(b => b.classList.remove("active"));
                        } else {
                            console.log("button pressed is not active")
                            btns.forEach(b => b.classList.remove("active"));
                            btn.classList.add("active");
                        }
                    });
                });
            </script>
        </div>
        <div class="allSteps">
            <div class="step1">
                <h1>STAP 1: KIES JE TICKET</h1>
                <div style="display: flex; justify-content: space-between;">
                    <span>TYPE</span>
                    <span>
                        <span>PRIJS</span>
                        <span style="margin-left: 50px;">AANTAL</span>
                    </span>
                </div>


                <hr style="border: 1px solid gray;">

                <div class="ticket-row">
                    <span>Normaal</span>
                    <span>
                        <span>€9,00</span>
                        <span class="aantal"> <input type="number" style="width: 50px;" value="0" min="0"></span>
                </div>

                <div class="ticket-row">
                    <span>Kind t/m 11 jaar</span>
                    <span>
                        <span>€5,00</span>
                        <span class="aantal"> <input type="number" style="width: 50px;" value="0" min="0"></span>
                </div>

                <div class="ticket-row">
                    <span>65 +</span>
                    <span>
                        <span>€7,00</span>
                        <span class="aantal"> <input type="number" style="width: 50px;" value="0" min="0"></span>
                    </span>
                </div>

                <hr style="border: 1px solid gray;">
                <div style="display: flex; justify-content: space-between;">
                    <span>VOUCHERCODE</span>
                    <span>
                        <span>code</span>
                        <span style="margin-left: 50px;">TOEVOEGEN</span>
                    </span>
                </div>
            </div>
            <div class="step2">
                <h1 style="margin-right: auto;">STAP 2: KIES JE STOEL</h1>

                <hr style="border: 4px solid rgb(69, 150, 186); width: 60%;">
                <h2 style="text-align: center; color: rgb(69, 150, 186);">FILMDOEK</h2>
                <div class="room">
                    <?php
                    for ($j = 1; $j <= 10; $j++) {
                        for ($i = 1; $i <= 11; $i++) {
                            $row = chr(64 + $j);
                            $seat = $i;
                            echo "<div class='chair' data-row='$row' data-seat='$seat'>
                                <div class='seat'></div>
                            </div>";
                        }
                    }
                    ?>
                </div>
                <div class="colors">
                    <p style="background-color: rgb(69, 150, 186); margin-right: auto;">VRIJ</p>
                    <p style="background-color: rgb(34, 84, 101);">BEZET</p>
                    <p style="background-color: rgb(70, 145, 171); margin-left: auto;">JOUW SELECTIE</p>
                </div>


                <div class="rating"></div>

                <script>
                    const rating = 4.0; // je rating
                    const ratingContainer = document.querySelector(".rating");

                    for (let i = 1; i <= 5; i++) {
                        const star = document.createElement("span");

                        if (i <= Math.floor(rating)) {
                            star.classList.add("fa", "fa-star"); // volle ster
                        } else if (i === Math.ceil(rating)) {
                            star.classList.add("fa", "fa-star-half-o"); // halve ster
                        } else {
                            star.classList.add("fa", "fa-star-o"); // lege ster
                        }

                        star.style.color = "rgb(69, 151, 186)"; // kleur
                        star.style.fontSize = "32px"; // groter
                        ratingContainer.appendChild(star);
                    }
                </script>

            </div>
    </main>
</body>

</html>