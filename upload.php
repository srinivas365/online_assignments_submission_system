<?php

// Initialize the session
require 'session_start.php';


if ($_FILES["upload_file"]["name"]!="") {
	# code...
	$new_file_name=$_FILES["upload_file"]["name"];
	$path='./uploads/'.$_SESSION["user_id"]."/".$_POST["hidden_folder_name"].'/'.$new_file_name;
	$upload_dir='./uploads/'.$_SESSION["user_id"]."/".$_POST["hidden_folder_name"];
	if (is_dir($upload_dir) && is_writable($upload_dir)) {
    // do upload logic here
	} else {
    echo 'Upload directory is not writable, or does not exist.';
	}


	if(move_uploaded_file($_FILES["upload_file"]["tmp_name"],$path)){
		echo "File Uploaded";
	}
	else
	{
		echo "There is some error";
	}

}
else{
	echo "Please select the image";
}
?>