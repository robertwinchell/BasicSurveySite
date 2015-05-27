<?php

$str = file_get_contents('question/question.json');
$json_quiz = json_decode($str, true);
// echo '<pre>' . print_r($json_quiz, true) . '</pre>';
// $title = $json_quiz->result->title;
// $questions = $json_quiz->result->questions;
$answers = array();
if(isset($_POST['monthlyTransSummaryYN_1'])){
	$answers[]=$_POST['monthlyTransSummaryYN_1'];
}

if(isset($_POST['monthlyTransSummaryYN_2'])){
	$answers[]=$_POST['monthlyTransSummaryYN_2'];
}

if(isset($_POST['monthlyTransSummaryYN_3'])){
	$answers[]=$_POST['monthlyTransSummaryYN_3'];
}
$json_quiz = $json_quiz['result'];
$json_quiz = $json_quiz['questions'];
$status = array();
$passScore = 70;
for($i=0;$i<3;$i++){
	$correctAnswer = $json_quiz[$i]['answer'][0];
	$sum=0;
	foreach ($answers[$i] as $answer) {
		$sum += $correctAnswer[$answer];
	}
	if($sum >= $passScore){
		$status[] = array('Status' => 'Passed');
	}
	else{
		$status[] = array('Status' => 'Failed');	
	}
}
$fp = fopen('question/results.json', 'w');
fwrite($fp, json_encode($status));
fclose($fp);
// echo "ok";
//if "email" variable is filled out, send email
 if (isset($_REQUEST['email'])){
 	$email = $_REQUEST['email'];
}

 //Email information
  mail($email);
header("Location: index.html")
?>