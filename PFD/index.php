<?php
session_start();
// Product data (in a real project, use a database)
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
// Add to cart logic
if (isset($_GET['add_to_cart'])) {
    $id = intval($_GET['add_to_cart']);
    if (isset($products[$id])) {
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
        $_SESSION['cart'][] = $id;
    }
    header('Location: index.php');
    exit();
}
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>flowers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="flowers.css">
</head>
<body>
<header>
    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>
    <a href="#" class="logo">flowers <span>.</span></a>
    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#products">products</a>
        <a href="#review">review</a>
        <a href="#contact">contact</a>
    </nav>
    <div class="icons">
        <a href="#" class="fas fa-heart"></a>
        <a href="cart.php" class="fas fa-shopping-cart"></a>
        <span style="color: var(--pink); font-weight: bold; position: relative; top: -10px; left: -10px; background: #fff; border-radius: 50%; padding: 2px 8px; font-size: 1.3rem;">
            <?php echo $cart_count; ?>
        </span>
        <a href="#" class="fas fa-user"></a>
    </div>
</header>
<!--home section start -->
<section class="home" id="home">
    <div class="content">
        <h3>fresh flowers</h3>
        <span>natural & beautiful flowers</span>
        <p>lorem ipsum dolor sit amet consectetur adipisicing elit. beatae laborum ut minus corrupti dolorum dolore assumenda iste voluptate dolorem pariatur.</p>
        <a href="#products" class="btn">shop now</a>
    </div>
</section>
<!--home section ends -->
<!-- products section starts-->
<section class="products" id="products">
    <h1 class="heading">latest <span>products</span></h1>
    <div class="box-container">
        <?php foreach ($products as $id => $prod): ?>
        <div class="box">
            <span class="discount">-<?= $prod['discount'] ?>%</span>
            <div class="image">
                <img src="<?= htmlspecialchars($prod['img']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="?add_to_cart=<?= $id ?>" class="cart-btn">add to cart</a>
                    <a href="#" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3><?= htmlspecialchars($prod['name']) ?></h3>
                <div class="price"><?= $prod['price'] ?>dh <span><?= $prod['old_price'] ?>dh</span></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<!-- products section ends-->
</body>
</html>
