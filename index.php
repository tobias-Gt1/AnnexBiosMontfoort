<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=p, initial-scale=1.0">
    <title>INDEX</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="fotos/logo_hoofd.png">
    <link rel="icon" type="image/png" href="fotos/header_afbeelding.png">
    <link rel="icon" type="image/png" href="fotos/maps.png">
    <link rel="icon" type="image/png" href="fotos/Tiv.png">
</head>
<body class="index-page">
    <div class="background-image"></div>
    <header>
        <?php include 'includes/header.php'; ?>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="title">WELKOM BIJ ANNEXBIOS 5</h1>
            <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum recusandae nemo necessitatibus sit est eos impedit placeat facere voluptate unde. Laudantium inventore sequi tempore sed voluptatibus eum fugit vero veniam!</p>
            <button class="button">BEKIJK DE DRAAIENDE FILMS</button>
        </div>
    </section>

    <!-- Contact en locatie Section-->
    <section class="contact-section">
        <div class="container">
            <div class="contact-content">
                <div class="contact-left">
                    <div class="map-container">
                        <img src="fotos/maps.png" alt="Locatie Kaart" class="map-image">
                    </div>
                    <div class="contact-info">
                        <div class="contact-details">
                            <div class="contact-item">
                                <span class="contact-icon">📍</span>
                                <div>
                                    <strong>Rijksstraatweg 42</strong><br>
                                    <span>3223 KA Hellevoetsluis</span>
                                </div>
                            </div>
                            <div class="contact-item">
                                <span class="contact-icon">📞</span>
                                <span>020-12345678</span>
                            </div>
                        </div>
                        <div class="opening-hours">
                            <h3>BEREIKBAARHEID</h3>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="contact-right">
                    <img src="fotos/Tiv.png" alt="Tivoli Theater" class="theater-image">
                </div>
            </div>
        </div>
    </section>
</body>
</html>
