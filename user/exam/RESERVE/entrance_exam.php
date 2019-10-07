<?php include '../../database/database_exam.php'; ?>
<?php session_start(); ?>
<?php
/*
		* Get total
		*/
		$query = "SELECT * FROM `exam_question`ORDER BY `subject` ASC";
		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
		$total = $result->num_rows;
// GET PAGE
	$number = (int) $_GET["n"];
/*
	*	Get Subject
	*/
	$query = "SELECT * FROM `exam_question` WHERE q_no = $number ORDER BY `subject` ASC";
	//Get result
	$get_subject = $mysqli->query($query) or die($mysqli->error.__LINE__);
	
	$subject = $get_subject->fetch_assoc();
// QUERY FOR GETTING QUESTION
	/*
	*	Get Question
	*/
	$query = "SELECT * FROM `exam_question` WHERE q_no = $number ORDER BY `subject` ASC";
	//Get result
	$get_question = $mysqli->query($query) or die($mysqli->error.__LINE__);
	
	$question = $get_question->fetch_assoc();
	
	/*
	*	Get Choices
	*/
	$query = "SELECT * FROM `exam_choices` WHERE q_no = $number ORDER BY `subject` ASC";
	//Get results
	$choices = $mysqli->query($query) or die($mysqli->error.__LINE__);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
		<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../../designer/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../designer/css/allcss.css">
	<link rel="icon" href="../../designer/logo.png">
	<title>GTIMS | Entrance Exam</title>
</head>
<body style="background: #303030;">
	<nav class="navbar navbar-light fixed-top bg-light flex-md-nowrap p-0 shadow">
	      <a class="navbar-brand col-sm-3 col-md-2 mr-0"><img src="../../designer/logo.png" style="width: 100px;"></a>
	</nav> 
	<div class="exam-container">
		<header class="subject-holder">
			<h3>*<?php echo $subject["subject"];?></h3>
		</header>
		<div class="question-holder">
			<p class="question"><?php echo $question["question"];?></p>
		</div>
		<div class="choices-holder">
			<form method="POST" action="test_bank.php">
				<ul>
					<?php while($row = $choices->fetch_assoc()): ?>
						<li><input name="choice" type="radio" value="<?php echo $row['id']; ?>" /><?php echo $row['choices']; ?></li>
					<?php endwhile; ?>
				</ul>
		</div>
		<center>
		<input type="submit" name="submit-btn" class="exam-btn" value="Submit">
		<input type="hidden" name="number" value="<?php echo $number; ?>" />
		</center>
	</form>
	</div>
	<footer><p style="color: #fff;"> &copy;2018 Enigma. All Right Reserved.</p><p style="color: #fff;"> Developed by Sean Paulo Bautista - LPU-Cav IT Student</p>
		</footer>
<!-- JQUERY -->
	<script type="text/javascript" src="../../designer/js/bootstrap.min.js"></script>
</body>
</html>