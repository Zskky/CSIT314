<?php
    include("../UserAccount/UpdateAcctController.php");
    include("LogoutController.php");

    $updateAcctController = new UpdateAcctController();

    // To call for data of drop down and details
    $acctList = $updateAcctController->displayAcctList();
    $selectedUserId = $updateAcctController->getAcctInfo();

    // Handle form submission
    $updateAcctController->handleUpdate();

    // Run Logout
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
            display: flex;
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

        .dob 
        {
            margin-bottom: 20px;
        }

        .selectForm
        {
            margin-bottom: 10px;
        }

        .details
        {
            margin-bottom: 10px
        }
    </style>
</head>

<body>
    <h2>Update User</h2>

    <form method="post" class="updateForm">
        <div class = "selectForm">
            <label for="acctDropdown">Select User:</label>
            <select name="acctDropdown" id="acctDropdown">
                <option value="">Please select a user</option>
                <?php foreach ($acctList as $useracct) : ?>
                    <option value="<?= $useracct['User_Id'] ?>" <?= $useracct['User_Id'] == $selectedUserId ? 'selected' : '' ?>>
                        <?= $useracct['E_Name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="details">
            <label for="new_date_of_birth" name="dob">Date of Birth (yyyy--mm--dd):</label>
            <input type="text" name="new_date_of_birth" id="new_date_of_birth" placeholder="yyyy--mm--dd" required
               value="<?= isset($selectedUserInfo['D_O_B']) ? $selectedUserInfo['D_O_B'] : '' ?>">
        </div>

        <div class="details">
            <label for="new_phone_no">Phone Number:</label>
            <input type="text" name="new_phone_no" id="new_phone_no" required
                value="<?= isset($selectedUserInfo['PhoneNo']) ? $selectedUserInfo['PhoneNo'] : '' ?>">
        </div>

        <div class="details">
        <label for="new_user_email">Email:</label>
            <input type="text" name="new_user_email" id="new_user_email" required
               value="<?= isset($selectedUserInfo['Email']) ? $selectedUserInfo['Email'] : '' ?>">
        </div>

        <button type="submit" name="acctUpdate" class = "update">Update</button>
    </form>

    <div class="buttons-container">
        <form method="post" name="logout">
			<button class="logOutButton" name="logout">Logout</button>
		</form>
        <button class="go-back-button" onclick="location.href='../UserAccount/AccountFeatures.php'">Back</button>
    </div>
</body>

</html>
