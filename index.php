<?php

session_start();
if (isset($_SESSION["email"])) {
	# code...
	if($_SESSION["student"]=='1'){
		header("location:student_boot.php");
	}else{
		header("location:teacher_boot.php");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Assignmentor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/login.css"/>
  <script type="text/javascript" src="js/login.js"></script>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">Assignmentor</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">ABOUT</a></li>
        <li><a href="#services">SERVICES</a></li>
        <li><a href="#contact">REPORT BUG</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h1>Assignmentor</h1> 
  <p>We specialize in hands free environment</p> 

</div>

<!-- Container (About Section) -->
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2>About Assignmentor</h2><br>
      <h4>A website which provides a clean and hands free environment for college community.</h4><hr>
      <p>Before days Professors have to send assigments through mail. Students have to download them and mail them to professors. Professors need to download them to run the code and need to store them properly.Say <span style="color: green">good bye</span> to this method and switch to Assignmentor</p><br>
      <br><button class="btn btn-default btn-lg">Get in Touch</button>
    </div>
    <div class="col-sm-4">
      <!--<span class="glyphicon glyphicon-signal logo"></span>-->
      <div class="wrapper">
                <h2>Login</h2>
                <p>Please fill in your credentials to login.</p>
                <form method="post" id="login">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>    
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                    <p>Don't have an account? <a href="signin.php">Sign up now</a>.</p>
                </form>
            </div>
    </div>
  </div>
</div>


<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">
  <h2>SERVICES</h2>
  <h4>What we offer</h4>
  <br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-off logo-small"></span>
      <h4>STORE</h4>
      <p>A cloud storage of your assignments</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-heart logo-small"></span>
      <h4>RUN ONLINE</h4>
      <p>Test and debug assignments online</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-lock logo-small"></span>
      <h4>JOB DONE</h4>
      <p>Send assignments to your student community</p>
    </div>
  </div>
  <br><br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-leaf logo-small"></span>
      <h4>LANGUAGES</h4>
      <p>Supports a huge number of programming languages</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-certificate logo-small"></span>
      <h4>CERTIFIED</h4>
      <p>Join the discussion community</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h4 style="color:#303030;">Practice</h4>
      <p>Practice and become an expert</p>
    </div>
  </div>
</div>

<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">REPORT BUG</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Andhra pradesh, India</p>
      <p><span class="glyphicon glyphicon-phone"></span> +91 9603552539</p>
      <p><span class="glyphicon glyphicon-envelope"></span> m.srinivas365@gmail.com</p>
    </div>
    <div class="col-sm-7 slideanim">
      <div class="row">
      <form class="form-group" id="bug_form" action="action.php" method="POST">
          <div class="col-sm-6">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <input class="btn btn-default pull-right" type="submit" id="submit">
        </div>
      </div>
      </form>       
    </div>
  </div>
</div>
<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>developed by Mannem Srinivas </p> 
</footer>
</body>
</html>
