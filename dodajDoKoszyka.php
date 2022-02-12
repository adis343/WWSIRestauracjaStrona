<?php
if(isset($_GET['id'])){
    if(isset($_COOKIE['koszyk'])){
        $products = unserialize($_COOKIE['koszyk']);
    }else {
        $products = array();
    }
    $products[] = $_GET['id'];

    setcookie('koszyk', serialize($products), time() + 60*60*3, '/');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

