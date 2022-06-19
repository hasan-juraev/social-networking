<footer class="footer mt-auto py-3">
  <div class="container">
    <p class="text-muted">&copy; My website</p>
  </div>
</footer>
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
-->

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalTitle">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- #loginAlert div -->        
        <div class="alert alert-danger" id="loginAlert"></div>
        <!-- #loginAlert div -->
        <form>
            <input type="hidden" name="loginActive" id="loginActive" value="1">
            <div class="form-group">            
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password">
            </div>               
        </form>        
      </div>

      <div class="modal-footer">
          <a  id="toggleLogin">Sign up</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="loginSignupButton">Login</button>
      </div>
    </div>
  </div>
</div>

<script>

$("#toggleLogin").click(function(){
    
    if( $("#loginActive").val() == "1"){
        // alert("login");
        $("#loginActive").val("0");
        $("#loginModalTitle").html("Sign up");
        $("#loginSignupButton").html("Sign up");
        $("#toggleLogin").html("Login");

    }else{

        $("#loginActive").val("1");
        $("#loginModalTitle").html("Login");
        $("#loginSignupButton").html("Login");
        $("#toggleLogin").html("Sign up");
    }

})

$("#loginSignupButton").click(function() {

  $.ajax({
    type: "POST",
    url: "action.php?action=loginSignup",
    data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),            
    success: function (result) {

      if (result == 1){
        
        alert("Now, you will be redirected to index.php");
        window.location.replace("./index.php");
      }
      else{
        
        $("#loginAlert").html(result).show();
      }
      

    }

  });

})


$(".toggleFollow").click(function() {
  
  var id = $(this).attr("data-userId");

  $.ajax({
    type: "POST",
    url: "action.php?action=toggleFollow",
    data:"userId=" + $(this).attr("data-userId"),        
    success: function(result) {
        
      if (result == 1){
        $("a[data-userId='" + id + "']").html("Follow");
        
      }
      else{          
        $("a[data-userId='" + id + "']").html("Unfollow");
      }

    }

  });  

})


$("#postTweetButton").click(function(){

  $.ajax({
    type: "POST",
    url: "action.php?action=postTweet",
    data:"tweetContent=" + $("#tweetContent").val(),
    success: function(result) {

      if(result == 1){

        $("#tweetSuccess").show();
        $("#tweetFail").hide();

      } else if(result != ""){

        $("#tweetFail").html(result).show();
        $("#tweetSuccess").hide();

      }

    }
  });  


})



</script>


  </body>
</html>