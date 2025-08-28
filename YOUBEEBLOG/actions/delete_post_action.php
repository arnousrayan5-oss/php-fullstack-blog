<?php
 session_start();
 require "../connection.php";
 require "../components/checkifNotloggedin.php";

 if($_SERVER['REQUEST_METHOD'] != "GET"){
    die("Wrong parameters");
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

try{
$sql = "UPDATE posts SET deleted_at = NOW() WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();
header("Location: ../index.php");
exit();
}catch(PDOException $ex){
   die("Error deletiong the post");
}