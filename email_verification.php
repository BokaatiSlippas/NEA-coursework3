<?php

session_start();

	include("connection.php");
	include("functions.php");

	if(isset($_POST["verify_email"]))
	{
		$email = $_POST["email"];
		$verification_code = $_POST["verification_code"];

		if(!empty($email) && !empty($verification_code))
		{
			$query = "UPDATE users SET email_verified_at = NOW() WHERE email = '$email' AND verification_code = '$verification_code'";
			mysqli_query($con, $query);
			header("Location: login.php");
		}
		else
		{

			echo "Please enter a verification code";
		}

		if(mysqli_affected_rows($con) == 0)
		{
			die("Verification code failed.");
		}

		echo "<p>You can login now.</p>";
		exit();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Email verification</title>
	<link rel="stylesheet" href="css_files/email_verification_style.css">
</head>
<body>
	<div class="box" id="box">
		<span class="borderLine"></span>
		<form method="POST">
			<div style="font-size: 20px;margin: 10px;color: white">Verify email</div>
			<input id="text" type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required="required">
			<div class="inputBox">
				<input id="text" type="text" name="verification_code" required="required">
				<span>Verification code</span>
				<i></i>
			</div>
			<br><br>
			<br><br>
			<input id="button" type="submit" name="verify_email" value="Verify Email">
		</form>
	</div>
</body>
</html>