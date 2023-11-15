<?php
    include("../Owner/ViewWSController.php");
    include("LogoutController.php");

    // Run Checking slots
    $bWorkS = new ViewWSController();
    $cfmSlots = $bWorkS->displayWS();

    // Run Logout
    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Work Slots</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        h2
        {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            border: 1px solid #ddd;
            background-color: white;
            margin-left: auto;
            margin-right: auto;
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
            border-radius: 5px;
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
<h2>View Work Slots</h2>

<?php
if (!empty($cfmSlots)) {
    echo "<table>";
    echo "<tr>
        <th>Employee Name</th>
        <th>Work Details</th>
        <th>Status</th>
        </tr>";

    foreach ($cfmSlots as $cSlot) {
        echo "<tr>";
        echo "<td>" . $cSlot["E_Name"] . "</td>";
        echo "<td>" . $cSlot["workName"] . "</td>";
        echo "<td>" . $cSlot["bidStatus"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No work slots found.";
}
?>

<div class="buttons-container">
    <form method="post" name="logout">
        <button class="logOutButton" name="logout">Logout</button>
    </form>
    <button class="go-back-button" onclick="location.href='../owner.php'">Go Back</button>
</div>
</body>
</html>
