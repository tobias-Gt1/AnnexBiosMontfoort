<?php
session_start();
?>

<?php
include("connection.inc.php");

if (isset($_POST['bestellen'])) {
    $stoelen = $_POST['selectedSeats'];
    $stoelenArray = explode(",", $stoelen);


    function seatToChairId($seatString)
    {
        $rowLetter = substr($seatString, 0, 1);
        $seatNumber = intval(substr($seatString, 1)); 
        $rowIndex = ord($rowLetter) - 64; 
        return ($rowIndex - 1) * 11 + $seatNumber; 
    }

    $normalCount = intval($_POST['normal'] ?? 0);
    $childCount = intval($_POST['child'] ?? 0);
    $seniorCount = intval($_POST['senior'] ?? 0);
    $totalTickets = $normalCount + $childCount + $seniorCount;

    $name = ($_POST['voornaam']);
    $last_name = ($_POST['achternaam']);
    $email = ($_POST['email']);


    $sql = "INSERT INTO reservation (ticket_amount, email, name, last_name) VALUES (?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "isss", $totalTickets, $email, $name, $last_name);
    mysqli_stmt_execute($stmt);
    $reservation_id = mysqli_insert_id($conn);
    foreach ($stoelenArray as $index => $seatString) {
        $chair_id = seatToChairId($seatString);
        $room_id = 1;

        if ($index < $normalCount) {
            $ticket_type = "normal";
        } elseif ($index < $normalCount + $childCount) {
            $ticket_type = "child";
        } else {
            $ticket_type = "senior";
        }

        $sql = "INSERT INTO ticket (reservation_id, ticket_type, room_id, chair_id) VALUES (?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssii", $reservation_id, $ticket_type, $room_id, $chair_id);
        mysqli_stmt_execute($stmt);
    }
    mysqli_close($conn);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assetsRobbin/css/bestel.css" defer>
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
        <?php
        include("connection.inc.php");
        $takenStoelen = [];
        $sql = "SELECT chair_id FROM ticket";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        ?>
        <div class="date">
            <h1 style="background-color: white; font-size: 50px; padding: 20px">TICKETS BESTELLEN</h1>
            <p class="filmName">FILM NAAM</p>
            <div class="datePicker">
                <div class="options">
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
                <div class="poster">
                    <div>poster</div>
                </div>
            </div>
            <script>
                const dagen = 10;
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
        <form id="myForm" action="" method="POST">
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
                            <span class="aantal"> <input name="normal" type="number" style="width: 50px;" value="0" min="0"></span>
                    </div>
                    <div class="ticket-row">
                        <span>Kind t/m 11 jaar</span>
                        <span>
                            <span>€5,00</span>
                            <span class="aantal"> <input name="child" type="number" style="width: 50px;" value="0" min="0"></span>
                    </div>
                    <div class="ticket-row">
                        <span>65 +</span>
                        <span>
                            <span>€7,00</span>
                            <span class="aantal"> <input name="senior" type="number" style="width: 50px;" value="0" min="0"></span>
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
                    <p><strong>Totaal tickets:</strong> <span id="totalChairs">0</span>/<span id="totalTickets">0</span></p>
                    <hr style="border: 4px solid rgb(69, 150, 186); width: 60%;">
                    <h2 style="text-align: center; color: rgb(69, 150, 186);">FILMDOEK</h2>
                    <div class="room">
                        <?php
                        for ($j = 1; $j <= 10; $j++) {
                            for ($i = 1; $i <= 11; $i++) {
                                $row = chr(64 + $j);
                                $seat = $i;
                                $currentSeat = (($j - 1) * 11) + $i;

                                // Check of deze stoel bezet is
                                if (in_array($currentSeat, $takenStoelen)) {
                                    $class = "chair taken"; // stoel bezet
                                } else {
                                    $class = "chair"; // stoel vrij
                                }

                                echo "<div class='$class' data-row='$row' data-seat='$seat' data-seat-id='$currentSeat'>
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

                    <input name="selectedSeats" id="selectedSeatsInput" value="0">

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
                <div class="background-image"></div>

                <!-- Centrale zwarte overlay voor bestelformulier -->
                <div class="center-overlay"></div>

                <div class="booking-container">
                    <!-- Stap 3: Controleer je bestelling -->
                    <h2 class="step-title">STAP 3: CONTROLEER JE BESTELLING</h2>

                    <div class="movie-details">
                        <div class="movie-poster">
                            <img src="fotos/" alt="film poster">
                        </div>

                        <div class="movie-info">
                            <h3 class="movie-title">Jplaceholder</h3>
                            <div class="movie-details-info">
                                <p><strong>Bioscoop:</strong> Montfoort (Zaal 3)</p>
                                <p><strong>Wanneer:</strong> 11 September 14:15</p>
                                <p><strong>Stoelen:</strong> <span id="chairCheck"></span> </p>
                                <p><strong>Tickets:</strong> <span id="ticketCheck"></span></p>
                            </div>

                            <div class="total-price">
                                <p><strong> Prijs: <span id="totalPrice"></span> </strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- Stap 4: Vul je gegevens in -->
                    <h2 class="step-title">STAP 4: VUL JE GEGEVENS IN</h2>

                    <!-- <form class="booking-form"> -->
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" id="voornaam" name="voornaam" placeholder="Voornaam*" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="achternaam" name="achternaam" placeholder="Achternaam*" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="E-mailadres*" required>
                    </div>

                    <div class="form-group">
                        <input type="email" id="email-confirm" name="email-confirm" placeholder="2de E-mailadres*" required>
                    </div>

                    <!-- Stap 5: Kies je betaalwijze -->
                    <h2 class="step-title">STAP 5: KIES JE BETAALWIJZE</h2>

                    <div class="payment-options">
                        <div class="payment-option">
                            <input type="radio" id="bancontact" name="payment" value="bancontact">
                            <label for="bancontact" class="payment-label">
                                <img src="fotos/NBB_logo.png" alt="Bancontact" class="payment-icon">
                            </label>
                        </div>

                        <div class="payment-option">
                            <input type="radio" id="maestro" name="payment" value="maestro">
                            <label for="maestro" class="payment-label">
                                <img src="fotos/maestro1.png" alt="Maestro" class="payment-icon">
                            </label>
                        </div>

                        <div class="payment-option">
                            <input type="radio" id="ideal" name="payment" value="ideal">
                            <label for="ideal" class="payment-label">
                                <img src="fotos/IDEAL_Logo.png" alt="iDEAL" class="payment-icon">
                            </label>
                        </div>
                    </div>

                    <div class="terms-checkbox">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">Ik ga akkoord met de Algemene voorwaarden</label>
                    </div>
                    <button type="submit" name="bestellen" id="reserveer" class="checkout-button">AFREKENEN</button>
                </div>
            </div>
            <form action=""> </form>
    </main>
</body>

</html>