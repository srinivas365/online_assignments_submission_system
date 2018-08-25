<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
  header("location: login.php");
  exit;
}

require 'php_test.php';
require 'defines.php';

$obj=new Dbobject("localhost","root","","college");
$user=$obj->grabfromTab("students","student_id",$_SESSION["user_id"],"*");
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
    		color: #5e5e5e;
    		text-align: center;
    		padding-top: 10px;
    		
		}
  	</style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
			<a href="index.php" class="navbar-brand">Assignmentor</a>			
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="login.php">Home</a></li>
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
			<!--<div class="col-sm-3 well">
				<div class="text-center well">
        			<img src=<?php echo $user["pic_location"]?> class="img-circle" height="75" width="75" alt="Avatar" id="profile_pic">
        			<h4 id="profile_name"><?php echo $user["student_id"]?></h4>
        			<h5 id="profile_sem">Semester <?php echo $user["student_name"]?></h5>
        			<h5 id="profile_name"><?php echo $user["branch"]?></h4>
					<h5 id="profile_name"><?php echo $user["stream"]?></h4>					
				</div>			
			</div>-->
			<div class="col-sm-7" style="margin-left: 50px;">
				<h4>your assignments</h4><hr>
				<?php
					// Create connection
					$conn = connectTo();
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} 
					$user_id=$user["student_id"];

					$sql = "SELECT * from new_assignments where course_id IN (select course_id from course_enrollment as ce where student_id='$user_id')";

					$result = $conn->query($sql);
					
					if ($result->num_rows > 0) {
					// output data of each row
						while($row = $result->fetch_assoc()) {
							$ass_name=$row["assignment_id"];
							$prof_name=$row["faculty_id"];
							$course=$row["course_id"];
							$lds=$row["last_date"];
							$opd=$row["description"];
							$location=$row["file_location"];
							$created_time=$row["created_time"];
							echo '
							<div class="row well">
								<div class="col-sm-3 text-center">
									<div class="well">
										<p id="prof_name">'.$prof_name.'</p>
										<img id="prof_pic" src='."user.png".' class="img-circle" height="55" width="55" alt="Avatar">
									</div>
									<button class="btn btn-primary" style="float: right;"><a href="download.php?location='.$location.'" style="color: white;text-decoration: none;">download</a></button>
								</div>
								<div class="col-sm-9">
									<div class="well">
										<p id="ass_name">'.$ass_name.'</p>
										<p id="created_time">'.$created_time.'</p>
										<p>last date of submission:<span id="ass_date">'.$lds.'</span></p>
										<p>description:<span id="ass_langs">'.$opd.'</span>
										</p>
									</div>
								</div>
							</div>';
						}
						
					} else{
						"<h4>No assign yet....!";
					}
								
					$conn->close();
				?>
			</div>			
			<div class="col-sm-2">
				
			</div>
		</div>		
	</div>
	<div class="footer">
  		<p> Copyright 1999-2018 by Refsnes Data. All Rights Reserved.
		Powered by assignmentor.in</p>
	</div>
</body>

<script type="text/javascript">
</script>
</html>