<?php
session_start();
require "components/checkifloggedin.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is demo page made for YouBee.ai's programming courses">
  <meta name="author" content="YouBee.ai">

  <title>Login - YouBee Blog Template</title>

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

      <div class="col-lg-2"></div>

      <!-- Login content  -->
      <div class="col-lg-8 login">

        <!-- Title -->
        <h1>Login</h1>

        <!-- Login form -->
        <form action="actions/login_action.php" method="POST" class="login-form">
          <div class="form-group">
            <label for="username">Email</label>
            <input type="email" id="email" name="email"
            value="<?php echo $_SESSION['email'];?>"  class="form-control">
            </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
          </div>

          <button type="submit" class="btn btn-primary">Log in</button>
          <p>Don't have an account? <a href="signup.html">Sign Up Now</a></p>
        </form>
        <!-- /form -->
          <p style="color: red;">
            <?php
            if(isset($_GET['err'])){
                switch($_GET['err']){
                    case 1:
                        echo "Missing Parameters";
                        break;
                    case 2:
                        echo "Wrong email or password";
                        break;
                    case 3:
                        echo "Failed to login. Contact Admin";
                        break;
                          
                }
            }
            $_SESSION['email'] = "";
            ?>
            </P>
      </div>

      <div class="col-lg-2"></div>

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