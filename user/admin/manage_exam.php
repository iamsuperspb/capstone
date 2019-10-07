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
  if(isset($_POST['add_btn'])){
    $id=uniqid();
    $topic = mysqli_real_escape_string($connection,$_POST["topic"]);
    $total = mysqli_real_escape_string($connection,$_POST["total"]);
    $set = mysqli_real_escape_string($connection,$_POST["exam_set"]);
    mysqli_query($connection,"INSERT INTO `quiz`(`eid`, `title`, `exam_set`, `sahi`, `wrong`, `total`, `duration`, `intro`, `tag`, `date_create`) VALUES  ('$id','$topic','$set','1' , '0','$total','10' ,'#','#', NOW())");
    $msg = "<div class='alert alert-success' role='alert' style='width:99%;'>
                Exam topic successfully added!
                </div>";
  }
?>
<?php
  if(isset($_POST["delete_btn"])){
    $id = mysqli_real_escape_string($connection,$_POST["id"]);
    $qid_query = mysqli_query($connection,"SELECT * FROM questions WHERE eid = '$id'");
    while($row = mysqli_fetch_array($qid_query)){
      $qid = $row["qid"];
      mysqli_query($connection,"DELETE FROM options WHERE qid='$qid'");
      mysqli_query($connection,"DELETE FROM answer WHERE qid='$qid' ");
    }
      mysqli_query($connection,"DELETE FROM questions WHERE eid='$id'");
      mysqli_query($connection,"DELETE FROM quiz WHERE eid='$id'");
      $msg = "<div class='alert alert-success' role='alert' style='width:99%;'>
                Exam topic successfully deleted!
                </div>";
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
    <title>Admin | Exam Questionnaire</title>
  </head>
  <body>
   	<?php
      include "top_header.php";
    ?>
    <?php
      $page = "exam";
      include "sidemenu.php"; 
    ?>
    <div class="main-content">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><i class="fas fa-feather-alt"></i> Exam Questionnaire</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <a href="#add_modal" data-toggle="modal">
                  <button type="button" class="btn btn-sm" style="background: #A62D38; color: white; border: 1px solid #772028;">
                    <span data-feather="plus-square"></span>
                   Add
                 </button>
                </a>
              </div>
            </div>
      </div>
      <?php
                $start = 0;
                $limit = 5;
                $total = mysqli_query($connection,"SELECT * FROM quiz ORDER BY exam_set ASC");
                $total_rows = mysqli_num_rows($total);
                if(isset($_GET["id"])){
                  $id = $_GET["id"];
                  $start = ($id-1)*$limit;
                }
                else {
                  $id = 1;
                }
                $page = ceil($total_rows/$limit);
              $fetch = mysqli_query($connection,"SELECT * FROM quiz ORDER BY exam_set ASC LIMIT $start,$limit");
      ?>
      <!-- ADD MODAL -->
      <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><span data-feather="plus"></span> Add</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                          <div class="form-group">
                          <label for="fname" class="col-form-label">Topic:</label>
                          <input type="text" class="form-control" id="topic" name="topic" required="">
                        </div>
                        <div class="form-group">
                          <label for="username" class="col-form-label">Total:</label>
                          <input type="text" class="form-control" id="total" name="total" required="">
                        </div>
                        <div class="form-group">
                          <label for="username" class="col-form-label" required="">Set:</label>
                          <select name="exam_set" class="form-control"> 
                            <option value="">--SELECT--</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="add_btn"><span data-feather="plus"></span> Add</button>
                      <button type="button" class="btn btn-dark" data-dismiss="modal"><span data-feather="x"></span> Cancel</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
                        <!-- ALERT MSG -->
     <div class="alert-holder">
      <p>
        <?php
          if(isset($_POST["add_btn"])){
            echo $msg;
          }
          if(isset($_POST["delete_btn"])){
            echo $msg;
          }
        ?>
      </p>
    </div>
      <table class="table table-bordered" style="width: 99%;">
        <thead style="background-color: #A62D38; color: white;">
          <tr>
            <th>Topic</th>
            <th>Set</th>
            <th>Total Question</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            while($row = mysqli_fetch_array($fetch)){
            $id = $row["eid"];
            $title = $row["title"];
            $set = $row["exam_set"];
            $total = $row["total"];
          ?>
          <tr>
            <?php
              // CHECK the number of question is equal to total

              $check_qn = mysqli_query($connection,"SELECT COUNT(*) as total_qn FROM questions WHERE eid = '$id'");
              $result = mysqli_fetch_array($check_qn);
              $total_qn = $result["total_qn"];
            ?>
            <td>
            <?php
            if($total_qn == $total){
              echo '<div class="alert alert-success" role="alert"><i class="fas fa-check"></i>
                    '.$title.'</div>';
            } 
            else{
              echo '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation"></i>
                    '.$title.'</div>';
            }
            ?>
              
            </td>
            <td><?php echo $set;?></td>
            <td><?php echo $total_qn.'/'.$total;?></td>
            <td>
              <a href="edit_exam.php?eid=<?php echo $id;?>&n=<?php echo $total;?>">
                <button name="update_btn" class="btn btn-warning"><i class="fas fa-edit"></i></button>
              </a>
              <a href="#deleteModal<?php echo $id;?>" data-toggle="modal">
                <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
              </a>
            </td>
          </tr>
           <!-- EDIT MODAL -->
              <div class="modal fade" id="edit_modal<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><span data-feather="edit"></span> Edit</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="REQUEST">
                    <div class="modal-body">
                          <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                          <div class="form-group">
                          <label for="fname" class="col-form-label">Subject:</label>
                          <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $title;?>">
                        </div>
                        <div class="form-group">
                          <label for="username" class="col-form-label">Total:</label>
                          <input type="text" class="form-control" id="total" name="total" value="<?php echo $total;?>">
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <a href="try.php?n=<?php echo $_POST['total']?>">
                        <button type="submit" class="btn btn-success" name="edit_btn"><span data-feather="check"></span> Confirm</button>
                      </a>
                      <button type="button" class="btn btn-dark" data-dismiss="modal"><span data-feather="x"></span> Cancel</button>
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
                      <h5 class="modal-title" id="exampleModalLabel"><span data-feather="trash-2"></span> Delete</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST">
                    <div class="modal-body">
                          <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                          <div class="alert alert-danger">Are you sure you want to delete this topic?</div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger" name="delete_btn"><span data-feather="check"></span> Yes</button>
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