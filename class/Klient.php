<?php


class Klient
{
    public $imie;
    public $nazwisko;
    public $telefon;

    public $errors = [];

    public function dodajKlienta()
    {
        if($this->sprawdzPoprawnosc()){
            $query = "INSERT INTO klienci (imie, nazwisko, telefon) VALUES (:imie,:nazwisko,:telefon)";
            $db = Database::db()->prepare($query);
            $db->bindParam(":imie", $this->imie);
            $db->bindParam(":nazwisko", $this->nazwisko);
            $db->bindParam(":telefon", $this->telefon);
            if($db->execute()){
                return true;
            }
            return false;
        }
    }

    public static function znajdzKlienta($id)
    {
        $query = "SELECT * FROM klienci WHERE id=:id LIMIT 1";
        $db = Database::db()->prepare($query);
        $db->bindParam(":id", $id, PDO::PARAM_INT);
        $db->execute();
        $klient = new Klient();
        foreach ($db->fetch(PDO::FETCH_ASSOC) as $key => $value) {
            $klient->$key = $value;
        }
        return ($klient)?$klient:false;
    }

    private function sprawdzPoprawnosc()
    {
        if(!$this->imie){
            $this->errors[] = 'Imię nie wpisane';
        }

        if(!$this->nazwisko){
            $this->errors[] = 'Nazwisko nie wpisane';
        }

        if(!$this->telefon){
            $this->errors[] = 'telefon nie wpisany';
        }

        if(empty($this->errors)){
            return true;
        }
        return false;
    }


    public function dajNumerOstatniego(){
        $query = "SELECT id FROM klienci ORDER BY id DESC LIMIT 1";
        $db = Database::db()->prepare($query);
        $db->execute();
        $last = $db->fetch();
        return $last['id'];
    }
}