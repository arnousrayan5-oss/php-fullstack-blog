<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "youbeeblog1";

// PDO
try {
    $pdo = new PDO("mysql:host=$server;dbname=$db", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $exception){
    echo "Connection to database failed! Error: ". $exception->getMessage();
    die();
}