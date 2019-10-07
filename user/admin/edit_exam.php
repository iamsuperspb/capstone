<?php
  include "../../include/connection.php";
  include "../../include/login_controller.php";
  $session_username = $_SESSION['username'];
  $session_usertype = $_SESSION['usertype'];
  if(empty($_SESSION['username'])){
    header("location:../../index");
  }
  if($session_usertype != "admin"){
    header("location:../../forbidden");
  }
?>
<?php
 $eid = $_REQUEST["eid"];
 $n = $_REQUEST["n"];
 $subj_name = mysqli_query($connection,"SELECT * FROM quiz WHERE eid ='$eid'");
 $fetch_sub = mysqli_fetch_array($subj_name);
 $subj = $fetch_sub["title"];
 $set = $fetch_sub["exam_set"];
 $query_validate = mysqli_query($connection,"SELECT COUNT(*) as total FROM questions WHERE eid = '$eid'");
 $validate_row = mysqli_fetch_array($query_validate);
 $total = $validate_row["total"] + 1; 
 // COUNT
 $validate_question = mysqli_query($connection,"SELECT * FROM questions where eid = '$eid'");
 $row_question = mysqli_num_rows($validate_question); 
 $count = mysqli_query($connection,"SELECT COUNT(*) as num FROM questions WHERE eid ='$eid'");
 $row_count = mysqli_fetch_array($count);
  $num = $row_count["num"] + 1;
?>
<?php
  if(isset($_POST["add_btn"])){
    if($total <= $n){
    $qtype = mysqli_real_escape_string($connection,$_POST["qtype"]);
      if($qtype == "Text"){
        $qid = uniqid();
        $oaid=uniqid();
        $obid=uniqid();
        $ocid=uniqid();
        $odid=uniqid();
        $question = mysqli_real_escape_string($connection,$_POST["question"]);
        $opt1 = mysqli_real_escape_string($connection,$_POST["opt_a"]);
        $opt2 = mysqli_real_escape_string($connection,$_POST["opt_b"]);
        $opt3 = mysqli_real_escape_string($connection,$_POST["opt_c"]);
        $opt4 = mysqli_real_escape_string($connection,$_POST["opt_d"]);
        mysqli_query($connection,"INSERT INTO `questions`(`eid`, `qid`, `image`, `qns`, `choice`, `sn`) VALUES  ('$eid','$qid','','$question' , '4' , '$num')");
        mysqli_query($connection,"INSERT INTO `options`(`qid`, `image`, `option`, `optionid`, `option_edit`) VALUES ('$qid','','$opt1','$oaid','a')") or die('Error61');
        mysqli_query($connection,"INSERT INTO `options`(`qid`, `image`, `option`, `optionid`, `option_edit`) VALUES ('$qid','','$opt2','$obid','b')") or die('Error62');
        mysqli_query($connection,"INSERT INTO `options`(`qid`, `image`, `option`, `optionid`, `option_edit`) VALUES ('$qid','','$opt3','$ocid','c')") or die('Error63');
        mysqli_query($connection,"INSERT INTO `options`(`qid`, `image`, `option`, `optionid`, `option_edit`) VALUES ('$qid','','$opt4','$odid','d')") or die('Error64');
        $canswer = mysqli_real_escape_string($connection,$_POST["canswer"]);
        switch($canswer)
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
        mysqli_query($connection,"INSERT INTO `answer`(`qid`, `ansid`) VALUES ('$qid','$ansid')");
        $msg = '<div class="alert alert-success" role="alert">
              Question Successfully added!
            </div>';
      }
      if($qtype == "Image"){
        $qid = uniqid();
        $oaid=uniqid();
        $obid=uniqid();
        $ocid=uniqid();
        $odid=uniqid();
        // $question_image = mysqli_real_escape_string($connection,$_POST["question_image"]);
        // $opt1_image = mysqli_real_escape_string($connection,$_POST["opt_a_image"]);
        // $opt2_image = mysqli_real_escape_string($connection,$_POST["opt_b_image"]);
        // $opt3_image = mysqli_real_escape_string($connection,$_POST["opt_c_image"]);
        // $opt4_image = mysqli_real_escape_string($connection,$_POST["opt_d_image"]);
        $canswer = mysqli_real_escape_string($connection,$_POST["canswer"]);
        switch($canswer)
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
      $fileqns = $_FILES['question_image'];
      $fileNameqns = $_FILES["question_image"]["name"];
      $fileTmpNameqns = $_FILES["question_image"]["tmp_name"];
      $fileSizeqns = $_FILES["question_image"]["size"];
      $fileErrorqns = $_FILES["question_image"]["error"];
      $fileTypeqns = $_FILES["question_image"]["type"];

      $file = $_FILES['opt_a_image'];
      $fileName = $_FILES["opt_a_image"]["name"];
      $fileTmpName = $_FILES["opt_a_image"]["tmp_name"];
      $fileSize = $_FILES["opt_a_image"]["size"];
      $fileError = $_FILES["opt_a_image"]["error"];
      $fileType = $_FILES["opt_a_image"]["type"];

      $file1 = $_FILES['opt_b_image'];
      $fileName1 = $_FILES["opt_b_image"]["name"];
      $fileTmpName1 = $_FILES["opt_b_image"]["tmp_name"];
      $fileSize1 = $_FILES["opt_b_image"]["size"];
      $fileError1 = $_FILES["opt_b_image"]["error"];
      $fileType1 = $_FILES["opt_b_image"]["type"];

      $file2 = $_FILES['opt_c_image'];
      $fileName2 = $_FILES["opt_c_image"]["name"];
      $fileTmpName2 = $_FILES["opt_c_image"]["tmp_name"];
      $fileSize2 = $_FILES["opt_c_image"]["size"];
      $fileError2 = $_FILES["opt_c_image"]["error"];
      $fileType2 = $_FILES["opt_c_image"]["type"];

      $file3 = $_FILES['opt_d_image'];
      $fileName3 = $_FILES["opt_d_image"]["name"];
      $fileTmpName3 = $_FILES["opt_d_image"]["tmp_name"];
      $fileSize3 = $_FILES["opt_d_image"]["size"];
      $fileError3 = $_FILES["opt_d_image"]["error"];
      $fileType3 = $_FILES["opt_d_image"]["type"];

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
              mysqli_query($connection,"INSERT INTO `questions`(`eid`, `qid`, `image`, `qns`, `choice`, `sn`) VALUES  ('$eid','$qid','$fileNameNewqns','' , '4' , '$num')");
              mysqli_query($connection,"INSERT INTO `options`(`qid`, `image`, `option`, `optionid`, `option_edit`) VALUES ('$qid','$fileNameNew','','$oaid','a')") or die('Error61');
              mysqli_query($connection,"INSERT INTO `options`(`qid`, `image`, `option`, `optionid`, `option_edit`) VALUES ('$qid','$fileNameNew1','','$obid','b')") or die('Error62');
              mysqli_query($connection,"INSERT INTO `options`(`qid`, `image`, `option`, `optionid`, `option_edit`) VALUES ('$qid','$fileNameNew2','','$ocid','c')") or die('Error63');
              mysqli_query($connection,"INSERT INTO `options`(`qid`, `image`, `option`, `optionid`, `option_edit`) VALUES ('$qid','$fileNameNew3','','$odid','d')") or die('Error64');
              mysqli_query($connection,"INSERT INTO `answer`(`qid`, `ansid`) VALUES ('$qid','$ansid')");
              $msg = '<div class="alert alert-success" role="alert">
                    Question Successfully added!
                  </div>';
            }
          }
          else{
             echo "<script language='javascript'>
            alert('Ther was an error uploading your image!');
            </script>";
          }
        }
         //   
      }
    }
    else{
      $msg = '<div class="alert alert-danger" role="alert">
              No slot for adding another question.
            </div>';
    }
  }
?>
<?php
  if(isset($_POST["edit_btn"])){
    $eid = mysqli_real_escape_string($connection,$_POST["eid"]);
    $qns = mysqli_real_escape_string($connection,$_POST["qns"]);
    $opt_ida = mysqli_real_escape_string($connection,$_POST["opt_ida"]);
    $opt_a = mysqli_real_escape_string($connection,$_POST["opt_a"]);
    $opt_idb = mysqli_real_escape_string($connection,$_POST["opt_idb"]);
    $opt_b = mysqli_real_escape_string($connection,$_POST["opt_b"]);
    $opt_idc = mysqli_real_escape_string($connection,$_POST["opt_idc"]);
    $opt_c = mysqli_real_escape_string($connection,$_POST["opt_c"]);
    $opt_idd = mysqli_real_escape_string($connection,$_POST["opt_idd"]);
    $opt_d = mysqli_real_escape_string($connection,$_POST["opt_d"]);
    mysqli_query($connection,"UPDATE questions SET qns = '$qns' WHERE qid = '$eid'");
    mysqli_query($connection,"UPDATE options SET option = '$opt_a' WHERE optionid = '$opt_ida'");
    mysqli_query($connection,"UPDATE options SET option = '$opt_b' WHERE optionid = '$opt_idb'");
    mysqli_query($connection,"UPDATE options SET option = '$opt_c' WHERE optionid = '$opt_idc'");
    mysqli_query($connection,"UPDATE options SET option = '$opt_d' WHERE optionid = '$opt_idd'");
    $msg = '<div class="alert alert-success" role="alert">
              Question Successfully update!
            </div>';
  }
?>
<?php
  if(isset($_POST["delete_btn"])){
    $id = mysqli_real_escape_string($connection,$_POST["id"]);
    mysqli_query($connection,"DELETE FROM questions WHERE qid = '$id'");
    mysqli_query($connection,"DELETE FROM options WHERE qid='$id'");
    mysqli_query($connection,"DELETE FROM answer WHERE qid='$id' ");
    $msg = '<div class="alert alert-success" role="alert">
              Question Successfully deleted!
            </div>';
  }
?>
<!-- -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" type="text/css" href="../../plugin/css/style.css">
    <!-- CUSTOM ICONS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- LOGO -->
    <link rel="icon" href="../../plugin/design/logo.png">
    <title>Admin | Edit Exam</title>
  </head>
  <body>
   	<?php
      include "top_header.php";
    ?>
    <?php
      $page = "exam";
      include "sidemenu.php"; 
    ?>
    <div class="main-content">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><i class="fa fa-paste"></i> <?php echo $subj;?> Set-<?php echo $set;?></h1>
             <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <a href="#addModal" data-toggle="modal">
                <button type="button" class="btn btn-sm" style="background: #A62D38; color: white; border: 1px solid #772028;"><span data-feather="plus-square"></span> Add</button>
              </a>
            </div>
          </div>
          </div>
      <!-- FOR TEXT -->
      <script>
        function questionType(){
          div = document.getElementById("qarea");
          qtype = document.getElementById("qtype").value;
          if(qtype == "Text"){
            p = document.createElement("p");
            node1 = document.createTextNode("Question:");
            div.appendChild(node1); 
            q = document.createElement("textarea");
            q.setAttribute("type","text");
            q.setAttribute("name","question");
            q.setAttribute("class","form-control");
            q.setAttribute("required","");
            div.appendChild(q);
            p = document.createElement("p");
            node1 = document.createTextNode("Option A:");
            div.appendChild(node1); 
            opt1 = document.createElement("input");
            opt1.setAttribute("type","text");
            opt1.setAttribute("name","opt_a");
            opt1.setAttribute("class","form-control");
            opt1.setAttribute("required","");
            div.appendChild(opt1);
            p = document.createElement("p");
            node1 = document.createTextNode("Option B:");
            div.appendChild(node1); 
            opt2 = document.createElement("input");
            opt2.setAttribute("type","text");
            opt2.setAttribute("name","opt_b");
            opt2.setAttribute("class","form-control");
            opt2.setAttribute("required","");
            div.appendChild(opt2);
            p = document.createElement("p");
            node1 = document.createTextNode("Option C:");
            div.appendChild(node1); 
            opt3 = document.createElement("input");
            opt3.setAttribute("type","text");
            opt3.setAttribute("name","opt_c");
            opt3.setAttribute("class","form-control");
            opt3.setAttribute("required","");
            div.appendChild(opt3);
            p = document.createElement("p");
            node1 = document.createTextNode("Option D:");
            div.appendChild(node1); 
            opt4 = document.createElement("input");
            opt4.setAttribute("type","text");
            opt4.setAttribute("name","opt_d");
            opt4.setAttribute("class","form-control");
            opt4.setAttribute("required","");
            div.appendChild(opt4);
          }
          if(qtype == "Image"){
             p = document.createElement("p");
            node1 = document.createTextNode("Question:");
            div.appendChild(node1); 
            q = document.createElement("input");
            q.setAttribute("type","file");
            q.setAttribute("name","question_image");
            q.setAttribute("class","form-control");
            q.setAttribute("required","");
            div.appendChild(q);
            p = document.createElement("p");
            node1 = document.createTextNode("Option A:");
            div.appendChild(node1); 
            opt1 = document.createElement("input");
            opt1.setAttribute("type","file");
            opt1.setAttribute("name","opt_a_image");
            opt1.setAttribute("class","form-control");
            opt1.setAttribute("required","");
            div.appendChild(opt1);
            p = document.createElement("p");
            node1 = document.createTextNode("Option B:");
            div.appendChild(node1); 
            opt2 = document.createElement("input");
            opt2.setAttribute("type","file");
            opt2.setAttribute("name","opt_b_image");
            opt2.setAttribute("class","form-control");
            opt2.setAttribute("required","");
            div.appendChild(opt2);
            p = document.createElement("p");
            node1 = document.createTextNode("Option C:");
            div.appendChild(node1); 
            opt3 = document.createElement("input");
            opt3.setAttribute("type","file");
            opt3.setAttribute("name","opt_c_image");
            opt3.setAttribute("class","form-control");
            opt3.setAttribute("required","");
            div.appendChild(opt3);
            p = document.createElement("p");
            node1 = document.createTextNode("Option D:");
            div.appendChild(node1); 
            opt4 = document.createElement("input");
            opt4.setAttribute("type","file");
            opt4.setAttribute("name","opt_d_image");
            opt4.setAttribute("class","form-control");
            opt4.setAttribute("required","");
            div.appendChild(opt4);
          }
        }
      </script>
        <!-- ADD MODAL -->
     <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-paste"></i> Add Question</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="fname" class="col-form-label">Question Type:</label>
                          <select name="qtype" id="qtype" class="form-control" required="" onchange="questionType()">
                            <option value="">--SELECT--</option>
                            <option value="Text">Text</option>
                            <option value="Image">Image</option>
                          </select>
                          
                        </div>
                        <div id="qarea"></div>
                        <label for="fname" class="col-form-label">Correct Answer:</label>
                          <select name="canswer" id="canswer" class="form-control" required=""">
                            <option value="">--SELECT--</option>
                            <option value="a">Option A</option>
                            <option value="b">Option B</option>
                            <option value="c">Option C</option>
                            <option value="d">Option D</option>
                          </select>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success" name="add_btn" style=""><i class="fas fa-paste"></i> Add</button>
                      <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Close</button>
                    </div>
                  </div>
                  </form>
                </div>
            </div>
      <?php
        $fetch = mysqli_query($connection,"SELECT * FROM questions WHERE eid = '$eid'");
      ?>
    <!-- ALERT MSG -->
     <div class="alert-holder">
      <p>
        <?php
          if(isset($_POST["add_btn"])){
            echo $msg;
          }
          if(isset($_POST["edit_btn"])){
            echo $msg;
          }
          if(isset($_POST["delete_btn"])){
            echo $msg;
          }
        ?>
      </p>
      <table class="table table-bordered" style="width: 99%;">
        <thead style="background-color: #A62D38; color: white;">
          <tr>
            <th width="90%">Question</th>
            <th>Action</th>
          </tr>
        </thead>
          <tbody>
            <?php while($row = mysqli_fetch_array($fetch)){
              $qns = $row["qns"];
              $img = $row["image"];
              $qid = $row["qid"];
              ?>
            <tr>
              <td>
              <?php 
                if($qns == ""){
                  echo "<img src='../../plugin/exam_image/".$img."'height='100px' width='100px'/>";
                }
                elseif($img == ""){
                  echo $qns;
                }
              ?>
              </td>
              <td>
                <a href="#edit_modal<?php echo $qid;?>" data-toggle="modal">
                  <button name="update_btn" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                </a>
                <a href="#deleteModal<?php echo $qid;?>" data-toggle="modal">
                  <button name="delete_btn" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                </a>
              </td>
            </tr>
             <!-- GET THE OPTION -->
             <?php
              $optiona = mysqli_query($connection,"SELECT * FROM options WHERE qid = '$qid' AND option_edit = 'a'");
              $row_optiona = mysqli_fetch_array($optiona);
              $opt_a = $row_optiona["option"];
              $opt_ida = $row_optiona["optionid"];
              $optionb = mysqli_query($connection,"SELECT * FROM options WHERE qid = '$qid' AND option_edit = 'b'");
              $row_optionb = mysqli_fetch_array($optionb);
              $opt_b = $row_optionb["option"];
              $opt_idb = $row_optionb["optionid"];
              $optionc = mysqli_query($connection,"SELECT * FROM options WHERE qid = '$qid' AND option_edit = 'c'");
              $row_optionc = mysqli_fetch_array($optionc);
              $opt_c = $row_optionc["option"];
              $opt_idc = $row_optionc["optionid"];
              $optiond = mysqli_query($connection,"SELECT * FROM options WHERE qid = '$qid' AND option_edit = 'd'");
              $row_optiond = mysqli_fetch_array($optiond);
              $opt_d = $row_optiond["option"];
              $opt_idd = $row_optiond["optionid"];
             ?>
             <!-- GET THE ANSWER -->
             <?php
              $answer_query = mysqli_query($connection,"SELECT * FROM answer WHERE qid = '$qid'");
              $row_answer = mysqli_fetch_array($answer_query);
              $answer = $row_answer["ansid"];
              $option_answer = mysqli_query($connection,"SELECT * FROM options WHERE qid = '$qid' AND optionid = '$answer'");
              $row_option_asnwer = mysqli_fetch_array($option_answer);
              $answer_option = $row_option_asnwer["option_edit"];
             ?>
             <!-- EDIT MODAL -->
              <div class="modal fade" id="edit_modal<?php echo $qid;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><span data-feather="edit"></span> Edit</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST">
                    <div class="modal-body">
                          <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $qid; ?>">
                        <div class="form-group">
                          <div class="form-group">
                            <input type="hidden" name="eid" value="<?php echo $qid;?>"> 
                          <label for="fname" class="col-form-label">Question:</label>
                          <textarea class="form-control" name="qns"><?php echo $qns;?></textarea>
                        </div>
                        <div class="form-group">
                          <label for="username" class="col-form-label">option A:</label>
                          <input type="hidden" class="form-control" id="opt_ida" name="opt_ida" value="<?php echo $opt_ida;?>">
                          <input type="text" class="form-control" id="opt_a" name="opt_a" value="<?php echo $opt_a;?>">
                        </div>
                        <div class="form-group">
                          <label for="username" class="col-form-label">option B:</label>
                          <input type="hidden" class="form-control" id="opt_idb" name="opt_idb" value="<?php echo $opt_idb;?>">
                          <input type="text" class="form-control" id="opt_b" name="opt_b" value="<?php echo $opt_b;?>">
                        </div>
                        <div class="form-group">
                          <label for="username" class="col-form-label">option C:</label>
                          <input type="hidden" class="form-control" id="opt_idc" name="opt_idc" value="<?php echo $opt_idc;?>">
                          <input type="text" class="form-control" id="opt_c" name="opt_c" value="<?php echo $opt_c;?>">
                        </div>
                        <div class="form-group">
                          <label for="username" class="col-form-label">option D:</label>
                          <input type="hidden" class="form-control" id="opt_idd" name="opt_idd" value="<?php echo $opt_idd;?>">
                          <input type="text" class="form-control" id="opt_d" name="opt_d" value="<?php echo $opt_d;?>">
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success" name="edit_btn"><span data-feather="check"></span> Confirm</button>
                      <button type="button" class="btn btn-dark" data-dismiss="modal"><span data-feather="x"></span> Cancel</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- DELETE MODAL -->
              <div class="modal fade" id="deleteModal<?php echo $qid;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel"><span data-feather="trash-2"></span> Delete</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="POST">
                    <div class="modal-body">
                          <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $qid; ?>">
                          <div class="alert alert-danger">Are you sure you want to delete this question?</div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger" name="delete_btn"><span data-feather="check"></span> Yes</button>
                      <button type="button" class="btn btn-dark" data-dismiss="modal"><span data-feather="x"></span> No</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
          <?php }?>
          </tbody>
        </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- custom icon -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
     <script>
      feather.replace()
    </script>
  </body>
</html>