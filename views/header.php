<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    
    <!-- custom stylesheet style.css -->
    <link rel="stylesheet" href="./style.css">
    
    <title>Hello, HASAN!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Twitter</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li>
        <a class="nav-link" href="?page=timeline">Your timeline</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=yourtweets">Your tweets</a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link " href="?page=publicprofiles">Public Profiles</a>
      </li>
    </ul>

    <div class="form-inline my-2 my-lg-0">

      <?php 
        if(isset($_SESSION['id'])){ ?>
        
        <a  class="btn btn-outline-success"  href="?function=logout">Logout</a>
        
      <?php } else{ ?>

      <button class="btn btn-outline-success my-2 my-sm-0 " data-toggle="modal" data-target="#exampleModal" >Login/Signup</button>

      <?php } ?>

    </div>
  </div>
</nav>
