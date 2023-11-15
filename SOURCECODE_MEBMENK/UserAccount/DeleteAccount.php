<?php
    include("../UserAccount/DeleteAcctController.php");
	include("LogoutController.php");

	// Retrieve the Info
    $deleteAcctController = new DeleteAcctController();
    $acctList = $deleteAcctController->displayAcctList();

	// Delete the account
	$deleteAcctController->deleteHandle();

	// Run Logout
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
			margin-bottom: 20px;
		  }

		  /* Additional styles for table */
		  .acctList table 
		  {
			width: 80%;
			border-collapse: collapse;
			margin-bottom: 20px;
			margin-left: auto;
			margin-right: auto;
		  }

		  .acctList th, .acctList td 
		  {
			border: 1px solid #ccc;
			padding: 10px;
			text-align: left;
		  }

		  .acctList th 
		  {
			background-color: #f2f2f2;
		  }

		  .buttons-container 
		  {
			display: flex;
			justify-content: center;
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

		<center><h2>User List</h2></center>

		<div class="acctList">
		  <table>
			<tr>
			  <th>User ID</th>
			  <th>Name</th>
			  <th>Phone</th>
			  <th>Action</th> <!-- Added action column -->
			</tr>
			<?php
				foreach ($acctList as $useracct) 
				{
					echo "<tr>";
					echo "<td>" . $useracct['User_Id'] . "</td>";
					echo "<td>" . $useracct['E_Name'] . "</td>";
					echo "<td>" . $useracct['PhoneNo'] . "</td>";
					echo "<td>";
					echo "<form method='post'>";
					echo "<input type='hidden' name='delete_user' value='" . $useracct['User_Id'] . "'>";
					echo "<button type='submit' name=deleteButton>Delete</button>";
					echo "</form>";
					echo "</td>";
					echo "</tr>";
				}
			?>
		  </table>
		</div>

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
