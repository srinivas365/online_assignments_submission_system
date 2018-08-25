<?php
//upload.php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "company";
$profile_name=$_SESSION["username"];
$pic_location="bandmember.jpg";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if($_FILES["file"]["name"] != '')
{
   $test = explode('.', $_FILES["file"]["name"]);
   $ext = end($test);
   $name = rand(100, 999) . '.' . $ext;
   $location = './upload/' . $name;  
   $pic_location=$location;
   move_uploaded_file($_FILES["file"]["tmp_name"], $location);
   $sql="UPDATE user_details set pic_location='$pic_location' where email_id='$profile_name' ";
    if ($conn->query($sql) === TRUE) {
        echo '<img src="'.$location.'" height="150" width="225" class="img-thumbnail" />';
    }
}
?>
