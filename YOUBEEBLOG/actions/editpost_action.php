<?php
 session_start();
 require "../connection.php";
 require "../components/checkifNotloggedin.php";

 if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("Wrong method");
}

$id = htmlspecialchars($_GET['id']);

$sql = 
"SELECT
 u.id as user_id
 FROM posts p INNER JOIN users u ON u.id = p.user_id
 WHERE p.id = :id
 AND p.deleted_at IS NULL
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id" , $id);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

 $isPostOwner =  $_SESSION['userId'] == $post['user_id'];
 if(!$isPostOwner){
     die("Access Denied");
 }

$subject = htmlspecialchars( $_POST["subject"]);
$content = htmlspecialchars( $_POST["content"]);

$_SESSION["subject"] = $subject;
$_SESSION["content"] = $content;

if(!isset($subject ) || empty(trim($subject ))
    || !isset($content) || empty(trim($content))
){
        header("Location: ../edit_post.php?err=1");
        exit();
    }

try{
$sql = "UPDATE  posts SET subject = :subject, content = :content WHERE id = :id ";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":subject", $subject);
$stmt->bindParam(":content", $content);
$stmt->bindParam(":id", $id);
$stmt->execute();
header("Location: ../index.php");
exit();

}catch(PDOException $exc){
   header("Location: ../index.php?err=0");
   exit();
}
