<?php
    include("LogoutController.php");

    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manager Features</title>
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
            background-color: #f0f0f0;
        }

        .UserAcctFeat 
        {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            width: 80%;
            margin: 0 auto;
        }

        .AcctFeat 
        {
            text-align: center;
            margin: 20px;
            width: 220px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }

        .AcctFeat:hover 
        {
            transform: scale(1.05);
        }

        .bigButton 
        {
            padding: 12px 24px;
            font-size: 18px;
            background-color: #fff; /* White background */
            color: #000; /* Black text */
            border: 2px solid #000; /* Black border */
            cursor: pointer;
            border-radius: 5px;
        }

        .buttons-container 
        {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .buttons-container button.logOutButton 
        {
            background-color: #fff; /* White background */
            color: #000; /* Black text */
            padding: 12px 24px;
            border: 2px solid #000; /* Black border */
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>

    <body>

        <div class="UserAcctFeat">
            <div class="AcctFeat">
                <a href="Manager/BidApproval.php" class="bigButton">Bid Approval</a>
            </div>

            <div class="AcctFeat">
                <a href="Manager/ViewMUnassignSlot.php" class="bigButton">Unassigned Slot</a>
            </div>

            <div class="AcctFeat">
                <a href="Manager/ViewMWorkSlot.php" class="bigButton">View Workslot</a>
            </div>

            <div class="AcctFeat">
                <a href="Manager/ManageUnassignedWorkslot.php" class="bigButton">Assign Workslot</a>
            </div>

        </div>

        <div class="buttons-container">
            <form method="post" name="logout">
                <button class="logOutButton" name="logout">Logout</button>
            </form>
        </div>

    </body>
</html>