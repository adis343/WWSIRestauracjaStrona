<?php


class Zamowienie
{
    public $data_dodania;
    public $data_realizacji;
    public $klient;

    public function dodajZamowienie()
    {
        $query = "INSERT INTO zamowienie (data_dodania, data_realizacji, klient) VALUES (:data_dodania,:data_realizacji,:klient)";
        $db = Database::db()->prepare($query);
        $db->bindParam(":data_dodania", $this->data_dodania);
        $db->bindParam(":data_realizacji", $this->data_realizacji);
        $db->bindParam(":klient", $this->klient);
        if($db->execute()){
            return true;
        }
        return false;
    }

    public function dajNumerOstatnie(){
        $query = "SELECT id FROM zamowienie ORDER BY id DESC LIMIT 1";
        $db = Database::db()->prepare($query);
        $db->execute();
        $last = $db->fetch();
        return $last['id'];
    }
}