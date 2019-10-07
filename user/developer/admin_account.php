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
  if(isset($_POST["add_btn"])){
    $name = mysqli_real_escape_string($connection,$_POST["fname"]);
    $username = mysqli_real_escape_string($connection,$_POST["username"]);
    $get_pass = mysqli_real_escape_string($connection,$_POST["password"]);
    $hashpass = md5($get_pass);
    if($name && $username && $hashpass){
      $query = mysqli_query($connection,"SELECT * FROM useraccount WHERE username = '$username'");
      $check = mysqli_num_rows($query);
      if($check > 0){
        $msg = "<div class='alert alert-danger' role='alert' style='width:99%;'>
                ".$username." already exist!
                </div>";
      }
      else{
         mysqli_query($connection,"INSERT INTO useraccount(name,username,password,usertype,status) VALUES ('$name','$username','$hashpass','admin','active')");
         $msg = "<div class='alert alert-success' role='alert' style='width:99%;'>
                Successfully added!
                </div>";
      }
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
      
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" type="text/css" href="../../plugin/css/style.css">
    <!-- CUSTOM ICONS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- LOGO -->
    <link rel="icon" href="../../plugin/design/logo.png">
    <title>Developer | Admin Acount</title>
  </head>
  <body>
     <?php
      include "top_header.php";
     ?>
     <?php
      $page = "admin_account";
      include "sidemenu.php";
     ?>
     <div class="main-content">
       <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Admin Account</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <a href="#addModal" data-toggle="modal">
                <button type="button" class="btn btn-sm" style="background: #A62D38; color: white; border: 1px solid #772028;"><span data-feather="plus-square"></span> Add</button>
              </a>
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
        ?>
      </p>
     </div>
     <!-- ADD MODAL -->
     <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-lock"></i> Account</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="POST">
                        <div class="form-group">
                          <label for="fname" class="col-form-label">Name:</label>
                          <input type="text" class="form-control" id="fname" name="fname" placeholder="Full Name" required="">
                        </div>
                        <div class="form-group">
                          <label for="username" class="col-form-label">Username:</label>
                          <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="">
                        </div>
                        <div class="form-group">
                          <label for="password" class="col-form-label">Password:</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-dark" name="add_btn" style=""><i class="fas fa-user-check"></i> Add</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Close</button>
                    </div>
                  </div>
                  </form>
                </div>
            </div>
     <!-- FETCH DATA -->
     <?php
      $fetch = mysqli_query($connection,"SELECT * FROM useraccount WHERE usertype = 'admin' AND status = 'active'");        
     ?>
     <form>
      <div class="alert alert-dark" style="width: 99%;">
        <input type="text" id="search" placeholder="Search" class="form-control" name=""searchBox" style="width: 20%;">
      </div>
     </form>
      <table class="table table-bordered" style="width: 99%;">
        <thead style="background-color: #A62D38; color: white;">
          <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
              while ($row = mysqli_fetch_array($fetch)) {
              $id = $row['user_id'];
              $name = $row['name'];
              $username = $row['username'];
              $password = $row['password'];
              $status = $row['status'];
          ?>
          <tr>
            <td><?php echo $name;?></td>
            <td><?php echo $username;?></td>
            <td><?php echo $password;?></td>
            <td><div class="alert alert-success"><?php echo $status;?></div></td>
            <td>
              <a href="#deactive<?php echo $id;?>" data-toggle="modal">
              <button type="button" class="btn btn-danger"><span data-feather="alert-triangle"></span></button>
              </a>
              <a href="">
              <button type="button" class="btn btn-warning"><span data-feather="edit"></span></button>
              </a>
            </td>
          </tr>
          <!-- DEACTIVE MODAL -->
            <div class="modal fade" id="deactive<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title"><i class="fas fa-sync-alt"></i> Deactivate</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form method="POST">
                          <div class="modal-body">
                            <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="name" value="<?php echo $name;?>">
                              <div class="alert alert-danger">Are you sure you want to deactivate <strong>
                                    <?php echo $name; ?>'s</strong> account?
                               </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" name="delete_btn"><span data-feather="check"></span> Okay</button>
                            <button type="button" class="btn btn-dark" data-dismiss="modal"><span data-feather="x"></span> Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
          <?php } ?>
        </tbody>
      </table>
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