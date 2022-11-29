<?php

$host = "127.0.0.1:3306";
$db = "pompier";
$user = "root";
$pw ="";
// connection à la base de données avec test si il y a une erreur
try
{
    $db = new PDO("mysql:host = $host;dbname = $db;charset=utf8",$user,$pw);
}
catch (Exception $e)
{
     die('Erreur : ' . $e->getMessage());
}

?>