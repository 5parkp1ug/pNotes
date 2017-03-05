<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<style>
		body{
			background-color:#F3F3F3;
			padding-top: 100px;
		}
	</style>
  </head>
  
 <body>
	<!-- Default Navigation Bar-->
	<?php include "default-nav.html" ?>

	
<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Register</div>
					<div class="panel-body">			
						<!-- Login Form -->
						<form id="register-form" data-toggle="validator" role="form" class="form-signin" method="POST" action="javascript:register();">
							
						    <div class="hidden form-group alert-dismissible" id="message">
						    	<span class="close" data-dismiss="alert">&times;</span>
						    </div>

							<div class="form-group">
								<label for="name" class="cols-sm-2 control-label">Name</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
										</span>
										<input type="text" class="form-control" name="name" id="name"  placeholder="Enter your Name" required/>
									</div>
								</div>
							</div>
							
							<div class="form-group has-feedback">
								<label for="email" class="cols-sm-2 control-label">Email</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
										</span>
										<input type="email" class="form-control" name="email" id="emailob" data-error="Invalid Email" placeholder="Enter your Email" required/>
										<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
									</div>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							
							<div class="form-group">
								<label for="password" class="cols-sm-2 control-label">Password</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
										</span>
										<input type="password" data-minlength="6" class="form-control" name="password" id="password"  placeholder="Enter your Password" required/>
									</div>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							
							<div class="form-group">
								<label for="password" class="cols-sm-2 control-label">Password Again</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
										</span>
										<input type="password" class="form-control" name="repassword" id="repassword" data-match="#password" data-match-error="Whoops, these don't match" placeholder="Enter your Password Again" required/>
									</div>
									<div class="help-block with-errors"></div>
								</div>
							</div>
							<button type="submit" class="btn btn-default">Submit</button>
						</form>
						<hr />
						Forgot Password? <a href="forgot_password.php"> Get started here</a>
					</div>
				</div>
			</div>
		</div>	
	</div> <!-- /container -->


	<!-- Default Foter-->
	<?php include "footer.html" ?>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>
	<script type="text/javascript">
		function register() {
		  	// console.log($("#register-form").serializeArray())

		  	$.ajax({
				type: "POST",
				url: "register-users.php",
				data: $("#register-form").serializeArray(),
				success: function(response) {
					console.log(response);
					if(response['status'] == 'OK'){
						success_message = response['message'];
						set_message(success_message, "alert alert-success fade in", "alert alert-danger fade input", 1);	
					}
					else {
						set_message(response['number']+": "+response['error'], "alert alert-danger fade in", "alert alert-success fade in", 0);
					}
		  		}
			});	

		}
		

		function set_message(message, class_to_add, class_to_remove, form_reset_flag) {

			$("#message").html(message);
			$("#message").removeClass(class_to_remove);
			$("#message").addClass(class_to_add);
			$("#message").removeClass("hidden");
			if (form_reset_flag)
				$("#register-form")[0].reset();
		}
		  
	</script>
  </body>
</html>

