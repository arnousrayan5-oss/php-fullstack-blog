<?php
require "connection.php";


$sql = 
"SELECT
  p.id as posts_id,
  p.content,
  p.subject,
  p.date_created,
  u.id as user_id,
  u.name as user_name
FROM posts p INNER JOIN users u ON u.id = p.user_id
WHERE p.deleted_at IS NULL
ORDER BY p.date_created DESC
";

$stmt = $pdo->query($sql);
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

      <!-- Blog Entries Column -->
      <div class="col-md-12">
    <?php
    foreach($posts as $post){
      $date = new DateTime($post['date_created']);
      $formattedDate = $date->format('F j, Y \a\t g:i A');
      echo '
        <!-- First Blog Post -->
        <h2 class="post-title">
          <a href="post.php?id='.$post['posts_id'].'">'.$post['subject'].'</a>
        </h2>
        <a href="author.php?id='.$post['user_id'].'" class="lead">
          '.$post['user_name'].'
        </a>
        <p><span class="glyphicon glyphicon-time"></span> Posted on '.$formattedDate.'</p>
        <p>'.$post['content'].'</p>
        <a class="btn btn-default" href="post.php?id='.$post['posts_id'].'">Read More</a>
        <a class="btn btn-default" href="post.php">Like</a>

        <hr>';
    }

        ?>

        <!-- Pager -->
        <!-- <ul class="pager">
          <li class="previous">
            <a href="#">Prev</a>
          </li>
          <li class="next">
            <a href="#">Next</a>
          </li>
        </ul> -->

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