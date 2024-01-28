<?php
	include 'assits/include/connection.php';

	if (isset($_POST['sign_up'])) 
	{
		$name = htmlentities(mysqli_real_escape_string($con, $_POST['user_name']));
		$email = htmlentities(mysqli_real_escape_string($con, $_POST['user_email']));
		$pass = htmlentities(mysqli_real_escape_string($con, $_POST['user_pass']));
		$country = htmlentities(mysqli_real_escape_string($con, $_POST['user_country']));
		$gender = htmlentities(mysqli_real_escape_string($con, $_POST['user_gender']));
		$rand = rand(1,2);

		if ($name == "") 
		{
			echo "<script> alert('We can not verify your name') </script>";
		}
		if (strlen($pass) < 8 ) 
		{
			echo "<script> alert('Password should be minimum 8 characters!') </script>";
			exit();
		}

		$check_email = "SELECT * FROM users WHERE user_email = '$email' ";
		$run_email = mysqli_query($con, $check_email);
		$check = mysqli_num_rows($run_email);

		if ($check > 0) 
		{
			echo "<script> alert('Email already exist, Please try again!') </script>";
			echo "<script> window.open('signup.php', '_self') </script>";
		}

		if ($rand == 1) 
		{
			$profile_pic = "assits/img/img1.jpg";
		}
		elseif($rand == 2)
		{
			$profile_pic = "assits/img/img2.png";	
		}

		$insert = "INSERT INTO users (user_name, user_email, user_pass, user_profile, user_country, user_gender) VALUES ('$name', '$email', '$pass', '$profile_pic', '$country', '$gender')";
		$query = mysqli_query($con, $insert);

		if ($query) 
		{
			echo "<script> alert('Congratulations $name, your account has been created successfully!') </script>";
			echo "<script> window.open('signin.php', '_self') </script>";
		}
		else
		{
			echo "<script> alert('Registration failed, try again!') </script>";
			echo "<script> window.open('signup.php', '_self') </script>";
		}
	}
?>

