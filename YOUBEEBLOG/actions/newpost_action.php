<?php
 session_start();
 require "../connection.php";
 require "../components/checkifNotloggedin.php";

 if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("Wrong parameters");
}

$subject = htmlspecialchars( $_POST["subject"]);
$content = htmlspecialchars( $_POST["content"]);

$_SESSION["subject"] = $subject;
$_SESSION["content"] = $content;

if(!isset($subject ) || empty(trim($subject ))
    || !isset($content) || empty(trim($content))
){
        header("Location: ../newpost.php?err=1");
        exit();
    }

try{
$sql = "INSERT INTO posts(subject, content, user_id) VALUES (:subject, :content, :user_id)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":subject", $subject);
$stmt->bindParam(":content", $content);
$stmt->bindParam(":user_id", $_SESSION['userId']);
$stmt->execute();
header("Location: ../index.php");
exit();

}catch(PDOException $exc){
   header("Location: ../index.php?err=0");
   exit();
}
