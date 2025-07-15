<?php
session_start();
$products = [
    1 => ["name" => "Mauve Roses", "price" => 250, "discount" => 10, "old_price" => 225, "img" => "ph.10 2.png"],
    2 => ["name" => "Red Roses", "price" => 280, "discount" => 20, "old_price" => 224, "img" => "ph 11.jpg"],
    3 => ["name" => "Pink Roses", "price" => 260, "discount" => 5, "old_price" => 247, "img" => "ph12 2.png"],
    4 => ["name" => "White Roses", "price" => 140, "discount" => 5, "old_price" => 133, "img" => "ph 13 2.png"],
    5 => ["name" => "Pink Lilies", "price" => 290, "discount" => 3, "old_price" => 281, "img" => "ph 14 2.png"],
    6 => ["name" => "Orange Lilies", "price" => 250, "discount" => 10, "old_price" => 225, "img" => "ph15 2.png"],
    7 => ["name" => "Sunshine Blooms", "price" => 200, "discount" => 25, "old_price" => 150, "img" => "ph16 2.png"],
    8 => ["name" => "Red & White Roses", "price" => 450, "discount" => 5, "old_price" => 427, "img" => "ph7.jpg"],
    9 => ["name" => "Colorful Roses", "price" => 450, "discount" => 10, "old_price" => 427, "img" => "ph18 2.png"],
];
// Remove from cart logic
if (isset($_GET['remove'])) {
    $remove_id = intval($_GET['remove']);
    if (isset($_SESSION['cart'])) {
        // Remove only one occurrence
        $key = array_search($remove_id, $_SESSION['cart']);
        if ($key !== false) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }
    header('Location: cart.php');
    exit();
}
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
// Count quantities
$cart_quantities = array_count_values($cart);
$cart_items = [];
foreach ($cart_quantities as $id => $qty) {
    if (isset($products[$id])) {
        $cart_items[] = [
            'id' => $id,
            'qty' => $qty,
            'product' => $products[$id]
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="flowers.css">
</head>
<body>
    <header>
        <a href="index.php" class="btn">Back to Shop</a>
        <h2 style="display:inline-block; margin-left:2rem;">Your Cart</h2>
    </header>
    <section class="products" id="cart">
        <div class="box-container">
            <?php if (count($cart_items) === 0): ?>
                <p style="font-size:2rem; color:#c00070;">Your cart is empty.</p>
            <?php else: ?>
                <?php foreach ($cart_items as $item): ?>
                    <div class="box">
                        <span class="discount">-<?= $item['product']['discount'] ?>%</span>
                        <div class="image">
                            <img src="<?= htmlspecialchars($item['product']['img']) ?>" alt="<?= htmlspecialchars($item['product']['name']) ?>">
                        </div>
                        <div class="content">
                            <h3><?= htmlspecialchars($item['product']['name']) ?></h3>
                            <div class="price">
                                <?= $item['product']['price'] ?>dh <span><?= $item['product']['old_price'] ?>dh</span>
                            </div>
                            <div style="margin-top:0.5rem; font-size:1.3rem;">
                                Quantity: <?= $item['qty'] ?>
                                <a href="?remove=<?= $item['id'] ?>" style="color:#c00070; margin-left:1rem; text-decoration:underline; font-size:1.1rem;">Remove one</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
