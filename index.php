<?php
	include "include/login_controller.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<!-- CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	
	<link rel="icon" href="plugin/design/logo.png">
	<link rel="stylesheet" type="text/css" href="plugin/css/style.css">
	<title>Lyceum of the Philippines - Cavite Campus</title>
</head>
<style type="text/css">
  .back-background{
  background-image: url("plugin/design/background.jpg");
}
</style>
<body>
  <?php
    $nav = "index";
    include "navbar.php";
  ?>
  <div class="back-background">
    <div id="slider" class="carousel slide" data-ride="carousel" style="width: 80%;margin: 0 auto; box-shadow: 2px 2px solid black;">
  				  <ol class="carousel-indicators">
  				    <li data-target="#slider" data-slide-to="0" class="active"></li>
  				    <li data-target="#slider" data-slide-to="1"></li>
  				    <li data-target="#slider" data-slide-to="2"></li>
  				    <li data-target="#slider" data-slide-to="3"></li>
  				  </ol>
  				  <div class="carousel-inner">
  				    <div class="carousel-item active">
  				      <img class="d-block w-100" src="plugin/design/bg5.jpg" width="100%" height="800px" alt="First slide">
  				    </div>
  				    <div class="carousel-item">
  				      <img class="d-block w-100" src="plugin/design/bg6.jpg" width="100%" height="800px" alt="Second slide">
  				    </div>
  				    <div class="carousel-item">
  				      <img class="d-block w-100" src="plugin/design/bg1.jpg" width="100%" height="800px" alt="Third slide">
  				    </div>
  				    <div class="carousel-item">
  				      <img class="d-block w-100" src="plugin/design/bg4.jpg" width="100%" height="800px" alt="Fourth slide">
  				    </div>
  				  </div>
  				  <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
  				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  				    <span class="sr-only">Previous</span>
  				  </a>
  				  <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
  				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
  				    <span class="sr-only">Next</span>
  				  </a>
      </div>
    </div>
	<!-- LOGIN Modal-->
		 <?php
      include "login.php";
     ?>
  <!-- Entrance Modal-->
    <?php
      include "examModal.php";
    ?>
<div class="footer">
      <center>
        <footer>
          <p style="color: #fff;"> &copy;<?php echo date('Y')."-".date('Y', strtotime('+1 year'));?> Enigma. All Right Reserved.</p>
        </footer>
        
      </center>
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