<?php
	include "include/login_controller.php";
  include "include/exam_controller.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<meta name="viewport" content="widt=device-width, initial-scale=1.0, shrink-to-fit=no">
	<!-- CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	
	<link rel="icon" href="plugin/design/logo.png">
	<link rel="stylesheet" type="text/css" href="plugin/css/style.css">
	<title>Entrance Exam - Lyceum of the Philippines - Cavite Campus</title>
</head>
<body>
  <?php
    $nav = "entrance_exam";
  ?>
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #A62D38;">
  <a class="navbar-brand" href="index"><img src="plugin/design/officialseal.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto w-100 justify-content-end">
      <li class="nav-item <?php if($nav=='index'){echo 'active';}?>">
        <a class="nav-link" href="index">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#loginModal" data-toggle="modal">Login</a>
      </li>
      <li class="nav-item <?php if($nav=='entrance_exam'){echo 'active';}?>">
        <a class="nav-link" href="entrance_exam">Exam</a>
      </li>
    </ul>
  </div>
</nav>
  <!-- LOGIN Modal-->
     <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <img src="plugin/design/logo.png" style="width: 50px; height: 50px;"><h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Username:</label>
            <input type="text" class="form-control" name="username" required="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Password:</label>
            <input type="password" class="form-control" name="password" required="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="login_btn" class="btn btn-danger"><span data-feather="check-square"></span> Login</button>
        <button type="button" class="btn btn-dark" data-dismiss="modal"><span data-feather="x-square"></span> Close</button>
      </div>
    </div>
  </form>
  </div>
              <!-- JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- Icons -->
    <script src="plugin/js/icon.js"></script>
    <script>
      feather.replace()
    </script>
</body>
</html>