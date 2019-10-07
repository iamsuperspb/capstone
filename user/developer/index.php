<?php
  include "../../include/connection.php";
  include "../../include/login_controller.php";
  $session_username = $_SESSION['username'];
  $session_usertype = $_SESSION['usertype'];
  if(empty($_SESSION['username'])){
    header("location:../../index");
  }
  if($session_usertype != "developer"){
    header("location:../../forbidden");
  }
?>
<?php 
  $query = mysqli_query($connection,"SELECT COUNT(*) AS admin FROM useraccount WHERE usertype = 'admin' AND status = 'active'");
  $result = mysqli_fetch_assoc($query);
  $admin = $result["admin"];
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
    <title>Developer | Dashboard</title>
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
            <h1 class="h2">Dashboard</h1>
      </div>
      <div class="overview">
        <div class="overview-header">
          <h3>Overview</h3> 
        </div>
        <div class="row">
          <div class="col-md-2">
                  <a href="admin_account">
                   <div class="dashboard college-applicant">
                     <center><h1><?php echo $admin;?></h1></center>
                     <h3>Admin</h3><h1><span class="fas fa-user-lock"></span></h1>
                   </div>
                   </a> 
          </div>
          <div class="col-md-2">
                  <a href="admin_account">
                   <div class="dashboard college-applicant">
                     <center><h1><?php echo $admin;?></h1></center>
                     <h3>Cpad</h3><h1><span class="fas fa-user-cog"></span></h1>
                   </div>
                   </a> 
          </div>
          <div class="col-md-2">
                  <a href="admin_account">
                   <div class="dashboard college-applicant">
                     <center><h1><?php echo $admin;?></h1></center>
                     <h3>Counselor</h3><h1><span class="fas fa-user-cog"></span></h1>
                   </div>
                   </a> 
          </div>
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