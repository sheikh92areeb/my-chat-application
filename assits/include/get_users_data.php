<?php
 include 'connection.php';

 $user = "SELECT * FROM users";
 $run_user = mysqli_query($con, $user);

 while ($row_user = mysqli_fetch_array($run_user)) 
 {
 	$user_id = $row_user['user_id'];
 	$user_name = $row_user['user_name'];
 	$user_profile = $row_user['user_profile'];
 	$login = $row_user['log_in'];

 	echo '
 		<li>
			<div class="chat-left-img">
				<img src="http://localhost/test/chatapp/'.$user_profile.'">
			</div>	
			<div class="chat-left-details">
				<p><a href="home.php?user_name='.$user_name.'">'.$user_name.'</a></p>';
				if ($login == 'Online') 
				{
					echo '<span><i class="fa fa-circle"></i> Online</span>';
				}
				else
				{
					echo '<span><i class="fa fa-circle-o"></i> Offline</span>';
				}
				'</div>
				</li>';
	}	

?>

