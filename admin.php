<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passwortgeschützte Seite</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class="container">

  <!--  ################################# Code ######################################## -->
    <?php
    // Definiere das 4-stellige Passwort
    $passwort = '1234';

    // Funktion zur Anzeige des Passwort-Formulars
    function zeige_passwort_formular($fehlermeldung = '') {
        echo '<form method="post">';
        if ($fehlermeldung != '') {
            echo '<p class="error">' . $fehlermeldung . '</p>';
        }
        echo 'Passwort: <input type="number" name="passwort" min="1000" max="9999" required />';
        echo '<input type="submit" value="Login" />';
        echo '</form>';
    }

    // Überprüfe, ob das Passwort gesendet wurde
    if (isset($_POST['passwort'])) {
        // Überprüfe, ob das eingegebene Passwort korrekt ist
        if ($_POST['passwort'] == $passwort) {
            // Setze eine Sitzung, um zu markieren, dass der Benutzer eingeloggt ist
            session_start();
            $_SESSION['eingeloggt'] = true;
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            // Falsches Passwort
            zeige_passwort_formular('Falsches Passwort. Bitte versuche es erneut.');
        }
    } else {
        // Überprüfe, ob die Sitzung gesetzt ist
        session_start();
        if (isset($_SESSION['eingeloggt']) && $_SESSION['eingeloggt'] === true) {
            // Geschützter Bereich
            echo '<h1>Willkommen auf der geschützten Seite!</h1>';
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "geno";

// Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM vorbestellung";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "Brezel: " . $row["Brezel"]. "<br>";
                    echo "Waffeln: " . $row["Waffeln"]. "<br>";
                    echo "Schokolade: " . $row["Schokolade"]. "<br>";
                    echo "Käsebrötchen " . $row["Käsebrot"]. "<br>";
                    echo "Croissant: " . $row["Croissant"]. "<br>";
                    echo "Schokobrötchen: " . $row["Schokobrot"]. "<br>";
                    echo "Starterpack" . $row["Starterpack"]. "<br>";
                    echo "StarterpackPremium: " . $row["StarterpackPremium"]. "<br>";

                }
            } else {
                echo "Keine Vorbestellungen vorhanden.";
            }
            //  ################################# Code ########################################

        } else {
            // Zeige das Passwort-Formular
            zeige_passwort_formular();
        }
    }

    $conn->close();
    ?>
</div>
</body>
</html>
