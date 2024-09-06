<?php 
include '../models/user_model.php';

$user = null;
$loc  = null;

if (isset($_POST['name'])) {
    if ($_POST["name"] != null && $_POST["name"] != null && $_POST["email"] != null && $_POST["pass"] != null) {
        if ($_POST["pass"] == $_POST["pass2"]) {
            $user = new User($_POST["name"], $_POST["email"], $_POST["address"]);
            setcookie('name', $user->clientid, time() + (86400 * 30), "/");

            session_start();
            $_SESSION[$user->clientid]['cart'] = array();
            $_SESSION[$user->clientid]['name'] = $user->name;

            header('Location: /?client=' . $_SESSION['cart']); exit;
        }
    }
}?>

<!DOCTYPE html>
<html>
    <head>
        <link href="../style.css" rel="stylesheet">
        <link href="../icons/icon.png" type="img/png" rel="shortcut icon">
        <meta charset="utf-8">
        <title>Регистрация</title>
    </head>
    <body>
        <header>
            <li><a href="/"><img src="../icons/icon.png" height="30" width="30"></a></li>
            <li><a href="/about">О нас</a></li>
        </header>
        <main>
            <h class="h-header">Регистрация</h>
            <form action="" method="post" class="form-container">
                Ваше имя: <input type="text" name="name" placeholder="Обязательное поле">
                Адрес эл. почты: <input type="text" name="email" placeholder="Обязательное поле">
                Пароль: <input type="password" name="pass" placeholder="Обязательное поле">
                Повторите пароль: <input type="password" name="pass2" placeholder="Обязательное поле">
                Адрес: <input type="text" name="address" placeholder="Необязательное поле. Однако при заказе будет необходимо указать адрес.">

                <button type="submit" name="submit_btn" class="add-to-cart">Регистрация</button>
            </form>
        </main>
        <footer>
            <p>31.07.2024 "Книжное чудо ©" Все права защищены.</p>
        </footer>
    </body>
</html>