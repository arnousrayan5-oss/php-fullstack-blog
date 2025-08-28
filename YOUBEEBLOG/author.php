<?php
session_start();
require "connection.php";

$id = htmlspecialchars($_GET['id']);

$sql="SELECT name, profile FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id" , $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user){
    die("No user found!");
}
$name = $user['name'];
$profile = $user['profile'];

$isProfileOwner = $id == $_SESSION['userId'];

$sql = 
"SELECT
  p.id as posts_id,
  p.content,
  p.subject,
  p.date_created
FROM posts p WHERE p.user_id = :id
AND p.deleted_at IS NULL
ORDER BY p.date_created DESC
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id" , $id);
$stmt->execute();
$posts = $stmt->fetchall(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
  <meta name="author" content="YouBee.ai">

  <title>Home - YouBee Blog Template</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/simple-blog-template.css" rel="stylesheet">


</head>

<body>

  <!-- Navigation -->
 <?php
require "components/navbar.php";
?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">
      <!-- Page Title -->
      <div class="col-md-12">
        <a class="pull-left" href="#">
          <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="profile-head">
          <img class="media-object" src="imgs/<?php echo $profile; ?>" width="64px" height="64px" alt="">
          <h2>Posts by <?php echo $name; ?> (<?php echo count($posts); echo count($posts) > 1 ? "Posts" : "Post" ?>)</h2>
          
       </div>
        <?php
          if($isProfileOwner){
            
            echo '<a href="update_profile.php" class="btn btn-default" >Update Profile </a>';
          }
          ?>
      </div>
      <!-- Blog Entries Column -->
      <div class="col-md-12">
    <?php
       if(count($posts)== 0){
        echo "<h2>No posts yet</h2>";
    }
      foreach($posts as $post){
        $date = new DateTime($post['date_created']);
        $formattedDate = $date->format('F j, Y \a\t g:i A');
        echo '
        <!-- First Blog Post -->
        <h2 class="post-title">
          <a href="post.php?id='.$post['posts_id'].'">'.$post['subject'].'</a>
        </h2>
        <p><span class="glyphicon glyphicon-time"></span> Posted on '.$formattedDate.'</p>
        <p>'.$post['content'].'</p>
        <a class="btn btn-default" href="post.php?id='.$post['posts_id'].'">Read More</a>

        <hr>';
      }
    ?>    

    

        <!-- Pager -->
        <ul class="pager">
          <li class="previous">
            <a href="#">Prev</a>
          </li>
          <li class="next">
            <a href="#">Next</a>
          </li>
        </ul>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
    <?php
 require "components/footer.php";
 ?>


  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>




</body>

</html>