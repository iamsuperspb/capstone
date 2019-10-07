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
<?php
        date_default_timezone_set("Asia/Manila");
        $date = date('mdy');
        $date_as = date('m/d/Y');
        $query_am = mysqli_query($connection,"SELECT COUNT(*)AS amses FROM college_applicant_information WHERE date_exam = '$date_as' AND time_exam = '9:00 AM'");
        $amses_result = mysqli_fetch_assoc($query_am);
        $amses = $amses_result["amses"];
        $query_pm = mysqli_query($connection,"SELECT COUNT(*)AS pmses FROM college_applicant_information WHERE date_exam = '$date_as' AND time_exam = '1:30 PM'");
        $pmses_result = mysqli_fetch_assoc($query_pm);
        $pmses = $pmses_result["pmses"];
?>
<?php
  $query = mysqli_query($connection,"SELECT COUNT(*) AS appno FROM college_applicant_information");
  $result = mysqli_fetch_assoc($query);
  $appno = $result["appno"];
 
  if(isset($_POST["applicant_btn"])){
     $fname = mysqli_real_escape_string($connection,$_POST["fname"]);
    $mname = mysqli_real_escape_string($connection,$_POST["mname"]);
    $lname = mysqli_real_escape_string($connection,$_POST["lname"]);
    $date_exam = mysqli_real_escape_string($connection,$_POST["date_exam"]);
    $time_exam = mysqli_real_escape_string($connection,$_POST["time_exam"]);
    $age = mysqli_real_escape_string($connection,$_POST["age"]);
    $gender = mysqli_real_escape_string($connection,$_POST["gender"]);
    $telno = mysqli_real_escape_string($connection,$_POST["telno"]);
    $mobileno = mysqli_real_escape_string($connection,$_POST["mobileno"]);
    $school = mysqli_real_escape_string($connection,$_POST["school"]);
    $schoolyr = mysqli_real_escape_string($connection,$_POST["schoolyr"]);
    $sem = mysqli_real_escape_string($connection,$_POST["semester"]);
    $citizen = mysqli_real_escape_string($connection,$_POST["citizen"]);
    $emailadd = mysqli_real_escape_string($connection,$_POST["email"]);
    $schooladd = mysqli_real_escape_string($connection,$_POST["schooladd"]);
    $firstchoice = mysqli_real_escape_string($connection,$_POST["firstchoice"]);
    $secondchoice = mysqli_real_escape_string($connection,$_POST["secondchoice"]);
    $thirdchoice = mysqli_real_escape_string($connection,$_POST["thirdchoice"]);
    if($time_exam == "9:00 AM"){
      $generate_appno = "ANCL".$appno.$date."AM";
      if($fname && $mname && $lname && $date_exam && $time_exam && $age && $gender && $telno && $mobileno && $school && $schoolyr && $sem && $citizen && $emailadd && $schooladd && $firstchoice && $secondchoice && $thirdchoice){
        $fullname = ucfirst($fname)." " . ucfirst($mname[0]) . ". " . ucfirst($lname);
        $validate = mysqli_query($connection,"SELECT * FROM college_applicant_information WHERE applicant_no = '$generate_appno'");
        $check = mysqli_num_rows($validate);
        if($check > 0){
          $msg = "<div class='alert alert-danger' role='alert' style='width:99%;'>
                  ".$generate_appno." already exist!
                  </div>";
        }
        else{
          mysqli_query($connection,"INSERT INTO college_applicant_information(applicant_no,fname,mname,lname,age,gender,telno,mobileno,school,schoolyear,semester,citizenship,emailadd,schooladd,firstchoice,secondchoice,thirdchoice,date_exam,time_exam) VALUES ('$generate_appno','$fname','$mname','$lname','$age','$gender','$telno','$mobileno','$school','$schoolyr','$sem','$citizen','$emailadd','$schooladd','$firstchoice','$secondchoice','$thirdchoice','$date_exam','$time_exam')");
          header("location:applicant_information");
        }
      }
    }
    if($time_exam == "1:30 PM"){
       $generate_appno = "ANCL".$appno.$date."PM";
      if($fname && $mname && $lname && $date_exam && $time_exam && $age && $gender && $telno && $mobileno && $school && $schoolyr && $sem && $citizen && $emailadd && $schooladd && $firstchoice && $secondchoice && $thirdchoice){
        $fullname = ucfirst($fname)." " . ucfirst($mname[0]) . ". " . ucfirst($lname);
        $validate = mysqli_query($connection,"SELECT * FROM college_applicant_information WHERE applicant_no = '$generate_appno'");
        $check = mysqli_num_rows($validate);
        if($check > 0){
          $msg = "<div class='alert alert-danger' role='alert' style='width:99%;'>
                  ".$generate_appno." already exist!
                  </div>";
        }
        else{
          mysqli_query($connection,"INSERT INTO college_applicant_information(applicant_no,fname,mname,lname,age,gender,telno,mobileno,school,schoolyear,semester,citizenship,emailadd,schooladd,firstchoice,secondchoice,thirdchoice,date_exam,time_exam) VALUES ('$generate_appno','$fname','$mname','$lname','$age','$gender','$telno','$mobileno','$school','$schoolyr','$sem','$citizen','$emailadd','$schooladd','$firstchoice','$secondchoice','$thirdchoice','$date_exam','$time_exam')");
          header("location:applicant_information");
        }
      }
    }
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
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" type="text/css" href="../../plugin/css/style.css">
    <!-- CUSTOM ICONS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- LOGO -->
    <link rel="icon" href="../../plugin/design/logo.png">
    <title>Admin | Application Form</title>
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
            <h1 class="h2">College Application Form</h1>
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
      <div class="application-holder">
        <div class="personal-info">
          <h4> *Applicant Information</h4>
        </div>
        <center>
        <form method="POST">
        <table width="95%">
          <tr>
            <td>
              <label for="fname" class="col-form-label">FIRST NAME:</label>
              <input type="text" name="fname" id="fname" class="form-control" required="">
            </td>
            <td>
              <label for="mname" class="col-form-label">MIDDLE NAME:</label>
              <input type="text" name="mname" id="mname" class="form-control" required="">
            </td>
            <td>
              <label for="lname" class="col-form-label">LAST NAME:</label>
              <input type="text" name="lname" id="lname" class="form-control" required="">
            </td>
            <td>
              <label for="date_exam" class="col-form-label">DATE EXAM:</label>
              <input id="datepicker" name="date_exam" required=""> 
            </td>
            <td>
              <label for="time_exam" class="col-form-label">TIME EXAM:</label>
              <select class="form-control" name="time_exam">
                <option value="9:00 AM">9:00 AM</option>
                <option value="1:30 PM">1:30 PM</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <label for="age" class="col-form-label">AGE:</label>
              <input type="text" name="age" id="age" class="form-control" required="">
            </td>
            <td>
              <label for="gender" class="col-form-label">GENDER:</label>
              <select class="form-control" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </td>
            <td>
              <label for="telno" class="col-form-label">TEL. NO:</label>
              <input type="tel" name="telno" id="telno" class="form-control" required="">
            </td>
            <td>
              <label for="mobileno" class="col-form-label">MOBILE. NO:</label>
              <input type="tel" name="mobileno" id="mobileno" class="form-control" required="">
            </td>
            <td>
              <label for="school" class="col-form-label">SCHOOL:</label>
              <input type="text" name="school" id="school" class="form-control" required="">
            </td>
          </tr>
          <tr>
            <td>
              <label for="schoolyr" class="col-form-label">SCHOOLYEAR:</label>
              <input type="text" name="schoolyr" id="schoolyr" class="form-control" required="">
            </td>
            <td>
              <label for="schoolyr" class="col-form-label">SEMESTER:</label>
              <label class="radio-inline"><input type="radio" name="semester" value="1st">1st</label>
              <label class="radio-inline"><input type="radio" name="semester" value="2nd">2nd</label>
              <label class="radio-inline"><input type="radio" name="semester" value="3rd">Summer</label>
            </td>
            <td>
              <label for="citizen" class="col-form-label">CITIZENSHIP:</label>
              <input type="text" name="citizen" id="citizen" class="form-control" required="">
            </td>
            <td>
              <label for="email" class="col-form-label">EMAIL ADDRESS:</label>
              <input type="email" name="email" id="email" class="form-control" required="">
            </td>
            <td>
               <label for="schooladd" class="col-form-label">SCHOOL ADDRESS:</label>
              <input type="text" name="schooladd" id="schooladd" class="form-control" required="">
            </td>
          </tr>
        </table>
      </center>
        <div class="course-info">
            <h4> *Course Preference</h4>
        </div>
        <center>
        <table width="95%">
          <tr>
            <td>
              <label>First Choice</label>
              <select name="firstchoice" class="form-control">
                <option value="">--SELECT--</option>
                <?php echo $options;?>
              </select>
            </td>
            <td>
              <label>Second Choice</label>
              <select name="secondchoice" class="form-control">
                <option value="">--SELECT--</option>
                <?php echo $options;?>
              </select>
            </td>
            <td>
              <label>Third Choice</label>
              <select name="thirdchoice" class="form-control">
                <option value="">--SELECT--</option>
                <?php echo $options;?>
              </select>
            </td>
          </tr>
        </table>
          <button type="submit" class="submit-applicantbtn" name="applicant_btn"> Submit</button>
      </form>
      </center>
      </div>
      <div class="count-sched">
        <table width="100%">
          <tr>
            <td><h6>As of <?php echo $date_as;?></h6></td>
            <td><h6>As of <?php echo $date_as;?></h6></td>
          </tr>          
          <tr>
            <td><h5> TOTAL MORNING SCHEDULE: <?php echo $amses;?></h5></td>
            <td><h5> TOTAL AFTERNOON SCHEDULE: <?php echo $pmses;?></h5></td>
          </tr>
        </table>
      </div>
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
    <!-- CUSTOM DATE TIME PICKER -->
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
        });
    </script>
  </body>
</html>