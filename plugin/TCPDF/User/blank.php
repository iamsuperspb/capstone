<?php
require_once('tcpdf_include.php');
include "../../../include/connection.php";
$id = $_REQUEST["id"];
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('LPU | Letter');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}


$pdf->SetFont('dejavusans', '', 10);


$pdf->AddPage('P');
// QUERY FOR GETTING STUDENT INFO
$query = mysqli_query($connection,"SELECT * FROM college_exam_score WHERE applicant_no = '$id'");
$row = mysqli_fetch_assoc($query);
$date_exam = $row['date_exam'];
$std_name = $row['name'];
$firstchoice = $row['first_course'];
$secondchoice = $row['second_course'];
$thirdchoice = $row['third_course'];
$status = $row['status'];

$html = '<table border="1">';
$body = '<h3>'.$date_exam.'</h3>';
$space = '';
$name = '<h2>DEAR MR/MS'." ".$std_name."</h2>";
$space1 = '';
$letterbd = '<h3>This is to inform you the result of your College Entrance Test in the following courses:</h3>';
$space2 = '';
$prefer = '<h3><u>Preferred course(s):</u></h3>';
$space3 = '';
$course1 = '<h3>1st Choice'.': '.' '.$firstchoice.' '.'- '.$status.'</h3>';
$course2 = '<h3>2nd Choice'.': '.' '.$secondchoice.' '.'- '.$status.'</h3>';
$course3 = '<h3>3rd Choice'.': '.' '.$thirdchoice.' '.'- '.$status.'</h3>';
$space4 = '';
$please = '<h3>You may enroll in your chosen course provided you have complied with/completed the requirements for the said course.</h3>';
$space5 = '';
$space6 = '';
$space7 = '';
$truly = '<h3>Very truly yours,</h3>';
$space8 = '';
$space9 = '';
$vice = '<h3><b>MARIA TERESA O. PILAPIL</b></h3>';
$vicep = '<h3>Vice President for Administration/Registrar</h3>';
$space10 = '';
$space11 = '';
$space12 = '';
$space13 = '';
$space14 = '';
$back1 = '';
$back2 = '';
$back3 = '';
$back4 = '';
$back5 = '';
$back6 = '';
$back7 = '';
$back8 = '';
$back9 = '';
$back10 = '';
$front1 = '';
$front2 = '';
$front3 = '';
$front4 = '';
$front5 = '';
$front6 = '';
$front7 = '';
$front8 = '';
$front9 = '';

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->writeHTML($body, true, false, true, false, '');
$pdf->writeHTML($space, true, false, true, false, '');	
$pdf->writeHTML($name, true, false, true, false, '');
$pdf->writeHTML($space1, true, false, true, false, '');
$pdf->writeHTML($letterbd, true, false, true, false, '');
$pdf->writeHTML($space2, true, false, true, false, '');
$pdf->writeHTML($prefer, true, false, true, false, '');
$pdf->writeHTML($space3, true, false, true, false, '');				
$pdf->writeHTML($course1, true, false, true, false, '');
$pdf->writeHTML($course2, true, false, true, false, '');
$pdf->writeHTML($course3, true, false, true, false, '');
$pdf->writeHTML($space4, true, false, true, false, '');
$pdf->writeHTML($please, true, false, true, false, '');
$pdf->writeHTML($space5, true, false, true, false, '');
$pdf->writeHTML($space6, true, false, true, false, '');
$pdf->writeHTML($space7, true, false, true, false, '');		
$pdf->writeHTML($truly, true, false, true, false, '');
$pdf->writeHTML($space8, true, false, true, false, '');
$pdf->writeHTML($space9, true, false, true, false, '');
$pdf->writeHTML($vice, true, false, true, false, '');
$pdf->writeHTML($vicep, true, false, true, false, '');
$pdf->writeHTML($space10, true, false, true, false, '');
$pdf->writeHTML($space11, true, false, true, false, '');
$pdf->writeHTML($space12, true, false, true, false, '');
$pdf->writeHTML($space13, true, false, true, false, '');
$pdf->writeHTML($space14, true, false, true, false, '');
$pdf->writeHTML($back1, true, false, true, false, '');
$pdf->writeHTML($back2, true, false, true, false, '');
$pdf->writeHTML($back3, true, false, true, false, '');
$pdf->writeHTML($back4, true, false, true, false, '');
$pdf->writeHTML($back5, true, false, true, false, '');
$pdf->writeHTML($back6, true, false, true, false, '');
$pdf->writeHTML($back7, true, false, true, false, '');
$pdf->writeHTML($back8, true, false, true, false, '');
$pdf->writeHTML($back9, true, false, true, false, '');
$pdf->writeHTML($back10, true, false, true, false, '');
$pdf->writeHTML($front1, true, false, true, false, '');
$pdf->writeHTML($front2, true, false, true, false, '');
$pdf->writeHTML($front3, true, false, true, false, '');
$pdf->writeHTML($front4, true, false, true, false, '');
$pdf->writeHTML($front5, true, false, true, false, '');
$pdf->writeHTML($front6, true, false, true, false, '');
$pdf->writeHTML($front7, true, false, true, false, '');
$pdf->writeHTML($front8, true, false, true, false, '');
$pdf->writeHTML($front9, true, false, true, false, '');
	
$pdf->lastPage();

$pdf->Output($std_name.'_'.'letter.pdf', 'I');

