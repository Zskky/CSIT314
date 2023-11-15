<?php
    include("../Staff/ViewBSController.php");
    include("LogoutController.php");

    $vWorkS = new ViewBSController();
    $workSlots = $vWorkS->displayBidStatus();

    // Run Logout
    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>View Pending Work Slots</title>
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

            table 
            {
                border-collapse: collapse;
                width: 80%;
                border: 1px solid #ddd;
                background: white;
            }

            th, td 
            {
                text-align: left;
                padding: 8px;
                border: 1px solid #ddd;
            }

            th 
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
        </style>
    </head>

    <body>
    <h2>View Bid Status</h2>

    <?php
    if (!empty($workSlots)) {
        echo "<table>";
        echo "<tr>
            <th>Employee Name</th>
            <th>Work Name</th>
            <th>Status</th>
        </tr>";

        foreach ($workSlots as $workSlot) {
            echo "<tr>";
            echo "<td>" . $workSlot["E_Name"] . "</td>";
            echo "<td>" . $workSlot["workName"] . "</td>";
            
            if ($workSlot["bidStatus"] == 1)
            {
                $workSlot["bidStatus"] = "Pending Approval";
            }
            else if($workSlot['bidStatus'] == 2)
            {
                $workSlot["bidStatus"] = "Bid Approved";
            }
            else
            {
                $workSlot["bidStatus"] = "Bid Rejected";
            }
            echo "<td>" . $workSlot["bidStatus"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } 
    else 
    {
        echo "No work slots found.";
    }
    ?>

        <div class="buttons-container">
            <form method="post" name="logout">      
                <button class="logOutButton" name="logout">Logout</button>
            </form>
            <button class="go-back-button" onclick="location.href='../Staff.php'">Go Back</button>
        </div>
    </body>
</html>
