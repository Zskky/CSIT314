<?php
    include("LogoutController.php");

    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Page</title>
		<style>
		  body 
		  {
			font-family: Arial, sans-serif;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			height: 100vh;
			margin: 0;
		  }

		  .container 
		  {
			display: flex;
			justify-content: space-between;
			width: 80%;
			margin: 20px auto;
		  }

		  .AcctFeat 
		  {
			text-align: center;
			margin: 0 10px;
		  }

		  .AcctFeat img 
		  {
			width: 300px;
			height: 300px;
			border-radius: 50%;
			display: block;
			margin: 0 auto;
		  }

		  .AcctFeat p 
		  {
			margin-top: 10px;
		  }

		  .logOutController 
		  {
			margin: 10px; 
			text-align: center;
			background-color: red;
			color: white;
			padding: 2.5px 10px;
			border: none;
			cursor: pointer;
			border-radius: 5px;
		  }

		  .logOutController:hover 
		  {
			background-color: #2980b9;
		  }

		  .UserAcctFeat 
		  {
			display: flex;
			justify-content: center;
			width: 100%;
		  }

		  .UserAcctFeat .AcctFeat 
		  {
			flex: 1;
			max-width: 35%; /* Ensure each container takes half width */
		  }
		</style>
	</head>
	
	<body>

		<div class="UserAcctFeat">
		<div class="AcctFeat">
			<a href="UserAccount/AccountFeatures.php">
			  <img src="Pictures/Account.jpg" alt="Account Image">
			</a>
			<p>User Account Feature</p>
		  </div>  
		
			<div class="AcctFeat">
				<a href="UserProfile/ProfileFeatures.php">
			  		<img src="Pictures/Profile.jpg" alt="Profile Image">
				</a>
			<p>User Profile Feature</p>
		  </div>
		</div>

		<div class="logOutController">
			<form method="post" name="logout">
				<button class="logOutController" name="logout">Logout</button>
			</form>
		</div>

	</body>
</html>
