<?php
session_start();
	
	include("../../connection.php");
	include("../../functions.php");

	$UID = $_SESSION['UID'];

	$query = "SELECT * FROM users WHERE UID = '$UID' LIMIT=1";
	$result = mysqli_query($con, $query);
	$user = mysqli_fetch_object($result);

	$user_steam_key = $user->user_steam_key;
	$user_steam_id = $user->user_steam_id;

	# I can place more data here for the other platforms and do similar sending process

	$command = escapeshellcmd("python steam_web_api/core.py $user_steam_key $user_steam_id");
	$output = shell_exec($command);
	echo $output;

?>