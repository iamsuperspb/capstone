<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="plugin/design/logo.png">
    <link rel="stylesheet" type="text/css" href="plugin/css/style.css">
    <title>Application Form</title>
  </head>
  <body>
    <?php
    $nav = "application";
    include "navbar.php";  
  ?>
    <div class="main-application">
      <div class="lbl">
        <h2>COLLEGE Applicant Details</h2>
      </div>
      <div class="personal-info" style="margin-top: 20px;">
          <h4> *Applicant Information</h4>
        </div>
      <form method="POST" autocomplete="off">
      <table width="90%" style="margin:20px;">
        <tr>
          <td style="text-align: right; height: 50px;"><label>FIRST NAME:</label></td>
          <td> </td>
          <td><input type="text" name="fname" class="form-control" required=""></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>MIDDLE NAME:</label></td>
          <td> </td>
          <td><input type="text" name="mname" class="form-control" required=""></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>LAST NAME:</label></td>
          <td> </td>
          <td><input type="text" name="lname" class="form-control" required=""></td>
        </tr>

        <tr>
          <td style="text-align: right; height: 50px;"><label>DATE EXAM:</label></td>
          <td> </td>
          <td><!-- <input id="datepicker1" name="date_exam" required=""> -->
            <input type="text" class="form-control" name="date" id="datepicker" autocomplete="off" readonly="" required="">
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
          <td><input type="text" name="school" id="school" class="form-control" required=""></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>SCHOOL ADDRESS:</label></td>
          <td> </td>
          <td><input type="text" name="schooladd" id="age" class="form-control" required=""></td>
        </tr>
        <tr>
          <tr>
          <td style="text-align: right; height: 50px;"><label>HOME ADDRESS:</label></td>
          <td> </td>
          <td><input type="text" name="homeadd" id="age" class="form-control" required=""></td>
        </tr>
          <td style="text-align: right; height: 50px;"><label>CITIZENSHIP:</label></td>
          <td> </td>
          <td><input type="text" name="citizen" id="age" class="form-control" required=""></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>EMAIL ADDRESS:</label></td>
          <td> </td>
          <td><input type="email" name="emailadd" id="age" class="form-control" required=""></td>
        </tr>
        <tr>
          <td style="text-align: right; height: 50px;"><label>SEMESTER:</label></td>
          <td></td>
          <td>
              <label class="radio-inline"><input type="radio" name="semester" value="1st">1st</label>
              <label class="radio-inline"><input type="radio" name="semester" value="2nd">2nd</label>
              <label class="radio-inline"><input type="radio" name="semester" value="3rd">Summer</label>
            </td>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>