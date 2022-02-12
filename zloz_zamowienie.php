<?php

include_once 'class/Database.php';
include_once 'class/Produkt.php';
include_once 'class/ProduktZamowienie.php';
include_once 'class/Zamowienie.php';
include_once 'class/Klient.php';

if(isset($_POST['save']) && isset($_COOKIE['koszyk'])){
    $klient = new Klient();
    $klient->imie = $_POST['imie'];
    $klient->nazwisko = $_POST['nazwisko'];
    $klient->telefon = $_POST['telefon'];


    $zamowienie = new Zamowienie();
    $zamowienie->data_dodania = date("Y-m-d H:i:s", time());
    $zamowienie->data_realizacji = $_POST['data_realizacji'];
    if((strtotime($zamowienie->data_realizacji) - time())<(60*60)){
        $wiadomosc = 'Realizacja nie może być wykonana wcześniej niż za godzinę.';
        setcookie('wiadomosc', $wiadomosc, time() + 3, '/');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else {
        if($klient->dodajKlienta()){
            $zamowienie->klient = $klient->dajNumerOstatniego();
            if($zamowienie->dodajZamowienie()){
                foreach(unserialize($_COOKIE['koszyk']) as $product){
                    $produktZamowienie = new ProduktZamowienie();
                    $produktZamowienie->zamowienie = $zamowienie->dajNumerOstatnie();
                    $produktZamowienie->produkt = $product;
                    $produktZamowienie->dodaj();
                }
                $wiadomosc = 'Zrealizowano zamówienie!';
                setcookie('wiadomosc', $wiadomosc, time() + 3, '/');
                setcookie('koszyk', $wiadomosc, time() - 5, '/');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }else {
            $wiadomosc = '';
            foreach($klient->errors as $error){
                $wiadomosc .= $error.'<br>';
            }
            setcookie('wiadomosc', $wiadomosc, time() + 3, '/');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

}