<?php
require 'session_start.php';
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
   

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://github.com/mgalante/jquery.redirect/blob/master/jquery.redirect.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
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
            <li class="active"><a href="folder_view.php">view directory</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="settings.php"><span class="glyphicon glyphicon-settings"></span> Settings</a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>       
        </div>
    </nav>
    

    <div class="container">
        <h2 align="center">List folder from Directory</h2>
        <br>
        <div align="right">
        <button type="button" name="create_folder" id="create_folder" class="btn btn-success">Create Folder</button><br><br>
        <div id="folder_table" class="table-responsive">
        </div>              
        </div>        
    </div>

   
    
</body>
</html>
<div id="folderModal" class="modal fade" role="dialog" align="left">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span id="change_title">Create Folder</span>
            </div>
            <div class="modal-body">
                <p>Enter Folder Name</p>
                <input type="text" name="folder_name" id="folder_name" class="form-control"/><br>
                <input type="hidden" name="action" id="action"/>
                <input type="hidden" name="old_name" id="old_name"/>
                <input type="button" name="folder_button" id="folder_button" class="btn btn-info" value="Create"/>                     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            
        </div>
    </div>
</div>

<div id="uploadModal" class="modal fade" role="dialog" align="left">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span id="change_title">Upload File</span>
            </div>
            <div class="modal-body">
                <form method="post" id="upload_form" enctype="multipart/form-data">
                    <p>Select File</p>
                    <input type="file" name="upload_file"><br>
                    <input type="hidden" name="hidden_folder_name" id="hidden_folder_name">
                    <input type="submit" name="upload_button" class="btn btn-info" value="Upload"/>
                </form>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            
        </div>
    </div>
</div>

<div id="linkModal" class="modal fade" role="dialog" align="left">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span id="change_title">Link this folder</span>
            </div>
            <div class="modal-body">
                <form method="post" id="link_form" enctype="multipart/form-data">
                   <div class="form-group">
                        <label>Assigment Id</label>
                        <input type="text" name="ass_name" id="ass_name" class="form-control">
                    </div> 
                    <div class="form-group">
                        <label>Professor Id</label>
                        <input type="text" name="prof_name" id="prof_name" class="form-control">
                    </div>
                    <input type="hidden" name="hid_fold_name" id="hid_fold_name">
                    <div class="form-group">
                        <input type="submit" value="Link this folder" class="btn btn-warning">
                    </div> 
                </form>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            
        </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function() {

    load_folder_list();

    function load_folder_list() {
        // body...
        var action="fetch";
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{action:action},
            success:function(data) {
                // body...
                $("#folder_table").html(data);
                console.log("hello world");
            }

        });
    }

    $(document).on('click','#create_folder',function() {
        // body...
        $('#action').val('create');
        $('#folder_name').val('');
        $('#folder_button').val('Create');
        $('#old_name').val('');
        $('#change_title').text('Create Folder');
        $('#folderModal').modal('show');
    });


    $(document).on('click','#folder_button',function() {
        // body...
        var folder_name=$('#folder_name').val();
        var old_name=$('#old_name').val();
        var action=$('#action').val();
        if(folder_name!=''){
            $.ajax({
                url:'action.php',
                method:'POST',
                data:{folder_name:folder_name,old_name:old_name,action:action},
                success:function(data) {
                    // body...
                    $('#folderModal').modal('hide');
                    load_folder_list();
                }
            });
        }else{
            alert("Enter folder name");
        }


    });


    $(document).on('click','.update',function() {
        // body...
        var folder_name=$(this).data("name");
        $('#old_name').val(folder_name);
        $('#folder_name').val(folder_name);
        $('#action').val("change");
        $('#folder_button').val('Update');
        $('#change_title').text("Change Folder Name");
        $('#folderModal').modal("show");
    });


    $(document).on('click','.upload',function() {
        // body...
        var folder_name=$(this).data("name");
        console.log(folder_name);
        alert(folder_name);
        $('#hidden_folder_name').val(folder_name);
        $('#uploadModal').modal('show');
        console.log("vello world");
    });

    $('#upload_form').on('submit',function() {
        // body...
        $.ajax({
            url:"upload.php",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success:function(data) {
                // body...
                load_folder_list();
                alert(data);
            }
        });
    });


    $(document).on('click','.view_files',function() {
        var folder_name=$(this).data("name");
        var location="./uploads/"+"<?php echo $_SESSION["user_id"]?>"+"/"+folder_name;
        window.location.href = "run_code.php?location="+location;

    });

    $(document).on('click','.link_folder',function() {
       var folder_name=$(this).data("name");
       $('#hid_fold_name').val(folder_name);
       $("#linkModal").modal("show"); 
    });

    $("#link_form").on('submit',function() {
        // body...
        var action="link";
        var ass_name=$("#ass_name").val();
        var prof_name=$("#prof_name").val();
        var folder_name=$("#hid_fold_name").val();
        if(ass_name!=''&&prof_name!=''&&folder_name!=''){
            $.ajax({
                url:"action.php",
                method:"POST",
                data:{ass_name:ass_name,prof_name:prof_name,folder_name:folder_name,action:action},
                success:function(data) {
                    $("linkModal").modal("hide");
                    alert(data);
                }
            });
        }
    });


}); 
</script>
