<?php
include 'models/user_model.php';
include 'dev/initialize.php';


$products = Initialize::GetArray();

$loc = null;
$user = null;
$basket_capacity = '';

// Сортировка 
if (isset($_GET['send'])){
    if ($_GET['sort'] == 'asc'){
        $products = SortAsc($products);
    } else if($_GET['sort'] == 'desc') {
        $products = SortDesc($products);
    }
}

// Подгрузка данных клиента из куки
if (isset($_COOKIE['name'])) {
    if ($_COOKIE['name'] != null){
        session_start();
        $user = $_SESSION[$_COOKIE['name']]['name'];
        $loc = 'client=' . $_COOKIE['name'] . '&';

        if (isset($_COOKIE['name']) && isset($_SESSION[$_COOKIE['name']]['cart'])){
            $cartItems = $_SESSION[$_COOKIE['name']]['cart'];
            $basket_capacity = sizeof($cartItems);
        }
    }
}


function AlreadyInCart($index) : bool
{
    session_start();
    if (isset($_COOKIE['name']) && isset($_SESSION[$_COOKIE['name']])){
        if (isset($_SESSION[$_COOKIE['name']]['count'])){
            if (isset($_SESSION[$_COOKIE['name']]['count'][$index])){
                return TRUE;
            }
        }
    }
    return FALSE;
} 

function GetCount($index) : int
{
    session_start();
    if (isset($_SESSION[$_COOKIE['name']])){
        if (isset($_SESSION[$_COOKIE['name']]['count'])){
            if (isset($_SESSION[$_COOKIE['name']]['count'][$index])){
                return $_SESSION[$_COOKIE['name']]['count'][$index];
            }
        }
    }
    return 0;
}

function SortAsc($products) : array
{
    for ($i = 0; $i < sizeof($products); $i++){
        for ($j = 0; $j < sizeof($products) - 1; $j++){
            if ($products[$j]->price < $products[$j + 1]->price){
                $tmp = $products[$j];
                $products[$j] = $products[$j + 1];
                $products[$j + 1] = $tmp;
            }
       }
    }

    return $products;
}

function SortDesc($products) : array
{
    for ($i = 0; $i < sizeof($products); $i++){
        for ($j = 0; $j < sizeof($products) - 1; $j++){
            if ($products[$j]->price > $products[$j + 1]->price){
                $tmp = $products[$j];
                $products[$j] = $products[$j + 1];
                $products[$j + 1] = $tmp;
            }
       }
    }

    return $products;
}
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
            <li>
                <img class="img-icon" src="icons/account.png" width="20" height="20">
                <a href="/signin/authorization.php"><?php if ($loc != null) { echo $user; } else echo 'Войти' ?></a>
            </li>
            <li class="last"><a href="/basket.php?<?php echo $loc?>">Корзина: <?php echo $basket_capacity ?></a></li>
        </header>
        
        <main>
            <div>
                <h1>Каталог</h1>
                <form action="/" method="get">
                    <select name="sort">
                        <option value="none">Не сортировать</option>
                        <option value="asc">Дороже</option>
                        <option value="desc">Дешевле</option>
                    </select>
                    <input class="sort-btn" type="submit" value="Соритровать" name="send">
                </form>
                <div class="figure-container">
                    <?php foreach($products as $product): ?>
                        <div class="product-card">
                            <p><img src="<?php echo $product->img; ?>" class="product-image"/></p>
                            <figcaption class="product-title"><?php echo $product->title; ?></figcaption>
                            <?php if(AlreadyInCart($product->id)):?>
                                <a class="already-in-cart" href="form.php?<?php echo $loc?>id=<?php echo $product->id?>">✔ В корзине <?php $c = GetCount($product->id);
                                    if ($c > 1){
                                        echo $c . 'шт'; 
                                    }
                                ?></a>
                                <a class="count-home" href="basket.php?<?php echo $loc?>&add=<?php echo $product->id?>&prefix=return">+</a>
                            <?php else: ?>
                                <a class="more-details" href="form.php?<?php echo $loc?>id=<?php echo $product->id?>"><?php echo $product->price?> руб</a>
                            <? endif?>
                        </div>
                    <?php endforeach ?>
                    <div style="height: 100vh"></div>
                </div>
            </div>
        </main>

        <footer>
            <p>31.07.2024 "Книжное чудо ©" Все права защищены.</p>
        </footer>
    </body>
</html>