<?php


class Kategoria
{
    public $nazwa;

    public static function znajdzKategorie($id)
    {
        $query = "SELECT * FROM kategorie WHERE id=:id LIMIT 1";
        $db = Database::db()->prepare($query);
        $db->bindParam(":id", $id, PDO::PARAM_INT);
        $db->execute();
        $kats = $db->fetch(PDO::FETCH_ASSOC);

        if($kats){
            $kat = new Kategoria();
            foreach ($kats as $key => $value) {
                $kat->$key = $value;
            }
            return ($kat)?$kat:false;
        }
    }
}