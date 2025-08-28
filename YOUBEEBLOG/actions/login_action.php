<?php
 session_start();
 require "../connection.php";
 require "../components/checkifloggedin.php";

if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("Wrong parameters");
}


$email = htmlspecialchars($_POST['email']);
$password = $_POST['password'];

if(  !isset($email) || empty(trim($email))
    || !isset($password) || empty(trim($password))){
        header("Location: ../login.php?err=1");
        exit();
    }
$_SESSION['email'] = $email;

try{
     $sql = "SELECT id, name, password FROM users WHERE email = :email";
     $stmt =$pdo->prepare($sql);
     $stmt->bindParam(":email", $email);
     $stmt->execute();
     $user = $stmt->fetch(PDO::FETCH_ASSOC);
     
if(!$user){
        header("Location: ../login.php?err=2");
        exit();
    }


   if(!password_verify($password,$user['password'])){
      header("Location: ../login.php?err=2");
      exit();
   }

     $_SESSION['loggedIn'] = true;
     $_SESSION['userId'] = $user['id'];
     $_SESSION['name'] = $user['name'];
     header("Location: ../index.php");
     exit();
     
     
    
}catch(PDOExecption $ex){
  header("Location: ../login.php?err=3");
  exit();  
}