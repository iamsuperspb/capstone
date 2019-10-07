<?php  
 include "../../include/connection.php";
$output = '';
date_default_timezone_set("Asia/Manila");
$time = time();
$datetime = date('M d Y H:i:s',$time);
$date_report = date('F,Y');
if(isset($_POST["export_btn"]))
{ 
  $department = mysqli_real_escape_string($connection,$_POST["department"]);
  $prepared_by = mysqli_real_escape_string($connection,$_POST["prepared_by"]);
  $get_month = mysqli_query($connection,"SELECT MONTH(now()) as month FROM student_record");
  $get_month_result = mysqli_fetch_array($get_month);
  $month_result = $get_month_result["month"];
 $query = "SELECT * FROM `student_record` WHERE department = '$department' AND month_report = '$month_result'";
 $result = mysqli_query($connection, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
  <center>
  <h2>Counselors Daily Activies Monthly Report </h2>
  </center>
  <center>
  <h4>'.$date_report.'</h4>
  </center>
   <table class="table" border="1">  
                    <tr> 
                          <th>Date</th> 
                         <th>Name</th>  
                         <th>Department</th>
                         <th>Course</th>
                         <th>Gender</th>
                         <th>Services Rendered</th>
                         <th>Reason</th>
                         <th>Remarks</th> 
                         <th>Follow Up</th>
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $name = $row["name"];
    $department = $row["department"];
    $course = $row["course"];
    $sex = $row["sex"];
    $services = $row["services"];
    $reason = $row["reason"];
    $remarks = $row["remarks"];
    $date_filed = $row["date_filed"];
    $followup = $row["followup"];
   $output .= '
                    <tr>                           
                          <td>'.$date_filed.'</td>
                         <td>'.$name.'</td>  
                         <td>'.$department.'</td>  
                         <td>'.$course.'</td>
                         <td>'.$sex.'</td>
                         <td>'.$services.'</td>
                         <td>'.$reason.'</td>
                         <td>'.$remarks.'</td>
                         <td>'.$followup.'</td> 
                    </tr>
   ';
  }
  $output .= '</table>
              Preferred By: '.$prepared_by.'('.$department.')';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=student_record'.$datetime.'.xls');
  echo $output;
 }
}
?>