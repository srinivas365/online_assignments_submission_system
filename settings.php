<?php
// Initialize the session
require 'session_start.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "company";
$profile_name=$_SESSION["username"];
$pic_location="bandmember.jpg";
$showDivFlag=false;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql="SELECT * FROM user_details WHERE email_id='$profile_name'";

$result = $conn->query($sql);

$email_id='';
$username='';
$semester='';
$college='';
$course='';
$pic_location='';
if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    $email_id=$row["email_id"];
    $username=$row["username"];
    $semester=$row["semester"];
	$college=$row["college"];
	$course=$row["course"];
	$pic_location=$row["pic_location"];
} else {
    echo "0 results";
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<style type="text/css">
  		.navbar{
  			margin-bottom: 20px;
  			border-radius: 0;
  		}
  		.footer {
    		position: fixed;
    		left: 0;
    		bottom: 0;
    		width: 100%;
    		background-color: black;
    		color: white;
    		text-align: center;
    		padding-top: 10px;
    		
		}
  	</style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
			<a href="login.php" class="navbar-brand">Assignmentor</a>			
		</div>
		<ul class="nav navbar-nav">
			<li><a href="login.php">Home</a></li>
			<li class="active"><a href="profile.php">My profile</a></li>	
			<li><a href="folder_view.php">view directory</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
      		<li><a href="settings.php"><span class="glyphicon glyphicon-settings"></span> Settings</a></li>
      		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    	</ul>		
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="thumbnail" style="padding:20px">
					<div id="uploaded_image"><img src="<?php echo $pic_location; ?>" style="width:200px;height: 200px;"></div><br>
   					<input type="file" name="file" id="file" />
   					<br />
				</div>		
			</div>
			
			<div class="col-sm-6">
			<h4><?php echo $email_id;?> profile</h4><hr>
			<form method="post" id="upload_form" enctype="multipart/form-data">
				<div class="form-group">
					<label for="username">username</label>
					<input type="text" name="username" class="form-control" id="username" value="<?php echo $username;?>">
				</div>
				<div class="form-group">
					<label for="semester">semester</label>
					<input type="text" name="semester" class="form-control" id="semester" value="<?php echo $semester;?>">
				</div>
				<div class="form-group">
					<label for="course">Course</label>
					<input type="text" name="course" class="form-control" id="course" value="<?php echo $course;?>">
				</div>
				<div class="form-group">
					<label for="college">college</label>
					<input type="text" name="college" class="form-control" id="college" value="<?php echo $college;?>">
				</div>
				<div class="form-group"><input class="btn btn-success" name="submit" type="submit" value="save changes"> </div>
			</form>				
			</div>
			<div class="col-sm-3">
				
			</div>
		</div>
	</div>
	<div class="footer">
  		<p> Copyright 1999-2018 by Refsnes Data. All Rights Reserved.
		Powered by assignmentor.in</p>
	</div>
</body>

<script type="text/javascript">
$(document).ready(function(){
	$(document).on('change', '#file', function(){
		var name = document.getElementById("file").files[0].name;
		var form_data = new FormData();
		var ext = name.split('.').pop().toLowerCase();
		if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
		{
			alert("Invalid Image File");
		}
		var oFReader = new FileReader();
		oFReader.readAsDataURL(document.getElementById("file").files[0]);
		var f = document.getElementById("file").files[0];
		var fsize = f.size||f.fileSize;
		if(fsize > 2000000)
		{
			alert("Image File Size is very big");
		}
		else
		{
			form_data.append("file", document.getElementById('file').files[0]);
			$.ajax({
				url:"upload2.php",
				method:"POST",
				data:form_data,
				contentType: false,
				cache: false,
				processData: false,
				beforeSend:function(){
				 $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
				},   
				success:function(data)
				{
				 $('#uploaded_image').html(data);
				}
			});
		}
	});


$('#upload_form').on('submit',function() {
        // body...
        var username=$("#username").val();
        var course=$("#course").val();
        var college=$("#college").val();
        var semester=$("#semester").val();
        var action="settings";

        $.ajax({
            url:"action.php",
            method:"POST",
            data:{action:action,username:username,course:course,college:college,semester:semester},
            success:function(data) {
                // body...
                if(data=="true"){
                	alert("succesfully updated");
                }
            }
        });
    });

});
</script>
</html>