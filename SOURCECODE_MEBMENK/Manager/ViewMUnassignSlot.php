<?php
    include("../Manager/ViewMUAWSController.php");

    $bWorkS = new ViewMUAWSController();
    $openSlots = $bWorkS->displayWS();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Work Slots</title>
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

        table {
            border-collapse: collapse;
            width: 80%;
            border: 1px solid #ddd;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .buttons-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .buttons-container button {
            margin: 10px;
            padding: 10px 20px;
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
    </style>
</head>

<body>
<h2>Unassigned Slots</h2>

<?php
    echo "<table>";
    echo "<tr>
        <th>Work Details</th>
        <th>Status</th>
        </tr>";

    foreach ($openSlots as $openSlot) {
        echo "<tr>";
        echo "<td>" . $openSlot["workName"] . "</td>";
        echo "<td>" . $openSlot["sBid"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
?>

<div class="buttons-container">
    <button class="logOutButton" onclick="location.href='../LoginPage.html'">Logout</button>
    <button class="go-back-button" onclick="location.href='../manager.php'">Go Back</button>
</div>
</body>
</html>
