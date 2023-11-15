<?php
    include ("../UserProfile/SearchProController.php");
	include("LogoutController.php");

	// Run Search
    $searchProController = new SearchProController();
	$searchResults = $searchProController-> displaySearch(); 

	// Run Logout
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
			width: 120%;
			border-collapse: collapse;
			margin-bottom: 20px;
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

		  .buttons-container .logOutButton 
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

		<h2>Search Profile Users</h2>

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
							echo "<th>Employee Name</th>";
							echo "<th>Password</th>";
							echo "<th>Appointment</th>";
							echo "<th>Role</th>";
						echo "</tr>";
							foreach ($searchResults as $uniprofile) 
							{
								echo "<tr>";
									echo "<td>" . $uniprofile['User_Id'] . "</td>";
									echo "<td>" . $uniprofile['E_Name'] . "</td>";
									echo "<td>" . $uniprofile['Pass'] . "</td>";
									echo "<td>" . $uniprofile['uniRole'] . "</td>";
									echo "<td>" . $uniprofile['staffRole'] . "</td>";
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
			window.location.href = "../UserProfile/ProfileFeatures.php";
		  }
		</script>
	</body>
</html>