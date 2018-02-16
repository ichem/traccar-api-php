<?php

  class traccar {

  public static $host='http://127.0.0.1:8082';

  private static $adminEmail='admin';

  private static $adminPassword='admin';

  public static $cookie;

  private static $jsonA='Accept: application/json';

  private static $jsonC='Content-Type: application/json';

  private static $urlencoded='Content-Type: application/x-www-form-urlencoded';

    
  public static function loginAdmin() {

  return self::login(self::$adminEmail,self::$adminPassword);
  }

  public static function login($email,$password) {

  $data='email='.$email.'&password='.$password;

  return self::curl('/api/session','POST','',$data,array(self::$urlencoded));
  }

  public static function checkLogin($cookie) {

  return self::curl('/api/session?'.$data,'GET',$cookie ,'',array());
  }

  public static function logout($cookie) {

  return self::curl('/api/session','DELETE',$cookie ,'',array(self::$urlencoded));
  }



public static function curl($task,$method,$cookie,$data,$header) {

  $res=new stdClass();

  $res->responseCode='';

  $res->error='';

  $header[]="Cookie: ".$cookie;

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, self::$host.$task);

  curl_setopt($ch, CURLOPT_TIMEOUT, 30);

  curl_setopt($ch, CURLOPT_HEADER, 1);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

  if($method=='POST' || $method=='PUT' || $method=='DELETE') {

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  }

  curl_setopt($ch, CURLOPT_HTTPHEADER,$header);

  $data=curl_exec($ch);

  $size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

  if (preg_match('/^Set-Cookie:\s*([^;]*)/mi', substr($data, 0, $size), $c) == 1) self::$cookie = $c[1];

    $res->response = substr($data, $size);

  if(!curl_errno($ch)) {

    $res->responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  }
  else {

    $res->responseCode=400;

    $res->error= curl_error($ch);
  }

  curl_close($ch);

  return $res;
  }
}

?>
