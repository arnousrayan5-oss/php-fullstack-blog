<?php

 session_start();
require "../connection.php";
require "../components/checkifNotloggedin.php";

if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("Wrong method");
}

$oldpass = $_POST['oldpass'];
$newpass = $_POST['newpass'];


if(!isset($oldpass) || empty(trim($oldpass))
  || !isset($newpass) || empty(trim($newpass)) ){
    header("Location: ../change_password.php?err=1");
    exit();
}

$id = $_SESSION['userId'];
$sql = "SELECT password FROM users WHERE id = $id";
$stmt = $pdo->query($sql);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!password_verify($oldpass , $user['password'])){
    header("Location: ../change_password.php?err=2");
    exit();
}

if(strlen($newpass) <8){
     header("Location: ../change_password.php?err=3");
     exit();
}

$hashed_password = password_hash($newpass , PASSWORD_BCRYPT);

try{
$sql = "UPDATE users SET password = :pass  WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":pass" , $hashed_password);
$stmt->bindParam(":id", $_SESSION['userId']);
$stmt->execute();
header("Location: ../index.php");
exit();

}catch(PDOExecption $e){
header("Location: ../change_password.php?err=0");
exit();
}