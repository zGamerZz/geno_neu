


<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 3');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>




<div class="featured">
    <h2>Schloss und Riegel</h2>
    <p>Dein Snack!</p>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Beliebte Produkte</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['title']?>">
            <span class="name"><?=$product['title']?></span>
            <span class="price">
                &dollar;<?=$product['price']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&dollar;<?=$product['rrp']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>


<?php

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    // Nach dem Anzeigen der Nachricht, löschen Sie sie.
    unset($_SESSION['message']);
}
?>
