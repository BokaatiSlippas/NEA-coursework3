<?php


session_start();
	
	include("connection.php");
	include("functions.php");

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require "vendor/autoload.php";
	
	if(isset($_POST["signup"]))
	{
		//something was posted
		$user_name = $_POST["user_name"];
		$password = $_POST["password"];
		$re_password = $_POST["re_password"];
		$email = $_POST["email"];

		$mail = new PHPMailer(true);

		if($password === $re_password)
		{
			try{

				$mail->SMTPDebug = 0;

				$mail->isSMTP();

				$mail->Host = "smtp.gmail.com";

				$mail->SMTPAuth = true;

				$mail->Username = "bhuiyanparveena@gmail.com";

				$mail->Password = "gnyjkssedbpeywjn";

				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

				//TCP port to connect to 465
				$mail->Port = 587;

				$mail->setFrom("bhuiyanparveena@gmail.com", "Arik-Bhuiyan-Parveen");

				$mail->addAddress($email, $user_name);

				$mail->isHTML(true);

				$verification_code = substr(number_format(time() * rand(), 0, "", ""), 0, 6);

				$mail->Subject = "Email verification";
				$mail->Body    = "<p>Your verification code is: <b style='font-size: 30px;'>" . $verification_code . "</b></p>";

				$mail->send();

				$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
				if(!empty($user_name) && !empty($password) && !empty($email) && !is_numeric($user_name) && !is_numeric($email))
				{

					//save to database
					$UID = random_num(20);
					$query = "INSERT INTO users (UID,user_name,password, email,verification_code,email_verified_at) VALUES ('$UID','$user_name','$encrypted_password','$email','$verification_code', NULL)";

					mysqli_query($con, $query);

					header("Location: email_verification.php?email=" . $email);
					exit();
				}else
				{

					echo "Please enter some valid information";
				}

			} catch (Exception $e) {
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo} ";
			}
		}
		else
		{
			echo "Passwords are not the same";
		}
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<link rel="stylesheet" href="css_files/signup_style.css">
</head>
<body>
	<div class="box" id="box">
		<span class="borderLine"></span>
		<form method="POST">
			<div style="font-size: 20px;margin: 10px;color: white">Signup</div>
			<div class="inputBox">
				<input id="text" type="text" name="user_name" required="required">
				<span>Username</span>
				<i></i>
			</div>
			<div class="inputBox">
				<input id="email" type="text" name="email" required="required" onkeydown="validation()">
				<span id="email">Email</span>
				<i></i>
			</div>
			<div class="inputBox">
				<input id="text" type="password" name="password" required="required">
				<span>Password</span>
				<i></i>
			</div>
			<div class="inputBox">
				<input id="text" type="password" name="re_password" required="required">
				<span>Confirm Password</span>
				<i></i>
			</div>
			<br><br>
			<div class="links">
				<a href="login.php">Login page</a>
			</div>
			<br>
			<input id="button" type="submit" name="signup" value="Signup">
		</form>
	</div>
</body>
</html>