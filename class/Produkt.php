<?php


class Produkt
{
    public $id;
    public $nazwa;
    public $kategoria;
    public $opis;
    public $zdjecie;


    public static function znajdzProdukt($id)
    {
        $query = "SELECT * FROM produkty WHERE id=:id LIMIT 1";
        $db = Database::db()->prepare($query);
        $db->bindParam(":id", $id, PDO::PARAM_INT);
        $db->execute();
        $produkt = new Produkt();
        foreach ($db->fetch(PDO::FETCH_ASSOC) as $key => $value) {
            $produkt->$key = $value;
        }
        return ($produkt)?$produkt:false;
    }

    public function dajKategorie()
    {
        Kategoria::znajdzKategorie($this->kategoria);
    }

    public static function znajdzPoKategorii($idKategorii)
    {
        $query = "SELECT * FROM produkty WHERE kategoria=:kategoria";
        $db = Database::db()->prepare($query);
        $db->bindParam(":kategoria", $idKategorii, PDO::PARAM_INT);
        $db->execute();
        $produkty = [];
        foreach($db->fetchAll(PDO::FETCH_ASSOC) as $result){
            $produkt = new Produkt();
            foreach ($result as $key => $value) {
                $produkt->$key = $value;
            }
            $produkty[] = $produkt;
        }
        return $produkty;
    }

    public static function znajdzPoNazwieIKategorii($idKategoria, $nazwa){
        $query = "SELECT * FROM produkty WHERE kategoria=:kategoria AND nazwa LIKE :nazwa";
        $db = Database::db()->prepare($query);
        $likeNazwa = '%'.$nazwa.'%';
        $db->bindParam(":kategoria", $idKategoria, PDO::PARAM_INT);
        $db->bindParam(":nazwa", $likeNazwa, PDO::PARAM_STR);
        $db->execute();
        $produkty = [];
        foreach($db->fetchAll(PDO::FETCH_ASSOC) as $result){
            $produkt = new Produkt();
            foreach ($result as $key => $value) {
                $produkt->$key = $value;
            }
            $produkty[] = $produkt;
        }
        return $produkty;
    }
}