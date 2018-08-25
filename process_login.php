<?php session_start();?>
<?php include 'defines.php'; ?>
<?php
foreach ($_POST as $p) {
	# code...
	if(empty($p) || !isset($p)){
		respond("error","empty");
	}
}

$pass=$_POST['password'];
$email = strtolower(sqlReady($_POST['email']));
$con=connectTo();
$exists=$con->query("SELECT * from user_accounts where email='$email'");
if(!($exists && $con->affected_rows)) {
  $con->close();
  respond("error","not_found");
} 
$exists=$exists->fetch_assoc();
if(verifyPass($pass,$exists['password'])){
	$_SESSION["email"]=$exists["email"];
	$_SESSION["student"]=$exists["student"];
	$_SESSION["user_id"]=$exists["user_id"];
	if(!file_exists("uploads/".$_SESSION["user_id"]))
    {
        mkdir("uploads/".$_SESSION["user_id"],0777,true);
    }
	$con->close();
	session_write_close();
	die(json_encode(array("error"=>"none","session"=>$_SESSION)));
} else {
  $con->close();
  respond("error","incorrect");
}
?>