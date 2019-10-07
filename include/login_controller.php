<!-- FOR AUTHORITY LOGIN CONTROLLER -->
<?php
	session_start();
	include "connection.php";
	if (isset($_POST["login_btn"])){
		$username = mysqli_real_escape_string($connection,$_POST["username"]);
		$password = mysqli_real_escape_string($connection,$_POST["password"]);
		$validate = mysqli_query($connection,"SELECT * FROM useraccount WHERE username = '$username'");
		$validate_user = mysqli_num_rows($validate);
		if($validate_user > 0){
			while ($row = mysqli_fetch_array($validate)) {
				if($row["password"] == md5($password)){
					$_SESSION['username'] = $row['username'];
					$_SESSION['usertype'] = $row['usertype'];
					if($row["usertype"] == "developer"){
						echo "<script language='javascript'>
							alert('Login Success');
							</script>";
						header("location:user/developer/index");
					}
					elseif($row["usertype"] == "cpad"){
						echo "<script language='javascript'>
							alert('Login Success');
							</script>";
						header("location:user/cpad/index");
					}
					elseif($row["usertype"] == "admin"){
						echo "<script language='javascript'>
							alert('Login Success');
							</script>";
						header("location:user/admin/index");
					}
					elseif($row["usertype"] == "counselor"){
						echo "<script language='javascript'>
							alert('Login Success');
							</script>";
						header("location:user/counseling/index");
					}
				}
				else{
					echo "<script language='javascript'>
							alert('Login Failed');
							</script>";
				}
			}
		}
		else{
			echo "<script language='javascript'>
							alert('Login Failed');
							</script>";
		}
	}
?>
<!-- APPLICANT LOGIN CONTROLLER -->
<?php
	if(isset($_POST["applicant_login_btn"])){
		date_default_timezone_set("Asia/Manila");  
        $datetime = date('m/d/Y');
        
		$appno = mysqli_real_escape_string($connection,$_POST["applicant_no"]);
		//college applicant no login controller
		$checktime = date('h:i A');
		// AM SESSION
		$cl_amchecktime = '9:00';
	    $cl_amcheckstamp = strtotime($cl_amchecktime);
	    $cl_amchecktime = date('h:i A', $cl_amcheckstamp);
		$cl_amtime = '9:00';
	    $cl_amtimestamp = strtotime($cl_amtime) + 60*60*2;
	    $cl_amtime = date('h:i A',$cl_amtimestamp);
	    if($checktime >= $cl_amchecktime){
		    	if($checktime <= $cl_amtime){
		    	$applicant_cl = mysqli_query($connection,"SELECT * FROM college_applicant_information WHERE applicant_no = '$appno' AND status = 'Approved' AND date_exam = '$datetime' AND time_exam = '9:00 AM'");
		    	$validate_cl = mysqli_num_rows($applicant_cl);
		    	if($validate_cl > 0){
				while($row_cl = mysqli_fetch_array($applicant_cl)){
					$_SESSION['appno'] = $row_cl["applicant_no"];
					if($appno == $row_cl["applicant_no"]){
						header("location:user/exam/cl_account.php?q=1");
						}
					}
				}
				else{
					echo "<script language='javascript'>
						alert('Incorrect Applicant Number!');
						</script>";
				}
			
		    }
			    else{
			    	echo "<script language='javascript'>
							alert('Your time scheduled already expired! Please go to CPAD to reschedule your exam!');
							</script>";
			    }
	    }
	    elseif($checktime > $cl_amtime){
	    	echo "<script language='javascript'>
							alert('The am session already end! Please wait for pm session.');
							</script>";
	    }
	    
		// PM SESSION
		$cl_pmchecktime = '13:30';
	    $cl_pmcheckstamp = strtotime($cl_pmchecktime);
	    $cl_pmchecktime = date('h:i A', $cl_pmcheckstamp);
	    $cl_pmtime = '13:30';
	    $cl_pmtimestamp = strtotime($cl_pmtime) + 60*60*2;
	    $cl_pmtime = date('h:i A',$cl_pmtimestamp);
	    if($checktime >= $cl_pmchecktime){
		    	if($checktime <= $cl_pmtime){
		    	$applicant_cl = mysqli_query($connection,"SELECT * FROM college_applicant_information WHERE applicant_no = '$appno' AND status = 'Approved' AND date_exam = '$datetime' AND time_exam = '1:30 PM'");
		    	$validate_cl = mysqli_num_rows($applicant_cl);
		    	if($validate_cl > 0){
				while($row_cl = mysqli_fetch_array($applicant_cl)){
					$_SESSION['appno'] = $row_cl["applicant_no"];
					if($appno == $row_cl["applicant_no"]){
						header("location:user/exam/cl_account.php?q=1");
						}
					}
				}
				else{
					echo "<script language='javascript'>
						alert('Incorrect Applicant Number!');
						</script>";
				}
			
		    }
			    else{
			    	echo "<script language='javascript'>
							alert('Your time scheduled already expired! Please go to CPAD to reschedule your exam!');
							</script>";
			    }
	    }
	    elseif($checktime > $cl_pmtime){
	    	echo "<script language='javascript'>
							alert('The am session already end! Please wait for pm session.');
							</script>";
	    }
		//senior high applicant no login controller
		$sh_amchecktime = '9:00';
	    $sh_amcheckstamp = strtotime($sh_amchecktime);
	    $sh_amchecktime = date('h:i A', $sh_amcheckstamp);
		$sh_amtime = '9:00';
	    $sh_amtimestamp = strtotime($sh_amtime) + 60*60*2;
	    $sh_amtime = date('h:i A',$sh_amtimestamp);
	    if($checktime >= $sh_amchecktime){
		    	if($checktime <= $sh_amtime){
		    	$applicant_sh = mysqli_query($connection,"SELECT * FROM senior_applicant_information WHERE applicant_no = '$appno' AND status = 'Approved' AND date_exam = '$datetime' AND time_exam = '9:00 AM'");
		    	$validate_sh = mysqli_num_rows($applicant_sh);
		    	if($validate_sh > 0){
				while($row_sh = mysqli_fetch_array($applicant_sh)){
					$_SESSION['appno'] = $row_sh["applicant_no"];
					if($appno == $row_sh["applicant_no"]){
						header("location:user/exam/sh_account.php?q=1");
						}
					}
				}
				else{
					echo "<script language='javascript'>
						alert('Incorrect Applicant Number!');
						</script>";
				}
			
		    }
			    else{
			    	echo "<script language='javascript'>
							alert('Your time scheduled already expired! Please go to CPAD to reschedule your exam!');
							</script>";
			    }
	    }
	    elseif($checktime > $sh_amtime){
	    	echo "<script language='javascript'>
							alert('The am session already end! Please wait for pm session.');
							</script>";
	    }
	    
		// PM SESSION
		$sh_pmchecktime = '13:30';
	    $sh_pmcheckstamp = strtotime($sh_pmchecktime);
	    $sh_pmchecktime = date('h:i A', $sh_pmcheckstamp);
	    $sh_pmtime = '13:30';
	    $sh_pmtimestamp = strtotime($sh_pmtime) + 60*60*2;
	    $sh_pmtime = date('h:i A',$sh_pmtimestamp);
	    if($checktime >= $sh_pmchecktime){
		    	if($checktime <= $sh_pmtime){
		    	$applicant_sh = mysqli_query($connection,"SELECT * FROM senior_applicant_information WHERE applicant_no = '$appno' AND status = 'Approved' AND date_exam = '$datetime' AND time_exam = '1:30 PM'");
		    	$validate_sh = mysqli_num_rows($applicant_sh);
		    	if($validate_sh > 0){
				while($row_sh = mysqli_fetch_array($applicant_sh)){
					$_SESSION['appno'] = $row_sh["applicant_no"];
					if($appno == $row_sh["applicant_no"]){
						header("location:user/exam/sh_account.php?q=1");
						}
					}
				}
				else{
					echo "<script language='javascript'>
						alert('Incorrect Applicant Number!');
						</script>";
				}
			
		    }
			    else{
			    	echo "<script language='javascript'>
							alert('Your time scheduled already expired! Please go to CPAD to reschedule your exam!');
							</script>";
			    }
	    }
	    elseif($checktime > $sh_pmtime){
	    	echo "<script language='javascript'>
							alert('The am session already end! Please wait for pm session.');
							</script>";
	    }


		// $applicant_sh = mysqli_query($connection,"SELECT * FROM senior_applicant_information WHERE applicant_no = '$appno' AND status = 'Approved' AND date_exam = '$datetime'");
		// $validate_sh = mysqli_num_rows($applicant_sh);
		// if($validate_cl > 0){
		// 	while($row_cl = mysqli_fetch_array($applicant_cl)){
		// 		$_SESSION['appno'] = $row_cl["applicant_no"];
		// 		if($appno == $row_cl["applicant_no"]){
		// 			header("location:user/exam/cl_account.php?q=1");
		// 		}
		// 	}
		// }
		// if($validate_cl == 0){
		// 	echo "<script language='javascript'>
		// 		alert('Incorrect Applicant Number!');
		// 		</script>";
		// }
		
		// if($validate_sh > 0){
		// 	while($row_sh = mysqli_fetch_array($applicant_sh)){
		// 		$_SESSION['appno'] = $row_sh["applicant_no"];
		// 		if($appno == $row_sh["applicant_no"]){
		// 			header("location:user/exam/sh_account.php?q=1");
		// 		}
		// 	}
		// }
		// if($validate_sh == 0){
		// 	echo "<script language='javascript'>
		// 		alert('Incorrect Applicant Number!');
		// 		</script>";
		// }
	}
?>