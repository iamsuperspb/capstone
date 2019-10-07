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
     <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.4/themes/blitzer/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- LOGO -->
    <link rel="icon" href="../../plugin/design/logo.png">
    <title>Admin | View Applicant Status</title>
  </head>
  <body>
   	<?php
      include "top_header.php";
    ?>
    <?php
      $page = "view_status";
      include "sidemenu.php"; 
    ?>
    <div class="main-content">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><i class="fas fa-star"></i> View Applicant Status</h1>
      </div>
        <div class="applicant-tab">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a href="#college_tab" class="nav-link active" role="tab" data-toggle="tab">College</a>
            </li>
            <li class="nav-item">
              <a href="#senior_tab" class="nav-link" role="tab" data-toggle="tab">Senior High</a>
            </li>
          </ul>
          <!-- COLLEGE TAB -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="college_tab">
              <!-- SEARCH -->
                 <form method="POST">
                    <div style="width: 99%; margin-top: 30px; height:60px; border: 2px solid #A62D38; border-radius: 5px; background: #A62D38; color: #fff;">
                      <table style = "margin-top: 10px; margin-left: 5px;">
                        <tr>
                          <td width="1%">
                            Date:
                          </td>
                          <td width="20%"><input id="cl_datepicker" name="cl_date_view" class="form-control" readonly=""></td>
                          <td>
                            <button type="submit" class="btn btn-danger" name="cl_search_btn" style="background: #fff; color: #A62D38;"><i class="fas fa-check"></i></button>
                          </td>
                          <td></td>
                        </tr>
                      </table>
                      </div>
                    </form>
                    </br>
                <?php
                  if(isset($_POST["cl_search_btn"])){
                      $cl_date_view = mysqli_real_escape_string($connection,$_POST["cl_date_view"]);
                      $start = 0;
                      $limit = 5;
                      $total = mysqli_query($connection,"SELECT * FROM college_exam_score WHERE date_exam = '$cl_date_view' ORDER BY applicant_no ASC");
                      $total_rows = mysqli_num_rows($total);
                      if(isset($_GET["id"])){
                        $id = $_GET["id"];
                        $start = ($id-1)*$limit;
                      }
                      else {
                        $id = 1;
                      }
                      $page = ceil($total_rows/$limit);
                    $fetch = mysqli_query($connection,"SELECT * FROM college_exam_score WHERE date_exam = '$cl_date_view' ORDER BY applicant_no ASC LIMIT $start,$limit");
                    }
                  else{
                      date_default_timezone_set("Asia/Manila");  
                      $datetime = date('m/d/Y');
                      $start = 0;
                      $limit = 5;
                      $total = mysqli_query($connection,"SELECT * FROM college_exam_score WHERE date_exam = '$datetime' ORDER BY applicant_no ASC");
                      $total_rows = mysqli_num_rows($total);
                      if(isset($_GET["id"])){
                        $id = $_GET["id"];
                        $start = ($id-1)*$limit;
                      }
                      else {
                        $id = 1;
                      }
                      $page = ceil($total_rows/$limit);
                    $fetch = mysqli_query($connection,"SELECT * FROM college_exam_score WHERE date_exam = '$datetime' ORDER BY applicant_no ASC LIMIT $start,$limit");
                    }
                ?>
               <table class="table table-bordered" style="width: 99%; margin-top: 20px;">
                <thead style="background-color: #A62D38; color: white;">
                  <tr>
                    <th>Applicant Number</th>
                    <th>Name</th>
                    <th>Score</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                <?php
                  while($row = mysqli_fetch_array($fetch)){
                    $fetch_appno = $row["applicant_no"];
                    $fetch_name = $row["name"];
                    $fetch_email = $row["email"];
                    $fetch_score = $row["score"];
                    $fetch_status = $row["status"];
                    $fetch_first = $row["first_course"];
                    $fetch_second = $row["second_course"];
                    $fetch_third = $row["third_course"];
                    $fetch_date = $row["date_exam"];
                    $fetch_time = $row["time_exam"];
                ?>
                    <td><?php echo $fetch_appno;?></td>
                    <td><?php echo $fetch_name;?></td>
                    <td><?php echo $fetch_score;?></td>
                    <td>
                      <?php if($fetch_status == "Passed"){ ?>
                        <div class="alert alert-success" role="alert">
                          <?php echo $fetch_status;?>
                        </div>
                      <?php }?>
                      <?php if($fetch_status == "Interview"){ ?>
                        <div class="alert alert-warning" role="alert">
                          <?php echo $fetch_status;?>
                        </div>
                      <?php }?> 
                      <?php if($fetch_status == "Failed"){ ?>
                        <div class="alert alert-danger" role="alert">
                          <?php echo $fetch_status;?>
                        </div>
                      <?php }?>  
                      </td>
                    <td>
                      <a href='../../plugin/TCPDF/User/blank.php?id=<?php echo $fetch_appno;?>'>
                        <button name="generate_btn" class="btn btn-info"><i class="fas fa-file-pdf"></i>PDF</button>
                      </a>
                    </td>
                  </tr>
                <?php }?>
                </tbody>
              </table>
              </br>
              <ul class="pagination pagination-sm justify-content-center">
                <?php
                  for($i=1;$i <= $page;$i++){
                  ?>
                    <li class="page-item"><a class="page-link" href="?id=<?php echo $i ?>"><?php echo $i;?></a></li>
                <?php } ?>
              </ul>
            </div>
          <!-- SENIOR TAB -->
            <div role="tabpanel" class="tab-pane" id="senior_tab">
              <!-- SEARCH -->
              <form method="POST">
                    <div style="width: 99%; margin-top: 30px; height:60px; border: 2px solid #A62D38; border-radius: 5px; background: #A62D38; color: #fff;">
                      <table style = "margin-top: 10px; margin-left: 5px;">
                        <tr>
                          <td width="1%">
                            Date:
                          </td>
                          <td width="20%"><input id="sh_datepicker" name="sh_date_view" class="form-control" readonly=""></td>
                          <td>
                            <button type="submit" class="btn btn-danger" name="sh_search_btn" style="background: #fff; color: #A62D38;"><i class="fas fa-check"></i></button>
                          </td>
                          <td></td>
                        </tr>
                      </table>
                      </div>
                    </form>
                </br>
                <?php
                    if(isset($_POST["sh_search_btn"])){
                      $sh_date_view = mysqli_real_escape_string($connection,$_POST["sh_date_view"]);
                      $start = 0;
                      $limit = 5;
                      $total = mysqli_query($connection,"SELECT * FROM sh_exam_score WHERE date_exam = '$sh_date_view' ORDER BY applicant_no ASC");
                      $total_rows = mysqli_num_rows($total);
                      if(isset($_GET["id"])){
                        $id = $_GET["id"];
                        $start = ($id-1)*$limit;
                      }
                      else {
                        $id = 1;
                      }
                      $page = ceil($total_rows/$limit);
                    $fetch = mysqli_query($connection,"SELECT * FROM sh_exam_score WHERE date_exam = '$sh_date_view' ORDER BY applicant_no ASC LIMIT $start,$limit");
                    }
                  else{
                      date_default_timezone_set("Asia/Manila");  
                      $datetime = date('m/d/Y');
                      $start = 0;
                      $limit = 5;
                      $total = mysqli_query($connection,"SELECT * FROM sh_exam_score WHERE date_exam = '$datetime' ORDER BY applicant_no ASC");
                      $total_rows = mysqli_num_rows($total);
                      if(isset($_GET["id"])){
                        $id = $_GET["id"];
                        $start = ($id-1)*$limit;
                      }
                      else {
                        $id = 1;
                      }
                      $page = ceil($total_rows/$limit);
                    $fetch = mysqli_query($connection,"SELECT * FROM sh_exam_score WHERE date_exam = '$datetime' ORDER BY applicant_no ASC LIMIT $start,$limit");
                    }
                ?>
               <table class="table table-bordered" style="width: 99%; margin-top: 20px;">
                <thead style="background-color: #A62D38; color: white;">
                  <tr>
                    <th>Applicant Number</th>
                    <th>Name</th>
                    <th>Score</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                <?php
                  while($row = mysqli_fetch_array($fetch)){
                    $fetch_appno = $row["applicant_no"];
                    $fetch_name = $row["name"];
                    $fetch_email = $row["email"];
                    $fetch_score = $row["score"];
                    $fetch_status = $row["status"];
                    $fetch_first = $row["first_course"];
                    $fetch_second = $row["second_course"];
                    $fetch_third = $row["third_course"];
                    $fetch_date = $row["date_exam"];
                    $fetch_time = $row["time_exam"];
                ?>
                    <td><?php echo $fetch_appno;?></td>
                    <td><?php echo $fetch_name;?></td>
                    <td><?php echo $fetch_score;?></td>
                    <td>
                      <?php if($fetch_status == "Passed"){ ?>
                        <div class="alert alert-success" role="alert">
                          <?php echo $fetch_status;?>
                        </div>
                      <?php }?>
                      <?php if($fetch_status == "Interview"){ ?>
                        <div class="alert alert-warning" role="alert">
                          <?php echo $fetch_status;?>
                        </div>
                      <?php }?> 
                      <?php if($fetch_status == "Failed"){ ?>
                        <div class="alert alert-danger" role="alert">
                          <?php echo $fetch_status;?>
                        </div>
                      <?php }?>  
                      </td>
                    <td>
                      <a href='../../plugin/TCPDF/User/blank.php?id=<?php echo $fetch_appno;?>'>
                        <button name="generate_btn" class="btn btn-info"><i class="fas fa-file-pdf"></i>PDF</button>
                      </a>
                    </td>
                  </tr>
                <?php }?>
                </tbody>
              </table>
              </br>
              <ul class="pagination pagination-sm justify-content-center">
                <?php
                  for($i=1;$i <= $page;$i++){
                  ?>
                    <li class="page-item"><a class="page-link" href="?id=<?php echo $i ?>"><?php echo $i;?></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.4/themes/blitzer/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <!-- custom icon -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
     <script>
      feather.replace()
    </script>
     <script>
        $('#cl_datepicker').datepicker({
        uiLibrary: 'bootstrap4'
        });
    </script>
    <script>
        $('#sh_datepicker').datepicker({
        uiLibrary: 'bootstrap4'
        });
    </script>
  </body>
</html>