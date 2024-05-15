<!DOCTYPE html>
<?php 
	session_start();
	include 'find_friends_function.php';

	if (!isset($_SESSION['user_email'])) 
	{
		header('location: signin.php');
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- ===== WEB TITLE STARTS ===== -->
	<title>Search for Friends</title>
	<!-- ===== WEB TITLE ENDS ===== -->

	<!-- ===== BOOTSTRAP LINK STARTS ===== -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- ===== BOOTSTRAP LINK ENDS ===== -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" type="text/css" href="../css/home.css">
</head>
<body>
	<nav class="navbar-brand" href="#">
		<a href="#" class="navbar-brand">
			<?php
				$user = $_SESSION['user_email'];
				$get_user = "SELECT * FROM users WHERE user_email = '$user'";
				$run_user = mysqli_query($con, $get_user);
				$row = mysqli_fetch_array($run_user);

				$user_name = $row['user_name'];

				echo "<a href='../../home.php?user_name=$user_name' class='navbar-brand' >MyChat</a>";
			?>			
		</a>
		<ul class="navbar-nav">
			<li>
				<a href="../../account_settings.php" style="color: white; text-decoration: none; font-size: 20px;" >Settings</a>
			</li>
		</ul>
	</nav>
	<br>
	<div class="row">
		<div class="col-sm-4"></div>		
		<div class="col-sm-4">
			<form class="search_form" action="">
				<input type="text" name="search_query" placeholder="Search Friends" autocomplete="off" required>
				<button class="btn" type="submit" name="search_btn">Search</button>
			</form>
		</div>
		<div class="col-sm-4"></div>		
	</div>
	<br><br>
	<?php search_user(); ?>
</body>
</html>
























