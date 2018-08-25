<?php
// Initialize the session
require 'session_start.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<script type="text/javascript" src="codemirror/lib/codemirror.js"></script>
	<link rel="stylesheet" type="text/css" href="codemirror/lib/codemirror.css">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<style type="text/css">
  		.navbar{
  			margin-bottom: 20px;
  			border-radius: 0;
  		}
  		textarea {
  		 resize: none;
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
		</ul>
		<ul class="nav navbar-nav navbar-right">
      		<li><a href="settings.php"><span class="glyphicon glyphicon-settings"></span> Settings</a></li>
      		<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    	</ul>		
		</div>
	</nav>
	<div class="container-fluid">

		<div class="row">
			<div class="col-sm-2">
				<div class="list-group">
					<?php
						$path=$_GET["location"];
					  	$dh = opendir($path);
						$i=1;
						while (($file = readdir($dh)) !== false) {
						    if($file != "." && $file != ".." && $file != "index.php" && $file != ".htaccess" && $file != "error_log" && $file != "cgi-bin") {
						        echo "<a href='javascript:void(0)' id='$path/$file' class='list-group-item' onclick='display_code(this.id)'><span class='glyphicon glyphicon-file'></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$file</a>";
						        $i++;
						    }
						}
						closedir($dh);
					?>	
				</div>				
			</div>
			<div class="col-sm-8 well well-success">
				<h4 id="file_name">hello.py</h5>
				<hr>
				<div id="code_editor">
					
				</div><br>
				<div class="row">
					<div class="col-sm-8">
					
						<label for="input">Input</label>
						<textarea class="form-control" rows="5" id="input"></textarea>
					
				</div>
				<div class="col-sm-4">
					<br>
					<div class="form-group">
	  					<label for="language">Select language</label>
	  					<select class="form-control" id="language">
			    				<option>php</option>
			    				<option>c++</option>
			    				<option>Java</option>
			    				<option>python3</option>
	  					</select><br>
	  					<button class="btn btn-primary" id="run_code">run the code</button><br>
					</div>					
				</div>
				</div>
				<br>
				<div class="well" id="output" style="background-color: white;">
					<p>hello here is the output
					
				</div>
								
			</div>
			<div class="col-sm-2">
			
				
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
var editor=CodeMirror(document.getElementById("code_editor"),{
	lineNumbers:true,
  	mode:"Python"
});
editor.setSize(null,500);
function display_code(file)
{
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function ()
    {
        if(rawFile.readyState === 4)
        {
            if(rawFile.status === 200 || rawFile.status == 0)
            {
                editor.getDoc().setValue(rawFile.responseText);
            }
        }
    }
    rawFile.send(null);
}

$(document).on("click","#run_code",function() {
  // body...
  var language=$("#language option:selected" ).text();
  var text = editor.getValue();
  var input=$("#input").val();
  
  $.ajax({
    url:'curl_call2.php',
    method:'POST',
    data:{script:text,language:language,input:input},
    success:function(data) {
      // body...
        var html_data="<p>";
      	var obj = JSON.parse(data);
    	$.each(obj, function(key, value) {
  			html_data+=key+"<hr>"+value+"<br><br><br><br>";
		});
		html_data+"<p>";
		$("#output").html(html_data);

    }
  });
});

</script>
</html>