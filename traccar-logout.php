<?php
include('traccar-api.php');

$traccarCookie = $_REQUEST['traccarcookie'];

$logout=traccar::logout($traccarCookie);

if($logout->responseCode=='204') {

  echo $apiResponse = 'ok';
	echo $response = $logout->response;
	echo $responseCode = $logout->responseCode;

}else{

  echo $apiResponse = 'ok';
	echo $response = $logout->response;
	echo $responseCode = $logout->responseCode;
	
}

?>
