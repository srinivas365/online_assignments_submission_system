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
			<a href="#" class="navbar-brand">Aseater.com</a>			
			</div>
			<ul class="nav navbar-nav">
				<li><a href="#">Home</a></li>
				<li><a href="#">My profile</a></li>	
				<li><a href="#">Notifications <span class="badge">9</span></a></li>
				<li><a href="welcom2.php">view directory</a></li>
				<li class="active"><a href="teacher.php">Teacher section</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
	      		<li><a href="#"><span class="glyphicon glyphicon-settings"></span> Settings</a></li>
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
			$assn_name=$_GET["assn_name"];

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "SELECT * FROM assignments WHERE prof_name='$profile_name' and assn_name='$assn_name' and flag=0";
			$result = $conn->query($sql);
			echo '<div class="table-responsive col-sm-10">       
			  		<table class="table">
					    <thead>
					      <tr>
					        <th>Name of the student</th>
					        <th>view</th>
					      </tr>
		    			</thead>
		    			<tbody>
		    			';
			if ($result->num_rows > 0) {
			// output data of each row
				while($row = $result->fetch_assoc()) {
					$stud_name=$row["stud_name"];
					$loc=$row["location"];
					$flag=$row["flag"];

					echo "<tr class='info'>
    				<td>".$stud_name."</td>
    				<td><button class='btn btn-primary'><a href='run_code.php?location=$loc'>view</a></button></td>
  					</tr>";
				}
			}

			$sql = "SELECT * FROM assignments WHERE prof_name='$profile_name' and assn_name='$assn_name' and flag=1";
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
			}
			echo "</tbody></table></div>";

			$sql = "UPDATE assignments set flag=1";
			$result = $conn->query($sql);

			
			$conn->close();
		?>
	</div>
</body>
</html>