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
    $sql = "UPDATE vorbestellung SET Croissant = Croissant + $increment";


    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Record updated successfully";
    } else {
        $_SESSION['message'] = "Error updating record: " . $conn->error;
    }

    header('Location: ../index.php');
    exit;

} else {
    echo "No post data received";
}






$conn->close();