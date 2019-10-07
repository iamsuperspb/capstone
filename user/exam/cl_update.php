<?php
include_once '../../include/connection.php';
session_start();
$session_appno = $_SESSION["appno"];
$get_applicant = mysqli_query($connection,"SELECT * FROM college_applicant_information WHERE applicant_no = '$session_appno'");
$get_row_applicant = mysqli_fetch_array($get_applicant);
$fname = $get_row_applicant["fname"];
$mname = $get_row_applicant["mname"];
$lname = $get_row_applicant["lname"];
$name = ucfirst($fname)." " . ucfirst($mname[0]) . ". " . ucfirst($lname);
$email = $get_row_applicant["emailadd"];
//delete feedback
if(@$_GET['fdid']) {
$id=@$_GET['fdid'];
$result = mysqli_query($connection,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
header("location:dash.php?q=3");
}

//delete user
if(@$_GET['demail']) {
$demail=@$_GET['demail'];
$r1 = mysqli_query($connection,"DELETE FROM rank WHERE email='$demail' ") or die('Error');
$r2 = mysqli_query($connection,"DELETE FROM history WHERE email='$demail' ") or die('Error');
$result = mysqli_query($connection,"DELETE FROM user WHERE email='$demail' ") or die('Error');
header("location:dash.php?q=1");
}
//remove quiz
if(@$_GET['q']== 'rmquiz') {
$eid=@$_GET['eid'];
$result = mysqli_query($connection,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$qid = $row['qid'];
$r1 = mysqli_query($connection,"DELETE FROM options WHERE qid='$qid'") or die('Error');
$r2 = mysqli_query($connection,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
}
$r3 = mysqli_query($connection,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($connection,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
$r4 = mysqli_query($connection,"DELETE FROM history WHERE eid='$eid' ") or die('Error');

header("location:../../user/admin/manage_exam");
}

//add quiz
if(@$_GET['q']== 'addquiz') {
$name = $_POST['name'];
$name= ucwords(strtolower($name));
$total = $_POST['total'];
// $sahi = $_POST['right'];
// $wrong = $_POST['wrong'];
// $time = $_POST['time'];
// $tag = $_POST['tag'];
// $desc = $_POST['desc'];
$id=uniqid();
$q3=mysqli_query($connection,"INSERT INTO quiz VALUES  ('$id','$name' , '1' , '0','$total','10' ,'#','#', NOW())");

header("location:../admin/add_exam.php?q=4&step=2&eid=$id&n=$total");
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
	$q3=mysqli_query($connection,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
	  $oaid=uniqid();
	  $obid=uniqid();
	$ocid=uniqid();
	$odid=uniqid();
	$a=$_POST[$i.'1'];
	$b=$_POST[$i.'2'];
	$c=$_POST[$i.'3'];
	$d=$_POST[$i.'4'];
	$target1 = "image/".basename($_FILES[$i.'image1']['name']);
	$target1 = "image/".basename($_FILES[$i.'image2']['name']);
	$target1 = "image/".basename($_FILES[$i.'image3']['name']);
	$target1 = "image/".basename($_FILES[$i.'image4']['name']);
	$image = $_FILES[$i.'image1']['name'];
	$image = $_FILES[$i.'image2']['name'];
	$image = $_FILES[$i.'image3']['name'];
	$image = $_FILES[$i.'image4']['name'];
	$img1=$_POST[$i.'image1'];
	$img2=$_POST[$i.'image2'];
	$img3=$_POST[$i.'image3'];
	$img4=$_POST[$i.'image4'];
	$qa=mysqli_query($connection,"INSERT INTO options VALUES  ('$qid','$img1','$a','$oaid')") or die('Error61');
	$qb=mysqli_query($connection,"INSERT INTO options VALUES  ('$qid','$img2','$b','$obid')") or die('Error62');
	$qc=mysqli_query($connection,"INSERT INTO options VALUES  ('$qid','$img3','$c','$ocid')") or die('Error63');
	$qd=mysqli_query($connection,"INSERT INTO options VALUES  ('$qid','$img3','$d','$odid')") or die('Error64');
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
	if(move_uploaded_file($_FILES[$i.'image1']['tmp_name'], $target1) || move_uploaded_file($_FILES[$i.'image2']['tmp_name'], $target1) || move_uploaded_file($_FILES[$i.'image3']['tmp_name'], $target1) || move_uploaded_file($_FILES[$i.'image4']['tmp_name'], $target1)){
			$msg = "Successfully uploaded!";
			echo "<script language='javascript'>";
			echo "alert('$msg');";
			echo "</script>";
		}
		else{
			$msg = "Theres was a problem uploading your image!";
			echo "<script language='javascript'>";
			echo "alert('$msg');";
			echo "</script>";
		}
	}


$qans=mysqli_query($connection,"INSERT INTO answer VALUES  ('$qid','$ansid')");

 }
header("location:../admin/manage_exam");
}

//quiz start
if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
	$eid=@$_GET['eid'];
	$sn=@$_GET['n'];
	$total=@$_GET['t'];
	$ans=$_POST['ans'];
	$qid=@$_GET['qid'];
	$q=mysqli_query($connection,"SELECT * FROM answer WHERE qid='$qid' " );
	$get_subj = mysqli_query($connection,"SELECT * FROM quiz WHERE eid = '$eid'");
	$row_subj = mysqli_fetch_array($get_subj);
	$subj = $row_subj["title"];
	while($row=mysqli_fetch_array($q) )
	{
	$ansid=$row['ansid'];
	}
	if($ans == $ansid)
	{
	$q=mysqli_query($connection,"SELECT * FROM quiz WHERE eid='$eid' " );
	while($row=mysqli_fetch_array($q) )
	{
	$sahi=$row['sahi'];
	$totaln = $row['total'];
	}
	if($sn == 1)
	{
	$q=mysqli_query($connection,"INSERT INTO history (name,email,eid,subject,score,level,sahi,wrong,date)VALUES('$name','$email','$eid','$subj','0','0','0','0',NOW() )")or die('Error');
	}
	$q=mysqli_query($connection,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');

	while($row=mysqli_fetch_array($q) )
	{
	$s=$row['score'];
	$r=$row['sahi'];
	}	
	$r++;
	$s=$s+$sahi;
	$divscore = $r/$totaln;
	$totalscore = $divscore*100;
	$q=mysqli_query($connection,"UPDATE `history` SET `score`=$totalscore,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');

	} 
	else
	{
	$q=mysqli_query($connection,"SELECT * FROM quiz WHERE eid='$eid' " )or die('Error129');

	while($row=mysqli_fetch_array($q) )
	{
	$wrong=$row['wrong'];
	}
	if($sn == 1)
	{
	$validate_history = mysqli_query($connection,"SELECT * FROM history WHERE subject = '$subj' AND name = '$name'");
	$history_num = mysqli_num_rows($validate_history);
	if($history_num == 0){
		$q=mysqli_query($connection,"INSERT INTO history (name,email,eid,subject,score,level,sahi,wrong,date)VALUES('$name','$email','$eid','$subj','0','0','0','0',NOW() )")or die('Error137');
	}
	else{

	}
	}
	$q=mysqli_query($connection,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
	while($row=mysqli_fetch_array($q) )
	{
	$s=$row['score'];
	$w=$row['wrong'];
	}
	$w++;
	$s=$s-$wrong;
	$q=mysqli_query($connection,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
	}
	if($sn != $total)
	{
	$sn++;
	
	header("location:cl_account.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total")or die('Error152');
	}
	else if( $_SESSION['key']!='lpu')
	{
	$q=mysqli_query($connection,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
	while($row=mysqli_fetch_array($q) )
	{
	$s=$row['score'];
	}
	$q=mysqli_query($connection,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
	$rowcount=mysqli_num_rows($q);
	if($rowcount == 0)
	{
	$q2=mysqli_query($connection,"INSERT INTO rank VALUES('$email','$s',NOW())")or die('Error165');
	}
	else
	{
	while($row=mysqli_fetch_array($q) )
	{
	$sun=$row['score'];
	}
	$sun=$s+$sun;
	$q=mysqli_query($connection,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
	}
	header("location:cl_account.php?q=1");
	}
	else
	{
	header("location:cl_account.php?q=1");
	}
}

//restart quiz
if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) {
$eid=@$_GET['eid'];
$n=@$_GET['n'];
$t=@$_GET['t'];
$q=mysqli_query($connection,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
}
$q=mysqli_query($connection,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');
$q=mysqli_query($connection,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
while($row=mysqli_fetch_array($q) )
{
$sun=$row['score'];
}
$sun=$sun-$s;
$q=mysqli_query($connection,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
header("location:cl_account.php?q=quiz&step=2&eid=$eid&n=1&t=$t");
}

?>



