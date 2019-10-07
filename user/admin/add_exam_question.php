  <?php
include "../../include/connection.php";
session_start();
//remove quiz
if($_GET['q']== 'rmquiz') {
  $eid=$_GET['eid'];
  $result = mysqli_query($connection,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
  while($row = mysqli_fetch_array($result)) {
    $qid = $row['qid'];
  $r1 = mysqli_query($connection,"DELETE FROM options WHERE qid='$qid'") or die('Error');
  $r2 = mysqli_query($connection,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
  }
  $r3 = mysqli_query($connection,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
  $r4 = mysqli_query($connection,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
  $r4 = mysqli_query($connection,"DELETE FROM history WHERE eid='$eid' ") or die('Error');
  echo "<script language='javascript'>
        alert('Remove Successfully');
        </script>";
  header("location:manage_exam");
}
//add quiz
if(@$_GET['q']== 'addquiz') {
  $validator = $_POST["opt_exam"];
  $name = $_POST['name'];
  $name= ucwords(strtolower($name));
  $total = $_POST['total'];
  $exam_set = $_POST["exam_set"];
  // $sahi = $_POST['right'];
  // $wrong = $_POST['wrong'];
  // $time = $_POST['time'];
  // $tag = $_POST['tag'];
  // $desc = $_POST['desc'];
  $id=uniqid();
  $q3=mysqli_query($connection,"INSERT INTO `quiz`(`eid`, `title`, `exam_set`, `sahi`, `wrong`, `total`, `duration`, `intro`, `tag`, `date_create`) VALUES  ('$id','$name','$exam_set','1' , '0','$total','10' ,'#','#', NOW())");
  if($validator == "Image"){
    header("location:add_exam.php?q=4&step=2&eid=$id&n=$total");
  }
  if($validator == "Text"){
    header("location:add_exam2.php?q=4&step=2&eid=$id&n=$total");
  }
  }

  //add question
    if(@$_GET['q']== 'addqns') {
    $n=@$_GET['n'];
    $eid=@$_GET['eid'];
    $ch=@$_GET['ch'];

    for($i=1;$i<=$n;$i++)
     {
     $qid=uniqid();
      $qns_img = mysqli_real_escape_string($connection,$_POST[$i.'qns_img']);
    
    $oaid=uniqid();
    $obid=uniqid();
    $ocid=uniqid();
    $odid=uniqid();
    $opt_img1 = mysqli_real_escape_string($connection,$_POST[$i.'opt_img1']);
    $opt_img2 = mysqli_real_escape_string($connection,$_POST[$i.'opt_img2']); 
    $opt_img3 = mysqli_real_escape_string($connection,$_POST[$i.'opt_img3']); 
    $opt_img4 = mysqli_real_escape_string($connection,$_POST[$i.'opt_img4']);  
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
  }
  if(isset($_POST["add_exam_btn"])){
    $fileqns = $_FILES[$i.'qns_img'];
    $fileNameqns = $_FILES[$i."qns_img"]["name"];
    $fileTmpNameqns = $_FILES[$i."qns_img"]["tmp_name"];
    $fileSizeqns = $_FILES[$i."qns_img"]["size"];
    $fileErrorqns = $_FILES[$i."qns_img"]["error"];
    $fileTypeqns = $_FILES[$i."qns_img"]["type"];

    $file = $_FILES[$i.'opt_img1'];
    $fileName = $_FILES[$i."opt_img1"]["name"];
    $fileTmpName = $_FILES[$i."opt_img1"]["tmp_name"];
    $fileSize = $_FILES[$i."opt_img1"]["size"];
    $fileError = $_FILES[$i."opt_img1"]["error"];
    $fileType = $_FILES[$i."opt_img1"]["type"];

    $file1 = $_FILES[$i.'opt_img2'];
    $fileName1 = $_FILES[$i."opt_img2"]["name"];
    $fileTmpName1 = $_FILES[$i."opt_img2"]["tmp_name"];
    $fileSize1 = $_FILES[$i."opt_img2"]["size"];
    $fileError1 = $_FILES[$i."opt_img2"]["error"];
    $fileType1 = $_FILES[$i."opt_img2"]["type"];

    $file2 = $_FILES[$i.'opt_img3'];
    $fileName2 = $_FILES[$i."opt_img3"]["name"];
    $fileTmpName2 = $_FILES[$i."opt_img3"]["tmp_name"];
    $fileSize2 = $_FILES[$i."opt_img3"]["size"];
    $fileError2 = $_FILES[$i."opt_img3"]["error"];
    $fileType2 = $_FILES[$i."opt_img3"]["type"];

    $file3 = $_FILES[$i.'opt_img4'];
    $fileName3 = $_FILES[$i."opt_img4"]["name"];
    $fileTmpName3 = $_FILES[$i."opt_img4"]["tmp_name"];
    $fileSize3 = $_FILES[$i."opt_img4"]["size"];
    $fileError3 = $_FILES[$i."opt_img4"]["error"];
    $fileType3 = $_FILES[$i."opt_img4"]["type"];

    $fileExtqns = explode('.', $fileNameqns);
    $fileActualExtqns = strtolower(end($fileExtqns));

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $fileExt1 = explode('.', $fileName1);
    $fileActualExt1 = strtolower(end($fileExt1));

    $fileExt2 = explode('.', $fileName2);
    $fileActualExt2 = strtolower(end($fileExt2));

    $fileExt3 = explode('.', $fileName3);
    $fileActualExt3 = strtolower(end($fileExt3));

    $allowed = array('jpg','jpeg','png');
    $allowed1 = array('jpg','jpeg','png');
    $allowed2 = array('jpg','jpeg','png');
    $allowed3 = array('jpg','jpeg','png');
    $allowed4 = array('jpg','jpeg','png');
        if(in_array($fileActualExt, $allowed) || in_array($fileActualExt1, $allowed1) || in_array($fileActualExt2, $allowed2) || in_array($fileActualExt3, $allowed3) || in_array($fileActualExtqns, $allowed4)){
        if($fileError === 0 || $fileError1 === 0 || $fileError2 === 0 || $fileError3 === 0 || $fileErrorqns === 0){
          if($fileSize < 1000000 || $fileSize1 < 1000000 || $fileSize2 < 1000000 || $fileSize3 < 1000000 || $fileSizeqns < 1000000){
            $fileNameNew = uniqid('', true).".".$fileActualExt;
            $fileDestionation = "../../plugin/exam_image/".$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestionation);

            $fileNameNew1 = uniqid('', true).".".$fileActualExt1;
            $fileDestionation1 = "../../plugin/exam_image/".$fileNameNew1;
            move_uploaded_file($fileTmpName1, $fileDestionation1);

            $fileNameNew2 = uniqid('', true).".".$fileActualExt2;
            $fileDestionation2 = "../../plugin/exam_image/".$fileNameNew2;
            move_uploaded_file($fileTmpName2, $fileDestionation2);

            $fileNameNew3 = uniqid('', true).".".$fileActualExt3;
            $fileDestionation3 = "../../plugin/exam_image/".$fileNameNew3;
            move_uploaded_file($fileTmpName3, $fileDestionation3);

            $fileNameNewqns = uniqid('', true).".".$fileActualExtqns;
            $fileDestionationqns = "../../plugin/exam_image/".$fileNameNewqns;
            move_uploaded_file($fileTmpNameqns, $fileDestionationqns);
            $q3=mysqli_query($connection,"INSERT INTO questions VALUES  ('$eid','$qid','$fileNameNewqns','' , '$ch' , '$i')");
            $qa=mysqli_query($connection,"INSERT INTO options VALUES  ('$qid','$fileNameNew','','$oaid')") or die('Error61');
            $qb=mysqli_query($connection,"INSERT INTO options VALUES  ('$qid','$fileNameNew1','','$obid')") or die('Error62');
            $qc=mysqli_query($connection,"INSERT INTO options VALUES  ('$qid','$fileNameNew2','','$ocid')") or die('Error63');
            $qd=mysqli_query($connection,"INSERT INTO options VALUES  ('$qid','$fileNameNew3','','$odid')") or die('Error64');
            $qans=mysqli_query($connection,"INSERT INTO answer VALUES  ('$qid','$ansid')");
          }
        }
      
        else{
           echo "<script language='javascript'>
          alert('Ther was an error uploading your image!');
          </script>";
        }
      }
    }
  }
  // echo "<script language='javascript'>
  //       alert('Successfully Added');
  //       </script>";
  header("location:manage_exam");
}
?>