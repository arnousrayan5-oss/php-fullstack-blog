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
        <h1>Change Profile Picture</h1>

        <!-- signup form -->
        <form action="actions/change_profile_action.php" method="POST" enctype="multipart/form-data" class="signup-form">
          <div class="form-group">
            <label for="username">Choose Image</label>
            <input type="file" id="email" name="profile" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Upload Image</button>
        </form>

        <p style="color: red;">
            <?php
            if(isset($_GET['err'])){
                switch($_GET['err']){
                    case 1:
                        echo "Unable to upload image";
                        break;
                    case 2:
                        echo "Unsupported file extention";
                        break;
                    case 3:
                        echo "Image larger than expected";
                        break;
                    case 4:
                        echo "This is not an image" ;    
                        break;
                    case 0:
                        echo "Email already registered";
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