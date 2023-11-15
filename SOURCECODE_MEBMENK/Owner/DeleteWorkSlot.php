<?php
    include ("../Owner/DeleteWSController.php");
    include("LogoutController.php");

    // Run Delete
    $delWS = new DeleteWSController();
    $workNames = $delWS-> displayWorkNames();
    $delWS -> handleDelWS();

    // Run logout
    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete Work Slot</title>
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

        h2
        {
            text-align: center;
        }

        .form-container 
        {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-container label 
        {
            font-weight: bold;
        }

        .form-container select, .form-container button 
        {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
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
    </style>
</head>

<body>
<div class="form-container">
    <h2>Delete Work Slot</h2>
    <form method="post" action="">
        <label for="workName">Select Work Name to Delete:</label>
        <select name="wNdropdown" required>
            <?php
                foreach ($workNames as $name) 
                {
                    $selected = ($_POST['wNdropdown'] == $name) ? 'selected="selected"' : '';
                    echo '<option value="' . $name . '" ' . $selected . '>' . $name . '</option>';
                }
            ?>
        </select>

        <button type="submit" name="delWS">Delete Work Slot</button>
    </form>
</div>
<div class="buttons-container">
    <form method="post" name="logout">
            <button class="logOutButton" name="logout">Logout</button>
    </form>
            <button class="go-back-button" onclick="location.href='../owner.php'">Go Back</button>
</div>
</body>
</html>
