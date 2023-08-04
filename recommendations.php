<?php

session_start();

	include("connection.php");
	include("functions.php");

	if(isset($_POST["done"]))
	{

		$daily_recommendations_num = "SELECT daily_recommendations_num FROM users WHERE UID='$UID'"

		if(intval($recommendations_num) <= intval($daily_recommendations_num))
		{
			$recommendations_num = $_POST["recommendations_btn"];

			$UID = $_SESSION['UID'];
			$query = "INSERT INTO sync_requests (UID,complete,recommendations_num) VALUES ('$UID','0','$recommendations_num')";

			$result = mysqli_query($con, $query);

			#The request logic here, maybe place query below for deleting within the request logic file

			$daily_recommendations_num = $daily_recommendations_num - $recommendations_num;

			$query = "UPDATE users SET daily_recommendations_num='$daily_recommendations_num' WHERE UID='UID'";

			$result = mysqli_query($con, $query);
		}
		else
		{
			echo("Maximum 5 recommendations a day OR daily limit reached");
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Recommendations</title>
	<link rel="stylesheet" href="css_files/recommendations_style.css">
</head>
<body>
	<div class="box" id="box">
		<span class="borderLine"></span>
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white">Recommendations</div>
			<div class="inputBox">
				<input id="text" type="number" name="recommendations_btn" required="required">
				<span>Number of recommendations</span>
				<i></i>
			</div>
			<br><br>
			<div class="links">
				<a href="index.php">Index page</a>
			</div>
			<br><br>
			<input id="button" type="submit" name="done" value="Done">
		</form>
	</div>
</body>
</html>