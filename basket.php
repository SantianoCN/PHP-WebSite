<?php
    include 'dev/initialize.php';
    
    
    $products = Initialize::GetArray();

    $loc = null;
    $basket = [];
    $sorted = [];
    $sum = 0;

    $status = null;

    // Проверка входа
    if (isset($_COOKIE['name'])){
        $loc = 'client=' . $_COOKIE['name'] . '&';
    } else header('Location: /signin/authorization.php');

    // Обработка ADD запроса
    if (isset($_GET['add'])){
        session_start();
        if (isset($_SESSION[$_COOKIE['name']]['count'][$_GET['add']])){
            $_SESSION[$_COOKIE['name']]['count'][$_GET['add']] += 1;
        }
    }

    // Обработка CLEAR запроса
    if (isset($_GET['clear'])){
        session_start();

        if (isset($_SESSION[$_COOKIE['name']]['cart'])){
            unset($_SESSION[$_COOKIE['name']]['cart']);
        }

        if (isset($_SESSION[$_COOKIE['name']]['count'])){
            unset($_SESSION[$_COOKIE['name']]['count']);
        }
    }

    // Обработка REMOVE запроса
    if (isset($_GET['remove'])){
        
            session_start();

        if (isset($_SESSION[$_COOKIE['name']]['cart']))
        {
            session_start();
                $startSize = sizeof($_SESSION[$_COOKIE['name']]['cart']);
                $currentSize = $startSize;

                if ($startSize > 0){
                    for ($i = 0; $currentSize != $startSize - 1; $i++){
                        if (isset($_SESSION[$_COOKIE['name']]['cart'][$i])){
                            if ($_SESSION[$_COOKIE['name']]['cart'][$i] == $_GET['remove']){
                                unset($_SESSION[$_COOKIE['name']]['cart'][$i]);
                                unset($_SESSION[$_COOKIE['name']]['count'][$_GET['remove']]);
                            }
                        }
                        $currentSize = sizeof($_SESSION[$_COOKIE['name']]['cart']);
                    }
                }
        }
    }

    // Обработка MINUS запроса
    if (isset($_GET['minus'])){
        session_start();
        if (isset($_SESSION[$_COOKIE['name']]['cart'])) 
        {       
                if ($_SESSION[$_COOKIE['name']]['count'][$_GET['minus']] > 1){
                    $_SESSION[$_COOKIE['name']]['count'][$_GET['minus']] -= 1;
                } else {
                    $index = $_GET['minus'];
                    header("Location: ?$loc&remove=$index");
                }
        }
    }

    // Обработка PREFIX
    if (isset($_GET['prefix'])){
        if ($_GET['prefix'] == 'return'){
            header('Location: /?');
        }
    }
                
    session_start();

    // Подгрузка корзины
    if (isset($_SESSION[$_COOKIE['name']]['cart'])){
        $basket = $_SESSION[$_COOKIE['name']]['cart'];
    
            foreach($basket as $index){
                foreach($products as $product){
                    if ($product->id == $index){
                        $sorted[] = $product;
                    }
                }
            }
    
            foreach ($sorted as $item) {
                $count = $_SESSION[$_COOKIE['name']]['count'][$item->id];
                $sum += $item->price * $count;
            }
    }

    if (sizeof($basket) == 0){
        $status = 'Корзина пуста.';
    } else $status = null;
?>

<html>
    <head>
        <link href="style.css" rel="stylesheet">
        <link href="icons/icon.png" type="img/png" rel="shortcut icon">
        <title>Книжное чудо</title>
        <meta charset="utf-8">
    </head>
    <body>
        <header>
            <li><a href="/?<?php echo $loc?>"><img src="icons/icon.png" height="30" width="30"></a></li>
            <li><a href="/about">О нас</a></li>
        </header>

        <main>
            <div>
                <h1>Корзина товаров</h1>
                <h2><?php echo $status?> <a href="index.php?<?php echo $loc?>">За покупками</a></h2>
                <div class="figure-container">
                    <?php foreach($sorted as $item): ?>
                        <div class="product-card-basket">
                            <p><img src="<?php echo $item->img; ?>" class="product-image-basket"/></p>
                            <figcaption class="product-title-basket"><?php echo $item->title; ?></figcaption>

                            <h3>Цена: <?php echo $item->price?> руб</h3>
                            <p>Количество: <?php session_start(); echo $_SESSION[$_COOKIE['name']]['count'][$item->id]?></p>

                            <a class="product-remove" href="?<?php echo $loc?>&remove=<?php echo $item->id?>">Удалить</a>
                            <a class="count" href="?<?php echo $loc?>&minus=<?php echo $item->id?>">-</a>
                            <a class="count" href="?<?php echo $loc?>&add=<?php echo $item->id?>">+</a>

                            <a class="more-details" href="form.php?<?php echo $loc?>id=<?php echo $item->id?>">Подробнее</a><br>
                        </div>
                        
                    <?php endforeach ?>
                    <div style="height: 100vh;"></div>
                </div>
            </div>
        </main>

        <footer class="buying-footer">
            <h2 class="price-text">Стоимость заказа: <?php echo $sum?> руб</h2>
            <button class="add-to-cart">Оформить</button>
            <a href="?<?php echo $loc?>&clear" class="clear-cart">Очистить коризину</a>
        </footer>
    </body>
</html>