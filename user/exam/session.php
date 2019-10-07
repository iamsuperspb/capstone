<?php
$_SESSION["duration"] = $duration;
$_SESSION["start_time"] = date("Y-m-d H:i:s");
$end_time = date('Y-m-d H:i:s', strtotime('+'.$_SESSION["duration"]."minutes",strtotime($_SESSION["start_time"])));

$_SESSION["end_time"] = $end_time;
?>
<script type="text/javascript">
  window.location="cl_account.php?q=quiz&step=2&eid='+ <?php echo $eid;?> +'&n=1&t='+ <?php echo $total;?> +'";
</script>
