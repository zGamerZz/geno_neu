<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
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
    $sql = "UPDATE vorbestellung SET Waffeln = Waffeln + $increment";


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