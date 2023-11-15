<?php
    include("../UserProfile/UpdateProController.php");
	include("LogoutController.php");

    $updateProController = new UpdateProController();

	// Run Retrival of information
    $proList = $updateProController->displayProList();
	$selectedUserId = $updateProController->acctInfo();

    // Handle form submission
    $updateProController->handleUpdate();

	$logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Update User</title>
		<style>
			body 
			{
				font-family: Arial, sans-serif;
				margin: 0;
				padding: 0;
				height: 100vh;
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
			}

			h2 
			{
				text-align: center;
				margin-bottom: 20px;
			}

			select
			{
				width: 100%;
				padding: 5px;
				margin: 5px 0;
			}

			input
			{
				width: 80%;
				padding: 5px;
				margin: 5px 0;
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

			.updateForm input[type="text"] 
			{
				width: 100%;
				padding: 10px;
				margin-bottom: 10px;
			}

			.input-group
			{
				margin-bottom: 10px;
			}

			.update
			{
				background-color: #3498db;
				color: white;
				padding: 10px 20px;
				font-size: 16px;
				border: none;
				cursor: pointer;
				margin: 0 175px;
				margin-bottom: 10px;
				border-radius: 5px;
			}

		</style>
	</head>
	
	<body>
		<h2>Update User Profile</h2>

		<form method="post" class="updateForm">
			<div class="input-group">
				<label for="acctDropdown">Select User:</label>
				<select name="acctDropdown" id="acctDropdown">
					<option value="">Please select a user</option>
					<?php foreach ($proList as $uniprofile) : ?>
						<option value="<?= $uniprofile['User_Id'] ?>" <?= $uniprofile['User_Id'] == $selectedUserId ? 'selected' : '' ?>>
							<?= $uniprofile['E_Name'] ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			
			<div class="input-group">
				<label for="newPass" name="newPass">New Password</label>
				<input type="text" name="newPass" id="newPass" placeholder="Enter new password" required
					value="<?= isset($selectedUserInfo['pass']) ? $selectedUserInfo['pass'] : '' ?>">
			</div>

			<div class="input-group">
				<label for="newUniRole">User Role:</label>
				<select id="newUniRole" name="newUniRole" required>
					<option value="owner">Owner</option>
					<option value="manager">Manager</option>
					<option value="staff">Staff</option>
				</select>
        	</div>

			<div class="input-group" id="staffRoleGroup" style="display: none;">
				<label for="newStaffRole">Staff Role:</label>
				<select id="newStaffRole" name="newStaffRole">
					<option value="chef">Chef</option>
					<option value="waiter">Waiter</option>
					<option value="cashier">Cashier</option>
				</select>
			</div>

			<button type="submit" name="updateProfile" class="update">Update</button>
		</form>

		<div class="buttons-container">
			<form method="post" name="logout">
				<button class="logOutButton" name="logout">Logout</button>
			</form>
			<button class="go-back-button" onclick="location.href='../UserProfile/ProfileFeatures.php'">Back</button>
		</div>

		<script>
			const userRoleSelect = document.getElementById("newUniRole");
			const staffRoleGroup = document.getElementById("staffRoleGroup");
			
			userRoleSelect.addEventListener("change", function() 
			{
				staffRoleGroup.style.display = this.value === "staff" ? "block" : "none";
			});
   		 </script>
	</body>
</html>