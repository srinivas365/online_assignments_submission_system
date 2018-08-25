<?php
// Initialize the session
require 'session_start.php';
require 'defines.php';
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
  		a,a:hover{
  			text-decoration: none;
  			color: white;
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
			<li><a href="index.php">Home</a></li>
			<li><a href="ass_new.php">Create Assignment</a></li>		
		</ul>
		<ul class="nav navbar-nav navbar-right">
      		<li><a href="settings.php"><span class="glyphicon glyphicon-settings"></span> Settings</a></li>
      		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    	</ul>		
		</div>
	</nav>
	<div class="container">
		<?php
			
			$assn_id=$_GET["assn_id"];

			// Create connection
			$conn = connectTo();
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			$user_id=$_SESSION['user_id']; 


			$sql = "SELECT * FROM assignments_submitted WHERE faculty_id='$user_id' and assignment_id='$assn_id'";


			$result = $conn->query($sql);
			echo '<div class="table-responsive col-sm-10">       
			  		<table class="table table-bordered table-stripped">
					    <thead>
					      <tr>
					        <th>Student Admission Number</th>
					        <th>Submission time</th>
					        <th>view</th>
					      </tr>
		    			</thead>
		    			<tbody>
		    			';
			if ($result->num_rows > 0) {
			// output data of each row
				while($row = $result->fetch_assoc()) {
					$stud_name=$row["student_id"];
					$loc=$row["file_location"];
					$date=$row["created_time"];
					echo "<tr class='info'>
    				<td>".$stud_name."</td>
    				<td>".$date."</td>
    				<td><button class='btn btn-primary'><a href='run_code.php?location=$loc'>view</a></button></td>
  					</tr>";
				}
			}else{
				echo "<tr>
				<td colspan='3'>No Submissions found</td>
				<tr>";
			}
			/*$sql = "SELECT * FROM assignments_submitted WHERE faculty_id='$user_id' and assignment_id='$assn_id' and flag=0";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			// output data of each row
				while($row = $result->fetch_assoc()) {
					$stud_name=$row["stud_name"];
					$loc=$row["location"];
					$flag=$row["flag"];

					echo "<tr>
    				<td>".$stud_name."</td>
    				<td><button class='btn btn-primary'><a href='run_code.php?location=$loc'>view</a></button></td>
  					</tr>";
				}
			}*/
			echo "</tbody></table></div>";

			/*$sql = "UPDATE assignments set flag=1";
			$result = $conn->query($sql);
			$conn->close();*/
		?>
	</div>
</body>
</html>