<?php
include_once 'class/Database.php';
include_once 'class/Produkt.php';
include_once 'class/ProduktZamowienie.php';
include_once 'class/Zamowienie.php';
include_once 'class/Klient.php';
if(isset($_GET['kategory']) && isset($_GET['text'])){

    if($produkty = Produkt::znajdzPoNazwieIKategorii((int)($_GET['kategory']), $_GET['text']) ) {
        foreach ($produkty as $produkt) {

            echo '<div class="product-container">';
            echo '<div class="img-product"><img src="' . $produkt->zdjecie . '"></div>';
            echo '<div class="description-product">';
            echo '<h3>' . $produkt->nazwa . '</h3>';
            echo '<p>' . $produkt->opis . '</p>';
            echo '<p><b>Cena: </b>' . $produkt->cena . ' pln</p>';
            echo '</div>';
            echo '<a href="dodajDoKoszyka.php?id=' . $produkt->id . '" class="button-order">Dodaj do
                            koszyka</a>';
            echo '</div>';
        }
    }else echo 'Brak wyników';
}else echo 'Błąd wyszukiwania';

