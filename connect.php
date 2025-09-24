<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="fotos/favicon.ico">

    <title>Connect</title>
</head>
<body>
    <h1>Connect to Database</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "annexbios";
    // maak verbinding
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check verbinding
    if ($conn->connect_error) {
        die("Verbinding mislukt: " . $conn->connect_error);
    }
    echo "Verbinding succesvol";
    $conn->close();
    ?>

    
</body>
</html>