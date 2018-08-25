$(document).ready(function(){
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });

  $("#bug_form").on("submit",function() {
    // body...
    var action="report";
    var name=$("#name").val();
    var email=$("#email").val();
    var comment=$("#comments").val();
    alert(action+" "+name+" "+email+" "+comment);
    $.ajax({
        url:"action.php",
        method:"POST",
        data:{action:action,name:name,email:email,comment:comment},
        contentType:false,
        cache:false,
        processData:false,
        success:function(data) {
          // body...
          alert(data);
        }
    });
  });
  processLogin();
});
function processLogin(){
  $("#login").submit(function(){
    var data={};
    $("#login input").each(function(k,v){
      if(!$(v).val().length){
        alert("error");
        return false;
      }
      data[$(v).attr('name')]=$(v).val();
    });
    $.ajax({
      url:"process_login.php",
      type:'post',
      data:data,
      dataType:'json',
      success:function(r) {
        // body...
      
        var a=JSON.stringify(r);
        var json_a=JSON.parse(a);
        var student=json_a["session"]["student"];
        console.log(student);
        if(student=="1"){
          window.location="student_boot.php";
        }else{
          window.location="teacher_boot.php";
        }
      },
      error:function(xhr, status, error) {
        var err = eval("(" + xhr.responseText + ")");
        alert(err.Message);
    } 
    })
  });

}
