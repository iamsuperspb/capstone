 <?php
 $query = mysqli_query($connection,"SELECT * FROM useraccount WHERE username = '$session_username'");
 $row = mysqli_fetch_assoc($query);
 $user_id = $row["user_id"];
 $user_name = $row["name"];
 $user_username = $row["username"];
 $userpass = $row["password"];
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
                <h6>Developer</h6>
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
                    <a href="admin_account">
                    <li class="<?php if($page=='admin_account'){echo 'active';}?>">
                      <i class="fas fa-user-tie"></i>
                        Admin Account
                    </li>
                    </a>
                    <a href="cpad_account">
                    <li class="<?php if($page=='cpad_account'){echo 'active';}?>">
                      <i class="fas fa-user-cog"></i>
                        Cpad Account
                    </li>
                    </a>
                    <a href="counselor_account">
                    <li class="<?php if($page=='counselor_account'){echo 'active';}?>">
                      <i class="fas fa-user-cog"></i>
                        Counselor Account
                    </li>
                    </a>
                 </div>
                 <a class="" href="#maintenance" data-toggle="collapse">
           <li>
               <span><i class="fas fa-cogs"></i></span>
               <span>Maintenance</span> <i class="fas fa-caret-down"></i>
           </li>
          </a>
          <div class="collapse" id="maintenance"> 
                    <a href="slider">
                    <li class="<?php if($page=='slider_maintenance'){echo 'active';}?>">
                      <i class="fas fa-sliders-h"></i>
                        Slider
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
                          <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $user_name;?>" required="">
                        </div>
                        <div class="form-group">
                          <label for="username" class="col-form-label">Username:</label>
                          <input type="text" class="form-control" id="username" name="username" value="<?php echo $user_username;?>" required="">
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
                      <button type="submit" class="btn btn-danger" name="add_btn" style="background-color: #A62D38;"><i class="fas fa-check"></i> Apply</button>
                      <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Close</button>
                    </div>
                  </div>
                  </form>
                </div>
            </div>