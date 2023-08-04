<?php

session_start();

	include("connection.php");
	include("functions.php");

	if(isset($_POST["login"]))
	{
		$user_name = $_POST["user_name"];
		$email = $_POST["email"];
		$password = $_POST["password"];

		if(!empty($user_name) && !empty($password) && !empty($email) && !is_numeric($user_name) && !is_numeric($email))
		{
			
			$query = "SELECT * FROM users WHERE email = '$email' AND user_name = '$user_name' LIMIT 1";
			$result = mysqli_query($con, $query);

		}else
		{

			echo "Please enter some valid information";
		}

		if(mysqli_num_rows($result) === 0)
		{
			die("Email not found.");
		}

		$user = mysqli_fetch_object($result);

		if(!password_verify($password, $user->password))
		{
			die("Password is not correct");
		}

		else if($user->email_verified_at == null)
		{
			die("Please verify your email <a href='email_verification.php?email=" . $email ."'>from here</a>");
		}
		else
		{
			$user_data = mysqli_fetch_assoc($result);
			$_SESSION["UID"] = $user->UID;
			header("Location: index.php");
			die;
			
		}
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="css_files/login_style.css">
</head>
<body>
	<div class="box" id="box">
		<span class="borderLine"></span>
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white">Login</div>
			<div class="inputBox">
				<input id="text" type="text" name="user_name" required="required">
				<span>Username</span>
				<i></i>
			</div>
			<div class="inputBox">
				<input id="text" type="text" name="email" required="required">
				<span>Email</span>
				<i></i>
			</div>
			<div class="inputBox">
				<input id="text" type="password" name="password" required="required">
				<span>Password</span>
				<i></i>
			</div>
			<br><br>
			<div class="links">
				<a href="singup.php">Signup page</a>
				<a href="forgot_password.php" class="float-end">Forgot Password</a>
			</div>
			<br><br>
			<input id="button" type="submit" name="login" value="Login">
		</form>
	</div>
</body>
</html>