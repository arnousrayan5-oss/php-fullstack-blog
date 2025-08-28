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

  <title>Update - YouBee Blog Template</title>

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

      <div class="col-lg-12">

        <!-- Title -->
        <h1>Update Profile</h1>

        <hr>

        <!-- Post Content -->
       <a href="change_profile.php" class="btn btn-default" >Change Profile Picture</a>
       <a href="change_password.php" class="btn btn-default" >Change Password</a>
       <a href="change_info.php" class="btn btn-default" >Change Information</a>

        <hr>

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