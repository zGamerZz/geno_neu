<?php
// Verbindung zur Datenbank herstellen
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "geno";

$conn = new mysqli($servername, $username, $password, $dbname);


// Überprüfen Sie die Verbindung
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Angenommen, Sie haben eine Variable $productTitle, die den Titel des Produkts enthält
$productTitle = 'Schokolade';

// SQL-Abfrage vorbereiten
$sql = "SELECT title FROM products WHERE title = ?";

// Statement vorbereiten
$stmt = $conn->prepare($sql);

// Parameter binden
$stmt->bind_param('s', $productTitle);

// Statement ausführen
$stmt->execute();

// Ergebnis holen
$result = $stmt->get_result();

// Überprüfen, ob das Produkt existiert
if ($result->num_rows > 0) {
    // Produkt existiert, also aktualisieren wir die Anzahl
    $increment = $_POST['increment'];
    $sqlUpdate = "UPDATE vorbestellung SET $productTitle = $productTitle + $increment";
    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Product does not exist!";
}

}
// Verbindung schließen
$conn->close();
?>





<?php
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $increment = $_POST['increment'];
    $column = '';

    switch ($product['title']) {
        case 'Schokolade':
            $column = 'Schokolade';
            
            break;
        case 'Salzbretzel':
            $column = 'salzbretzel';
            break;
        



        default:
            $_SESSION['message'] = "Ungültiger Produkt-Titel: " . $product['title'];
            header('Location: index.php');
            exit;
    }

    $sql = "UPDATE vorbestellung SET $column = $column + ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $increment);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Sie haben erfolgreich $increment  " . $product['title'] . " vorbestellt";
    } else {
        $_SESSION['message'] = "Error updating record: " . $conn->error;
    }

    header('Location: index.php');
    exit;

} else {
    echo "No post data received";
}
$conn->close();
*/


?>
