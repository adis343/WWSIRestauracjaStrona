<?php


class ProduktZamowienie
{
    public $produkt;
    public $zamowienie;

    public function dodaj()
    {
        $query = "INSERT INTO zmowienie_produkt (produkt, zamowienie) VALUES (:produkt,:zamowienie)";
        $db = Database::db()->prepare($query);
        $db->bindParam(":produkt", $this->produkt);
        $db->bindParam(":zamowienie", $this->zamowienie);
        if($db->execute()){
            return true;
        }
        return false;
    }
}