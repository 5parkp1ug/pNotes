<?php 
	session_start();
	if (isset($_SESSION['email'])) 
		header('location:home.php');
?>
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<style>
		body{
			background-color:#F3F3F3;
			padding-top: 100px;
		}
	</style>

		<title>pNotes</title>
  </head>

  <body>

		<!-- Default Navigation Bar-->
		<?php include "default-nav.html" ?>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">Sign In</div>
					<div class="panel-body">
						<!-- Login Form -->
						<form id="login-form" class="form-signin" method="POST" action="javascript:login();">

							<div class="form-group">
								<label for="email" class="cols-sm-2 control-label">email</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
										</span>
										<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your email" value="<?php if(isset($_GET['email']))echo $_GET['email']; ?>"/>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="password" class="cols-sm-2 control-label">Password</label>
								<div class="cols-sm-10">
									<div class="input-group">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
										</span>
										<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
									</div>
								</div>
							</div>


							<div class="checkbox">
								<label><input type="checkbox"> Remember me</label>
							</div>
							<button type="submit" class="btn btn-default">Submit</button>

						</form>
						<hr />
						<a class="btn btn-lg btn-primary btn-block" href="register.php">Register</a>
						Forgot Password? <a href="forgot_password.php"> Get started here</a>
					</div>
				</div>
			</div>
		</div>

	</div> <!-- /container -->

	<!-- Default Foter-->
	<?php include "footer.html" ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript">
		function login(){

			$.ajax({
				type: "POST",
				url: "/login.php",
				data: $("#login-form").serializeArray(),
				success: function(response) {
					window.location = "/home.php";
				}
			});
		}
	</script>
  </body>
</html>
