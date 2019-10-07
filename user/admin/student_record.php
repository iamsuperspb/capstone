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
  $select_course = mysqli_query($connection,"SELECT * FROM `college_course`");
  $options = "";
  while ($row_course = mysqli_fetch_array($select_course)) {
  $options = $options."<option>".$row_course[1]."</option>";
}
?>
<!-- <?php
   $query = mysqli_query($connection,"SELECT * FROM counselor_account WHERE username = '$session_username'");
   $row_query = mysqli_fetch_array($query);
   $dept = $row_query['department'];
   ?> -->
   <?php
  if(isset($_POST['add_btn'])){
    $std_name = mysqli_real_escape_string($connection,$_POST['name']);
    $std_course = mysqli_real_escape_string($connection,$_POST['course']);
    $dept = mysqli_real_escape_string($connection,$_POST["department"]);
    $std_sex = mysqli_real_escape_string($connection,$_POST['sex']);
    $std_services = mysqli_real_escape_string($connection,$_POST['services']);
    $std_reason = mysqli_real_escape_string($connection,$_POST['reason']);
    $std_remark = mysqli_real_escape_string($connection,$_POST['remarks']);
    $std_datefiled = mysqli_real_escape_string($connection,$_POST['datefiled']);
    $std_follow = mysqli_real_escape_string($connection,$_POST['followup']);
    mysqli_query($connection,"INSERT INTO student_record (name,department,course,sex,services,reason,remarks,date_filed,followup) VALUES ('$std_name','$dept','$std_course','$std_sex','$std_services','$std_reason','$std_remark','$std_datefiled','$std_follow')");
    $msg = "Successfully Added!";
  }
?>
<?php
  if(isset($_POST['update_btn'])){
    $id = mysqli_real_escape_string($connection,$_POST['id']);
    $edit_name = mysqli_real_escape_string($connection,$_POST['name']);
    $edit_course = mysqli_real_escape_string($connection,$_POST['course']);
    $edit_gender = mysqli_real_escape_string($connection,$_POST['sex']);
    $edit_services = mysqli_real_escape_string($connection,$_POST['services']);
    $edit_reason = mysqli_real_escape_string($connection,$_POST['reason']);
    $edit_remark = mysqli_real_escape_string($connection,$_POST['remarks']);
    mysqli_query($connection,"UPDATE student_record SET name = '$edit_name', course = '$edit_course', sex = '$edit_gender', services = '$edit_services', reason = '$edit_reason', remarks = '$edit_remark' WHERE id = '$id'");
    $msg = "Successfully Updated!";
  }
?>
<?php
  if(isset($_POST["delete_btn"])){
    $id = mysqli_real_escape_string($connection,$_POST['delete_id']);
    mysqli_query($connection,"DELETE FROM student_record WHERE id = '$id'");
    $msg = "Successfully deleted!";
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
    <!-- LOGO -->
    <link rel="icon" href="../../plugin/design/logo.png">
    <title>Counselor | Daily Rendered Record</title>
  </head>
  <body>
    <?php
      include "top_header.php";
    ?>
    <?php
      $page = "student_record";
      include "sidemenu.php";
    ?>
    <div class="main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><i class="fas fa-clipboard"></i> Counselor's Daily Acitivities</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <a href="#addModal" data-toggle="modal">
                <button type="button" class="btn btn-sm" style="background: #A62D38; color: white; border: 1px solid #772028;"><span data-feather="plus-square"></span> Add</button>
              </a>
            </div>
          </div>
        </div>
        <!-- ADD MODAL -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-graduation-cap"></i> Add Student</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="POST">
                        <div class="form-group">
                          <label for="name" class="col-form-label">Name:</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="">
                        </div>
                        <div class="form-group">
                          <label for="course" class="col-form-label">Course:</label>
                          <select name="course" class="form-control" required="">
                            <option value="">--SELECT--</option>
                            <?php echo $options;?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="sex" class="col-form-label">Department:</label>
                          <select class="form-control" name="department" required="">
                            <option value="">--SELECT--</option>
                            <option value="COECSA">COECSA</option>
                            <option value="CITHM">CITHM</option>
                            <option value="CAS/CAMS">CAS/CAMS</option>
                            <option value="CBA">CBA</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="sex" class="col-form-label">Sex:</label>
                          <select name="sex" class="form-control" required="">
                            <option value="">--SELECT--</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="services" class="col-form-label">Services Initial:</label>
                          <input type="text" class="form-control" id="services" name="services" placeholder="Services Initial" required="">
                        </div>
                        <div class="form-group">
                          <label for="reason" class="col-form-label">Reason Filed:</label>
                          <input type="text" class="form-control" id="reason" name="reason" placeholder="Reason Filed" required="">
                        </div>
                        <div class="form-group">
                          <label for="remarks" class="col-form-label">Remarks Filed:</label>
                          <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks Filed" required="">
                        </div>
                        <div class="form-group">
                          <label for="name" class="col-form-label">Date Filed:</label>
                          <input id="datepicker1" name="datefiled" required="" readonly=""> 
                        </div>
                        <div class="form-group">
                          <label for="name" class="col-form-label">For Follow up:</label>
                          <input id="datepicker" name="followup" required="" readonly="">                            
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger" style="background: #A62D38; color: white; border: 1px solid #772028;" name="add_btn"><span data-feather="plus"></span>Add</button>
                      <button type="button" class="btn btn-dark" data-dismiss="modal"><span data-feather="x"></span>Close</button>
                    </div>
                  </div>
                  </form>
                </div>
            </div>
        <?php
          if(isset($_POST["search_btn"])){
                $dept_view = mysqli_real_escape_string($connection,$_POST["department"]);
               $start = 0;
                $limit = 5;
                $total = mysqli_query($connection,"SELECT * FROM student_record WHERE department LIKE '%".$dept_view."'");
                $total_rows = mysqli_num_rows($total);
                if(isset($_GET["id"])){
                  $id = $_GET["id"];
                  $start = ($id-1)*$limit;
                }
                else {
                  $id = 1;
                }
                $page = ceil($total_rows/$limit);
              $fetch = mysqli_query($connection,"SELECT * FROM student_record WHERE department LIKE '%".$dept_view."'");
          }
        else{
                $start = 0;
                $limit = 5;
                $total = mysqli_query($connection,"SELECT * FROM student_record");
                $total_rows = mysqli_num_rows($total);
                if(isset($_GET["id"])){
                  $id = $_GET["id"];
                  $start = ($id-1)*$limit;
                }
                else {
                  $id = 1;
                }
                $page = ceil($total_rows/$limit);
              $fetch = mysqli_query($connection,"SELECT * FROM student_record LIMIT $start,$limit");
            }
        ?>
          <!-- ALERT ACTION -->
          <div class="alert-holder">
            <p>
          <?php 
            if (isset($_POST['add_btn'])){
              echo "<div class='alert alert-success' role='alert' style='width:99%;'>".$msg."</div>";
            }
            if (isset($_POST['update_btn'])){
              echo "<div class='alert alert-success' role='alert' style='width:99%;'>".$msg."</div>";
            }
            if (isset($_POST['delete_btn'])){
              echo "<div class='alert alert-success' role='alert' style='width:99%;'>".$msg."</div>";
            }
           ?>
            </p>
           </div>
           <form method="POST"> 
            <div style="width: 99%; margin-top: 30px; height:60px; border: 2px solid #A62D38; border-radius: 5px; background: #A62D38; color: #fff;">
              <table style = "margin-top: 10px; margin-left: 5px;">
                <tr>
                  <td width="2%">View By:</td>
                  <td width="20%">
                     <select class="form-control" name="department">
                            <option value="">--SELECT--</option>
                            <option value="COECSA">COECSA</option>
                            <option value="CITHM">CITHM</option>
                            <option value="CAS/CAMS">CAS/CAMS/CON</option>
                            <option value="CBA">CBA</option>
                            <option value="IS">IS</option>
                          </select>
                  </td>
                  <td width="20%">
                    <button class="btn btn-danger" name="search_btn" style="background: #fff; color: #A62D38;"><i class="fas fa-check"></i></button>
                  </td>
                </tr>
              </table>
            </div>
       </form>
        <table class="table table-bordered" style="width: 99%; margin-top: 20px;">
          <thead style="background-color: #A62D38; color: white;">
            <tr>
              <th>Name</th>
              <th>Department</th>
              <th width="20%">Course</th>
              <th>Services Rendered</th>
              <th>Remark</th>
              <th>Reason</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = mysqli_fetch_array($fetch)){
                $id = $row["id"];
                $fetch_name = $row["name"];
                $fetch_depart = $row["department"];
                $fetch_course = $row["course"];
                $fetch_sex = $row["sex"];
                $fetch_services = $row["services"];
                $fetch_reason = $row["reason"];
                $fetch_remarks = $row["remarks"];
                $date_filed = $row["date_filed"];
                $followup = $row["followup"];
                date_default_timezone_set("Asia/Manila");  
                $datetime = date('m/d/Y');
                if($followup == $datetime){
                                $alert = "<div class='alert alert-warning'>
                                <i class='fas fa-flag'></i> $followup
                                </div>";
                                $criticalmsg = $fetch_name . " has a followup interview today!";
                                echo "<script language='javascript'>";
                                echo "alert('$criticalmsg');";
                                echo "</script>";
                            }else {
                                $alert = $followup;
                            }
                ?>
            <tr>
              <td><?php echo $fetch_name;?></td>
              <td><?php echo $fetch_depart;?></td>
              <td><?php echo $fetch_course;?></td>
              <td><?php echo $fetch_services;?></td>
              <td><?php echo $fetch_remarks;?></td>
              <td><?php echo $fetch_reason;?></td>
              <td>
                <a href="#editModal<?php echo $id;?>" data-toggle="modal">
                  <button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                </a>
                <a href="#deleteModal<?php echo $id;?>" data-toggle="modal">
                  <button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </a>
              </td>
            </tr>
             <!-- Edit MODAL -->
              <div class="modal fade" id="editModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><span data-feather="edit"></span> Edit</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST">
                    <div class="modal-body">
                          <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                          <label for="name" class="col-form-label">Name:</label>
                          <input type="text" class="form-control" id="name" name="name" value="<?php echo $fetch_name;?>">
                        </div>
                        <div class="form-group">
                          <label for="address" class="col-form-label">Course:</label>
                          <!-- <input type="text" class="form-control" id="address" name="address" value="<?php echo $course;?>"> -->
                          <select name="course" class="form-control">
                            <?php echo $fetch_course;?>
                            <option>
                              <?php echo $fetch_course;?>
                              <?php echo $options;?>
                              </option> 
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="contact" class="col-form-label">Gender:</label>
                          <!-- <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $sex;?>"> -->
                          <select name="sex" class="form-control">
                            <?php echo $fetch_sex;?>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="services" class="col-form-label">Services Initial:</label>
                          <input type="text" class="form-control" id="services" name="services" value="<?php echo $fetch_services;?>">
                        </div>
                        <div class="form-group">
                          <label for="reason" class="col-form-label">Reason Filed:</label>
                          <input type="text" class="form-control" id="reason" name="reason" value="<?php echo $fetch_reason;?>">
                        </div>
                         <div class="form-group">
                          <label for="remarks" class="col-form-label">Remarks Filed:</label>
                          <input type="text" class="form-control" id="remarks" name="remarks" value="<?php echo $fetch_remarks;?>">
                        </div>
                         <div class="form-group">
                          <label for="date_filed" class="col-form-label">Date Filed:</label>
                          <input id="datepickeredit" name="datefiled" readonly value="<?php echo $date_filed;?>"> 
                        </div>
                         <div class="form-group">
                          <label for="followup" class="col-form-label">For Follow up:</label>
                          <input id="datepickeredit1" name="followup" readonly value="<?php echo $followup;?>"> 
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success" name="update_btn"><span data-feather="check"></span> Submit</button>
                      <button type="button" class="btn btn-dark" data-dismiss="modal"><span data-feather="x"></span> Close</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            <!-- DELETE MODAL -->
                     <div class="modal fade" id="deleteModal<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title"><span data-feather="trash-2"></span> Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form method="POST">
                          <div class="modal-body">
                            <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="name" value="<?php echo $fetch_name;?>">
                              <div class="alert alert-danger">Are you sure you want to Delete <strong>
                                    <?php echo $fetch_name; ?>'s</strong> data ?
                               </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" name="delete_btn"><span data-feather="trash-2"></span> Delete</button>
                            <button type="button" class="btn btn-dark" data-dismiss="modal"><span data-feather="x"></span> Close</button>
                          </div>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- custom icon -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
     <script>
      feather.replace()
    </script>
    <script>
        $('#datepicker1').datepicker({
        uiLibrary: 'bootstrap4'
        });
    </script>
    <script>
        $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
        });
    </script>
    <script>
        $('#datepickeredit').datepicker({
        uiLibrary: 'bootstrap4'
        });
    </script>
    <script>
        $('#datepickeredit1').datepicker({
        uiLibrary: 'bootstrap4'
        });
    </script>
  </body>
</html>