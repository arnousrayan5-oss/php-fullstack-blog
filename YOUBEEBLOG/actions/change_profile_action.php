<?php
 session_start();
 require "../connection.php";
 require "../components/checkifNotloggedin.php";

 if($_SERVER['REQUEST_METHOD'] != "POST"){
    die("Wrong parameters");
}

$fileType = strtolower(pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION));
$img_name = "img" . $_SESSION['userId'] . "_" . bin2hex(random_bytes(10)) . "." . $fileType;
$target = "../imgs/" . $img_name;

if($fileType != "jpeg" && $fileType != "jpg" && $fileType != "png" && $fileType != "gif"){
    header("Location: ../change_profile.php?err=2");
    exit();
}

while(file_exists($target)){
   $img_name = "img" . $_SESSION['userId'] . "_" . bin2hex(random_bytes(10)) . "." . $fileType;
   $target = "../imgs/" . $img_name;
}

if($_FILES['profile']['size'] > 100000){
    header("Location: ../change_profile.php?err=3");
    exit();
}

if(!getimagesize($_FILES['profile']['tmp_name'])){
   header("Location: ../change_profile.php?err=4");
    exit(); 
}

try{
   if(!move_uploaded_file($_FILES['profile']['tmp_name'] , $target)){
    header("Location: ../change_profile.php?err=1");
    exit();
   }

    $sql = "UPDATE users SET profile = :profile WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":profile", $img_name);
    $stmt->bindparam(":id", $_SESSION['userId']);
    $stmt->execute();
    header("Location: ../index.php");
    exit();
   
}catch(Exception $ex){
    header("Location: ../change_profile.php?err=0");
    exit();
}