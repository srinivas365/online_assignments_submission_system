<?php
// Initialize the session
require 'session_start.php';
require 'defines.php';

if(isset($_POST["submit"])){

  $showDivFlag=false;

  
  //uploading file
  if ($_FILES["ass_file"]["name"]!="") {
    # code...
    if (!file_exists('./uploads/'.$_SESSION["user_id"]."/assigments")) {
      mkdir('./uploads/'.$_SESSION["user_id"]."/assigments", 0777, true);
    }
    $new_file_name=$_FILES["ass_file"]["name"];
    $path='./uploads/'.$_SESSION["user_id"].'/assigments/'.$new_file_name;

    if(move_uploaded_file($_FILES["ass_file"]["tmp_name"],$path)){
          $ass_id=$_POST["assn_name"];
          $faculty_id=$_SESSION["user_id"];
          $course_id=$_POST["course_id"];
          $lds=$_POST["lds"];
          $desc=$_POST["desc"];
          $new_file_name=$_FILES["ass_file"]["name"];
          $path='./uploads/'.$_SESSION["user_id"].'/assigments/'.$new_file_name;

          // Create connection
          $conn = connectTo();
          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          } 

          $sql = "INSERT INTO new_assignments(assignment_id,faculty_id,course_id,file_location,description,last_date)
          VALUES ('$ass_id','$faculty_id','$course_id','$path','$desc','$lds')";

          if ($conn->query($sql) === TRUE) {
              $showDivFlag=true;
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
          $conn->close();
    }
    else
    {
      echo "There is some error";
    }

  }
  
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
      #success_alert{
        display:none;
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
      <li class="active"><a href="ass_new.php">Create Assignment</a></li>
      <li><a href="ass_view.php">View Assignments</a></li>      
    </ul>
    <ul class="nav navbar-nav navbar-right">
          <li><a href="settings.php"><span class="glyphicon glyphicon-settings"></span> Settings</a></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>   
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <div class="alert alert-success alert-dismissible" id="success_alert" <?php if ($showDivFlag===true){?>style="display:block;"<?php } ?>>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    New assignment successfully created.
        </div>
        <h3>Create new assignment</h3><hr>
      <form action="" method="POST" enctype="multipart/form-data" id="form_data">
        <div class="form-group">
          <label for="assn_name">Assignment Name:</label>
          <input type="text" name="assn_name" id="assn_name" class="form-control">          
        </div>
        <div class="form-group">
            <label for="semester">course_ID</label>
            <input type="text" name="course_id" id="course_id" class="form-control">
        </div>
        <div class="form-group">
          <label for="lds">Last date of submission</label>
          <input type="text" name="lds" id="lds" class="form-control">
        </div>
        <div class="form-group">
            <label for="desc">Optional Description</label>  
            <textarea class="form-control" rows="5" id="desc" name="desc"></textarea>
        </div>
        <div class="form-group">
          <label for="upload">Upload file</label>
          <input type="file" name="ass_file" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" name="submit">          
        </div>        
      </form>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
</script>
</html>