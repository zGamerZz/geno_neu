



<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'geno';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
// Template header, feel free to customize this
function template_header($title) {




// Get the number of items in the shopping cart, which will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Shopping Cart System</h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>
                </nav>
                <div class="link-icons">
                </div>
            </div>
        </header>
        <main>
EOT;
}
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year, Schloss&Riegel -- Schüler-Genossenschaft Schloss Gymnasium</p>
            </div>
        </footer>
    </body>
</html>
EOT;
}
?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Shopping Cart System</title>
        <link href="style.css" rel="stylesheet" type="text/css">

    </head>
<?php
if (isset($_SESSION['message'])) {
    echo '
    <label>
        <input type="checkbox" class="alertCheckbox" autocomplete="off" />
        <div class="alert notice">
            <span class="alertClose">X</span>
            <span class="alertText">' . $_SESSION['message'] . '</span>
        </div>
    </label>';
    unset($_SESSION['message']);
}
?>

</html>
