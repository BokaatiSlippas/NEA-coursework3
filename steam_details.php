<?php
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

	$UID = $user_data["UID"];

	if(isset($_POST["submit"]))
	{
		$user_steam_key = $_POST["user_steam_key"];
		$user_steam_id = $_POST["user_steam_id"];

		if(!empty($user_steam_key) && !empty($user_steam_id) && is_numeric($user_steam_id) && !is_numeric($user_steam_key))
		{
			$query = "UPDATE users SET user_steam_id = '$user_steam_id', user_steam_key = '$user_steam_key' WHERE UID = '$UID'";
			$result = mysqli_query($con, $query);
			header("Location: index.php");
		}
		else
		{
			echo("Please enter valid details");
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Steam details</title>
	<link rel="stylesheet" href="css_files/personal_details_style.css">
</head>
<body>
	<div class="box" id="box">
		<span class="borderLine"></span>
		<form method="POST">
			<div style="font-size: 20px;margin: 10px;color: white">Steam details</div>
			<div class="inputBox">
				<input id="text" type="text" name="user_steam_key" required="required">
				<span>Steam API Key</span>
				<i></i>
			</div>
			<div class="inputBox">
				<input id="text" type="text" name="user_steam_id" required="required">
				<span>Steam ID</span>
				<i></i>
			</div>
			<br><br>
			<div class="links">
				<a href="index.php">Index page</a>
			</div>
			<br>
			<input id="button" name="submit" type="submit" value="Submit">
		</form>
	</div>
</body>
</html>