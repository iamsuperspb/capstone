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
  if(isset($_POST["delete_btn"])){
    $id = mysqli_real_escape_string($connection,$_POST['delete_id']);
    mysqli_query($connection,"UPDATE student_record SET archive = '0' WHERE id = '$id'");
    $msg = "Data has been successfully restore!";
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
    <title>Counselor | Archive</title>
  </head>
  <body>
    <?php
      include "top_header.php";
    ?>
    <?php
      $page = "archive";
      include "sidemenu.php";
    ?>
    <div class="main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><i class="fas fa-archive"></i> Archive</h1>
        </div>
        <?php
           if(isset($_POST["search_btn"])){
                $search = mysqli_real_escape_string($connection,$_POST["search_by"]);
                $start = 0;
                $limit = 5;
                $total = mysqli_query($connection,"SELECT * FROM student_record WHERE name LIKE '%".$search."%' AND department = '$department' AND archive = '1'");
                $total_rows = mysqli_num_rows($total);
                if(isset($_GET["id"])){
                  $id = $_GET["id"];
                  $start = ($id-1)*$limit;
                }
                else {
                  $id = 1;
                }
                $page = ceil($total_rows/$limit);
              $fetch = mysqli_query($connection,"SELECT * FROM student_record WHERE name LIKE '%".$search."%' AND department = '$department' AND archive = '1' LIMIT $start,$limit");
            }
            else{
              $start = 0;
                $limit = 5;
                $total = mysqli_query($connection,"SELECT * FROM student_record WHERE department = '$department' AND archive = '1'");
                $total_rows = mysqli_num_rows($total);
                if(isset($_GET["id"])){
                  $id = $_GET["id"];
                  $start = ($id-1)*$limit;
                }
                else {
                  $id = 1;
                }
                $page = ceil($total_rows/$limit);
              $fetch = mysqli_query($connection,"SELECT * FROM student_record WHERE department = '$department' AND archive = '1' LIMIT $start,$limit");
            }
        ?>
          <!-- ALERT ACTION -->
          <div class="alert-holder">
            <p>
          <?php 
            if (isset($_POST['delete_btn'])){
              echo "<div class='alert alert-success' role='alert' style='width:99%;'>".$msg."</div>";
            }
            ?>
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
              <td>
                 <a href="#deleteModal<?php echo $id;?>" data-toggle="modal">
                  <button type="button" class="btn btn-danger"><i class="fas fa-sync"></i></button>
                </a>
              </td>
              <!-- RESTORE -->
               <div class="modal fade" id="deleteModal<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title"><span data-feather="refresh-cw"></span> Restore</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form method="POST">
                          <div class="modal-body">
                            <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="name" value="<?php echo $fetch_name;?>">
                              <div class="alert alert-danger">Are you sure you want to restore <strong>
                                    <?php echo $fetch_name; ?>'s</strong> data?
                               </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" name="delete_btn"><span data-feather="check"></span> Yes</button>
                            <button type="button" class="btn btn-dark" data-dismiss="modal"><span data-feather="x"></span> Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
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