<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- ===== WEB TITLE STARTS ===== -->
	<title>Create New Account</title>
	<!-- ===== WEB TITLE ENDS ===== -->

	<!-- ===== GOOGLE FONTS LINK STARTS ===== -->
	<link href="https://fonts.googleapis.com/css?family=Roboto|Courgette|Pacifico:400,700" rel="stylesheet">
	<!-- ===== GOOGLE FONTS LINK ENDS ===== -->

	<!-- ===== BOOTSTRAP LINK STARTS ===== -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- ===== BOOTSTRAP LINK ENDS ===== -->

	<!-- ===== CUSTOM CSS FILE LINK STARTS ===== -->
	<link rel="stylesheet" type="text/css" href="assits/css/signup.css">
	<!-- ===== CUSTOM CSS FILE LINK STARTS ===== -->

</head>
<body>
	<div class="signup-form">
		<form action="" method="post">
			<div class="form-header">
				<h2>Sign Up</h2>
				<p>Fill out this form and start chating with your friends.</p>
			</div>
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="user_name" placeholder="username" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" name="user_email" placeholder="someone@site.com" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="user_pass" placeholder="password" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Country</label>
				<select class="form-control" name="user_country" required>
					<option disabled="">Select a Country</option>
					<option>Pakistan</option>
					<option>India</option>
					<option>Uk</option>
					<option>USA</option>
					<option>UAE</option>
				</select>
			</div>
			<div class="small">Forgot Password? <a href="forgot_pass.php">Click Here</a></div><br>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block btn-lg" name="sign_in">Sign in</button>
			</div>
			<!-- <?php //include 'signin_user.php'; ?> -->
		</form>
		<div class="text-center small" style="color: #67428B;">Don't have an account? <a href="signup.php">Create one</a></div>
	</div>


	<!-- ===== JS CDN LINKS ===== -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- ===== JS CDN LINKS ===== -->

</body>
</html>