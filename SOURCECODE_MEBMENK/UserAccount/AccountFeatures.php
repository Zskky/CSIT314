<?php
    include("LogoutController.php");

    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Account Features</title>
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

		  .UserAcctFeat
		  {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-around; /* Spread the images evenly */
			width: 80%; /* Adjusted width */
			margin: 0 auto; /* Center the images */
		  }

		  .AcctFeat 
		  {
			text-align: center;
			margin: 20px; /* Adjusted margin */
			width: 150px; /* Adjusted image width */
		  }

		  .AcctFeat img 
		  {
			width: 100%;
			height: auto;
			border-radius: 15px;
		  }

		  .AcctFeat p 
		  {
			margin-top: 10px;
		  }

		  .buttons-container 
		  {
			display: flex;
			justify-content: center;
			margin-top: 20px;
		  }

		  .buttons-container button 
		  {
			margin: 10px;
			padding: 10px 20px;
			font-size: 16px;
			border: none;
			cursor: pointer;
			border-radius: 5px;
		  }

		  .buttons-container button.logOutController
		  {
			background-color: red;
			color: white;
		  }

		  .buttons-container button.go-back-button 
		  {
			background-color: #3498db;
			color: white;
		  }
		</style>
	</head>
	
	<body>

		<div class="UserAcctFeat">
			<div class="AcctFeat">
				<a href="../UserAccount/CreateUserAccount.php">
				  <img src="../Pictures/CreateUser.jpg" alt="Create User Image">
				</a>
				<p>Create User</p>
			</div>
		  
			<div class="AcctFeat">
				<a href="../UserAccount/ViewAccounts.php">
					<img src="../Pictures/ViewUser.jpg" alt="View User Image">
				</a>
				<p>View User</p>
			</div>

			<div class="AcctFeat">
				<a href="../UserAccount/SearchAccount.php">
				  <img src="../Pictures/SearchUser.jpg" alt="Search User Image">
				</a>
				<p>Search User</p>
			</div>

			<div class="AcctFeat">
				<a href="../UserAccount/DeleteAccount.php">
				  <img src="../Pictures/DeleteUser.jpg" alt="Delete User Image">
				</a>
				<p>Delete User</p>
			</div>

			<div class="AcctFeat">
				<a href="../UserAccount/UpdateAccount.php">
				  <img src="../Pictures/UpdateUser.jpg" alt="Update User Image">
				</a>
				<p>Update User</p>
			</div>
		</div>

		<div class="buttons-container">
			<form method="post" name="logout">
				<button class="logOutController" name="logout">Logout</button>
			</form>
		  <button class="go-back-button" onclick="goBack()">Back</button>
		</div>

		<script>
		  function goBack() 
		  {
			window.location.href = "../admin.php";
		  }
		</script>

	</body>
</html>

