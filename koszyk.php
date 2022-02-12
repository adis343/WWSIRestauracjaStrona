<?php
include_once 'class/Database.php';
include_once 'class/Produkt.php';
?>

<!DOCTYPE html>
<html lang="pl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Italiano - Firma Cateringowa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <header id="banner">
        <div id="logo"><img src="img/logo.jpg" width="200px" height="auto"></div><!-- Logo firmy -->
        <div id="haslo">
            <div class="haslo-title">Catering <i>Italiano</i> </div>
            <div class="haslo-motto">Smacznie, tanio, wygodnie!</div>
        </div>
    </header>

    <main>
        <?php
        if(isset($_COOKIE['wiadomosc'])){
            ?>
            <h4 class="message"><?php echo $_COOKIE['wiadomosc']; ?></h4>
            <?php
        }
        ?>
        <div class="cart-container">
            <form action="zloz_zamowienie.php" method="post" class="cart-form">
                <div id="cart-form" class="cart-table">
                    <h4>Aby złożyć zamówienie wypełnij poniższe dane</h4>
                    <label for="imie">Imię</label>
                    <input name="imie" class="input-text" type="text" placeholder="Imię"><br>
                    <label for="nazwisko">Nazwisko</label>
                    <input name="nazwisko" class="input-text" type="text" placeholder="Nazwisko"><br>
                    <label for="telefon">Telefon</label>
                    <input name="telefon" class="input-text" type="text" placeholder="Numer telefonu"><br>
                    <label for="telefon">Data realizacji</label>
                    <input name="data_realizacji" class="input-text" type="datetime-local" placeholder="Data realizacji"><br>
                </div>
                <div id="cart-products" class="cart-table">
                    <h3 style="text-align: center">Produkty w Twoim koszyku</h3>

                    <?php
                    if(isset($_COOKIE['koszyk'])){
                        ?>
                        <table id="table-product-cart">
                            <thead><tr><th>Nazwa</th><th>Cena</th></tr></thead>
                            <?php
                            $razem = 0;
                            foreach(unserialize($_COOKIE['koszyk']) as $id){
                                $product = Produkt::znajdzProdukt($id);
                                echo '<tr><th>'.$product->nazwa.'</th><th>'.$product->cena.' zł</th></tr>';
                                $razem += (int)($product->cena);
                            }
                            ?>

                        </table>
                        <h3 style="text-align: center">Razem: <b><?php echo $razem ?> zł</b></h3>
                        <h4 style="text-align: center"> <input type="submit" class="btnZlozZamowienie" name="save" value="Złóż zamówienie"></h4>
                        <?php
                    }else {
                        echo '<h4>Twój koszyk jest pusty</h4>';
                    }
                    ?>


                </div>
            </form>
        </div>
    </main>
    <footer>
        <div class="column-footer-left">
            <div class="mapa-footer">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19531.82600406123!2d20.96155519685866!3d52.27101896633324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ecbebf8ab1969%3A0x3a0fa288cb735db6!2s%C5%BBoliborz%2C%2000-001%20Warszawa!5e0!3m2!1spl!2spl!4v1576703728135!5m2!1spl!2spl" width="300" height="300"></iframe>
            </div>
            <div class="kontakt-footer">
                <h3>Kontakt</h3>
                <p><b>Telefon: </b> (29) 712 34 56</p>
                <p><b>Mail: </b> kontakt@italianocatering.pl</p>
                <p><b>Adres: </b> ul. Kwiatowa 71, 00-001 Warszawa</p>
            </div>

        </div>
        <div class="column-footer-right">
            <ul class="menu-footer">
                <li class="link-menu"><a href="index.html">Strona główna</a></li>
                <li class="link-menu"><a href="menu.php?kat=1">Menu dań głównych</a></li>
                <li class="link-menu"><a href="menu.php?kat=2">Menu przystawek</a></li>
                <li class="link-menu"><a href="menu.php?kat=3">Menu drinków i napoji</a></li>
                <li class="link-menu"><a href="kontakt.html">Kontakt</a></li>
                <li class="link-menu"><a href="koszyk.php">Koszyk</a></li>
            </ul>
        </div>
    </footer>
</div>
</body>
</html>

