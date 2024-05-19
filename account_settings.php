<!DOCTYPE html>
<?php 
	session_start();
	include 'assits/include/connection.php';
	include 'assits/include/header.php';

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
	<title>Account Settings</title>
	<!-- ===== WEB TITLE ENDS ===== -->

	<!-- ===== BOOTSTRAP LINK STARTS ===== -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<!-- ===== BOOTSTRAP LINK ENDS ===== -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" type="text/css" href="../css/find_people.css">
</head>
<body>
	<div class="row">
		<div class="col-sm-2"></div>
		<?php
			$user = $_SESSION['user_email'];
			$get_user = "SELECT * FROM users WHERE user_email = '$user'";
			$run_user = mysqli_query($con, $get_user);
			$row = mysqli_fetch_array($run_user);

			$user_name = $row['user_name'];
			$user_pass = $row['user_pass'];
			$user_email = $row['user_email'];
			$user_profile = $row['user_profile'];
			$user_country = $row['user_country'];
			$user_gender = $row['user_gender'];
		?>
		<div class="col-sm-8">
			<form action="" method="post" enctype="multipart/form-data">
				<table class="table table-bordered table-hover">
					<tr align="center">
						<td colspan="6" class="active">
							<h2>Change Account Settings</h2>
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Change Your Username</td>
						<td>
							<input type="text" name="u_name" class="form-control" required value="<?= $user_name ?>" />
						</td>
					</tr>

					<tr>
						<td></td>
						<td>
							<a href="upload.php" class="btn btn-default" style="text-decoration: none; font-size: 15px;">
								<i class="fa fa-user" aria-hidden="true"></i>
								Change Profile
							</a>
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Change Your Email</td>
						<td>
							<input type="email" name="u_email" class="form-control" required value="<?= $user_email ?>" />
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Country</td>
						<td>
							<select class="form-control" name="u_country">
								<option><?= $user_country ?></option>
								<option>USA</option>
								<option>UK</option>
								<option>UAE</option>
							</select>
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Gender</td>
						<td>
							<select class="form-control" name="u_gender">
								<option><?= $user_gender ?></option>
								<option>Male</option>
								<option>Female</option>
								<option>Others</option>
							</select>
						</td>
					</tr>

					<tr>
						<td style="font-weight: bold;">Forgotten Password</td>
						<td>
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
								Forgotton Password
							</button>

							<div id="myModal" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">
												&times;
											</button>
										</div>
										<div class="modal-body">
											<form action="recovery.php?id=<?= $user_id ?>" method="post" id="f">
												<strong>What is Your School Best Friend Name?</strong>
												<textarea class="form-control" cols="83" rows="4" name="content" placeholder="Someone"></textarea>
												<input class="btn btn-default" type="submit" name="sub" value="Submit" style="width: 100px;">
												<br><br>
												<pre>
													Answer the above question we will ask you this question if you forgot your 
													<br>Password.													
												</pre>
												<br><br>
											</form>
											<?php
												if (isset($_POST['sub'])) 
												{
													$bfn = htmlentities($_POST['content']);

													if ($bfn == "")
													{
														echo "<script>alert('Please Enter Something')</script>";
														echo "<script>window.open('account_settings.php', '_self')</script>";
														exit();
													}
													else
													{
														$update = "UPDATE users SET forgotten_answer = '$bfn' WHERE user_email = '$user'";
														$run = mysqli_query($con, $update);

														if ($run) 
														{
															echo "<script>alert('Working ...')</script>";
															echo "<script>window.open('account_settings.php', '_self')</script>";
														}
														else
														{
															echo "<script>alert('Error while updating information')</script>";
															echo "<script>window.open('account_settings.php', '_self')</script>";
														}
													}
												}

											?>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						</td>
					</tr>

					<tr>
						<td></td>
						<td>
							<a href="change_password.php" class="btn btn-default" style="text-decoration: none; font-size: 15px;">
								<i class="fa fa-key fa-fw" aria-hidden="true"></i>
								Change Password
							</a>
						</td>
					</tr>

					<tr align="center">
						<td colspan="6">
							<input type="submit" value="Update" name="update" class="btn btn-info">
						</td>
					</tr>
				</table>
			</form>
			<?php
				if (isset($_POST['update'])) 
				{
					$u_name = htmlentities($_POST['u_name']);
					$u_email = htmlentities($_POST['u_email']);
					$u_country = htmlentities($_POST['u_country']);
					$u_genders = htmlentities($_POST['u_gender']);

					$update = "UPDATE users SET user_name = '$u_name', user_email = '$u_email', user_country = '$u_country', user_gender = '$u_gender' WHERE user_email = '$user'";
					$run = mysqli_query($con, $update);

					if ($run) 
					{
						echo "<script>window.open('account_settings.php', '_self')</script>";
					}
				}
			?>			
		</div>
		<div class="col-sm-2"></div>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>	
</body>
</html>

















