<?php
  include "include/login_controller.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="plugin/design/logo.png">
    <link rel="stylesheet" type="text/css" href="plugin/css/style.css">
    <title>Data Privacy Policy - Lyceum of the Philippines Univesity Cavite Campus</title>
  </head>
 <!--  <style type="text/css">
    .back-background{
       background-image: url("plugin/design/background.jpg");
    }
  </style> -->
  <body>
    <?php
      $nav = "application";
      include "navbar.php";
    ?>
    <!-- LOGIN Modal-->
     <?php
      include "login.php";
     ?>
  <!-- Entrance Modal-->
    <?php
      include "examModal.php";
    ?>
    <div class="back-background">
      <div class="data-holder" style="overflow-y: scroll;">
        <div style="width: 100%;height: 40px; background:  #A62D38; color: #fff;">
          <h4 style="margin-left: 20px;">*Data Privacy Policy</h4>
        </div>
        <div class="data-body" style="margin: 10px auto; height: 100%;">
          <p style="margin-left: 10px;">In August 2012, Congress enacted Rebulic Act No. 10173 known as the "Data Privacy Act of 2012"("DPA"). After four years,
          the National Privacy Commission("NPC") issued the Implementing Rules and Regulations(IRR) of the DPA which provides guidelines on the implementation of the law.</p>

          <p style="margin-left: 10px;">In accordance with the DPA and its IRR, the Lyceum of the Philippines University("LPU") will collect, store and continue to process your child's/your personal information, sensitive personal information and privileged information, as defined below (collectively, "Personal Data") in the course of your child's/your entrance examination/admission/studies in LPU.</p>

          <p style="margin-left: 20px;">• <b>Personal information</b> refers to any information, whether recorded in material form or not, that will directly ascertain the identify of an individual. This includes an individual's address and contact information.</p>

          <p style="margin-left: 20px;">• <b>Sensitive personal information</b> is personal information that includes an individual's age, date of birth, marital status, social security and other government indentification numbers, policy information, grades/educatiom, health/medical and financial information.</p>

          <p style="margin-left: 20px;">• <b> Privileged Information</b> is any and all forms of information which, under the Rules of Court and other pertinent laws, constitute privileged communication, such as, but not limited to, information which a person authorized to practice medicine, surgery or obstetrics may have acquired in attending to a patient in a professional capacity.</p>

           <p style="margin-left: 10px;"> By continuing your child's/your entrance examination/admission studies in LPU, you as the parent of a minor student, or as a student of age:</p>

           <p style="margin-left: 20px;">• explicitly authorize LPU, its employees, duly authorized representatives, related companies and third-party service providers, to collect, use, process, store and share your Personal Data needed in the legitimate educational and related services offered and given by LPU:</p>

           <p style="margin-left: 20px;">• consent to LPU using your contact details, demographic information and other details to contact you with news, marketing or promotional information regarding LPU and studies/surveys to be conducted by LPU via phone calls, mail, email, SMS or any type of electronic facility;</p>

           <p style="margin-left: 20px;">• consent to LPU using your Personal Data for purposes of providing services to you or for other reasonable purposes which are related to the services it provides or improvements/upgrades in its systems and education/business processes, such as, but not limited to, data analytics and automated processing;</p>

           <p style="margin-left: 20px;">• allow LPU to make your Personal Data available to its affiliates and related companies for the same purposes as described above; and</p>

           <p style="margin-left: 20px;">• acknowledge and agree to LPU retaining your Personal Data in LPU;s records throughout your stay in LPU and for a period of five(5) years thereafter unless retention for a longer period is required by law or for reasonable cause. (for those who took the examination and enrolled)</p>

           <p style="margin-left: 20px;">• acknowledge abd agree to LPU retaining your Personal Data in LPU's record for a period of one (1) year after the application for admission/ entrance examination. (for those who took the examination only and did not enrolled)</p>

           <p style="margin-left: 10px;"> Please be informed that under the DPA and its IRR, you are entitled to certain rights such as, but not limited to, the right to be informed of nad to object to the processing of your Personal Data and the right to access and rectify your Personal Data.</p>

           <p style="margin-left: 10px;"> This authorization and consenct once signed will continue to have effect throughout the duration of your child's/your entrance examination/admission/studies in LPU and/or until expiration of the retention limit set by laws and regulations from completion of entrance examination/admission/studies, and the period set until destruction or disposal of recrods, unless withdrawn in writing or withheld due to changes in the information supplied by LPU.</p>
        </div>
      </div>
      <center>
        <div style="margin-top: 10px;">
          <input type="checkbox" id="chckbox">  I agree to the terms and conditions stated above
        </div>
        <a href="index">
          <button type="button" class="btn" style="margin-top: 20px; margin-bottom: 20px; border:1px solid grey;">Cancel</button>
        </a>
        <?php 
          if($_GET["option"] == "college"){ ?>
            <a href="college_application">
         <?php }?>
         <?php if($_GET["option"] == "sh"){ ?>
            <a href="sh_application">
         <?php }?>
          <input type="submit" name="submit_btn" id="submit_btn" class="btn btn-danger" value="Continue">
          </a>
      </center>
    </div>
    <!-- <div class="footer">
      <center>
        <footer>
          <p style="color: #fff;"> &copy;<?php echo date('Y')."-".date('Y', strtotime('+1 year'));?> Enigma. All Right Reserved.</p>
        </footer>     
      </center>
     </div> -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
          $("#submit_btn").attr("disabled","disabled");
          $("#chckbox").click(function(){
            if ($("#chckbox").is(":checked")) {
              $("#submit_btn").removeAttr("disabled");
            } else {
              $("#submit_btn").attr("disabled","disabled");
            }
          });
        });
      </script>
  </body>
</html> 