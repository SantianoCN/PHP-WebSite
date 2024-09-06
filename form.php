<?php 
    include 'dev/initialize.php';
    
    $loc = null;
    $products = Initialize::GetArray();
    $product = null;
    $basket_capacity = '';

    if (!isset($_GET['id'])){
        header('Location: /?');
    }

    for ($i = 0; $i < sizeof($products); $i++) {
        if ($products[$i]->id == $_GET["id"]) {
            $product = $products[$i];
            break;
        }
    }

    if (isset($_COOKIE['name'])){
        $loc = '?client=' . $_COOKIE['name'];
    }

    // Обработка ADD зпроса
    if (isset($_COOKIE['name'])){
        if (isset($_GET['action'])){
            if ($_GET['action'] == 'add'){
                if (isset($_GET['id'])){
                    session_start();
    
                    if (!isset($_SESSION[$_COOKIE['name']]['cart'])) {
                        $_SESSION[$_COOKIE['name']]['cart'] = array();
                    }
    
                    if (!isset($_SESSION[$_COOKIE['name']]['count'])){
                        $_SESSION[$_COOKIE['name']]['count'] = array();
                    }
                    
                    if (array_key_exists($_GET['id'], $_SESSION[$_COOKIE['name']]['count'])){
                        $_SESSION[$_COOKIE['name']]['count'][$product->id] += 1;
                    } else {
                        $_SESSION[$_COOKIE['name']]['cart'][] = $product->id;
                        $_SESSION[$_COOKIE['name']]['count'][$product->id] += 1;
                    }
                    
                    header('Location: /?client=' . $_COOKIE['name']);
                    exit();
                }
            }
        }
    }

    // Show basket
    session_start();

    if (isset($_GET['client'])){
        if (isset($_SESSION[$_GET['client']]['cart'])){
            $cartItems = $_SESSION[$_GET['client']]['cart'];
                $basket_capacity = sizeof($cartItems);
        }
    }
    // Session abort
    session_abort();
?>

<?php if ($product != null): ?>
    <!DOCTYPE html>
<html>
<head>
    <link href="style.css" rel="stylesheet">
    <link href="icons/icon.png" type="img/png" rel="shortcut icon">
    <title><?php echo $product->title?></title>
    <meta charset="utf-8">
</head>
<body>
    <header>
        <li><a href="/<?php echo $loc?>"><img src="icons/icon.png" height="30" width="30"></a></li>
        <li><a href="/about">О нас</a></li>
        <li class="last"><a href="/basket.php?<?php echo $loc?>">Корзина: <?php echo $basket_capacity ?></a></li>
    </header>

    <main>
        <div class="product-page">
            <div class="image-box">
                <img src="<?php echo $product->img; ?>" alt="<?php echo $product->title; ?>" class="product-image-home">
            </div>
            <div class="product-container">
                <h2><?php echo $product->title; ?></h2>
                <div class="description">
                    <p><?php echo $product->description?></p>
                </div>
                <div class="price-block">
                    <div class="column-1">
                        <img class="figure-like" src="icons/like.png" alt="В избранное" type="img/png">
                    </div>
                    <div class="column-2">
                        <p class="product-price"><?php echo $product->price; ?> руб.</p>
                    </div>
                    <div class="column-3">
                        <?php if (isset($_GET['client'])): ?>
                            <a href="form.php?id=<?php echo $_GET['id']?>&client=<?php echo $_GET['client']?>&action=add" id="addToCartButton" class="add-to-cart">Добавить в корзину</a>
                        <? else: ?>
                            <a href="signin/authorization.php" class="add-to-cart">Добавить в корзину</a>
                        <? endif ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>31.07.2024 "Книжное чудо ©" Все права защищены.</p>
    </footer>
</body>
</html>
<?php else: echo "Товар не найден" ?>
<?php endif ?>