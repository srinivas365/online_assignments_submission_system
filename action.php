<?php

require 'session_start.php';
require 'defines.php';
$conn=connectTo();
	// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

chdir("./uploads/".$_SESSION["user_id"]);

if ($_POST["action"]=="fetch") {
	# code...
	$folder=array_filter(glob("*"),'is_dir');
	$output='<table class="table table-bordered table-stripped">
	<tr>
		<th>Folder Name</th>
		<th>Total File</th>
		<th>Update</th>
		<th>Delete</th>
		<th>Upload File</th>
		<th>View Uploaded File</th>
		<th>Link this folder</th>
	</tr>	
	';

	if (count($folder)>0) {
		# code...
		foreach ($folder as $name) {
			# code...
			$output.='<tr>
			<td>'.$name.'</td>
			<td>'.(count(scandir($name))-2).'</td>
			<td><button type="button" name="update" data-name="'.$name.'" class="update btn btn-warning btn-xs">Update</button></td>
			<td><button type="button" name="delete" data-name="'.$name.'" class="delete btn btn-danger btn-xs">Delete</button></td>
			<td><button type="button" name="Upload" data-name="'.$name.'" class="upload btn btn-info btn-xs">Upload</button></td>
			
			<td><button type="button" name="view_files" data-name="'.$name.'" class="view_files btn btn-default btn-xs">View Files</button></td>
			<td><button type="button" name="link_folder" data-name="'.$name.'" class="link_folder btn btn-warning btn-xs">link folder</button> 
			<button type="button" name="view_links" data-name="'.$name.'" class="view_links btn btn-warning btn-xs">view links</button></td>
			</tr>
			';
		}


	}else
	{
		# code...
		$output.='
			<tr>
				<td colspan="7">No folder found</td>
			<tr>
		';
	}
	$output.="</table>";

	echo $output;
}



if($_POST["action"]=='create'){
	if(!file_exists($_POST['folder_name']))
	{
		mkdir($_POST['folder_name'],0777,true);
		echo "Folder Created";
	}
	else
	{
		echo "Folder Already Created";
	}

}


if($_POST['action']=='change'){
	if(!file_exists($_POST['folder_name']))
	{
		rename($_POST['old_name'], $_POST['folder_name']);
		echo 'Folder Name changed';
	}
	else
	{
		echo "Folder Already Created";
	}
}

if($_POST["action"]=="link"){
	$ass_name=$_POST["ass_name"];
	$prof_name=$_POST["prof_name"];
	$folder_name=$_POST["folder_name"];
	$stud_name=$_SESSION["user_id"];

	$location="./uploads/".$stud_name."/".$folder_name;

	$sql = "INSERT INTO assignments_submitted(assignment_id,faculty_id,student_id,file_location) VALUES ('$ass_name', '$prof_name','$stud_name', '$location')";

	if ($conn->query($sql) === TRUE) {
	    echo "linked successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
		
}

if($_POST["action"]=="settings"){

	$email_id=$_SESSION["username"];
	$username=$_POST["username"];
	$semester=$_POST["semester"];
	$college=$_POST["college"];
	$course=$_POST["course"];
	$sql="UPDATE user_details SET username='$username',semester='$semester',course='$course',college='$college' WHERE email_id='$email_id'";
	if ($conn->query($sql) === TRUE) {
	    echo "true";
	}else{
		echo "error";
	}
}


?>