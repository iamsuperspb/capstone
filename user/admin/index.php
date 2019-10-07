<?php
  include "../../include/connection.php";
  include "../../include/login_controller.php";
  $session_username = $_SESSION['username'];
  $session_usertype = $_SESSION['usertype'];
  if(empty($_SESSION['username'])){
    header("location:../../index");
  }
  if($session_usertype != "admin"){
    header("location:../../forbidden");
  }
?>
<?php 
  date_default_timezone_set("Asia/Manila");
  $date = date('m/d/Y');
  $query = mysqli_query($connection,"SELECT COUNT(*) AS college_applicant FROM college_applicant_information");
  $college_result = mysqli_fetch_assoc($query);
  $college_applicant = $college_result["college_applicant"];
  $sh_query = mysqli_query($connection,"SELECT COUNT(*) AS sh_applicant FROM senior_applicant_information");
  $sh_result = mysqli_fetch_assoc($sh_query);
  $sh_applicant = $sh_result["sh_applicant"];
  $cpad_query = mysqli_query($connection,"SELECT COUNT(*) AS cpad FROM useraccount WHERE usertype = 'cpad' AND status = 'active'");
  $cpad_result = mysqli_fetch_assoc($cpad_query);
  $cpad = $cpad_result["cpad"];
  $counselor_query = mysqli_query($connection,"SELECT COUNT(*) AS counselor FROM counselor_account WHERE status = 'active'");
  $counselor_result = mysqli_fetch_assoc($counselor_query);
  $counselor = $counselor_result["counselor"];
  
  
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" type="text/css" href="../../plugin/css/style.css">
    <!-- CUSTOM ICONS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- LOGO -->
    <link rel="icon" href="../../plugin/design/logo.png">
    <title>Admin | Dashboard</title>
  </head>
  <body>
   	<?php
      include "top_header.php";
    ?>
    <?php
      $page = "index";
      include "sidemenu.php"; 
    ?>
    <div class="main-content">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><i class="fa fa-tachometer-alt"></i> Dashboard</h1>
      </div>
      <div class="overview">
        <div class="overview-header">
          <h3>Overview</h3> 
        </div>
        <div class="row">
          <div class="col-md-2">
                  <a href="college_applicant">
                   <div class="dashboard college-applicant">
                     <center><h1><?php echo $college_applicant;?></h1></center>
                     <h5>College Applicant</h5><h1><span class="fas fa-user"></span></h1>
                   </div>
                   </a> 
          </div>
          <div class="col-md-2">
                  <a href="shs_applicant">
                   <div class="dashboard college-applicant">
                     <center><h1><?php echo $sh_applicant;?></h1></center>
                     <h6>Senior High Applicant</h6><h1><span class="fas fa-user"></span></h1>
                   </div>
                   </a> 
          </div>
          <div class="col-md-2">
                  <a href="cpad_account">
                   <div class="dashboard college-applicant">
                     <center><h1><?php echo $cpad;?></h1></center>
                     <h5>CPAD Account</h5><h1><span class="fas fa-user"></span></h1>
                   </div>
                   </a> 
          </div>
          <div class="col-md-2">
                  <a href="counselor_account">
                   <div class="dashboard college-applicant">
                     <center><h1><?php echo $counselor;?></h1></center>
                     <h5>Counselor Account</h5><h1><span class="fas fa-user"></span></h1>
                   </div>
                   </a> 
          </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- custom icon -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
     <script>
      feather.replace()
    </script>
  </body>
</html>