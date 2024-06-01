<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    echo 'Bitte zuerst <a href="login-register/login.php">einloggen</a>. Du wirst in 5 Sekunden zum Login weitergeleitet.';
    sleep(5);
    header('Location: ../login-register/index.html');
    exit;
}
?>



<?php
session_start();

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





if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $increment = $_POST['increment'];
    $sql = "UPDATE vorbestellung SET salzbrezel = salzbrezel + $increment";


    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Sie haben erfolgreich $increment Salzbrezel(n) vorbestellt";
    } else {
        $_SESSION['message'] = "Es gab einen Fehler bei ihrer Vorbestellung, bitte kontaktieren Sie den Kiosk!" . $conn->error;
    }

    header('Location: ../index.php');
    exit;

} else {
    echo "No post data received";
}






$conn->close();