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
    $sql = "UPDATE vorbestellung SET Käsebrot = Käsebrot + $increment";


    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Sie haben erfolgreich $increment Käsebrot(e) vorbestellt";
    } else {
        $_SESSION['message'] = "Es gab einen Fehler bei ihrer Vorbestellung, bitte kontaktieren Sie den Kiosk!" . $conn->error;
    }

    header('Location: ../index.php');
    exit;

} else {
    echo "No post data received";
}






$conn->close();