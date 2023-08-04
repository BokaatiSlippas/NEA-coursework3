<?php
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  	<head>
    	<meta charset="UTF-8">
    	<title>Arik's Games Recommender</title>
		<link rel="stylesheet" href="css_files/index_style.css">
    	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     		<meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  	<div class="sidebar close">
    	<div class="logo-details">
      	<i class='bx bxl-medium-square'></i>
      	<span class="logo_name">Menu</span>
    	</div>
    	<ul class="nav-links">
	      	<li>
	        	<a href="#">
	          		<i class='bx bx-grid-alt' ></i>
    	      		<span class="link_name">Dashboard</span>
        		</a>
        		<ul class="sub-menu blank">
          			<li><a class="link_name" href="#">Dashboard</a></li>
	        	</ul>
    	  	</li>
      		<li>
        		<div class="icon-link">
          			<a href="#">
            			<i class='bx bx-collection' ></i>
            			<span class="link_name">Platforms</span>
          			</a>
          			<i class='bx bxs-chevron-down arrow' ></i>
        		</div>
        		<ul class="sub-menu">
          			<li><a class="link_name" href="#">Platforms</a></li>
          			<li><a href="steam_details.php">Steam</a></li>
          			<li><a href="#">Playstation</a></li>
          			<li><a href="#">Xbox</a></li>
          			<li><a href="#">Nintendo Switch</a></li>
          			<li><a href="#">Epic games</a></li>
        		</ul>
      		</li>
      		<li>
        		<a href="#">
          			<i class='bx bx-list-ol'></i>
          			<span class="link_name">Games list</span>
        		</a>
        		<ul class="sub-menu blank">
          			<li><a class="link_name" href="games_list.php">Games-list</a></li>
        		</ul>
      		</li>
      		<li>
        		<a href="#">
          			<i class='bx bx-search-alt'></i>
          			<span class="link_name">Search Games</span>
        		</a>
        		<ul class="sub-menu blank">
          			<li><a class="link_name" href="search_games.php">Search Games</a></li>
        		</ul>
      		</li>
      		<li>
        		<a href="recommendations.php">
          			<i class='bx bx-happy-heart-eyes'></i>
          			<span class="link_name">Recommendations</span>
        		</a>
        		<ul class="sub-menu blank">
          			<li><a class="link_name" href="recommendations.php">Recommendations</a></li>
        		</ul>
      		</li>
      		<li>
        		<div class="icon-link">
        	  		<a href="#">
            			<i class='bx bx-book-alt' ></i>
            			<span class="link_name">Posts</span>
          			</a>
          			<i class='bx bxs-chevron-down arrow' ></i>
        		</div>
        		<ul class="sub-menu">
          			<li><a class="link_name" href="#">Posts</a></li>
          			<li><a href="#">My posts</a></li>
          			<li><a href="#">All posts</a></li>
        		</ul>
      		</li>
      		<li>
        		<div class="icon-link">
          			<a href="#">
            			<i class='bx bx-cog'></i>
            			<span class="link_name">Settings</span>
          			</a>
          			<i class='bx bxs-chevron-down arrow' ></i>
        		</div>
        		<ul class="sub-menu">
          			<li><a class="link_name" href="#">Settings</a></li>
          			<li><a href="#">Account settings</a></li>
          			<li><a href="#">Accessability settings</a></li>
          			<li><a href="personal_details.php">Personal Details</a></li>
          			<li><a href="logout.php">Logout</a></li>
        		</ul>
      		</li>
      		<li>
      			<a href="#">
          			<i class='bx bxs-moon'></i>
          			<span class="link_name" id="mode_toggle">Switch Modes</span>
        		</a>
        		<ul class="sub-menu blank">
          			<li><a class="link_name" href="#" id="mode_toggle">Switch Modes</a></li>
        		</ul>
      		</li>
		</ul>
  	</div>
  	<section class="home-section">
  		<div class="home-content">
  			<i class="bx bx-menu"></i>
  			<span class="text">Sidebar</span>
  		</div>
  	</section>
  	<script>
  	let arrow = document.querySelectorAll(".arrow");
  	for (var i = 0; i < arrow.length; i++) {
    		arrow[i].addEventListener("click", (e)=>{
   	let arrowParent = e.target.parentElement.parentElement;
   	arrowParent.classList.toggle("showMenu");
    		});
  	}


  	let sidebar = document.querySelector(".sidebar");
  	let sidebarBtn = document.querySelector(".bx-menu");
  	console.log(sidebarBtn);
  	sidebarBtn.addEventListener("click", ()=>{
    	sidebar.classList.toggle("close");
  	});

  	let DarkMode = localStorage.getItem("DarkMode");

  	if (DarkMode === null) {
  		DarkMode = "false";
  	}

  	toggleMode(DarkMode);

  	function toggleMode(DarkMode) {
  		const body = document.body;

  		if (DarkMode === "true"){
    		body.classList.add("Dark_mode");
  		}else{
    		body.classList.remove("Dark_mode");
  		}
  	}

  	const toggleButton = document.getElementById("mode_toggle");
  	toggleButton.addEventListener("click", () => {
  		DarkMode = (DarkMode === "false") ? "true" : "false";
  		localStorage.setItem("DarkMode", DarkMode)
  		toggleMode(DarkMode)
  	})

  	</script>
</body>
</html>