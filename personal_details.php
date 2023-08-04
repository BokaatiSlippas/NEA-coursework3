<?php
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

	if(isset($_POST["submit"]))
	{
		if(is_numeric(intval($age)))
		{
			$UID = $_SESSION["UID"];
			$age = $_POST["age"];
			$gender = strtolower($_POST["gender"]);

			if($gender==="male")
			{
				$gen = "1";
			}
			else if($gender==="female")
			{
				$gen = "2";
			}
			else
			{
				$gen = "3";
			}

			$query = "UPDATE users SET age='$age',gender='$gen' WHERE UID='$UID'";
			mysqli_query($con, $query);
			header("Location: index.php");
		}
		else
		{
			echo "Please enter a number for age";
		}
	}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Personal Details</title>
	<link rel="stylesheet" href="css_files/personal_details_style.css">
</head>
<body>
	<div class="box" id="box">
		<span class="borderLine"></span>
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white">Personal Details</div>
			<div class="inputBox">
				<input id="text" type="text" name="age" required="required">
				<span>Age</span>
				<i></i>
			</div>
			<div class="inputBox">
				<input id="text" type="text" name="gender" required="required">
				<span>Gender</span>
				<i></i>
			</div>
			<br><br>
			<div class="links">
				<a href="index.php">Index page</a>
			</div>
			<br><br>
			<input id="button" type="submit" name="submit" value="Submit">
		</form>
	</div>
</body>
</html>