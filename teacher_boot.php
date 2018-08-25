<?php
// Initialize the session
require 'session_start.php';
require 'php_test.php';
require 'defines.php';

$obj=new Dbobject("localhost","root","","college");
$user=$obj->grabfromTab("faculty","faculty_id",$_SESSION["user_id"],"*");
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
			<li><a href="ass_new.php">Create Assignment</a></li>			
		</ul>
		<ul class="nav navbar-nav navbar-right">
      		<li><a href="settings.php"><span class="glyphicon glyphicon-settings"></span> Settings</a></li>
      		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    	</ul>		
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="row">
			<!--<div class="col-sm-3 well">
				<div class="text-center well">
        			<img src=<?php echo $user["pic_location"]?> class="img-circle" height="75" width="75" alt="Avatar" id="profile_pic">
        			<h4 id="profile_name"><?php echo $user["email_id"]?></h4>
        			<h5 id="profile_sem">Semester <?php echo $user["semester"]?></h5>
        			<h5 id="profile_name"><?php echo $user["course"]?></h4>
					<h5 id="profile_name"><?php echo $user["college"]?></h4>					
				</div>			
			</div>-->
			<div class="col-sm-7" style="margin-left: 50px;">								
				<h4>Created Assignments</h4><hr>
						<?php

						$conn=connectTo();
						// Check connection
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						} 
						$user_id=$user["faculty_id"];
						$sql = "SELECT * from new_assignments where course_id IN (select course_id from course_enrollment as ce where faculty_id='$user_id')";
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
											<p id="prof_name">'.$ass_name.'</p>
											<img id="prof_pic" src="assignment.png" class="img-circle" height="55" width="55" alt="Avatar">

										</div>
										<button class="btn btn-primary" style="float: right;"><a href="ind_ass_view.php?assn_id='.$ass_name.'" style="color: white;text-decoration: none;">view submissions</a></button></p>
									</div>
									<div class="col-sm-9">
										<div class="well">
											<p id="ass_name">'.$course.'</p>
											<p>last date of submission:<span id="ass_date">'.$lds.'</span></p>
											<p>description:<span id="ass_langs">'.$opd.'</span>
										</div>
									</div>
								</div>';
							}
						}
						else{
							echo "<br>
							<p>No Assignments created yet. Go to new Assignments tab to create one.</p>";
						}
						
						$conn->close();
					?>
			</div>			
			<div class="col-sm-2">
				
			</div>
		</div>		
	</div>
</body>

<script type="text/javascript">
</script>
</html>