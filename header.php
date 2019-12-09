<?php

require_once("conn.php");

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="/CSS/styles.css">

    <script src="https://kit.fontawesome.com/ea81b73834.js" crossorigin="anonymous"></script>
    
  </head>
   <body>




   <nav class="navbar navbar-expand-lg navbar-light bg-light">
   
  <a class="navbar-brand" href="#">SSP3310</a>


    <!-- to search members change this form action to /members.php to search posts change it to /articles.php -->
    <form action="/articles.php" class="form-inline input-group my-2 my-lg-0 w-50">
      <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search" value="<?php echo (isset($_GET["search"])) ? $_GET["search"] : ""; ?>">
      <div class="input-group-append">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </div>
    </form>




  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
    <?php
      if(isset($_SESSION["user_id"])) :               // USER IS LOGGED IN 
    ?>
      <li class="nav-item">
        <a class="nav-link" href="/members.php">Members</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/index.php">Home</a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/profile.php">My Profile</a>
          <a class="dropdown-item" href="/add_post.php">Add Post</a>
          <a class="dropdown-item" href="/articles.php">View Posts</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/actions/login.php?action=logout">Logout</a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>

      <?php
        else: // if user is not logged in
          ?>

            <li class="nav-item">
              <a class="nav-link" href="/index.php">Login</a>
              <!-- <a href="/http://<?php echo $_SERVER['SERVER_NAME']; ?>">Login</a>  this is the same as the one above-->
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/signup.php">Signup</a>
            </li>
          

          <?php

        endif;
      ?>

    </ul>
    
  </div>
</nav>