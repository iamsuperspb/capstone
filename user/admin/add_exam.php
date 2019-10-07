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
  date_default_timezone_set("Asia/Manila");
  $date = date('m/d/Y');
  $query = mysqli_query($connection,"SELECT COUNT(*) AS college_applicant FROM college_applicant_information WHERE date_exam = '$date'");
  $college_result = mysqli_fetch_assoc($query);
  $college_applicant = $college_result["college_applicant"];
  $sh_query = mysqli_query($connection,"SELECT COUNT(*) AS sh_applicant FROM senior_applicant_information WHERE date_exam = '$date'");
  $sh_result = mysqli_fetch_assoc($sh_query);
  $sh_applicant = $sh_result["sh_applicant"];
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
            <h1 class="h2">Exam Questionnaire</h1>
      </div>
      <!-- ADD EXAM STEP 1 -->
      <?php
      if(@$_GET['q']==4 && !(@$_GET['step'])) {
    echo ' 
    <center>
    <form class="form-horizontal title1" name="form" action="add_exam_question?q=addquiz&"  method="POST">
    <h2> Enter Exam Details </h2>
    <input type="text" name="name" class="form-control" style="width:30%; margin-top:20px;" placeholder="Enter exam title" required>
    <input type="text" name="total" class="form-control" style="width:30%; margin-top:20px;" placeholder="Enter total number of question" required>
    <select name="exam_set" class="form-control" style="width:30%; margin-top:20px;"> 
      <option>Select set</option>
      <option value="A">A</option>
      <option value="B">B</option>
      <option value="C">C</option>
    </select>
    <select name="opt_exam" class="form-control" style="width:30%; margin-top:20px;"> 
      <option>Select exam type</option>
      <option value="Text">Text</option>
      <option value="Image">Image</option>
    </select>
    <input  type="submit" style="margin-top:20px;" class="btn btn-primary" value="Submit"/>
    <a href="manage_exam">
      <button type="button" class="btn btn-warning" style="margin-top:20px;"> Back </button>
    </a>
    </form>
    </center>';
}
?>
<?php
if(@$_GET['q']==4 && (@$_GET['step'])==2 ) {
echo ' 
<center>
<span class="title1" style="font-size:30px;"><b>Enter Question Details</b></span><br /><br />
 <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="add_exam_question.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].'&ch=4"  method="POST" enctype="multipart/form-data">
<fieldset>
';
 
 for($i=1;$i<=@$_GET['n'];$i++)
 {
echo '<b>Select Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
  <div class="col-md-12">
  <input type="file" name="'.$i.'qns_img" class="form-control">
  </div>
</div>
<!-- Text input-->
<b> Select Option A </b>
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'1"></label>  
  <div class="col-md-12">
  <input type="file" name="'.$i.'opt_img1" class="form-control">
  </div>
</div>
<!-- Text input-->
<b> Select Option B </b>
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'2"></label>  
  <div class="col-md-12">
  <input type="file" name="'.$i.'opt_img2" class="form-control">  
  </div>
</div>
<!-- Text input-->
<b> Select Option C </b>
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'3"></label>  
  <div class="col-md-12">
  <input type="file" name="'.$i.'opt_img3" class="form-control">  
  </div>
</div>
<!-- Text input-->
<b> Select Option D </b>
<div class="form-group">
  <label class="col-md-12 control-label" for="'.$i.'4"></label>  
  <div class="col-md-12">
  <input type="file" name="'.$i.'opt_img4" class="form-control">  
  </div>
</div>
<br />
<b>Correct answer</b>:<br />
<select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md" required>
   <option value="">Select answer for question '.$i.'</option>
  <option value="a">option a</option>
  <option value="b">option b</option>
  <option value="c">option c</option>
  <option value="d">option d</option> </select><br /><br />'; 
 }
    
echo '<div class="form-group">
  <label class="col-md-12 control-label" for=""></label>
  <div class="col-md-12"> 
    <input  type="submit" class="btn btn-primary" value="Submit" name = "add_exam_btn" class="btn btn-primary"/>
  </div>
</div>

</fieldset>
</form></center>';



}
?>
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