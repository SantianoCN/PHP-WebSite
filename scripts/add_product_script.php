<?php
  session_start();
  header('Location: /?');

  $itemId = $_POST['itemId'];

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }

  $_SESSION['cart'][] = $itemId;