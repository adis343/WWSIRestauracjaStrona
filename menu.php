<?php
include_once 'class/Database.php';
include_once 'class/Produkt.php';
include_once 'class/Kategoria.php';

if(isset($_GET['kat']) && Kategoria::znajdzKategorie($_GET['kat'])) {
    $kategoria = Kategoria::znajdzKategorie($_GET['kat']);
    ?>

    <!DOCTYPE html>
    <html lang="pl" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8"/>
        <title>Italiano - Firma Cateringowa</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="js/scripts.js"></script>
    </head>
    <body>
    <div class="container">
        <header id="banner">
            <div id="logo"><img src="img/logo.jpg" width="200px" height="auto"></div><!-- Logo firmy -->
            <div id="haslo">
                <div class="haslo-title">Catering <i>Italiano</i></div>
                <div class="haslo-motto">Smacznie, tanio, wygodnie!</div>
            </div>
        </header>

        <main>
            <header class="content-title">Dania główne</header>
            <input id="searchProduct" type="text" class="input-search" placeholder="Wyszukaj potrawę">
            <div class="product-row" id="lista">
                <?php



                foreach (Produkt::znajdzPoKategorii($kategoria->id) as $produkt) {
                    ?>
                    <div class="product-container">
                        <div class="img-product"><img src="<?php echo $produkt->zdjecie ?>"></div>
                        <div class="description-product">
                            <h3><?php echo $produkt->nazwa ?></h3>
                            <p><?php echo $produkt->opis ?></p>
                            <p><b>Cena:</b> <?php echo $produkt->cena ?> pln</p>
                        </div>
                        <a href="dodajDoKoszyka.php?id=<?php echo $produkt->id ?>" class="button-order">Dodaj do
                            koszyka</a>
                    </div>
                    <?php
                }
                ?>


            </div>

        </main>
        <footer>
            <div class="column-footer-left">
                <div class="mapa-footer">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19531.82600406123!2d20.96155519685866!3d52.27101896633324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ecbebf8ab1969%3A0x3a0fa288cb735db6!2s%C5%BBoliborz%2C%2000-001%20Warszawa!5e0!3m2!1spl!2spl!4v1576703728135!5m2!1spl!2spl"
                        width="300" height="300"></iframe>
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

    <?php
}else {
    header('Location: index.html');
}
?>