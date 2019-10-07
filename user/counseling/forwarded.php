<?php
  include "../../include/connection.php";
  include "../../include/login_controller.php";
  $session_username = $_SESSION['username'];
  $session_usertype = $_SESSION['usertype'];
  if(empty($_SESSION['username'])){
    header("location:../../index");
  }
  if($session_usertype != "counselor"){
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
<?php
  $select_strand = mysqli_query($connection,"SELECT * FROM `strand`");
  $options_strand = "";
  while ($row_strand = mysqli_fetch_array($select_strand)) {
  $options_strand = $options_strand.$row_strand[1];
}
?>
<?php
   $query = mysqli_query($connection,"SELECT * FROM counselor_account WHERE username = '$session_username'");
   $row_query = mysqli_fetch_array($query);
   $dept = $row_query['department'];
   ?>
   <?php
  if(isset($_POST['add_btn'])){
    $std_name = mysqli_real_escape_string($connection,$_POST['name']);
    $std_course = mysqli_real_escape_string($connection,$_POST['course']);
    $std_sex = mysqli_real_escape_string($connection,$_POST['sex']);
    $std_services = mysqli_real_escape_string($connection,$_POST['services']);
    $std_reason = mysqli_real_escape_string($connection,$_POST['reason']);
    $std_remark = mysqli_real_escape_string($connection,$_POST['remarks']);
    if($std_services == "Consultation-Referred By"){
    $std_referred = mysqli_real_escape_string($connection,$_POST["services_text"]);
      if($std_remark == "For Followup"){
        $std_followup = mysqli_real_escape_string($connection,$_POST["followup"]);
        mysqli_query($connection,"INSERT INTO student_record (name,department,course,sex,services,referred_by,reason,remarks,date_filed,followup,archive) VALUES ('$std_name','$dept','$std_course','$std_sex','$std_services','$std_referred','$std_reason','$std_remark','$datetime','$std_followup','0')");
      $msg = "Successfully Added!";
      }
      else{
      mysqli_query($connection,"INSERT INTO student_record (name,department,course,sex,services,referred_by,reason,remarks,date_filed,followup,archive) VALUES ('$std_name','$dept','$std_course','$std_sex','$std_services','$std_referred','$std_reason','$std_remark','$datetime','N/A','0')");
      $msg = "Successfully Added!";
      }
    }
    else{
      if($std_remark == "For Followup"){
        $std_followup = mysqli_real_escape_string($connection,$_POST["followup"]);
         mysqli_query($connection,"INSERT INTO student_record (name,department,course,sex,services,referred_by,reason,remarks,date_filed,followup,archive) VALUES ('$std_name','$dept','$std_course','$std_sex','$std_services','N/A','$std_reason','$std_remark','$datetime','$std_followup','0')");
      $msg = "Successfully Added!";
      }
      else{
      mysqli_query($connection,"INSERT INTO student_record (name,department,course,sex,services,referred_by,reason,remarks,date_filed,followup,archive) VALUES ('$std_name','$dept','$std_course','$std_sex','$std_services','N/A','$std_reason','$std_remark','$datetime','N/A','0')");
      $msg = "Successfully Added!";
    }
    }

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
    mysqli_query($connection,"UPDATE student_record SET archive = '1' WHERE id = '$id'");
    $msg = "Data move to archive successfully!";
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
    <title>Counselor | Forwarding</title>
  </head>
  <body>
    <?php
      include "top_header.php";
    ?>
    <?php
      $page = "forwarded";
      include "sidemenu.php";
    ?>
    <div class="main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><i class="fas fa-reply"></i> Forwarding</h1>
            <div class="btn-group mr-2">
                <a href="#addModal" data-toggle="modal">
                <button type="button" class="btn btn-sm" style="background: #A62D38; color: white; border: 1px solid #772028;"><span data-feather="plus-square"></span> Add</button>
              </a>
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
                        <script>
                          function dept(){
                             div = document.getElementById("div");
                             dept = document.getElementById("department").value;
                             if($dept == "IS"){
                              x = document.createElement("select");
                              x.setAttribute("class","form-control");
                              x.setAttribute("required","");
                              y = document.createElement("option");
                              y.setAttribute("value","<?php echo $options_strand?>");
                              y.appendChild()
                             }
                          }
                        </script>
                        <div class="form-group">
                           <label for="password" class="col-form-label">Department:</label>
                          <select class="form-control" name="department" id="department" onchange="dept()" required="">
                            <option value="">--SELECT--</option>
                            <option value="COECSA">COECSA</option>
                            <option value="CITHM">CITHM</option>
                            <option value="CAS/CAMS">CAS/CAMS/CON</option>
                            <option value="CBA">CBA</option>
                            <option value="IS">IS</option>
                          </select>
                        </div>
                        <div id="div">
                          <!-- <label for="course" class="col-form-label">Course:</label>
                          <select name="course" class="form-control" required="">
                            <option value="">--SELECT--</option>
                            <?php
                              $dpt = mysqli_real_escape_string($connection,$_POST);
                                if($dept == "IS"){
                                  echo $options_strand;
                                }
                                else {
                                  echo $options;
                                }
                            ?>
                          </select> -->
                        </div>
                        <div class="form-group">
                          <label for="sex" class="col-form-label">Sex:</label>
                          <select name="sex" class="form-control" required="">
                            <option value="">--SELECT--</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                        <script>
                          function display(){
                              div = document.getElementById("div");
                              valid = document.getElementById("services").value;
                              if(valid == "Consultation-Referred By"){
                                para = document.createElement("p");
                                node = document.createTextNode("Referred By:");
                                div.appendChild(node); 
                                x = document.createElement("input");
                                x.setAttribute("type","text");
                                x.setAttribute("class","form-control");
                                x.setAttribute("name","services_text");
                                x.setAttribute("required","");
                                div.appendChild(x);
                            }
                          }
                        </script>
                        <div class="form-group">
                          <label for="services" class="col-form-label">Services Rendered:</label>
                          <select class="form-control" name="services" id="services" required="" onchange="display()">
                            <option value="">--SELECT--</option>
                            <option value="Consultation-Walk in">Consultation-Walk in</option>
                            <option value="Consultation-Referred By">Consultation-Referred By</option>
                            <option value="Counseling">Counseling</option>
                            <option value="Dropping">Dropping</option>
                            <option value="Shifting/Changing Track">Shifting/Changing Track</option>
                            <option value="Transfer">Transfer</option>
                            <option value="SSS Clearance - Graduating">SSS Clearance - Graduating</option>
                          </select>
                        </div>
                        <div id="div"></div>
                        <div class="form-group">
                          <label for="reason" class="col-form-label">Reason:</label>
                          <input type="text" class="form-control" id="reason" name="reason" placeholder="Reason Filed" required="">
                        </div>
                        <script>
                          function follow_date(){
                            div1 = document.getElementById("div1");
                            valid1 = document.getElementById("remarks").value;
                            if(valid1 == "For Followup"){
                                p = document.createElement("p");
                                node1 = document.createTextNode("For Followup:");
                                div1.appendChild(node1); 
                                x1 = document.createElement("input");
                                x1.setAttribute("type","date");
                                x1.setAttribute("id","datepicker");
                                x1.setAttribute("name","followup");
                                x1.setAttribute("class","form-control");
                                x1.setAttribute("required","");
                                div1.appendChild(x1);
                            }
                          }
                        </script>
                        <div class="form-group">
                          <label for="remarks" class="col-form-label">Remarks:</label>
                          <select class="form-control" name="remarks" id="remarks" required="" onchange="follow_date()">
                            <option value="">--SELECT--</option>
                            <option value="Filed/Terminated">Filed/Terminated</option>
                            <option value="For Followup">For Followup</option>
                          </select>
                        </div>
                        <div id="div1"></div>
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
                $search = mysqli_real_escape_string($connection,$_POST["search_by"]);
                $start = 0;
                $limit = 5;
                $total = mysqli_query($connection,"SELECT * FROM student_record WHERE name LIKE '%".$search."%' AND department = '$department' AND archive = '0'");
                $total_rows = mysqli_num_rows($total);
                if(isset($_GET["id"])){
                  $id = $_GET["id"];
                  $start = ($id-1)*$limit;
                }
                else {
                  $id = 1;
                }
                $page = ceil($total_rows/$limit);
              $fetch = mysqli_query($connection,"SELECT * FROM student_record WHERE name LIKE '%".$search."%' AND department = '$department' AND archive = '0' LIMIT $start,$limit");
            }
            else{
              $start = 0;
                $limit = 5;
                $total = mysqli_query($connection,"SELECT * FROM student_record WHERE department = '$department' AND archive = '0'");
                $total_rows = mysqli_num_rows($total);
                if(isset($_GET["id"])){
                  $id = $_GET["id"];
                  $start = ($id-1)*$limit;
                }
                else {
                  $id = 1;
                }
                $page = ceil($total_rows/$limit);
              $fetch = mysqli_query($connection,"SELECT * FROM student_record WHERE department = '$department' AND archive = '0' LIMIT $start,$limit");
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
                          <td width="1%">
                            Search:
                          </td>
                          <td width="20%"><input type="text" name="search_by" class="form-control"></td>
                          <td>
                            <button type="submit" class="btn btn-danger" name="search_btn" style="background: #fff; color: #A62D38;"><i class="fas fa-check"></i></button>
                          </td>
                          <td></td>
                        </tr>
                      </table>
                      </div>
                    </form>
        <table class="table table-bordered" style="width: 99%; margin-top: 20px;">
          <thead style="background-color: #A62D38; color: white;">
            <tr>
              <th>Name</th>
              <th>Course</th>
              <th>Services Rendered</th>
              <th>Reason</th>
              <th>Remarks</th>
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
            ?>
            <tr>
              <td><?php echo $fetch_name;?></td>
              <td><?php echo $fetch_course;?></td>
              <td><?php echo $fetch_services;?></td>
              <td><?php echo $fetch_reason;?></td>
              <td><?php echo $fetch_remarks;?></td>
              <!-- <td><?php echo $date_filed;?></td>
              <td><?php echo $alert;?></td> -->
              <td>
                <a href="#editModal<?php echo $id;?>" data-toggle="modal">
                  <button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                </a>
                <a href="#deleteModal<?php echo $id;?>" data-toggle="modal">
                  <button type="button" class="btn btn-danger"><i class="fas fa-sync"></i></button>
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
                          <label for="services" class="col-form-label">Services Rendered:</label>
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
    <!-- custom icon -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
     <script>
      feather.replace()
    </script>
  </body>
</html>