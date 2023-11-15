<?php
    include("../Staff/ViewAWController.php");
    include("LogoutController.php");

    $vWorkS = new ViewAWController();
    $workSlots = $vWorkS->displayAWS();
    //$vWorks->retProInfo();
    $selectedWSId = $vWorkS->wsInfo();
    $vWorkS->bidUpdate();

    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Available Work Slots</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .bidForm
        {
            padding: 50px;
            border: 1px solid black;
            background-color: white;
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
            border-radius: 10px;
        }

        h2
        {
            text-align: center;
            margin-bottom: 20px;
        }

        .SlotT
        {
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 20px;
        }

        table 
        {
            border-collapse: collapse;
            align-items: center;
            justify-content: center;
            width: 100%;
            border: 1px solid black;
            margin-bottom: 20pax;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .buttons-container 
        {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .buttons-container button {
            margin: 10px;
            margin-top: -5px;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .buttons-container button.logOutButton {
            background-color: red;
            color: white;
        }

        .buttons-container button.go-back-button {
            background-color: #3498db;
            color: white;
        }

        .updateForm input[type="text"] 
        {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        #bid
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
    </style>
</head>

<body>
    <div class="bidForm">
        <h2>View Available Work Slots</h2>
            <div class="SlotT">
                <?php
                if (!empty($workSlots)) {
                    echo "<table>";
                    echo "<tr>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Work Date</th>
                        <th>Unirole</th>
                        <th>Staff Role</th>
                        <th>Status</th>
                    </tr>";

                    foreach ($workSlots as $workSlot) {
                        echo "<tr>";
                        echo "<td>" . $workSlot["startTime"] . "</td>";
                        echo "<td>" . $workSlot["endTime"] . "</td>";
                        echo "<td>" . $workSlot["workDate"] . "</td>";
                        echo "<td>" . $workSlot["uniRole"] . "</td>";
                        echo "<td>" . $workSlot["staffRole"] . "</td>";
                        echo "<td>" . $workSlot["status"] . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "No work slots found.";
                }
                ?>
            </div>

            <form method="post" class="updateForm">
                <div class="input-group">
                    <label for="wsDropdown" id="select">Select slot:</label>
                    <select name="wsDropdown" id="wsDropdown">
                        <option value="">Please select a slot</option>
                        <?php foreach ($workSlots as $workslot) : ?>
                            <option value="<?= $workslot['wsId'] ?>" <?= $workslot['wsId'] == $selectedWSId ? 'selected' : '' ?>>
                                <?= $workslot['workName'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" name="bidWS" id="bid">Bid</button>  
            </form>

            <div class="buttons-container">
                <form method="post" name="logout" >
                        <button class="logOutButton" name="logout">Logout</button>
                </form>
                <button class="go-back-button" onclick="location.href='../Staff.php'">Go Back</button>
            </div>
    </div>   
    </body>
</html>
