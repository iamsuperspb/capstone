<?php
	session_start();
?>
<div id="timer">

</div>
<script type="text/javascript">
var x = setInterval(fun1,1000);
 setTimeout('xx()',60000);
 function fun1(){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET","timer.php",false);
  xmlhttp.send(null);
  var str = document.getElementById("timer").innerHTML=xmlhttp.responseText;
  /*if(str.slice(7,9) == "58"){
   window.location.href='login.php';
  }*/

 }
 function xx(){
   clearInterval(x);
   window.location.href='cl_account.php?q=1';
   // alert("time up");
  }
  

</script>