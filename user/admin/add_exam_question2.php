<?php
include "../../include/connection.php";
session_start();
//remove quiz
if($_GET['q']== 'rmquiz') {
  $eid=$_GET['eid'];
  $result = mysqli_query($connection,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
  while($row = mysqli_fetch_array($result)) {
    $qid = $row['qid'];
  $r1 = mysqli_query($connection,"DELETE FROM options WHERE qid='$qid'") or die('Error');
  $r2 = mysqli_query($connection,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
  }
  $r3 = mysqli_query($connection,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
  $r4 = mysqli_query($connection,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
  $r4 = mysqli_query($connection,"DELETE FROM history WHERE eid='$eid' ") or die('Error');
  echo "<script language='javascript'>
        alert('Remove Successfully');
        </script>";
  header("location:manage_exam");
}
//add quiz
if(@$_GET['q']== 'addquiz') {
$name = $_POST['name'];
$name= ucwords(strtolower($name));
$total = $_POST['total'];
$exam_set = $_POST["exam_set"];
// $sahi = $_POST['right'];
// $wrong = $_POST['wrong'];
$time = $_POST['time'];
$tag = $_POST['tag'];
$desc = $_POST['desc'];
$id=uniqid();
$q3=mysqli_query($connection,"INSERT INTO `quiz`(`eid`, `title`, `exam_set`, `sahi`, `wrong`, `total`, `duration`, `intro`, `tag`, `date_create`) VALUES  ('$id','$name','$exam_set','1' , '0','$total','10' ,'#','#', NOW())");

header("location:dash.php?q=4&step=2&eid=$id&n=$total");
}
//add question
  if(@$_GET['q']== 'addqns') {
  $n=@$_GET['n'];
  $eid=@$_GET['eid'];
  $ch=@$_GET['ch'];

  for($i=1;$i<=$n;$i++)
   {
   $qid=uniqid();
   $qns=$_POST['qns'.$i];
  $q3=mysqli_query($connection,"INSERT INTO questions VALUES  ('$eid','$qid','','$qns' , '$ch' , '$i')");
    $oaid=uniqid();
    $obid=uniqid();
  $ocid=uniqid();
  $odid=uniqid();
  $a=mysqli_real_escape_string($connection,$_POST[$i.'1']);
  $b=mysqli_real_escape_string($connection,$_POST[$i.'2']);
  $c=mysqli_real_escape_string($connection,$_POST[$i.'3']);
  $d=mysqli_real_escape_string($connection,$_POST[$i.'4']);
  $qa=mysqli_query($connection,"INSERT INTO options VALUES  ('$qid','','$a','$oaid')") or die('Error61');
  $qb=mysqli_query($connection,"INSERT INTO options VALUES  ('$qid','','$b','$obid')") or die('Error62');
  $qc=mysqli_query($connection,"INSERT INTO options VALUES  ('$qid','','$c','$ocid')") or die('Error63');
  $qd=mysqli_query($connection,"INSERT INTO options VALUES  ('$qid','','$d','$odid')") or die('Error64');
  $e=$_POST['ans'.$i];
  switch($e)
  {
  case 'a':
  $ansid=$oaid;
  break;
  case 'b':
  $ansid=$obid;
  break;
  case 'c':
  $ansid=$ocid;
  break;
  case 'd':
  $ansid=$odid;
  break;
  default:
  $ansid=$oaid;
  }


$qans=mysqli_query($connection,"INSERT INTO answer VALUES  ('$qid','$ansid')");

 }
  echo "<script language='javascript'>
        alert('Successfully Added');
        </script>";
  header("location:manage_exam");
}
?>