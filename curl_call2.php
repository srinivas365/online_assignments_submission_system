<?php

/**
* 
*/
class CodeObject
{
	
	public $clientId;
	public $clientSecret;
	public $script;
	public $language;
	public $versionIndex;
	public $stdin;
}

$ch = curl_init();
$client_id="4393cb2b9168a551642e47dc560a2664";
$client_secret="d286e70ae70bc271bc0b2529cad3b95358b62aaeb6a1ac27f4d2359273e8962f";
$language=$_POST["language"];
$versionIndex="0";
$input=$_POST["input"];
$script=$_POST["script"];

$myobj=new CodeObject;
$myobj->clientId=$client_id;
$myobj->clientSecret=$client_secret;
$myobj->script=$script;
$myobj->language=$language;
$myobj->versionIndex=$versionIndex;
$myobj->stdin=$input;

$new_json=json_encode($myobj);

curl_setopt($ch, CURLOPT_URL, "https://api.jdoodle.com/v1/execute");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$new_json);
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Content-Type: application/json; charset=UTF-8";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
echo $result;

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

?>