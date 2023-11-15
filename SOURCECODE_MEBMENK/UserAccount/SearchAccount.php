<?php
    include ("../UserAccount/SearchAcctController.php");
	include("LogoutController.php");
	
	// Search Accounts
    $searchAcctController = new SearchAcctController();
	$searchResults = $searchAcctController->handleSearch();

	// Reset When Logout
    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search Users</title>
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
			margin-bottom: 20px;
			text-align: center;
		  }

		  .searchForm 
		  {
			margin-bottom: 20px;
			margin-left: auto;
			margin-right: auto;
			justify-content: center;
			align-items: center;
			display: flex;
		  }

		  .searchResults table 
		  {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: auto;
			align-items: center;
			margin-left: auto;
			margin-right: auto;
			width: 85%;
		  }

		  .searchResults th, .searchResults td 
		  {
			border: 1px solid #ccc;
			padding: 10px;
			text-align: left;
		  }

		  .searchResultss th 
		  {
			background-color: #f2f2f2;
		  }
		  
		  .buttons-container 
		  {
			display: flex;
			justify-content: center;
			margin-top: 5px;
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

		  .buttons-container button.logOutButton
		  {
			background-color: red;
			color: white;
		  }

		  .buttons-container button.go-back-button 
		  {
			background-color: #3498db;
			color: white;
		  }
		  
		  .displayResult
		  {
			text-align: center;
		  }
		</style>
	</head>
	
	<body>
		<h2>Search Users</h2>

		<div class="searchForm">
		  <form method="post">
			<label for="E_Name">Employee Name:</label>

			<input type="text" id="E_Name" name="E_Name" required>

			<button type="submit" name="search">Search</button>
		  </form>
		</div>

		<div class ="displayResult">
			<?php
				if (isset($_POST["search"])) 
				{
					if (count($searchResults) > 0) 
					{
						echo "<div class='searchResults'>";
							echo "<table>";
							echo "<tr>";
								echo "<th>User ID</th>";
								echo "<th>Name</th>";
								echo "<th>Date of Birth</th>";
								echo "<th>Phone</th>";
								echo "<th>Email</th>";
							echo "</tr>";
								foreach ($searchResults as $useracct) 
								{
									echo "<tr>";
										echo "<td>" . $useracct['User_Id'] . "</td>";
										echo "<td>" . $useracct['E_Name'] . "</td>";
										echo "<td>" . $useracct['D_O_B'] . "</td>";
										echo "<td>" . $useracct['PhoneNo'] . "</td>";
										echo "<td>" . $useracct['Email'] . "</td>";
									echo "</tr>";
								}
							echo "</table>";
						echo "</div>";
					} 
					else 
					{
						echo "<div>No results found.</div>";
					}
				}
			?>
		</div >

		<div class="buttons-container">
			<form method="post" name="logout">
				<button class="logOutButton" name="logout">Logout</button>
			</form>
			<button class="go-back-button" onclick="goBack()">Back</button>
		</div>

		<script>
		  function goBack() {
			window.location.href = "../UserAccount/AccountFeatures.php";
		  }
		</script>
	</body>
</html>