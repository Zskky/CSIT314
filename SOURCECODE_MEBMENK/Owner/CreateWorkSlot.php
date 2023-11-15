<?php
    include('../Owner/CreateWSController.php');
    include("LogoutController.php");

    // Add a workslot
    $cWorkSlot = new CreateWSController();
    $cWorkSlot->createWorkSlot();

    // Run Logout
    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Work Slot</title>
    <style>
        body 
        {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        h2
        {
            text-align: center;
        }

        .form-container
        {
            padding: 50px;
            border: 1px solid black;
            background-color: white;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
            border-radius: 10px;
        }

        .form-container label 
        {
            font-weight: bold;
            margin-top: 20px;
        }

        .form-container input[type="text"],
        .form-container select 
        {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }

        .staff-role-container 
        {
            display: none;
        }

        .success-message 
        {
            color: green;
            font-weight: bold;
            text-align: center;
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
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
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

        #cSlot
        {
            background-color: #3498db;
            color: white;
            padding: 10px 30px;
            border: none;
            cursor: pointer;
            margin: 0 250px;
            margin-top: 20px;
            border-radius: 5px;
            display: inline-flex;
        }

        #cSlot button
        {
            font-size: 16px;
            display: flex;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Create Work Slot</h2>
        <form method="post">
            <label for="startTime">Start Time (HH:MM:SS):</label>
            <input type="text" name="startTime" placeholder="Enter start time (HH:MM:SS)" required>

            <label for="endTime">End Time (HH:MM:SS):</label>
            <input type="text" name="endTime" placeholder="Enter end time (HH:MM:SS)" required>

            <label for="uniRole">Unirole:</label>
            <select name="uniRole" id="uniRoleSelect" required>
                <option value="owner">Owner</option>
                <option value="manager">Manager</option>
                <option value="staff">Staff</option>
            </select>

            <div class="staff-role-container">
                <label for="staffRole">Staff Role:</label>
                <select name="staffRole">
                    <option value="chef">Chef</option>
                    <option value="waiter">Waiter</option>
                    <option value="cashier">Cashier</option>
                </select>
            </div>

            <div>
                <label for="workDate">Work Date (YYYY-MM-DD):</label>
                <input type="text" name="workDate" placeholder="Enter work date (YYYY-MM-DD)" required>
            </div>
            
            <div>
                <label for="sBid">Status:</label>
                <input type="text" name="sBid" value = "No Bids" readonly="true">
            </div>

            <button type="submit" name="cWorkslot" id="cSlot">Create Work Slot</button>
        </form>

        <script>
            document.getElementById('uniRoleSelect').addEventListener('change', function() {
                var staffRoleContainer = document.querySelector('.staff-role-container');

                if (this.value === 'staff') {
                    staffRoleContainer.style.display = 'block';
                } else {
                    staffRoleContainer.style.display = 'none';
                }
            });
        </script>
    </div>

    <div class="buttons-container">
        <form method="post" name="logout">  
            <button class="logOutButton" name="logout">Logout</button>
        </form>
        <button class="go-back-button" onclick="location.href='../owner.php'">Back</button>
    </div>
</body>
</html>


