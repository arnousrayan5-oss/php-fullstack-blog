<?php

 session_start();
require "../connection.php";
require "../components/checkifNotloggedin.php";

if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("Wrong method");
}

$name = htmlspecialchars( $_POST["username"]);
$email = htmlspecialchars( $_POST["email"]);
$password = $_POST["password"];

if(!isset($name) || empty(trim($name))
    || !isset($email) || empty(trim($email))
    || !isset($password) || empty(trim($password))){
        header("Location: ../change_info.php?err=1");
        exit();
    }


if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
     header("Location: ../change_info.php?err=2");
        exit();
}
if(strlen($password) <8){
     header("Location: ../change_info.php?err=3");
        exit();
}

$id = $_SESSION['userId'];
$sql = "SELECT password FROM users WHERE id = $id";
$stmt = $pdo->query($sql);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!password_verify($password , $user['password'])){
    header("Location: ../change_info.php?err=6");
        exit();
}



try{
    $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
    $stmt =$pdo->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":id", $_SESSION['userId']);
    $stmt->execute();
    $_SESSION['name'] = $name;
    header("Location: ../index.php");
    exict();
} catch(PDOExecption $ex){
    if($ex->errinfo[1] == 1062){
      header("Location: ../change_info.php?err=5");
        exit();  
    }
     header("Location: ../change_info.php?err=4");
        exit();
}