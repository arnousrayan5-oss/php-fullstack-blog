<?php

 session_start();
require "../connection.php";
require "../components/checkifloggedin.php";

if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("Wrong parameters");
}

$name = htmlspecialchars( $_POST["username"]);
$email = htmlspecialchars( $_POST["email"]);
$password = $_POST["password"];

if(!isset($name) || empty(trim($name))
    || !isset($email) || empty(trim($email))
    || !isset($password) || empty(trim($password))){
        header("Location: ../signup.php?err=1");
        exit();
    }

$_SESSION['email'] = $email;
$_SESSION['name'] = $name;

if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
     header("Location: ../signup.php?err=2");
        exit();
}

if(strlen($password) <8){
     header("Location: ../signup.php?err=3");
        exit();
}

$hashed_password = password_hash($password , PASSWORD_BCRYPT);

try{
    $sql = "INSERT INTO users (name,email,password) VALUES (:name, :email , :password)";
    $stmt =$pdo->prepare($sql);
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $hashed_password);
    $stmt->execute();
    $_SESSION['loggedIn'] = true;
    $_SESSION['userId'] = $pdo->lastInsertId();
    $_SESSION['name'] = $name;
    header("Location: ../index.php");
    exict();
} catch(PDOExecption $ex){
    if($ex->errinfo[1] == 1062){
      header("Location: ../signup.php?err=5");
        exit();  
    }
     header("Location: ../signup.php?err=4");
        exit();
}