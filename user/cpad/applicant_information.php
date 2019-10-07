  <?php
  include "../../include/connection.php";
  include "../../include/login_controller.php";
  $session_username = $_SESSION['username'];
  $session_usertype = $_SESSION['usertype'];
  if(empty($_SESSION['username'])){
    header("location:../../index");
  }
  if($session_usertype != "cpad"){
    header("location:../../forbidden");
  }
?>
<?php
  if(isset($_POST["college_tab_btn"])){
      header("location:college_applicationform");
  }
?>
<?php
  if(isset($_POST["senior_tab_btn"])){
      header("location:senior_applicationform");
  }
?>
<?php
  if(isset($_POST["verify_cl_btn"])){
    $apl_no = mysqli_real_escape_string($connection,$_POST["appno"]);
    mysqli_query($connection,"UPDATE college_applicant_information SET status='Approved' WHERE applicant_no = '$apl_no'");
  }
?>
<?php
  if(isset($_POST["verify_sh_btn"])){
    $apl_no = mysqli_real_escape_string($connection,$_POST["appno"]);
    mysqli_query($connection,"UPDATE senior_applicant_information SET status='Approved' WHERE applicant_no = '$apl_no'");
  }
?>
<?php
  if(isset($_POST["cl_edit_btn"])){

  }
?>
<?php
  if(isset($_POST["schedule_cl_btn"])){
    $id = mysqli_real_escape_string($connection,$_POST["id"]);
    $update_date = mysqli_real_escape_string($connection,$_POST["date_exam"]);
    $update_time = mysqli_real_escape_string($connection,$_POST["time_exam"]);
    mysqli_query($connection,"UPDATE college_applicant_information SET date_exam = '$update_date', time_exam = '$update_time' WHERE applicant_no = '$id'");
  }
?>
<?php
  if(isset($_POST["schedule_sh_btn"])){
    $id = mysqli_real_escape_string($connection,$_POST["id"]);
    $update_date = mysqli_real_escape_string($connection,$_POST["date_exam"]);
    $update_time = mysqli_real_escape_string($connection,$_POST["time_exam"]);
    mysqli_query($connection,"UPDATE senior_applicant_information SET date_exam = '$update_date', time_exam = '$update_time' WHERE applicant_no = '$id'");
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
    <title>Admin | Applicant Information</title>
    
  </head>
  <body>
    <?php
      include "top_header.php";
    ?>
    <?php
      $page = "applicant_information";
      include "sidemenu.php"; 
    ?>
    <div class="main-content">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Applicant Information</h1>
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
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="college_tab"> 
          <!-- COLLEGE TAB -->
          <!-- SEARCH BOX -->
        <form method="POST"> 
            <div style="width: 99%; margin-top: 30px; height:60px; border: 2px solid #A62D38; border-radius: 5px; background: #A62D38; color: #fff;">
              <table style = "margin-top: 10px; margin-left: 5px;">
                <tr>
                  <td width="1%">
                    Date:
                  </td>
                  <td width="20%"><input id="datepicker" name="date_view" class="form-control" readonly=""></td>
                  <td width="3%"> View By:</td>
                  <td width="20%">
                    <select class="form-control" name = "viewby_opt" required="">
                      <option value="">Select</option>
                      <option value="Approved">Approved</option>
                      <option value="Pending">Pending</option>
                    </select>
                  </td>
                  <td width="20%">
                    <button class="btn btn-danger" name="cl_search_btn" style="background: #fff; color: #A62D38;"><i class="fas fa-check"></i></button>
                  </td>
                </tr>
              </table>
            </div>
       </form>
       <!-- <form method="POST">
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2" style="margin-left: 89%;">
                <button type="submit" name="export_btn" class="btn btn-sm" style="background: #A62D38; color: white; border: 1px solid #772028;"><span data-feather="file-text"></span>Export</button>
                <button type="submit" name="college_tab_btn" class="btn btn-sm" style="background: #A62D38; color: white; border: 1px solid #772028;"><span data-feather="plus-square"></span> Add</button>
              </div>
            </div>
          </form> -->
          <?php
            if(isset($_POST["cl_search_btn"])){
              $date_view = mysqli_real_escape_string($connection,$_POST["date_view"]);
              $viewby = mysqli_real_escape_string($connection,$_POST["viewby_opt"]);
              $start = 0;
                $limit = 5;
                $total = mysqli_query($connection,"SELECT * FROM college_applicant_information WHERE date_exam ='$date_view' AND status = '$viewby' ORDER BY applicant_no ASC");
                $total_rows = mysqli_num_rows($total);
                if(isset($_GET["id"])){
                  $id = $_GET["id"];
                  $start = ($id-1)*$limit;
                }
                else {
                  $id = 1;
                }
              $page = ceil($total_rows/$limit);
              $fetch = mysqli_query($connection,"SELECT * FROM college_applicant_information WHERE date_exam ='$date_view' AND status = '$viewby' ORDER BY applicant_no ASC LIMIT $start,$limit");
            }
            else{
                date_default_timezone_set("Asia/Manila");  
                $datetime = date('m/d/Y');
                $start = 0;
                $limit = 5;
                $total = mysqli_query($connection,"SELECT * FROM college_applicant_information WHERE date_exam = '$datetime' ORDER BY applicant_no ASC");
                $total_rows = mysqli_num_rows($total);
                if(isset($_GET["id"])){
                  $id = $_GET["id"];
                  $start = ($id-1)*$limit;
                }
                else {
                  $id = 1;
                }
                $page = ceil($total_rows/$limit);
              $fetch = mysqli_query($connection,"SELECT * FROM college_applicant_information WHERE date_exam = '$datetime' ORDER BY applicant_no ASC LIMIT $start,$limit");
              }
          ?>
         <table class="table table-bordered" style="width: 99%; margin-top: 20px;">
          <thead style="background-color: #A62D38; color: white;">
            <tr>
              <th>Applicant Number</th>
              <th>Name</th>
              <th>Email Address</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = mysqli_fetch_array($fetch)){
                $appno = $row["applicant_no"];
                $fname = $row["fname"];
                $lname = $row["lname"];
                $mname = $row["mname"];
                $fullname = ucfirst($fname)." " . ucfirst($mname[0]) . ". " . ucfirst($lname);
                $email = $row["emailadd"];
                $first_course = $row["firstchoice"];
                $second_course = $row["secondchoice"];
                $third_course = $row["thirdchoice"];
                $status = $row["status"];
                $date_exam = $row["date_exam"];
                $time_exam = $row["time_exam"];
            ?>
            <tr>
              <td><?php echo $appno;?></td>
              <td><?php echo $fullname;?></td>
              <td><?php echo $email;?></td>
              <td>
                <?php if($status == "Pending"){?>
                  <div class="alert alert-warning">
                <?php }?>
                <?php if($status == "Approved"){?>
                  <div class="alert alert-success">
                <?php }?>
                <?php echo $status;?>
              </td>
              <td>
                <?php if($status=="Approved"){?>
                  <a href="#reschedModal<?php echo $appno;?>" data-toggle="modal">
                    <button class="btn btn-danger" style="background-color: #A62D38;" name="view_btn"><i class="fas fa-calendar-alt"></i></button>
                  </a>
                  <a href="#viewModal<?php echo $appno;?>" data-toggle="modal">
                    <button class="btn btn-info" name="view_btn"><i class="fas fa-eye"></i></button>
                  </a>
                <?php }?>
                <?php if($status=="Pending"){?>
                  <a href="#reschedModal<?php echo $appno;?>" data-toggle="modal">
                    <button class="btn btn-danger" style="background-color: #A62D38;" name="view_btn"><i class="fas fa-calendar-alt"></i></button>
                  </a>
                  <a href="#verifyModal<?php echo $appno;?>" data-toggle="modal">
                    <button class="btn btn-success" name="verify_btn"><i class="fas fa-check"></i> Verify</button>
                  </a>
                <?php }?>
              </td>
            </tr>
            <!-- VERIFY -->
            <div class="modal fade" id="verifyModal<?php echo $appno;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><span data-feather="check"></span> Verify</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST">
                    <div class="modal-body">
                          <input type="hidden" class="form-control" id="appno" name="appno" value="<?php echo $appno; ?>">
                          <div class="alert alert-success">Are you sure you want to verify <strong>
                                    <?php echo $appno; ?>?</strong>
                               </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success" name="verify_cl_btn"><span data-feather="check"></span> Yes</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><span data-feather="x"></span> No</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Reschedule -->
              <script type="text/javascript">
                $(document).ready(function(){
                    $('#date_exam<?php echo $appno;?>').datepicker({
                      minDate: 0,
                      beforeShowDay: function(date){
                      var day = date.getDay();
                      if(day==0 || day==4 || day==2){
                        return[false];
                      }
                      else if(date != date){
                        return[false];
                      }
                      else{
                        return [true];
                      }   
                    }});
                   });    
              </script>
            <div class="modal fade" id="reschedModal<?php echo $appno;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><span data-feather="calendar"></span> Schedule</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST">
                    <div class="modal-body">
                      <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $appno;?>">
                        <label for="fname" class="col-form-label">Date of Exam</label>
                        <input type="text" class="form-control" name="date_exam" id="date_exam<?php echo $appno;?>" value="<?php echo $date_exam?>" autocomplete="off" readonly="">
                        <label for="fname" class="col-form-label">Time of Exam</label>
                        <select class="form-control" name="time_exam">
                          <option value="<?php echo $time_exam;?>"><?php echo $time_exam;?></option>
                          <?php if($time_exam == "9:00 AM"){?>
                            <option value="1:30 PM">1:30 PM</option>
                          <?php }?>
                          <?php if($time_exam == "1:30 PM"){?>
                          <option value="9:00 AM">9:00 AM</option>
                          <?php }?>
                        </select>
                      </div>    
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success" name="schedule_cl_btn"><span data-feather="check"></span> Confirm</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><span data-feather="x"></span> No</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
                <!-- VIEW -->
      <div class="modal fade bd-example-modal-xl" id="viewModal<?php echo $appno;?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
             <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">*Applicant Information</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST">
                    <div class="modal-body">
                        <form method="POST">
                          <div id="printableArea">
                            <div class="form-group">
                              <label for="fname" class="col-form-label">Name</label>
                              <input type="text" class="form-control" id="fname" name="name" value="<?php echo $fullname;?>">
                              <label for="fname" class="col-form-label">Applicant Status</label>
                              <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $status;?>">
                              <label for="fname" class="col-form-label">Course Applied</label>
                              <label for="fname" class="col-form-label">Firt Choice:</label>
                              <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $first_course;?>">
                              <br>
                              <label for="fname" class="col-form-label">Second Choice:</label>
                              <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $second_course;?>">
                              <label for="fname" class="col-form-label">Third Choice:</label>
                              <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $third_course;?>">
                            </div>
                          </div>
                        </form> 
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-warning" name="cl_edit_btn"><i class="fas fa-pen"></i> Edit</button>
                      <button type="button" class="btn btn-dark" data-dismiss="modal"><span data-feather="x"></span> No</button>
                    </div>
                    </form>
          </div>
        </div>
      </div>
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
        <!-- SENIOR HIGH TAB -->
          <div role="tabpanel" class="tab-pane" id="senior_tab">
             <form method="POST"> 
            <div style="width: 99%; margin-top: 30px; height:60px; border: 2px solid #A62D38; border-radius: 5px; background: #A62D38; color: #fff;">
              <table style = "margin-top: 10px; margin-left: 5px;">
                <tr>
                  <td width="1%">
                    Date:
                  </td>
                  <td width="20%"><input id="datepicker1" name="date_view" class="form-control" readonly=""></td>
                  <td width="3%"> View By:</td>
                  <td width="20%">
                    <select class="form-control" name = "viewby_opt" required="">
                      <option value="">Select</option>
                      <option value="Approved">Approved</option>
                      <option value="Pending">Pending</option>
                    </select>
                  </td>
                  <td width="20%">
                    <button class="btn btn-danger" name="sh_search_btn" style="background: #fff; color: #A62D38;"><i class="fas fa-check"></i></button>
                  </td>
                </tr>
              </table>
            </div>
       </form>
       <!-- <form method="POST">
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2" style="margin-left: 89%;">
                <button type="submit" name="export_btn" class="btn btn-sm" style="background: #A62D38; color: white; border: 1px solid #772028;"><span data-feather="file-text"></span>Export</button>
                <button type="submit" name="senior_tab_btn" class="btn btn-sm" style="background: #A62D38; color: white; border: 1px solid #772028;"><span data-feather="plus-square"></span> Add</button>
              </div>
            </div>
          </form> -->
          <?php
           if(isset($_POST["sh_search_btn"])){
              $date_view = mysqli_real_escape_string($connection,$_POST["date_view"]);
              $viewby = mysqli_real_escape_string($connection,$_POST["viewby_opt"]);
              $start = 0;
                $limit = 5;
                $total = mysqli_query($connection,"SELECT * FROM `senior_applicant_information` WHERE date_exam ='$date_view' AND status = '$viewby' ORDER BY applicant_no ASC");
                $total_rows = mysqli_num_rows($total);
                if(isset($_GET["id"])){
                  $id = $_GET["id"];
                  $start = ($id-1)*$limit;
                }
                else {
                  $id = 1;
                }
              $page = ceil($total_rows/$limit);
              $fetch = mysqli_query($connection,"SELECT * FROM `senior_applicant_information` WHERE date_exam ='$date_view' AND status = '$viewby' ORDER BY applicant_no ASC LIMIT $start,$limit");
            }
             else{
                date_default_timezone_set("Asia/Manila");  
                $datetime = date('m/d/Y');
                $start = 0;
                $limit = 5;
                $total = mysqli_query($connection,"SELECT * FROM `senior_applicant_information` WHERE date_exam = '$datetime' ORDER BY applicant_no ASC");
                $total_rows = mysqli_num_rows($total);
                if(isset($_GET["id"])){
                  $id = $_GET["id"];
                  $start = ($id-1)*$limit;
                }
                else {
                  $id = 1;
                }
                $page = ceil($total_rows/$limit);
                $fetch = mysqli_query($connection,"SELECT * FROM `senior_applicant_information` WHERE date_exam = '$datetime' ORDER BY applicant_no ASC LIMIT $start,$limit");
              }
          ?>
         <table class="table table-bordered" style="width: 99%; margin-top: 20px;">
          <thead style="background-color: #A62D38; color: white;">
            <tr>
              <th>Applicant Number</th>
              <th>Name</th>
              <th>Email Address</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = mysqli_fetch_array($fetch)){
                $appno = $row["applicant_no"];
                $fname = $row["fname"];
                $lname = $row["lname"];
                $mname = $row["mname"];
                $fullname = ucfirst($fname)." " . ucfirst($mname[0]) . ". " . ucfirst($lname);
                $email = $row["emailadd"];
                $status = $row["status"];
                $date_exam = $row["date_exam"];
                $time_exam = $row["time_exam"];
            ?>
            <tr>
              <td><?php echo $appno;?></td>
              <td><?php echo $fullname;?></td>
              <td><?php echo $email;?></td>
              <td><?php if($status == "Pending"){?>
                  <div class="alert alert-warning">
                <?php }?>
                <?php if($status == "Approved"){?>
                  <div class="alert alert-success">
                <?php }?>
                <?php echo $status;?></td>
              <td>
                <?php if($status=="Approved"){?>
                  <a href="#reschedModal<?php echo $appno;?>" data-toggle="modal">
                    <button class="btn btn-danger" style="background-color: #A62D38;" name="view_btn"><i class="fas fa-calendar-alt"></i></button>
                  </a>
                  <a href="#viewModal<?php echo $appno;?>" data-toggle="modal">
                    <button class="btn btn-info" name="view_btn"><i class="fas fa-eye"></i> View</button>
                  </a>
                <?php }?>
                <?php if($status=="Pending"){?>
                  <a href="#reschedModal<?php echo $appno;?>" data-toggle="modal">
                    <button class="btn btn-danger" style="background-color: #A62D38;" name="view_btn"><i class="fas fa-calendar-alt"></i></button>
                  </a>
                  <a href="#verifyModal<?php echo $appno;?>" data-toggle="modal">
                    <button class="btn btn-success" name="verify_btn"><i class="fas fa-check"></i> Verify</button>
                  </a>
                <?php }?>
              </td>
            </tr>
            <div class="modal fade" id="verifyModal<?php echo $appno;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><span data-feather="check"></span> Verify</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST">
                    <div class="modal-body">
                          <input type="hidden" class="form-control" id="appno" name="appno" value="<?php echo $appno; ?>">
                          <div class="alert alert-success">Are you sure you want to verify <strong>
                                    <?php echo $appno; ?>?</strong>
                               </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success" name="verify_sh_btn"><span data-feather="check"></span> Yes</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><span data-feather="x"></span> No</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
                <!-- Reschedule -->
                <script type="text/javascript">
                $(document).ready(function(){
                    $('#date_exam<?php echo $appno;?>').datepicker({
                      minDate: 0,
                      beforeShowDay: function(date){
                      var day = date.getDay();
                      if(day==0 || day==4 || day==2){
                        return[false];
                      }
                      else if(date != date){
                        return[false];
                      }
                      else{
                        return [true];
                      }   
                    }});
                   });    
              </script>
            <div class="modal fade" id="reschedModal<?php echo $appno;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><span data-feather="calendar"></span> Schedule</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST">
                    <div class="modal-body">
                      <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $appno;?>">
                        <label for="fname" class="col-form-label">Date of Exam</label>
                        <input type="text" class="form-control" name="date_exam" id="date_exam<?php echo $appno;?>" value="<?php echo $date_exam?>" autocomplete="off" readonly="">
                        <label for="fname" class="col-form-label">Time of Exam</label>
                        <select class="form-control" name="time_exam">
                          <option value="<?php echo $time_exam;?>"><?php echo $time_exam;?></option>
                          <?php if($time_exam == "9:00 AM"){?>
                            <option value="1:30 PM">1:30 PM</option>
                          <?php }?>
                          <?php if($time_exam == "1:30 PM"){?>
                          <option value="9:00 AM">9:00 AM</option>
                          <?php }?>
                        </select>
                      </div>    
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success" name="schedule_sh_btn"><span data-feather="check"></span> Confirm</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><span data-feather="x"></span> No</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
                        <!-- VIEW -->
      <div class="modal fade bd-example-modal-xl" id="viewModal<?php echo $appno;?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
             <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">*Applicant Information</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST">
                    <div class="modal-body">
                        <form method="POST">
                          <div id="printableArea">
                            <div class="form-group">
                              <label for="fname" class="col-form-label">Name</label>
                              <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fullname;?>">
                              <label for="fname" class="col-form-label">Applicant Status</label>
                              <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $status;?>">
                              <label for="fname" class="col-form-label">Course Applied</label>
                              <label for="fname" class="col-form-label">Firt Choice:</label>
                              <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $first_course;?>">
                              <br>
                              <label for="fname" class="col-form-label">Second Choice:</label>
                              <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $second_course;?>">
                              <label for="fname" class="col-form-label">Third Choice:</label>
                              <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $third_course;?>">
                            </div>
                          </div>
                        </form> 
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-warning" name="sh_edit_btn"><i class="fas fa-pen"></i> Edit</button>
                      <button type="button" class="btn btn-dark" data-dismiss="modal"><span data-feather="x"></span> No</button>
                    </div>
                    </form>
          </div>
        </div>
      </div>
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
        $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
        });
    </script>
    <script>
        $('#datepicker1').datepicker({
        uiLibrary: 'bootstrap4'
        });
    </script>
  </body>
</html>