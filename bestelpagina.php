<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bestel.css">
    <script src="bestelpagina.js" defer></script>
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
                    for ($i = 1; $i <= 110; $i++) {
                        // maak een unieke stoel-ID, bijvoorbeeld S1, S2, S3...
                        $seatId = "S" . $i;
                        echo '<div class="chair" id="' . $seatId . '">
                            <div class="seat"></div>
                        </div>';
                    }
                    ?>
                </div>
                <div class="colors">
                    <p style="background-color: rgb(69, 150, 186); margin-right: auto;">VRIJ</p> 
                    <p style="background-color: rgb(34, 84, 101); margin-center: auto;">BEZET</p>
                    <p style="background-color: rgb(70, 145, 171); margin-left: auto;">JOUW SELECTIE</p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>