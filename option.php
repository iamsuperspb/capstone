<?php
  include "include/login_controller.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="icon" href="plugin/design/logo.png">
    <link rel="stylesheet" type="text/css" href="plugin/css/style.css">
    <title>University Entrance Exam Online Aplication</title>
  </head>
  <body>
    <?php
      $nav = "application";
      include "navbar.php";
    ?>
    <!-- LOGIN Modal-->
     <?php
      include "login.php";
     ?>
  <!-- Entrance Modal-->
    <?php
      include "examModal.php";
    ?>
    <div class="main">
      <center>
        <a href="dataprivacy.php?option=college" style="color: #fff;">
          <div class="applicant-option">
            <div style="margin-top: 80px;">
              <h2> College </h2>
              <h4>Incoming College</h4>
            </div>
          </div>
        </a>
        <a href="dataprivacy.php?option=sh" style="color: #fff;">
          <div class="applicant-option">
            <div style="margin-top: 80px;">
              <h2> Senior High School </h2>
              <h4>Incoming Senior High</h4>
            </div>
          </div>
        </a>
      </center>
    </div>
    <div class="footer">
      <center>
        <footer>
          <p style="color: #fff;"> &copy;<?php echo date('Y')."-".date('Y', strtotime('+1 year'));?> Enigma. All Right Reserved.</p>
        </footer>
        
      </center>
     </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>