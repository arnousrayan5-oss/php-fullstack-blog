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
        <h1> Change Password</h1>

        <!-- signup form -->
        <form action="actions/edit_password_action.php" method="POST" class="signup-form">
           
        <div class="form-group">
            <label for="username">Old Password</label>
            <input type="password" id="password" name="oldpass" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" id="password" name="newpass" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary">Change Password</button>
          
        </form>

        <p style="color: red;">
            <?php
            if(isset($_GET['err'])){
                switch($_GET['err']){
                    case 1:
                        echo "Missing Parameters";
                        break;
                    case 2:
                        echo "old password is wrong";
                        break;
                    case 3:
                        echo "Password should be at least 8 characters";
                        break;
                    case 0:
                        echo "Unable to change password. Contact admin" ;    
                        break;
                            
                }
            }
            
          
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