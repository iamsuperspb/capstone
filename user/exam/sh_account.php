<?php
  include '../../include/connection.php';
  include "../../include/login_controller.php";
  $session_appno = $_SESSION["appno"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript">
    function preback(){window.history.forward();}
    setTimeout("preback()",0);
    window.onunload=function(){null};
  </script>
<title>Entrance Exam </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <link rel="icon" href="../../plugin/design/logo.png">
 <script src="js/jquery.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<script src="js/bootstrap.min.js"  type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
 <!--alert message-->
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->

</head>
<body>
<div class="header">
<div class="row">
<div class="col-lg-6">
<span class="logo"><img src="image/officialseal.png" class="img-logo"></span></div>
<div class="col-md-4 col-md-offset-2">
 <?php
  if(!(isset($_SESSION['appno']))){
header("location:index.php");

}
else
{
$get_applicant = mysqli_query($connection,"SELECT * FROM senior_applicant_information WHERE applicant_no = '$session_appno'");
$get_row_applicant = mysqli_fetch_array($get_applicant);
$fname = $get_row_applicant["fname"];
$mname = $get_row_applicant["mname"];
$lname = $get_row_applicant["lname"];
$name = ucfirst($fname)." " . ucfirst($mname[0]) . ". " . ucfirst($lname);
$email = $get_row_applicant["emailadd"];
$date_exam = $get_row_applicant["date_exam"];
$time_exam = $get_row_applicant["time_exam"];
$exam_set = $get_row_applicant["exam_set"];

echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="sh_account.php?q=1" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=sh_account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
}?>
<!-- SUBMITTING SCORE FROM THE ADMIN -->
<?php
  // COUNTING SUBJECT
  if(isset($_POST['finish_btn'])){
    date_default_timezone_set("Asia/Manila");
    $date = date('F d, Y');
  // GET COURSE
  $get_month = mysqli_query($connection,"SELECT MONTH(now()) as month FROM sh_exam_score");
  $get_month_result = mysqli_fetch_array($get_month);
  $month_result = $get_month_result["month"];
  $get_course = mysqli_query($connection,"SELECT * FROM senior_applicant_information WHERE applicant_no = '$session_appno'");
  $fetch_course = mysqli_fetch_array($get_course);
  $firstcourse = $fetch_course['firstchoice'];
  $secondcourse = $fetch_course['secondchoice'];
  $thirdcourse = $fetch_course['thirdchoice'];
  // GET SCORE
  $get_student = mysqli_query($connection,"SELECT name,email FROM history WHERE name = '$name' AND email='$email'");
  $fetch_student = mysqli_fetch_array($get_student);
  $std_name = $fetch_student['name'];
  $std_email = $fetch_student['email'];
  // AVERAGE SCORE
  $avg_score = mysqli_query($connection,"SELECT AVG(score) FROM history WHERE name = '$name' AND email = '$email'");
  $fetch_avg = mysqli_fetch_array($avg_score);
  $total_avg = number_format($fetch_avg['AVG(score)'],2);
 if($total_avg < 60 && $total_avg >=40){
     $insert_score = mysqli_query($connection,"INSERT INTO sh_exam_score (applicant_no,name,email,score,status,first_course,second_course,third_course,date_exam,time_exam,month_report)VALUES('$session_appno','$std_name','$std_email','$total_avg','For Interview','$firstcourse','$secondcourse','$thirdcourse','$date_exam','$time_exam','$month_result')");
  }
  if($total_avg >= 60 && $total_avg <=100){
     $insert_score = mysqli_query($connection,"INSERT INTO sh_exam_score (applicant_no,name,email,score,status,first_course,second_course,third_course,date_exam,time_exam,month_report)VALUES('$session_appno','$std_name','$std_email','$total_avg','Passed','$firstcourse','$secondcourse','$thirdcourse','$date_exam','$time_exam','$month_result')");
  }
  if($total_avg < 40 && $total_avg >=0){
     $insert_score = mysqli_query($connection,"INSERT INTO sh_exam_score (applicant_no,name,email,score,status,first_course,second_course,third_course,date_exam,time_exam,month_report)VALUES('$session_appno','$std_name','$std_email','$total_avg','Failed','$firstcourse','$secondcourse','$thirdcourse','$date_exam','$time_exam','$month_result')");
  }
  }
?>
</div>
</div></div>
<div class="bg">

<!--navigation menu-->
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!--navigation menu closed-->
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">

<!--home start-->
<?php if(@$_GET['q']==1) {
// echo  '<div class="panel"><h4>Note:Please answer all the subject below!</h4></div>';
  // FETCHING ALL SUBJECT
$result = mysqli_query($connection,"SELECT * FROM quiz WHERE exam_set = '$exam_set'") or die('Error');
// COUNTING SUBJECT
  $query_count = mysqli_query($connection,"SELECT COUNT(*) AS quiz FROM quiz WHERE exam_set = '$exam_set'");
$count = mysqli_fetch_assoc($query_count);
$count_subject = $count["quiz"];
// echo $count_subject;
echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td></td></tr>';
$c=1;
// VALIDATE IF IT THE USER SUBMIT THE Exam
 $validate_exam = mysqli_query($connection,"SELECT COUNT(*) as std_validate FROM sh_exam_score WHERE email = '$email'");
$std_exam_count = mysqli_fetch_array($validate_exam);
$count_exam_std = $std_exam_count["std_validate"];
// COUNTING SUBJECT
  $validate_user = mysqli_query($connection,"SELECT COUNT(*) as validate FROM `history` WHERE email = '$email'");
$validate_count = mysqli_fetch_array($validate_user);
$count_user = $validate_count["validate"];
// echo $count_user;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
    $time = $row['duration'];
	$eid = $row['eid'];
$q12=mysqli_query($connection,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
  $r = mysqli_fetch_assoc($q12);
  $score = $r["score"];
$rowcount=mysqli_num_rows($q12);	
if($rowcount == 0){
	echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td>
	<td><b><a href="sh_account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#A62D38">&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
}
else
{

echo '<tr style="color:#99cc32"><td>'.$c++.'</td><td>'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td>'.$total.'</td>  
	<td><b><a href="sh_update.php?q=quizre&step=25&eid='.$eid.'&n=1&t='.$total.'"</a></b></td></td></tr>';
}
}
if($count_exam_std == 0){
  if($count_subject == $count_user){
    echo '</table></div></br><center><p>Note:After finishing all the subject above. Dont forget to click finish exam! </p><form method = "POST"><button type = "submit" class="btn btn-success"name = "finish_btn" ">Finish Exam</button></form></center></div>';

  }
}
else{
  echo "</table></div></br><center><p>Thankyou for submiting your exam!</p></center></div>";
}
$c=0;
}?>
<!--home closed-->

<!--quiz start-->
<?php
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
$eid=@$_GET['eid'];
$sn=@$_GET['n'];
$total=@$_GET['t'];
$q=mysqli_query($connection,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn'" );
echo '<div class="panel" style="margin:5%">
      <div class="alert alert-danger" role="alert"><h4> Please read the question carefully and answer it carefully. If you submit your answer you cant re answer it</h4></div>
      </div>';
echo '<div class="panel" style="margin:5%">';
while($row=mysqli_fetch_array($q))
{
$qns=$row['qns'];
$image_qns = $row['image'];
$qid=$row['qid'];
if($image_qns != ""){
  echo "<b>Question &nbsp;".$sn."&nbsp;<br /><img src='../../plugin/exam_image/".$image_qns."' height='500px' width='500px'/></b><br /><br />";
}
if($qns != ""){
  echo '<b>Question &nbsp;'.$sn.'&nbsp;<br />'.$qns.'</b><br /><br />';
}
if($image_qns != "" && $qns != ""){
  echo "<b>Question &nbsp;".$sn."&nbsp;<br />".$qns."</b><br />
          <img src='../../plugin/exam_image/".$image_qns."' height='500px' width='500px'/></b><br /><br />";

}
}
$q=mysqli_query($connection,"SELECT * FROM options WHERE qid='$qid'" );
echo '<form name=quiz action="sh_update.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
<br />';

while($row=mysqli_fetch_array($q) )
{
$option=$row['option'];
$image_option = $row['image'];
$optionid=$row['optionid'];
if($image_option != ""){
  echo"<input type='radio' name='ans' value='".$optionid."'><img src='../../plugin/exam_image/".$image_option."' height='100px' width='100px'/><br /><br />";
}
if($option != ""){
  echo'<input type="radio" name="ans" value="'.$optionid.'">'.$option.'<br /><br />';
}
}
echo'<table><button type="submit" class="btn btn-success" style="width:100px;"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Submit</button></form></table>
</div>';
//header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
?>

<!-- result display -->
<?php
if(@$_GET['q']== 'result' && @$_GET['eid']) 
{
$eid=@$_GET['eid'];
$q=mysqli_query($connection,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
echo  '<div class="panel">
<center><h1 class="title" style="color:#660033">Finish</h1><center><br /><a href="sh_account.php?q=1"><button class ="btn btn-success"><span class = "glyphicon glyphicon-ok"></span> Finish</button></a>';

// while($row=mysqli_fetch_array($q) )
// {
// $s=$row['score'];
// $w=$row['wrong'];
// $r=$row['sahi'];
// $qa=$row['level'];
// echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>'.$qa.'</td></tr>
//       <tr style="color:#99cc32"><td>Right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r. "/".$qa.'</td></tr>
// 	  <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
// }
// echo '</table></div>';

}
?>
<!--quiz end-->

</div></div></div></div>

</body>
</html>
