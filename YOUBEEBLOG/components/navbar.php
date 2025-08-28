 <?php
 if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
  ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">YouBee Blog</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="about.php">About</a>
          </li>
          <?php
          if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){
            echo '<li>
            <a href="author.php?id='.$_SESSION['userId'].'">'. $_SESSION['name'].'</a>
            </li>';
           echo '<li>
            <a href="Logout.php">Logout</a>
            </li>';
           echo '<li>
            <a href="newpost.php">New Post</a>
            </li>';
          }else{
            echo ' <li>
            <a href="login.php">Login</a>
            </li>
            <li>
            <a href="signup.php">Sign up</a>
            </li>';
          }
          ?>
          
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>

  </body>
 </html>