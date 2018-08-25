<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
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
			<li class="active"><a href="ass_view.php">View Assignments</a></li>			
		</ul>
		<ul class="nav navbar-nav navbar-right">
      		<li><a href="settings.php"><span class="glyphicon glyphicon-settings"></span> Settings</a></li>
      		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    	</ul>		
		</div>
	</nav>
	<div class="container">
		<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "company";
			$profile_name=$_SESSION["username"];

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "SELECT assn_name,count(*) as tot_count FROM assignments WHERE prof_name='$profile_name' GROUP BY assn_name";
			$result = $conn->query($sql);
			echo '<div class="table-responsive col-sm-10 ">       
			  		<table class="table table-bordered table-stripped">
					    <thead>
					      <tr>
					        <th>Assignment Name</th>
					        <th>Total submissions</th>
					        <th>view</th>
					      </tr>
		    			</thead>
		    			<tbody>
		    			';
			if ($result->num_rows > 0) {
			// output data of each row
				while($row = $result->fetch_assoc()) {
					$a=$row["assn_name"];
					echo "<tr>
        				<td>".$row['assn_name']."</td>
        				<td>".$row["tot_count"]."</td>
        				<td><button class='btn btn-primary'><a href='ind_ass_view.php?assn_name=$a'>view</a></button></td>
      				</tr>";
				}
				echo "</tbody></table></div>";
			} 
			
			$conn->close();
		?>
	</div>
</body>
</html>
