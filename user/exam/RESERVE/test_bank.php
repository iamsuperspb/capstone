<?php
	include ("../../database/database_exam.php");
	session_start();

	if (!isset($_SESSION["score"]))
	{
		$_SESSION["score"] = 0;
	}
	if($_POST)
	{
		$number = $_POST["number"];
		$selected_choice = $_POST["choice"];
		$next_q = $number+1;

		
		/*
		* Get total
		*/
		$query = "SELECT * FROM `exam_question`";
		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
		$total = $result->num_rows;
	//DETERMINE IF IT IS CORRECT 
		$query = "SELECT * FROM `exam_choices` WHERE q_no = $number AND answer_key = 1";
		// Get Result
		$correct_result = $mysqli->query($query) or die($mysqli->error.__LINE__);
		// GET ROW
		$row = $correct_result->fetch_assoc();
		//SET CORRECT CHOICE
		$correct_choice = $row["id"];
		if($correct_choice == $selected_choice)
		{
			//ANSWER IS CORRECT
				$_SESSION["score"]++;
		}
		//check if its is last page
		if($number == $total)
		{
			include("../../database/connection.php");
			
			header("Location:success.php");
			exit();
		}
		else
		{
			header("Location:entrance_exam.php?n=$next_q");
		}
	}
?>
