<?php
	session_start();
?>
<?php
	include "../../database/connection.php";
	if(isset($_POST["submit-test"])){
	date_default_timezone_set("Asia/Manila");
	$time = time();
	$datetime = date('M d Y H:i:s',$time);
	$score = $_POST["score"];

	if($score){
		$insert = mysqli_query($connection, "INSERT INTO `student_testscore`(score)VALUES('$score')");
		session_destroy();
		header("location:index.php");
	}
}
?>
<!DOCTYPE html>
<html>
		<meta charset="utf-8">
			<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="../../designer/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../../designer/css/allcss.css">
		<link rel="icon" href="../../designer/logo.png">

<head>
	<title>GTIMS | Entrance Exam</title>
</head>
<body style="background: #303030;">
	<nav class="navbar navbar-light fixed-top bg-light flex-md-nowrap p-0 shadow">
	      <a class="navbar-brand col-sm-3 col-md-2 mr-0"><img src="../../designer/logo.png" style="width: 100px;"></a>
	</nav> 
	<div class="success-container">
		<form method="POST">
			<input type="hidden" name="score" value="<?php echo $_SESSION["score"];?>">
			<input type="submit" name="submit-test" value="Finish">
		</form>
	</div>
</body>
</html>