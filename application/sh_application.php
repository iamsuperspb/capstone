<?php
 include "../include/connection.php";

?>
<?php
  $select_course = mysqli_query($connection,"SELECT * FROM `strand`");
  $options = "";
  while ($row_course = mysqli_fetch_array($select_course)) {
  $options = $options."<option>".$row_course[1]."</option>";
}
?>
<?php
   date_default_timezone_set("Asia/Manila");
    $date = date('mdy');
    $date_as = date('m/d/Y');
  $query = mysqli_query($connection,"SELECT COUNT(*) AS appno FROM college_applicant_information");
  $result = mysqli_fetch_assoc($query);
  $appno = $result["appno"];
  
  if(isset($_POST["submit_btn"])){
    $fname = mysqli_real_escape_string($connection,$_POST["fname"]);
    $mname = mysqli_real_escape_string($connection,$_POST["mname"]);
    $lname = mysqli_real_escape_string($connection,$_POST["lname"]);
    $date_exam = mysqli_real_escape_string($connection,$_POST["date"]);
    $time_exam = mysqli_real_escape_string($connection,$_POST["time_exam"]);
    $age = mysqli_real_escape_string($connection,$_POST["age"]);
    $gender = mysqli_real_escape_string($connection,$_POST["gender"]);
    $telno = mysqli_real_escape_string($connection,$_POST["telno"]);
    $mobileno = mysqli_real_escape_string($connection,$_POST["mobileno"]);
    $school = mysqli_real_escape_string($connection,$_POST["school"]);
    $schoolyr = date('Y')."-".date('Y', strtotime('+1 year'));
    $homeadd = mysqli_real_escape_string($connection,$_POST["homeadd"]);
    $citizen = mysqli_real_escape_string($connection,$_POST["citizen"]);
    $emailadd = mysqli_real_escape_string($connection,$_POST["emailadd"]);
    $schooladd = mysqli_real_escape_string($connection,$_POST["schooladd"]);
    $firstchoice = mysqli_real_escape_string($connection,$_POST["firstchoice"]);
    $secondchoice = mysqli_real_escape_string($connection,$_POST["secondchoice"]);
    $thirdchoice = mysqli_real_escape_string($connection,$_POST["thirdchoice"]);
    // VALIDATE IF THE SLOT IS LESSTHAN 40 FOR AM SESSION SLOT
  $validate_slot_amses = mysqli_query($connection,"SELECT COUNT(*) AS am_slot FROM senior_applicant_information WHERE date_exam = '$date_exam' AND time_exam = '9:00 AM'");
  $result_amses = mysqli_fetch_assoc($validate_slot_amses);
  $am_slot = $result_amses["am_slot"];
  // VALIDATE IF THE SLOT IS LESSTHAN 40 FOR PM SESSION SLOT
  $validate_slot_pmses = mysqli_query($connection,"SELECT COUNT(*) AS pm_slot FROM senior_applicant_information WHERE date_exam = '$date_exam' AND time_exam = '1:30 PM'");
  $result_pmses = mysqli_fetch_assoc($validate_slot_pmses);
  $pm_slot = $result_pmses["pm_slot"];
    if($am_slot <= 39){
      if($time_exam == "9:00 AM"){
        $generate_appno = "ANSH".$appno.$date."AM";
        if($fname && $mname && $lname && $date_exam && $time_exam && $age && $gender && $telno && $mobileno && $school && $schoolyr && $citizen && $emailadd && $schooladd && $firstchoice && $secondchoice && $thirdchoice){
          $fullname = ucfirst($fname)." " . ucfirst($mname[0]) . ". " . ucfirst($lname);
          $validate = mysqli_query($connection,"SELECT * FROM senior_applicant_information WHERE applicant_no = '$generate_appno'");
          $check = mysqli_num_rows($validate);
          if($check > 0){
            $msg = "<div class='alert alert-danger' role='alert' style='width:99%;'>
                    ".$generate_appno." already exist!
                    </div>";
          }
          else{
            mysqli_query($connection,"INSERT INTO senior_applicant_information(applicant_no,fname,mname,lname,age,gender,telno,mobileno,school,schoolyear,citizenship,emailadd,schooladd,homeadd,firstchoice,secondchoice,thirdchoice,date_exam,time_exam,status) VALUES ('$generate_appno','$fname','$mname','$lname','$age','$gender','$telno','$mobileno','$school','$schoolyr','$citizen','$emailadd','$schooladd','$homeadd','$firstchoice','$secondchoice','$thirdchoice','$date_exam','$time_exam','Pending')");
            echo "<script language='javascript'>
                  alert('Successfully Added');
                  </script>";
                  header("location:../index");
          }
        }
      }
    }
    if($am_slot > 39){
      echo "<script language='javascript'>
                  alert('No Slot for 9:00 AM available please choose other schedule');
                  </script>";
    }
    if($pm_slot <= 39){
      if($time_exam == "1:30 PM"){
         $generate_appno = "ANSH".$appno.$date."PM";
        if($fname && $mname && $lname && $date_exam && $time_exam && $age && $gender && $telno && $mobileno && $school && $citizen && $emailadd && $schooladd && $firstchoice && $secondchoice && $thirdchoice){
          $fullname = ucfirst($fname)." " . ucfirst($mname[0]) . ". " . ucfirst($lname);
          $validate = mysqli_query($connection,"SELECT * FROM senior_applicant_information WHERE applicant_no = '$generate_appno'");
          $check = mysqli_num_rows($validate);
          if($check > 0){
            $msg = "<div class='alert alert-danger' role='alert' style='width:99%;'>
                    ".$generate_appno." already exist!
                    </div>";
          }
          else{
            mysqli_query($connection,"INSERT INTO senior_applicant_information(applicant_no,fname,mname,lname,age,gender,telno,mobileno,school,schoolyear,citizenship,emailadd,schooladd,homeadd,firstchoice,secondchoice,thirdchoice,date_exam,time_exam) VALUES ('$generate_appno','$fname','$mname','$lname','$age','$gender','$telno','$mobileno','$school','$schoolyr','$citizen','$emailadd','$schooladd','$homeadd','$firstchoice','$secondchoice','$thirdchoice','$date_exam','$time_exam','Pending')");
            echo "<script language='javascript'>
                  alert('Successfully Added');
                  </script>";
          }
        }
      }
    }
    if($pm_slot > 39){
      echo "<script language='javascript'>
                  alert('No Slot for 1:30 PM available please choose other schedule');
                  </script>";
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="../plugin/design/logo.png">
    <link rel="stylesheet" type="text/css" href="../plugin/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.4/themes/blitzer/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <title>University Entrance Exam Online Application</title>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#datepicker').datepicker({
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
</head>
<body>
  <div class="college-header">
        <img src="../plugin/design/officialseal.png">
    </div>
    <div class="main-application">
      <div class="lbl">
        <h2>Senior High School Applicant Details</h2>
      </div>
      <div class="personal-info" style="margin-top: 20px;">
          <h4> *Applicant Information</h4>
        </div>
        <form autocomplete="off" method="POST">
      <table width="90%" style="margin:20px;">
        <tr>
          <td style="text-align: right; height: 50px;"><label>FIRST NAME:</label></td>
          <td> </td>
          <td><input type="text" name="fname" class="form-control"></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>MIDDLE NAME:</label></td>
          <td> </td>
          <td><input type="text" name="mname" class="form-control"></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>LAST NAME:</label></td>
          <td> </td>
          <td><input type="text" name="lname" class="form-control"></td>
        </tr>

        <tr>
          <td style="text-align: right; height: 50px;"><label>DATE EXAM:</label></td>
          <td> </td>
          <td>
            <input type="text" class="form-control" name="date" id="datepicker" readonly="" required="" >
          </td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>TIME EXAM:</label></td>
          <td> </td>
          <td><select class="form-control" name="time_exam">
                <option value="">--SELECT--</option>
                <option value="9:00 AM">9:00 AM</option>
                <option value="1:30 PM">1:30 PM</option>
              </select></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>AGE:</label></td>
          <td> </td>
          <td><input type="text" name="age" id="age" class="form-control" required=""></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>GENDER:</label></td>
          <td> </td>
          <td><select class="form-control" name="gender">
                <option value="">--SELECT--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>TEL NO:</label></td>
          <td> </td>
          <td><input type="tel" name="telno" id="telno" class="form-control" required=""></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>MOBILE NO:</label></td>
          <td> </td>
          <td><input type="text" name="mobileno" id="age" class="form-control" required=""></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>PREVIOUS SCHOOL:</label></td>
          <td> </td>
          <td><input type="text" name="school" id="age" class="form-control" required=""></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>SCHOOL ADDRESS:</label></td>
          <td> </td>
          <td><input type="text" name="schooladd" id="age" class="form-control" required=""></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>HOME ADDRESS:</label></td>
          <td> </td>
          <td><input type="text" name="homeadd" id="age" class="form-control" required=""></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>CITIZENSHIP:</label></td>
          <td> </td>
          <td><input type="text" name="citizen" id="age" class="form-control" required=""></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>EMAIL ADDRESS:</label></td>
          <td> </td>
          <td><input type="text" name="emailadd" id="age" class="form-control" required=""></td>
        </tr>
      </table>
      <div class="course-info">
            <h4> *Course Preference</h4>
      </div>
      <table width="90%" style="margin:20px auto;">
        <tr>
          <td style="text-align: right; width: 40%;height: 50px;"><label>FIRST CHOICE:</label></td>
          <td width="20px"> </td>
          <td>
            <select name="firstchoice" class="form-control" required="">
                <option value="">--SELECT--</option>
                <?php echo $options;?>
              </select>
          </td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>SECOND CHOICE:</label></td>
          <td> </td>
          <td>
            <select name="secondchoice" class="form-control" required="">
                <option value="">--SELECT--</option>
                <?php echo $options;?>
              </select>
          </td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>THIRD CHOICE:</label></td>
          <td> </td>
          <td>
            <select name="thirdchoice" class="form-control" required="">
                <option value="">--SELECT--</option>
                <?php echo $options;?>
              </select>
          </td>
        </tr>
      </table>
    </div>
    <center>
      <div class="terms-agreement">
        <div class="terms-header">
          <p style="margin-left: 20px;">*Terms and Conditions</p>
        </div>
        <div class="terms-body">
          <p style="margin-left: 10px;">Please be informed that under the DPA and its IRR, you are entitled to certain rights such as, but not limited to, the right to be informed of and to object to the processing of your Personal Data and the right to access and retify your Personal Data.
          </p>
        </br>
        <p style="margin-left: 10px;">This authorization and consent once signed will continue to have effect throughout the duration of your entrance examination/admission/studies in LPU and/or until expiration of the retention limit set by laws and regulations from completion of entrance examination/admission/studies, and the perioid set until destruction or disposal of recrods, unless withdrawn in writing or withheld due to changes in the information supplide by LPU.</p>
        </br>
        <p style="margin-left: 10px;">I hereby give my consent that my personal data to the LPU, I am confirming that the data is true and correct. I Understand LPU reserves the right to revise any decision made on the basis of the information I provided should the information be found to be untrue or incorrect. I likewise agree that any issue that may arise in connection with the processing of my personal information will be settled amicably with LPU before resorting to appropriate arbitration or court proceedings within the Philippin jursdiction. Finally, I hereby certify that I have carefully read and understood the policy and terms stated herein and I am providing my voluntary xconsent and authorization to LPU.</p>
        </div>
      </div>
      <script>
        $(document).ready(function(){
          $("#submit_btn").attr("disabled","disabled");
          $("#chckbox").click(function(){
            if ($("#chckbox").is(":checked")) {
              $("#submit_btn").removeAttr("disabled");
            } else {
              $("#submit_btn").attr("disabled","disabled");
            }
          });
        });
      </script>
      <div style="margin-top: 10px;">
        <input type="checkbox" id="chckbox">  I agree to the terms and conditions stated above
      </div>
      <a href="option">
        <button class="btn" style="margin-top: 20px; margin-bottom: 20px; border:1px solid grey;">Cancel</button>
      </a>
      <input type="submit" name="submit_btn" id="submit_btn" class="btn btn-danger" value="Submit Application">
    </center>
  </form> 
</body>
</html>