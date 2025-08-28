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

  <title>Sign up - Template</title>

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

      <!-- Signup content  -->
      <div class="col-lg-8 signup">

        <!-- Title -->
        <h1>Sign up</h1>

        <!-- signup form -->
        <form action="actions/signup_action.php" method="POST" class="signup-form">
          <div class="form-group">
            <label for="username">Email</label>
            <input type="email" id="email" name="email" class="form-control" 
            value="<?php echo $_SESSION['email'];?>"
             required>
          </div>

          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-control"
            value="<?php echo $_SESSION['name'];?>" 
             required>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary">Sign up</button>
          <p>Already have an account? <a href="login.html">Login</a></p>
        </form>

        <p style="color: red;">
            <?php
            if(isset($_GET['err'])){
                switch($_GET['err']){
                    case 1:
                        echo "Missing Parameters";
                        break;
                    case 2:
                        echo "Email not valid";
                        break;
                    case 3:
                        echo "Password should be at least 8 characters";
                        break;
                    case 4:
                        echo "Unable to register. Contact admin" ;    
                        break;
                    case 5:
                        echo "Email already registered";
                        break;          
                }
            }
            
            $_SESSION['email'] = "";
            $_SESSION['name'] = "";
            ?>
            </P>
        <!-- /form -->
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