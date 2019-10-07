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
  if(isset($_POST["add_btn"])){
    $get_course = mysqli_real_escape_string($connection,$_POST["strand"]);
    $check = mysqli_query($connection,"SELECT * FROM strand WHERE strand = '$get_course'");
    $check_row = mysqli_num_rows($check);
    if($check_row > 0){
      $msg = "<div class='alert alert-danger' role='alert' style='width:99%;'>
                ".$get_course." already exist!
                </div>";
    }
    else{
      mysqli_query($connection,"INSERT INTO strand (strand) VALUES ('$get_course')");
      $msg = "<div class='alert alert-success' role='alert' style='width:99%;'>
                Successfully Added!
                </div>";
    }
  }
?>
<?php
  if(isset($_POST["update_btn"])){
    $id = mysqli_real_escape_string($connection,$_POST["id"]);
    $strand = mysqli_real_escape_string($connection,$_POST["strand"]);
    mysqli_query($connection,"UPDATE strand SET strand = '$strand' WHERE id = '$id'");
    $msg = "<div class='alert alert-success' role='alert' style='width:99%;'>
                Successfully Updated!
                </div>";
  }
?>
<?php
  if(isset($_POST["delete_btn"])){
    $delete_id = mysqli_real_escape_string($connection,$_POST["delete_id"]);
    mysqli_query($connection,"DELETE FROM strand WHERE id = '$delete_id'");
    $msg = "<div class='alert alert-success' role='alert' style='width:99%;'>
                Successfully Deleted!
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
    <title>Admin | Track/Strand</title>
  </head>
  <body>
    <?php
      include "top_header.php";
    ?>
    <?php
      $page = "strand";
      include "sidemenu.php"; 
    ?>
    <div class="main-content">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><i class="fas fa-chalkboard"></i> Track/Strand</h1>
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
                      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-chalkboard"></i> Track/Strand</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="POST">
                        <div class="form-group">
                          <label for="strand" class="col-form-label">Track/Strand:</label>
                          <input type="text" class="form-control" id="strand" name="strand" placeholder="Track/Strand" required="">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-dark" name="add_btn" style=""><i class="fas fa-plus-square"></i> Add</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Close</button>
                    </div>
                  </div>
                  </form>
                </div>
            </div>
         <!-- ALERT MSG -->
     <div class="alert-holder">
      <p>
        <?php
          if(isset($_POST["add_btn"])){
            echo $msg;
          }
          if(isset($_POST["update_btn"])){
            echo $msg;
          }
          if(isset($_POST["delete_btn"])){
            echo $msg;
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
                    </br>
      <?php
        // PAGINATION AND SEARCH
            if(isset($_POST["search_btn"])){
                $search = mysqli_real_escape_string($connection,$_POST["search_by"]);
                $start = 0;
                $limit = 5;
                $total = mysqli_query($connection,"SELECT * FROM strand WHERE strand LIKE '%".$search."%' ORDER BY `strand`.`strand` ASC");
                $total_rows = mysqli_num_rows($total);
                if(isset($_GET["id"])){
                  $id = $_GET["id"];
                  $start = ($id-1)*$limit;
                }
                else {
                  $id = 1;
                }
              $page = ceil($total_rows/$limit);
              $fetch = mysqli_query($connection,"SELECT * FROM strand WHERE strand LIKE '%".$search."%' ORDER BY `strand`.`strand` ASC LIMIT $start,$limit");
            }
            else{
                 $start = 0;
                $limit = 5;
                $total = mysqli_query($connection,"SELECT * FROM strand ORDER BY `strand`.`strand` ASC");
                $total_rows = mysqli_num_rows($total);
                if(isset($_GET["id"])){
                  $id = $_GET["id"];
                  $start = ($id-1)*$limit;
                }
                else {
                  $id = 1;
                }
                $page = ceil($total_rows/$limit);
              $fetch = mysqli_query($connection,"SELECT * FROM strand ORDER BY `strand`.`strand` ASC LIMIT $start,$limit");
            }
     ?>
      <table class="table table-bordered" style="width: 99%;">
        <thead style="background-color: #A62D38; color: white;">
          <tr>
            <th>Track/Strand</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
             while($row = mysqli_fetch_array($fetch)){
              $id = $row["id"];
              $strand = $row["strand"];
          ?>
          <tr>
            <td><?php echo $strand;?></td>
            <td>
              <a href="#deleteModal<?php echo $id;?>" data-toggle="modal">
              <button type="button" class="btn btn-danger"><span data-feather="trash-2"></span></button>
              </a>
              <a href="#editModal<?php echo $id;?>" data-toggle="modal">
              <button type="button" class="btn btn-warning"><span data-feather="edit"></span></button>
              </a>
            </td>
          </tr>
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
                          <label for="name" class="col-form-label">Track/Strand:</label>
                          <input type="text" class="form-control" id="name" name="strand" value="<?php echo $strand;?>">
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
                                    <?php echo $strand; ?>'s</strong>?
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
                if($id == 1){?>
                   <li class="page-item"><a class="page-link" href="?id=<?php echo ($id-1)?>"> Previous </a> </li> 
              <?php }?>
              <?php
                for($i=1;$i <= $page;$i++){
                ?>
                  <li class="page-item"><a class="page-link" href="?id=<?php echo $i ?>"><?php echo $i;?></a></li>
              <?php } ?>
              <?php
                if($id==$page){
                  ?>
                  <li class="page-item"><a class="page-link" href="?id=<?php echo ($id+1);?>">Next</a></li>
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