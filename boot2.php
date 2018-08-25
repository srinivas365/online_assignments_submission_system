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
  	</style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
			<a href="login.php" class="navbar-brand">Assignmentor</a>			
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="boot2.php">Home</a></li>
			<li><a href="profile.php">My profile</a></li>	
			<li><a href="folder_view.php">view directory</a></li>
			<li><a href="ass_new.php">new Assignment</a></li>
			<li><a href="ass_view.php">view submissions <span class="badge">9</span></a></li>
			
		</ul>
		<ul class="nav navbar-nav navbar-right">
      		<li><a href="settings.php"><span class="glyphicon glyphicon-settings"></span> Settings</a></li>
      		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    	</ul>		
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-sm-3 well">
				<div class="well text-center">
        			<img src="bandmember.jpg" class="img-circle" height="65" width="65" alt="Avatar" id="profile_pic">
        			<h4 id="profile_name"><?php echo $_SESSION["username"]?></h4>
        			<h5 id="profile-regno">2016BCS0021</h5>
        			<h5 id="profile_sem">Semester 5</h5>					
				</div>				
			</div>
			<div class="col-sm-7" style="margin-left: 50px;">
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

						$sql = "SELECT * from new_assns";
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
						// output data of each row
							while($row = $result->fetch_assoc()) {
								$ass_name=$row["name"];
								$prof_name=$row["prof_name"];
								$semester=$row["semester"];
								$lds=$row["lds"];
								$opd=$row["opd"];
								$location=$row["file_loc"];
								$created_time=$row["created_time"];
								echo '
								<div class="row well">
									<div class="col-sm-3 text-center">
										<div class="well">
											<p id="prof_name">'.$prof_name.'</p>
											<img id="prof_pic" src="bandmember.jpg" class="img-circle" height="55" width="55" alt="Avatar"><br>
											
										</div>
										<button class="btn btn-primary" style="float: right;"><a href="download.php?location='.$location.'" style="color: white;text-decoration: none;">download</a></button>
									</div>
									<div class="col-sm-9">
										<div class="well">
											<p id="ass_name">'.$ass_name.'</p>
											<p id="created_time">created time:'.$created_time.'</p>
											<p>last date of submission:<span id="ass_date">'.$lds.'</span></p>
											<p>description:<span id="ass_langs">'.$opd.'</span>
											</p>
										</div>
									</div>
								</div>';
							}
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
	$(document).ready(function() {
		$.ajax({
			url:"grab_nots.php",
			method:"POST",
			data:{},
			success:function(data){
				
			}
		});
	});
</script>
</html>