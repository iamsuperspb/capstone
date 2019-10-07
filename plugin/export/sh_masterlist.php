<?php  
 include "../../include/connection.php";
$output = '';
date_default_timezone_set("Asia/Manila");
$time = time();
$datetime = date('M d Y H:i:s',$time);
$date = date('m/d/Y');
$date_report = date('F,Y');
$date_today = date('F d,Y');
if(isset($_POST["export_btn"]))
{ 
  $status_report = mysqli_real_escape_string($connection,$_POST["status_report"]);
  $report_by = mysqli_real_escape_string($connection,$_POST["report_by"]);
  $get_month = mysqli_query($connection,"SELECT MONTH(now()) as month FROM sh_exam_score");
  $get_month_result = mysqli_fetch_array($get_month);
  $month_result = $get_month_result["month"];
  // REPORT BY MONTHLY
  if($report_by == "Monthly"){
       if($status_report != "All"){
          $query = "SELECT * FROM `sh_exam_score` WHERE status = '$status_report' AND month_report = '$month_result'";
         $result = mysqli_query($connection, $query);
         if(mysqli_num_rows($result) > 0)
         {
          $output .= '
          <center>
          <h2> Senior High Applicant Status Monthly Report </h2>
          </center>
          <center>
          <h4>'.$date_report.'</h4>
          </center>
           <table class="table" border="1">  
                            <tr> 
                                <th>Date </th>
                                <th>Applicant Number</th> 
                                 <th>Name</th>  
                                 <th>Score</th>
                                 <th>Status</th>
                            </tr>
          ';
          while($row = mysqli_fetch_array($result))
          {
            $appno = $row["applicant_no"];
            $name = $row["name"];
            $date = $row["date_exam"];
            $score = $row["score"];
            $status = $row["status"];
           $output .= '
                            <tr>                           
                                  <td>'.$date.'</td>
                                 <td>'.$appno.'</td>  
                                 <td>'.$name.'</td>  
                                 <td>'.$score.'</td>
                                 <td>'.$status.'</td>
                            </tr>
           ';
          }
          $output .= '</table>';
          header('Content-Type: application/xls');
          header('Content-Disposition: attachment; filename=applicant_status'.$datetime.'.xls');
          echo $output;
         }
         else{
          header("location:../../user/admin/shs_applicant_status");
         }
    }
    else{
      $query = "SELECT * FROM `sh_exam_score` WHERE month_report = '$month_result' ORDER BY applicant_no";
         $result = mysqli_query($connection, $query);
         if(mysqli_num_rows($result) > 0)
         {
          $output .= '
          <center>
          <h2> Senior High Applicant Status Monthly Report </h2>
          </center>
          <center>
          <h4>'.$date_report.'</h4>
          </center>
           <table class="table" border="1">  
                            <tr> 
                                <th>Date </th>
                                <th>Applicant Number</th> 
                                 <th>Name</th>  
                                 <th>Score</th>
                                 <th>Status</th>
                            </tr>
          ';
          while($row = mysqli_fetch_array($result))
          {
            $appno = $row["applicant_no"];
            $name = $row["name"];
            $date = $row["date_exam"];
            $score = $row["score"];
            $status = $row["status"];
           $output .= '
                            <tr>                           
                                  <td>'.$date.'</td>
                                 <td>'.$appno.'</td>  
                                 <td>'.$name.'</td>  
                                 <td>'.$score.'</td>
                                 <td>'.$status.'</td>
                            </tr>
           ';
          }
          $output .= '</table>';
          header('Content-Type: application/xls');
          header('Content-Disposition: attachment; filename=applicant_status'.$datetime.'.xls');
          echo $output;
         }
         else{
          header("location:../../user/admin/shs_applicant_status");
         }
    }
  }
  // REPORT BY TODAY
  if($report_by == "Today"){
    if($status_report != "All"){
          $query = "SELECT * FROM `sh_exam_score` WHERE status = '$status_report' AND date_exam ='$date'";
         $result = mysqli_query($connection, $query);
         if(mysqli_num_rows($result) > 0)
         {
          $output .= '
          <center>
          <h2> Senior High Applicant Status Todays Report </h2>
          </center>
          <center>
          <h4>'.$date_today.'</h4>
          </center>
           <table class="table" border="1">  
                            <tr> 
                                <th>Date </th>
                                <th>Applicant Number</th> 
                                 <th>Name</th>  
                                 <th>Score</th>
                                 <th>Status</th>
                            </tr>
          ';
          while($row = mysqli_fetch_array($result))
          {
            $appno = $row["applicant_no"];
            $name = $row["name"];
            $date = $row["date_exam"];
            $score = $row["score"];
            $status = $row["status"];
           $output .= '
                            <tr>                           
                                  <td>'.$date.'</td>
                                 <td>'.$appno.'</td>  
                                 <td>'.$name.'</td>  
                                 <td>'.$score.'</td>
                                 <td>'.$status.'</td>
                            </tr>
           ';
          }
          $output .= '</table>';
          header('Content-Type: application/xls');
          header('Content-Disposition: attachment; filename=applicant_status'.$datetime.'.xls');
          echo $output;
         }
         else{
          header("location:../../user/admin/shs_applicant_status");
         }
    }
    else{
      $query = "SELECT * FROM `sh_exam_score` WHERE date_exam = '$date' ORDER BY applicant_no";
         $result = mysqli_query($connection, $query);
         if(mysqli_num_rows($result) > 0)
         {
          $output .= '
          <center>
          <h2> Senior High Applicant Status Todays Report </h2>
          </center>
          <center>
          <h4>'.$date_today.'</h4>
          </center>
           <table class="table" border="1">  
                            <tr> 
                                <th>Date </th>
                                <th>Applicant Number</th> 
                                 <th>Name</th>  
                                 <th>Score</th>
                                 <th>Status</th>
                            </tr>
          ';
          while($row = mysqli_fetch_array($result))
          {
            $appno = $row["applicant_no"];
            $name = $row["name"];
            $date = $row["date_exam"];
            $score = $row["score"];
            $status = $row["status"];
           $output .= '
                            <tr>                           
                                  <td>'.$date.'</td>
                                 <td>'.$appno.'</td>  
                                 <td>'.$name.'</td>  
                                 <td>'.$score.'</td>
                                 <td>'.$status.'</td>
                            </tr>
           ';
          }
          $output .= '</table>';
          header('Content-Type: application/xls');
          header('Content-Disposition: attachment; filename=applicant_status'.$datetime.'.xls');
          echo $output;
         }
         else{
          header("location:../../user/admin/shs_applicant_status");
         }
    }
  }
  // REPORT BY DATE TO DATE
  if($report_by == "Date"){
    $start_date = mysqli_real_escape_string($connection,$_POST["start_date"]);
    $start_date = strtotime($start_date);
    $start_date = date('m/d/Y',$start_date);
    $end_date = mysqli_real_escape_string($connection,$_POST["end_date"]);
    $end_date = strtotime($end_date);
    $end_date = date('m/d/Y',$end_date);
    if($status_report != "All"){
          $query = "SELECT * FROM `sh_exam_score` WHERE status = '$status_report' AND date_exam BETWEEN '$start_date' AND '$end_date'";
         $result = mysqli_query($connection, $query);
         if(mysqli_num_rows($result) > 0)
         {
          $output .= '
          <center>
          <h2> Senior High Applicant Status Date to date Report </h2>
          </center>
          <center>
          <h4>'.$start_date.' TO '.$end_date.'</h4>
          </center>
           <table class="table" border="1">  
                            <tr> 
                                <th>Date </th>
                                <th>Applicant Number</th> 
                                 <th>Name</th>  
                                 <th>Score</th>
                                 <th>Status</th>
                            </tr>
          ';
          while($row = mysqli_fetch_array($result))
          {
            $appno = $row["applicant_no"];
            $name = $row["name"];
            $date = $row["date_exam"];
            $score = $row["score"];
            $status = $row["status"];
           $output .= '
                            <tr>                           
                                  <td>'.$date.'</td>
                                 <td>'.$appno.'</td>  
                                 <td>'.$name.'</td>  
                                 <td>'.$score.'</td>
                                 <td>'.$status.'</td>
                            </tr>
           ';
          }
          $output .= '</table>';
          header('Content-Type: application/xls');
          header('Content-Disposition: attachment; filename=applicant_status'.$datetime.'.xls');
          echo $output;
         }
         else{
          header("location:../../user/admin/shs_applicant_status");
         }
    }
    else{
      $query = "SELECT * FROM `sh_exam_score`  WHERE date_exam BETWEEN '$start_date' AND '$end_date' ORDER BY applicant_no";
         $result = mysqli_query($connection, $query);
         if(mysqli_num_rows($result) > 0)
         {
          $output .= '
          <center>
          <h2> Senior High Applicant Status Date to date Report </h2>
          </center>
          <center>
          <h4>'.$start_date.' TO '.$end_date.'</h4>
          </center>
           <table class="table" border="1">  
                            <tr> 
                                <th>Date </th>
                                <th>Applicant Number</th> 
                                 <th>Name</th>  
                                 <th>Score</th>
                                 <th>Status</th>
                            </tr>
          ';
          while($row = mysqli_fetch_array($result))
          {
            $appno = $row["applicant_no"];
            $name = $row["name"];
            $date = $row["date_exam"];
            $score = $row["score"];
            $status = $row["status"];
           $output .= '
                            <tr>                           
                                  <td>'.$date.'</td>
                                 <td>'.$appno.'</td>  
                                 <td>'.$name.'</td>  
                                 <td>'.$score.'</td>
                                 <td>'.$status.'</td>
                            </tr>
           ';
          }
          $output .= '</table>';
          header('Content-Type: application/xls');
          header('Content-Disposition: attachment; filename=applicant_status'.$datetime.'.xls');
          echo $output;
         }
         else{
          header("location:../../user/admin/shs_applicant_status");
         }
    }
  }
}
?>