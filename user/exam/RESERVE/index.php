<?php
include ("../../database/connection.php");
// for course choice
$select_course = mysqli_query($connection,"SELECT * FROM `college_course`");
$options = "";
while ($row_course = mysqli_fetch_array($select_course)) {
	$options = $options."<option>".$row_course[1]."</option>";
}
// for insertion of student details
if(isset($_POST['submit']))
{
	// date register format
	date_default_timezone_set("Asia/Manila");
	$time = time();
	$datetime = date('M d Y H:i:s',$time);
	//getting data
	$fname = $_POST["fname"];
	$mname = $_POST["mname"];	
	$lname = $_POST["lname"];
	$address = $_POST["address"];
	$contact = $_POST["contactnum"];
	$emailadd = $_POST["emailadd"];
	$firstchoice = $_POST["firstchoice"];
	$secondchoice = $_POST["secondchoice"];
	$thirdchoice = $_POST["thirdchoice"];
	// getting query
	if ($fname && $mname && $lname && $address && $contact && $emailadd && $firstchoice && $secondchoice && $thirdchoice)
	{
	
	$insert_query = mysqli_query($connection, "INSERT INTO student_info(firstname,middlename,lastname,address,contact,email,course_firstchoice,course_secondchoice,course_thirdchoice,dateregister) VALUES ('$fname','$mname','$lname','$address','$contact','$emailadd','$firstchoice','$secondchoice','$thirdchoice','$datetime')");

			header("location:../../user/exam/entrance_exam.php?n=1");
	
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../../designer/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../designer/css/allcss.css">
	<link rel="icon" href="../../designer/logo.png">

	<title>GTMIS | Exam</title>
</head>
<body style="background: #303030;">
	<form method="POST">
		<div class="container">
			<table class="table table-bordered" style="width: 100%; margin-top: 20px; background: #a62d38; color: white">
				<tr>
					<td>*Student Information</td>
				</tr>
			</table>
			<table class="table table-bordered" style="width: 90%; margin-top: 20px;">
				<tr>
					<td>Firstname</td>
					<td>Middlename</td>
					<td>Lastname</td>
				</tr>
				<tr>
					<td style="width: 200px;">
						<input type="text" name="fname" class="form-control" placeholder="First Name" required="">
					</td>
					<td style="width: 200px;">
						<input type="text" name="mname" class="form-control" placeholder="Middle Name" required="">
					</td>
					<td style="width: 200px;">
						<input type="text" name="lname" class="form-control" placeholder="Last Name" required="">
					</td>
				</tr>
				<tr>
					<td colspan="3">Address</td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="address" class="form-control" required="" placeholder="Address"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">Contact Number</td>
				</tr>
				<tr>
					<td colspan="3"><input type="tel" name="contactnum" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" placeholder="09123456789"  pattern="[0-9]{11}" title="Phone number" maxlength="11" required=""></td>
				</tr>
				<tr>
					<td colspan="3">Email Address</td>
				</tr>
				<tr>
					<td colspan="3"><input type="email" name="emailadd" class="form-control" placeholder="example@example.com" required=""></td>
				</tr>
				<tr>
					<td colspan="3">Course Offering</td>
				</tr>
				<tr>
					<td colspan="3">
						<!-- First choice -->
						<p>First Choice:</p>
						<select name="firstchoice" class="form-control">
							<option value="">--SELECT--</option>
							<?php echo $options; ?>
						</select>
						<!-- Second Choice -->
						<p>Second Choice:</p>
						<select name="secondchoice" class="form-control">
							<option value="">--SELECT--</option>
							<?php echo $options; ?>
						</select>
						<!-- Third Choice -->
						<p>Third Choice:</p>
						<select name="thirdchoice" class="form-control">
							<option value="">--SELECT--</option>
							<?php echo $options; ?>
						</select>
					</td>
				</tr>
			</table>
			<center><input type="submit" name="submit" class="btn-student" value="Submit"></center>
		</div>
	</form>
		<footer><p style="color: #fff;"> &copy;2018 Enigma. All Right Reserved.</p><p style="color: #fff;"> Developed by Sean Paulo Bautista - LPU-Cav IT Student</p>
		</footer>
		<!-- JQUERY -->
		<script type="text/javascript" src="../../designer/js/bootstrap.min.js"></script>
</body>
</html>