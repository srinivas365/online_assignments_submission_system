<?php
DEFINE('DB_USER','root');
DEFINE('DB_PASS','');
DEFINE('DB_HOST','localhost');
DEFINE('DB_DB','college');

function connectTo(){
	$con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_DB);
  	return $con; 
}

function sqlReady($input) {
/*
 Takes -> Any string
 Returns -> Escapes the string
*/
  $con = connectTo();
  $string = mysqli_real_escape_string($con,$input);
  $con->close();
  return $string; 
}

function hashPass($pass,$rounds = 9) {
/*
 Takes -> Password
 Returns -> Hashes the password using blow-fish algorithm
*/
  $salt = "";
  $i = -1;
  $saltChars = array_merge(range(0,9),range('a','z'),range('A','Z'));
  while(++$i < 22)
    $salt .= $saltChars[array_rand($saltChars)];
  return crypt($pass, sprintf('$2y$%02d$', $rounds) . $salt);
}
function verifyPass($input,$pass) {
/*
 Takes -> 2 Password strings
 Returns -> true if matches false if doesn't
*/
  //return crypt($input,$pass)== $pass? true : false ;
  return $input==$pass?true:false;
}
function respond($as,$what) {
/*
 Takes -> key and value
 Does -> Dies by printing json_encoded array having the key and value
*/
  die(json_encode(array($as=>$what)));
}

?>