<?php
session_start();
require "connection.php";

$id = htmlspecialchars($_GET['id']);

$sql = 
"SELECT
  p.id as posts_id,
  p.content,
  p.subject,
  p.date_created,
  u.id as user_id,
  u.name as user_name
FROM posts p INNER JOIN users u ON u.id = p.user_id
WHERE p.id = :id
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id" , $id);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$post){
    die('post not found');
}

$date = new DateTime($post['date_created']);
$formattedDate = $date->format('F j, Y \a\t g:i A');

$isPostOwner = $_SESSION['userId'] == $post['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
  <meta name="author" content="YouBee.ai">

  <title>Post - YouBee Blog Template</title>

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

      <!-- Blog Post Content Column -->
      <div class="col-lg-12">

        <!-- Blog Post -->

        <!-- Title -->
        <h1 class="post-title"><?php echo $post['subject']; ?></h1>

        <!-- Author -->
        <a href="author.php?id=<?php echo $post['user_id']; ?>" class="lead">
          by <?php echo $post['user_name']; ?>
        </a>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $formattedDate; ?></p>

        <hr>

        <!-- Post Content -->
        <p><?php echo $post['content']; ?></p>

        <hr>
        <?php
        if($isPostOwner){
            echo'    
        <a class="btn btn-default" href="edit_post.php?id='.$post['posts_id'].'">Edit</a>
        <a class="btn btn-default" href="actions/delete_post_action.php?id='.$post['posts_id'].'">Delete</a>';
        }else if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
            echo '<a class="btn btn-default" href="post.php">Like</a>';
        }
        ?>
        <hr>
        <!-- Blog Comments -->

        <!-- Comments Form -->
        <div class="well">
          <h4>Leave a Comment:</h4>
          <form role="form">
            <div class="form-group">
              <textarea class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>

        <hr>

        <!-- Posted Comments -->

        <!-- Comment -->
        <div class="media">
          <a class="pull-left" href="#">
            <img class="media-object" src="imgs/default.png" width="64px" height="64px" alt="">
          </a>
          <div class="media-body">
            <h4 class="media-heading">Elie Amin
              <small>August 25, 2024 at 9:30 PM</small>
            </h4>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere ratione doloribus amet numquam eaque sit
            fugiat, repudiandae cupiditate quia dolores asperiores a quaerat nobis culpa corrupti natus saepe, obcaecati
            atque.
          </div>
        </div>

        <!-- Comment -->
        <div class="media">
          <a class="pull-left" href="#">
            <img class="media-object" src="imgs/default.png" width="64px" height="64px" alt="">
          </a>
          <div class="media-body">
            <h4 class="media-heading">Hasan Nahleh
              <small>August 25, 2024 at 9:30 PM</small>
            </h4>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi veniam iure, ex repellat porro quia, quas
            reprehenderit error soluta dolores aut esse ad non officia nam. Ipsam error repudiandae incidunt!
            <!-- Nested Comment -->
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="imgs/default.png" width="64px" height="64px" alt="">
              </a>
              <div class="media-body">
                <h4 class="media-heading">Ali Nahleh
                  <small>August 25, 2024 at 9:30 PM</small>
                </h4>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint tempore veritatis numquam libero qui
                repudiandae laudantium architecto cum reiciendis ipsam placeat, omnis sapiente voluptas repellat nihil
                nesciunt sequi ex consequuntur?
              </div>
            </div>
            <!-- End Nested Comment -->
          </div>
        </div>

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