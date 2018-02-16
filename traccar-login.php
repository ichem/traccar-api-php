<?php
include('api.php');

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

$login=traccar::login($username,$password);

if($login->responseCode=='200') {
  
	$traccarCookie = traccar::$cookie;
	$traccarPHPSESSIONID = $traccarCookie;
  
  $response = $login->response;
	$userArray = json_decode($response,true);
	$traccarUserid = $userArray['id'];
	  
	echo $apiResponse = 'ok';
  echo $response = $login->response;
	echo $responseCode = $login->responseCode;
		
}else{
  
	echo $apiResponse = 'error';
  echo $response = $login->response;
	echo $responseCode = $login->responseCode;
		
}



?>
