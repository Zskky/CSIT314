<?php
    include("LogoutController.php");

    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>User Profile Features</title>
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

			.header 
			{
				text-align: center;
				margin-bottom: 30px;
			}

			.profiles 
			{
				display: flex;
				justify-content: space-between;
				margin-bottom: 20px;
			}

			.profile 
			{
				text-align: center;
				width: 150px; /* Increased width for spacing */
				padding: 10px; /* Added padding for spacing */
			}

			.profile button 
			{
				width: 100px;
				height: 100px;
				display: block;
				margin: 0 auto;
				border: none;
				background: none;
				cursor: pointer;
				margin-bottom: 10px; /* Added margin for spacing */
			}

			.profile img 
			{
				width: 100px;
				height: 100px;
			}

			.button-container 
			{
				display: flex;
				justify-content: space-between;
			}

			.button-container button 
			{
				padding: 12px 24px;
				margin: 8px 0;
				font-size: 16px;
				border: none;
				cursor: pointer;
				margin: 10px; /* Added margin for spacing */
				border-radius: 5px;
			}

			.logOutButton
			{
				background-color: Red;
				color: White;
			}

			.button-container .go-back-button 
            {
              background-color: #3498db;
              color: white;
            }
		</style>
	</head>

	<body>
		<div class="header">
			<h2>User Profile Features</h2>
		</div>

		<div class="profiles">
			<div class="profile">
				<button style="margin: 10px;" onclick="location.href='CreateProfile.php'"><img src="../Pictures/create_profile_image.jpg" alt="Create Profile"></button>
				<p>Create Profile</p>
			</div>
			<div class="profile">
				<button style="margin: 10px;" onclick="location.href='ViewProfile.php'"><img src="../Pictures/view_profile_image.jpg" alt="View Profile"></button>
				<p>View Profile</p>
			</div>
			
			<div class="profile">
				<button style="margin: 10px;" onclick="location.href='SearchProfile.php'"><img src="../Pictures/search_profile_image.jpg" alt="Search Profile"></button>
				<p>Search Profile</p>
			</div>
			
			<div class="profile">
				<button style="margin: 10px;" onclick="location.href='UpdateProfile.php'"><img src="../Pictures/update_profile_image.jpg" alt="Update Profile"></button>
				<p>Update Profile</p>
			</div>
			<div class="profile">
				<button style="margin: 10px;" onclick="location.href='DeleteProfile.php'"><img src="../Pictures/delete_profile_image.jpg" alt="Delete Profile"></button>
				<p>Delete Profile</p>
			</div>
		</div>

		<div class="button-container">
			<form method="post" name="logout">
				<button class="logOutButton" name="logout">Logout</button>
			</form>
			<button class="go-back-button" onclick="location.href='../admin.php'">Back</button>
		</div>
	</body>

</html>


