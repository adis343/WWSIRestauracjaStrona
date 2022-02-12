<?php


class Database
{

    public static function db()
    {
        $host = 'localhost';
        $port = '3306';
        $username = 'root';
        $password = '';
        $database = 'lab4';

        try{
            $pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';port=' . $port . ";charset=utf8", $username, $password );
            $pdo->exec('SET NAMES utf8');
            return $pdo;
        }catch(PDOException $e){
            echo('Błąd połączenia');
            die();
        }

    }


}