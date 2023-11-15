<?php
    include("../UserProfile/CreateProController.php");
    include("LogoutController.php");

    //Get Account Names
    $createProController = new CreateProController();
    $staffName = $createProController->displayStaffName();

    // Run Logout
    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User Profile</title>
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

        label 
        {
            margin-right: 10px;
        }

        select, input 
        {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
        }

        button 
        {
            padding: 12px 24px;
            margin: 8px 0;
        }

        .buttons-container 
        {
            display: flex;
            justify-content: space-between;
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

        .input-group 
        {
            display: flex;
            align-items: center;
            margin: 10px 0;
            width: 300px;
            justify-content: space-between;
        }

        .logOutButton
        {
            background-color: red;
            color: white;
        }

        #create
        {
            justify-content: center;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            margin: 0 117px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .buttons-container .go-back-button 
        {
            background-color: #3498db;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Create User Profile</h2>

    <form method="post" action="../UserProfile/CreateProController.php">
        <div class="input-group">
            <label for="empName">Select Employee Name:</label>
            <select id="empName" name="empName" required>
                <?php 
                    foreach ($staffName as $name) : ?>
                    <option value="<?= $name ?>"><?= $name ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="input-group">
            <label for="uniRole">User Role:</label>
            <select id="uniRole" name="uniRole" required>
				<option value="owner">Owner</option>
                <option value="manager">Manager</option>
                <option value="staff">Staff</option>
            </select>
        </div>

        <div class="input-group" id="staffRoleGroup" style="display: none;">
            <label for="staffRole">Staff Role:</label>
            <select id="staffRole" name="staffRole">
                <option value="chef">Chef</option>
                <option value="waiter">Waiter</option>
                <option value="cashier">Cashier</option>
            </select>
        </div>

        <div class="input-group">
            <label for="Password">Password:</label>
            <input type="Password" id="Password" name="Password" placeholder="Input Password" required>
        </div>

        <button type="submit" name="createProf" id="create">Create</button>
    </form>

    <div class="buttons-container" style="text-align: center;">
        <form method="post" name="logout">
			<button class="logOutButton" name="logout">Logout</button>
		</form>
        <button class="go-back-button" onclick="location.href='../UserProfile/ProfileFeatures.php'">Back</button>
	</div>

    <script>
        const userRoleSelect = document.getElementById("uniRole");
        const staffRoleGroup = document.getElementById("staffRoleGroup");
        
        userRoleSelect.addEventListener("change", function() {
            staffRoleGroup.style.display = this.value === "staff" ? "block" : "none";
        });
    </script>
</body>
</html>