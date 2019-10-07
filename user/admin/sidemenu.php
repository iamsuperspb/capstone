 <?php
 $query = mysqli_query($connection,"SELECT * FROM useraccount WHERE username = '$session_username'");
 $row = mysqli_fetch_assoc($query);
 $user_id = $row["user_id"];
 $user_name = $row["name"];
 $user_username = $row["username"];
 $user_password = $row["password"];
 $userpass = $row["password"];
 $user_usertype = $row["usertype"];
 ?>
 <?php
  if(isset($_POST["update_account_btn"])){
    $account_name = mysqli_real_escape_string($connection,$_POST["account_name"]);
    $account_username = mysqli_real_escape_string($connection,$_POST["account_username"]);
    $current_password = mysqli_real_escape_string($connection,$_POST["current_password"]);
    $hash_current = md5($current_password);
    $new_password = mysqli_real_escape_string($connection,$_POST["new_password"]);
    $hash_new = md5($new_password);
    if($user_password == $hash_current){
      mysqli_query($connection,"UPDATE useraccount SET username = '$account_username', password = '$hash_new' WHERE name = '$account_name' AND usertype = 'admin'");
      // remove all session variables
        session_unset(); 

        // destroy the session 
        session_destroy();
          header('location:../../index');
    }
    else{
      echo "<script language='javascript'>
            alert('Incorrect current password!');
            </script>";
    }
  }
 ?>
 <div class="side-nav">
           <div class="usermanage">
            <center>
              <img src="../../plugin/design/dev.png" class="displayphoto">
              <a href="#accountModal" data-toggle="modal">
                <button class="usersettings">
                <i class="fas fa-cog"></i>
              </button>
            </a>
            </center>
            <center>
              <span>
                <h6><?php echo $user_name;?></h6>
                <img src="../../plugin/design/online.png" style="width: 10px; height: 10px;"> Online
                <h6>Admin</h6>
              </span>
            </center>
          </div>
       <nav>
         <ul>
          <a href="index">
           <li class="<?php if($page=='index'){echo 'active';}?>">
               <span><i class="fa fa-tachometer-alt"></i></span>
               <span>Dashboard</span>
           </li>
          </a>
          <a class="" href="#manageAccount" data-toggle="collapse">
           <li>
               <span><i class="fas fa-users"></i></span>
               <span>Account Management</span> <i class="fas fa-caret-down"></i>
           </li>
          </a>
          <div class="collapse" id="manageAccount"> 
                    <a href="cpad_account">
                    <li class="<?php if($page=='cpad'){echo 'active';}?>">
                      <i class="fas fa-user-tie"></i>
                        CPAD Account
                    </li>
                    </a>
                    <a href="counselor_account">
                    <li class="<?php if($page=='counselor_account'){echo 'active';}?>">
                      <i class="fas fa-user-cog"></i>
                        Counselor Account
                    </li>
                    </a>
                 </div>
                 <a class="" href="#studentRecord" data-toggle="collapse">
           <li>
               <span><i class="fas fa-user"></i></span>
               <span>Counseling</span> <i class="fas fa-caret-down"></i>
           </li>
          </a>
          <div class="collapse" id="studentRecord"> 
                    <a href="student_record">
                    <li class="<?php if($page=='student_record'){echo 'active';}?>">
                      <i class="fas fa-clipboard"></i>
                        Counselor's Daily Activities
                    </li>
                    </a>
                 </div>
          <a class="" href="#examManage" data-toggle="collapse">
           <li>
               <span><i class="fas fa-book-open"></i></span>
               <span>Exam Management</span> <i class="fas fa-caret-down"></i>
           </li>
          </a>
          <div class="collapse" id="examManage"> 
                    <a href="college_applicant">
                    <li class="<?php if($page=='applicant_information'){echo 'active';}?>">
                      <i class="fas fa-sitemap"></i>
                      Applicant Information
                    </li>
                    </a>
                    <a href="college_applicant_status">
                    <li class="<?php if($page=='view_status'){echo 'active';}?>">
                      <i class="fas fa-star"></i>
                      View Applicant Status
                    </li>
                    </a>
                    <a href="manage_exam">
                    <li class="<?php if($page=='exam'){echo 'active';}?>">
                      <i class="fas fa-feather-alt"></i>
                        Exam Questionnaire
                    </li>
                 </div>
          <a class="" href="#courseManage" data-toggle="collapse">
           <li class="<?php if($page=='applicant'){echo 'active';}?>">
               <span><i class="fas fa-bookmark"></i></span>
               <span>Course Management</span> <i class="fas fa-caret-down"></i>
           </li>
          </a>
          <div class="collapse" id="courseManage"> 
                    <a href="strand">
                    <li class="<?php if($page=='strand'){echo 'active';}?>">
                      <i class="fas fa-chalkboard"></i>
                      Track/Strand
                    </li>
                    </a>
                    <a href="college_course">
                    <li class="<?php if($page=='college_course'){echo 'active';}?>">
                      <i class="fas fa-chalkboard"></i>
                        College Course
                    </li>
                  </a>
                 </div>
         </ul>
       </nav>
     </div>
     <!-- ACCOUTN SETTINGS -->
      <div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-cogs"></i> Account Settings</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="POST">
                        <div class="form-group">
                          <label for="fname" class="col-form-label">Name:</label>
                          <input type="text" class="form-control" id="fname" name="account_name" value="<?php echo $user_name;?>" readonly required="">
                        </div>
                        <div class="form-group">
                          <label for="username" class="col-form-label">Username:</label>
                          <input type="text" class="form-control" id="username" name="account_username" value="<?php echo $user_username;?>" required="">
                        </div>
                        <div class="form-group">
                          <label for="password" class="col-form-label">Current Password:</label>
                          <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password" required="">
                        </div>
                        <div class="form-group">
                          <label for="password" class="col-form-label">New Password:</label>
                          <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required="">
                        </div>
                        <a href="../../logout.php">
                          <button type="button" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                        </a>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger" name="update_account_btn" style="background-color: #A62D38;"><i class="fas fa-check"></i> Apply</button>
                      <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Close</button>
                    </div>
                  </div>
                  </form>
                </div>
            </div>