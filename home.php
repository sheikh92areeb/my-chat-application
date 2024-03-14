<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- ===== WEB TITLE STARTS ===== -->
	<title>My Chat - Home</title>
	<!-- ===== WEB TITLE ENDS ===== -->

	<!-- ===== BOOTSTRAP LINK STARTS ===== -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- ===== BOOTSTRAP LINK ENDS ===== -->
</head>
<body>
	<div class="container main-section">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
				<div class="input-group searchbox">
					<div class="input-group-btn">
						<center>
							<a href="assits/include/find_friends.php">
								<button class="btn btn-default search-icon" name="search_user" type="submit">
									Add new user
								</button>
							</a>
						</center>
					</div>
				</div>
				<div class="left-chat">
					<ul>
						<?php include 'assits/include/get_users_data.php'; ?>
					</ul>
				</div>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
				<div class="row">
					<!-- GETTING THE USER INFORMATION WHO IS LOGGED IN -->
					<?php
						$user = $_SESSION['user_email'];
						$get_user = "SELECT * FROM users WHERE user_email = '$user'";
						$run_user = mysqli_query($con, $get_user);
						$row = mysqli_fetch_array($run_user);

						$user_id = $row['user_id'];
						$user_name = $row['user_name'];
					?>

					<!-- GETTING USER DATA ON WHICH USER CLICK -->
					<?php
						if (isset($_GET['user_name'])) 
						{
							global $con;
							$get_username = $_GET['user_name'];
							$get_user = "SELECT * FROM users WHERE user_name = '$get_username'";
							$run_user = mysqli_query($con, $get_user);
							$row_user = mysqli_fetch_array($run_user);

							$username = $row_user['user_name'];
							$user_profile_img = $row_user['user_profile'];
						}

						$total_messages = "SELECT * FROM users_chat WHERE (sender_username = '$user_name' AND reciever_username = '$username') OR (reciever_username = '$user_name' AND sender_username = '$username')";
						$run_messages = mysqli_query($con, $total_messages);
						$total = mysqli_num_rows($run_messages);
					?>

					<div class="col-md-12 right-header">
						<div class="right-header-img">
							<img src="<?= $user_profile_img ?>">
						</div>
						<div class="right-header-detail">
							<form action="#" method="post">
								<p><?= $username ?></p>
								<span><?= $total ?> messages</span> &nbsp; &nbsp;
								<button name="logout" class="btn btn-danger">Logout</button>
							</form>
							<?php
								if (isset($_POST['logout'])) 
								{
									$update_msg = mysqli_query($con, "UPDATE users SET log_in = 'Offline' WHERE user_name = '$user_name'");
									header("location: logout.php");
									exit();
								}
							?>
						</div>
					</div>
				</div>
				<div class="row">
					<div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
						<?php
							$update_msg = mysqli_query($con, "UPDATE users_chat SET msg_status = 'read' WHERE sender_username = '$username' AND reciever_username = '$user_name'");
							$sel_msg = "SELECT * FROM users_chat WHERE (sender_username = '$user_name' AND reciever_username = '$username') OR (reciever_username = '$user_name' AND sender_username = '$username') ORDER by 1 ASC";
							$run_msg = mysqli_query($con, $sel_msg);

							while ($row = mysqli_fetch_array($run_msg)) 
							{
								$sender_username = $row['sender_username'];
								$reciever_username = $row['reciever_username'];
								$msg_content = $row['msg_content'];
								$msg_date = $row['msg_date'];							
						?>
						<ul>
							<?php
								if ($user_name == $sender_username AND $username == $reciever_username) 
								{
									echo "
										<li>
											<div class='right-side-chat'>
												<span>$username <small>$msg_date</small></span>
												<p>$msg_content</p>
											</div>
										</li>
									";
								}
								elseif ($user_name == $reciever_username AND $username == $sender_username) 
								{
									echo "
										<li>
											<div class='right-side-chat'>
												<span>$username <small>$msg_date</small></span>
												<p>$msg_content</p>
											</div>
										</li>
									";
								}
							?>
						</ul>
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 right-chat-textbox">
						<form action="#" method="post">
							<input type="text" name="msg_content" placeholder="write your message ....." autocomplete="off">
							<button type="submit" class="btn" name="submit">
								<i class="fa fa-telegram" aria-hidden="true"></i>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		if (isset($_POST['submit'])) 
		{
			$msg = htmlentities($_POST['msg_content']);

			if ($msg == "") 
			{
				echo "
					<div class='alert alert-danger'>
						<strong><center>Message was unable to send</center></strong>
					</div>
				";
			}
			elseif (strlen($msg) > 100 ) 
			{
				echo "
					<div class='alert alert-danger'>
						<strong><center>Message is too long, use only 100 characters</center></strong>
					</div>
				";	
			}
			else
			{
				$insert = "INSERT INTO users_chat (sender_username, reciever_username, msg_content, msg_status, msg_date) VALUES ('$user_name', '$username', '$msg', 'unread', NOW())";
				$run_insert = mysqli_query($con, $insert);
			}
		}

	?>

	<!-- ===== JS CDN LINKS ===== -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- ===== JS CDN LINKS ===== -->
</body>
</html>