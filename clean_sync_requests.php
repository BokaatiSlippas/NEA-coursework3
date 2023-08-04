<?php

session_start();

	include("connection.php");
	include("functions.php");

	$query = "DELETE FROM users WHERE complete!='0'";
	mysqli_query($con, $query);

	#I may use other codes such as 2 for complete if request is not possible

?>