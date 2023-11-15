<?php
	include ("../UserAccount/ViewAcctController.php");
	include("LogoutController.php");

	// Call for Viewing
	$viewAcctController = new ViewAcctController();
	$acctList = $viewAcctController->getUserAccount();

	// Call for Logout
    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Users</title>
		<style>
		  body 
		  {
			font-family: Arial, sans-serif;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			height: 100vh;
			margin: 0;
		  }

		  h2 
		  {
			margin-bottom: 10px;
			text-align: center;
		  }

		  /* Additional styles for table */
		  .displayAcctResult table 
		  {
			width: 80%;
			border-collapse: collapse;
			margin-bottom: 20px;
			margin-left: auto;
			margin-right: auto;
		  }

		  .displayAcctResult th, .displayAcctResult td 
		  {
			border: 1px solid #ccc;
			padding: 10px;
			text-align: left;
		  }

		  .displayAcctResult th 
		  {
			background-color: #f2f2f2;
		  }

		  .buttons-container 
		  {
			display: flex;
			justify-content: center;
			margin-top: 10px;
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

		  .buttons-container .logOutButton
		  {
			background-color: red;
			color: white;
		  }

		  .buttons-container .go-back-button 
		  {
			background-color: #3498db;
			color: white;
		  }
		</style>
	</head>
	<body>

	<h2>User Account List</h2>

		<div class="displayAcctResult">
			<table>
				<tr>
				<th>User ID</th>
					<th>Name</th>
					<th>Phone</th>
				</tr>
				<tr>
				<?php
					foreach ($acctList as $useracct) 
					{
						echo "<tr>";
						echo "<td>" . $useracct['User_Id'] . "</td>";
						echo "<td>" . $useracct['E_Name'] . "</td>";
						echo "<td>" . $useracct['PhoneNo'] . "</td>";
						echo "</tr>";
					}
				?>
				</tr>
			</table>
		</div>

		<div class="buttons-container">
			<form method="post" name="logout">
				<button class="logOutButton" name="logout">Logout</button>
			</form>
			<button class="go-back-button" onclick="goBack()">Back</button>
		</div>

		<script>
		function goBack() 
		{
			window.location.href = "../UserAccount/AccountFeatures.php";
		}
		</script>

	</body>
</html>