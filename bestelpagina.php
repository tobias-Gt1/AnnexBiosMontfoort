<?php
// start de sessie
session_start();
?>

<?php
include("connection.inc.php");

if (isset($_POST['bestellen'])) {
    // Tickets

    // Voucher
    // $voucher = $_POST['voucher_code'] ?? '';

    // Stoelen
    $stoelen = $_POST['selectedSeats'];
    $stoelenArray = explode(",", $stoelen);


    function seatToChairId($seatString)
    {
        $rowLetter = substr($seatString, 0, 1); // "A"
        $seatNumber = intval(substr($seatString, 1)); // "1" → 1
        $rowIndex = ord($rowLetter) - 64; // "A" → 1, "B" → 2, etc.
        return ($rowIndex - 1) * 11 + $seatNumber; // jouw chair.id
    }


    $normalCount = intval($_POST['normal'] ?? 0);
    $childCount = intval($_POST['child'] ?? 0);
    $seniorCount = intval($_POST['senior'] ?? 0);
    $totalTickets = $normalCount + $childCount + $seniorCount;
    
    $email = "test@test.com";
    $name = "Test";
    $last_name = "Gebruiker";
    // 1. Voeg reservering toe
    $sql = "INSERT INTO reservation (ticket_amount, email, name, last_name) VALUES (?,?,?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    // Hier zou je echte klantgegevens moeten invoeren of uit sessie halen
    mysqli_stmt_bind_param($stmt, "isss", $totalTickets, $email, $name, $last_name);
    mysqli_stmt_execute($stmt);
    $reservation_id = mysqli_insert_id($conn);
    // 2. Voeg tickets toe
    echo " Dit is een test";
    // echo ". $stoelenArray . ";
    // voorbeeld uit POST
    // echo '??????????????????????????????????????????////';
    // var_dump($normalCount, $childCount, $seniorCount);
    // echo '?????????---???';
    // var_dump($stoelen);
    // var_dump($stoelenArray);
    // echo 'hihihi';
    // exit;

    // Voorbeeld: stoelen matchen met types
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



    echo "Reservering succesvol!";
}
?>



<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include(__DIR__ . "/connection.inc.php");

if ($conn) {
    echo "Verbinding werkt!";
} else {
    echo "Verbinding mislukt: " . mysqli_connect_error();
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

        $sql = "SELECT id, ticket_amount, email, last_name FROM ticket ORDER BY id ASC";
        $sql = "SELECT * FROM ticket";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product">
            <p>' . ($row["id"]) . ' </p>
            <p>' . ($row["reservation_id"]) . ' </p>
            <p>' . ($row["ticket_type"]) . ' </p>
            <p>' . ($row["chair_id"]) . ' </p>
            </div>';
            }
        } else {
            echo "0 results";
        }
        echo '-------------------------';
        $takenStoelen = [];
        $sql = "SELECT chair_id FROM ticket";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $takenStoelen[] = $row['chair_id'];
                echo  '<p>' . ($row["chair_id"]) . ' </p>';
            }
        }

        // Zet de array om naar JS
        echo "<script>const takenSeats = " . json_encode($takenStoelen) . ";</script>";
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
                    <button type="submit" name="bestellen" id="reserveer" onclick="console.log($selectedSeats)">Reserveer</button>
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
            </div>
            <form action=""> </form>
    </main>
</body>

</html>