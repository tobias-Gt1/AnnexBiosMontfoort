<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestel Tickets - AnnexBios</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="fotos/logo_hoofd.png">
</head>
<body>
    <div class="background-image"></div>
    
    <!-- Centrale zwarte overlay voor bestelformulier -->
    <div class="center-overlay"></div>
    
    <div class="booking-container">
        <!-- Stap 3: Controleer je bestelling -->
        <section class="booking-step">
            <h2 class="step-title">STAP 3: CONTROLEER JE BESTELLING</h2>
            
            <div class="movie-details">
                <div class="movie-poster">
                    <img src="fotos/" alt="film poster">
                </div>
                
                <div class="movie-info">
                    <h3 class="movie-title">Jplaceholder</h3>
                    
                    <!-- <div class="movie-ratings">
                        <span class="rating-12">12</span>
                        <span class="rating-icon">👁️</span>
                        <span class="rating-icon">⚠️</span>
                    </div> -->
                    
                    <div class="movie-details-info">
                        <p><strong>Bioscoop:</strong> Hellevoetsluis (Zaal 3)</p>
                        <p><strong>Wanneer:</strong> 11 juni 14:15</p>
                        <p><strong>Stoelen:</strong> Rij 2, stoel 7</p>
                        <p><strong>Tickets:</strong> 1x normaal</p>
                    </div>
                    
                    <div class="total-price">
                        <p><strong>Totaal 1 ticket: €9,00</strong></p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Stap 4: Vul je gegevens in -->
        <section class="booking-step">
            <h2 class="step-title">STAP 4: VUL JE GEGEVENS IN</h2>
            
            <div class="form-container">
                <form class="booking-form">
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
                </form>
            </div>
        </section>
        
        <!-- Stap 5: Kies je betaalwijze -->
        <section class="booking-step">
            <h2 class="step-title">STAP 5: KIES JE BETAALWIJZE</h2>
            
            <div class="payment-container">
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
            </div>
        </section>
        
        <!-- Afrekenen knop -->
        <div class="checkout-section">
            <button type="submit" class="checkout-button">AFREKENEN</button>
        </div>
    </div>



</body>
</html>