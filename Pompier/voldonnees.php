<?php

try{

    $db new PDO("mysql:host=localhost ; dbname = demo _ injection', 'root ', ");
    $db->exec('SET NAMES UTF8"' );

}catch(PDOException $e){
    echo $e->getMessage();
}

if(!enpty($_GET['id'])){


$id $GET['id'];

$sql = "SELECT * FROM 'users' wHERE 'id' = $id;";

$query = $db->query($sql);

$users = $query->fetchALL(PDO::FETCH_ASSOC);

}
foreach( $users as $user){
    echo '<p>'.$user['email ']. '</p>';
}
