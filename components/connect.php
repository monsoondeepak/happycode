<?php

$host = "mysql:host=localhost;dbname=shop_db";
$user = "root";
$password = "";

$conn = new PDO($host,$user,$password);

if(!$conn){
    echo 'connection failed';
}

?>