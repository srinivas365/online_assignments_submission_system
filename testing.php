<?php
session_start();
$user_id=$_SESSION["user_id"];
if(!file_exists("uploads/".$user_id))
{
    mkdir("uploads/".$user_id,0777,true);
    echo "hello world";
}
?>