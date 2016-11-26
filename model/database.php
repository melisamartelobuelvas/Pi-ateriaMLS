<?php
class Database
{
    public static function StartUp()
    {
        $pdo = new PDO('mysql:host=mysql.hostinger.es;dbname=u603763480_jaxaj;charset=utf8', 'u603763480_syhys', '1067927898');
        //$pdo = new PDO('mysql:host=localhost;dbname=pinateria;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}