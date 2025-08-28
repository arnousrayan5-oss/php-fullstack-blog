<?php
session_start();
require "components/checkifNotloggedin.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
  <meta name="author" content="YouBee.ai">

  <title>New post - YouBee Blog Template</title>

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

      <!-- Newpost content  -->
      <div class="col-lg-12 newpost">

        <!-- Title -->
        <h1>New post</h1>

        <!-- Newpost form -->
        <form action="actions/newpost_action.php" method="POST" class="newpost-form">
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" class="form-control" value="<?php echo $_SESSION['subject'];?>">
          </div>

          <div class="form-group">
            <label for="content">Content</label>
            <textarea rows="5" id="content" name="content" class="form-control"><?php echo $_SESSION['content'];?></textarea>
          </div>

          <button type="submit" class="btn btn-primary">Post</button>
        </form>
        <p style="color: red;">
            <?php
            if(isset($_GET['err'])){
                switch($_GET['err']){
                    case 1:
                        echo "Missing Parameters";
                        break;
                    case 0:
                        echo "Unable to post. Content admin.";
                        break;
                        
                }
            }
            
            $_SESSION['subject'] = "";
            $_SESSION['content'] = "";
            ?>
            </P>
        <!-- /form -->
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