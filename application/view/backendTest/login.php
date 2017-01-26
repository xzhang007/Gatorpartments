<!-- Log In Form -->
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4 ">
      <form class="form-horizontal" action="<?php echo URL . 'backendTest/login';?>" method="post">
	<div class="page-header">
	  <h1 class="text-center">Log In</h1>
	</div>

	<!-- Username  -->
	<div class="form-group">
	  <label>Username</label>
            <span class="usernameValidInput alert alert-success glyphicon glyphicon-ok" aria-hidden="true"></span>
            <span class="usernameInvalidInput alert alert-danger" aria-hidden="true">Error - Field cannot be empty</span>

  	    <input id="username" class="form-control gatorForm" type="text" name="username">
	</div>

	<!-- Password -->
	<div class="form-group">
	  <label>Password</label>
	  <input class="form-control" type="password" name="password1">
	</div>

	<!-- Confirm Password -->
	<div class="form-group">
	  <label>Confirm Password</label>
	  <input class="form-control" type="password" name="password">
	</div>

	<!-- Login Button -->
	<div class="form-group">
	  <label class="sr-only">Login Button</label>
	  <button type="submit" class="btn btn-success pull-right" name="submitLogin">Log In</button>
	</div>
      </form>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>

  $(function(){
    $('#username').blur(function(){
      if(!$(this).val()){
        $('.usernameInvalidInput').show();
      }
    });

  });

</script>
