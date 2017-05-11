<?php
$garbage = array('referrer', 'emailto', 'Submit');
$Subject = "Internet PPC Campaign Customer LEAD";
$path  = $_POST['referrer'];
$EmailTo = $_POST['emailto'];
$ref = explode('/', $_SERVER['HTTP_REFERER']); 
//$EmailFrom = $_POST['emailfrom'];
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: " . $_POST['emailfrom'] . "\n" . "Return-Path: " . $_POST['emailfrom'] . "\n" . "Reply-To: " . $_POST['emailfrom'] . "\n";

// validation
$validationOK=true;
if ($_POST['emailfrom']=="" ) $validationOK=false;
if( strstr($_POST['emailfrom'], '@' )==FALSE ) $validationOK=false;
if (!$validationOK) {
  echo "Please press the back button on your browser and enter a valid email address.";
  exit;
}

if( strstr($ref['2'], 'aitrk')==FALSE && strstr($ref['2'], 'aiprxadmin')==FALSE && strstr($ref['2'], 'aiprx')==FALSE && strstr($ref['2'], 'calls.net')==FALSE){
	echo "Submissions Not Allowed From External Domains";
    exit;
}

//ini_set("sendmail_from","$_POST['emailfrom']");
foreach($garbage as $key)
	unset($_POST[$key]);

$body = "";
foreach ($_POST as $var => $value) {
$body .= '<b>' . $var  . '</b>' . "= $value<br />";
} 
//echo("$body");


// send email 
$success = mail($EmailTo, $Subject, $body, $headers);

// redirect to success page 
if ($success){
	//$path = substr($path, 0, -1);
	$path = rtrim($path);
  header("Location: $path");
}
else{
 echo("mail not sent please click back and try again");
 
}
?>