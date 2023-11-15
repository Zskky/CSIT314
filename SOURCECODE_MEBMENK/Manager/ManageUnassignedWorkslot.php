<?php
    include("../Manager/ManageUAWSController.php");
	include("LogoutController.php");

    $mWSc = new ManageUAWSController();

	// Run Retrival of information
    //WorkList
    $uAList = $mWSc->displayWSList();
	$selectedUAId = $mWSc -> getUnassignedWSId();
	$selectedUAInfo = $mWSc->getUnassignedBidInfo($selectedUAId);
    
    //Employee
    $empName = $mWSc->displayEmp();
    $selectedEmpId = $mWSc -> getEmpId();
	$selectedEmpInfo = $mWSc->getEmpInfo($selectedEmpId);

    // Handle form submission
    $mWSc->handleUpdate();

    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Assign WorkSlot</title>
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
				background-color: #f0f0f0;
			}

			h2 
			{
				text-align: center;
				margin-bottom: 20px;
			}

			.updateForm
			{
				padding: 50px;
				border: 1px solid black;
				background-color: white;
				margin-left: auto;
				margin-right: auto;
				margin-top: 50px;
				border-radius: 10px;
			}

			select, input 
			{
				width: 100%;
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

			.updateForm button 
			{
				background-color: #3498db;
				color: white;
				padding: 10px 20px;
				border: none;
				cursor: pointer;
			}

			#con
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

	<form method="post" class="updateForm">
		<h2>Assign Work Slot</h2>
			<div class="input-group">
				<label for="wsDropdown">Select slot:</label>
				<select name="wsDropdown" id="wsDropdown" onchange="this.form.submit()">
					<option value="">Please select a slot</option>
					<?php foreach ($uAList as $workslot) : ?>
						<option value="<?= $workslot['wsId'] ?>" <?= $workslot['wsId'] == $selectedUAId ? 'selected' : '' ?>>
							<?= $workslot['workName'] ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>

            <?php if ($selectedUAInfo && isset($selectedUAInfo['unAssignedBids'])) : ?>
                <div class="input-group" id="sBid">
                    <label for="uStaff">Staff Name:</label>
                    <select id="uStaff" name="uStaff">
                        <option value="">Please select a staff</option>
                            <?php foreach ($empName as $emp): ?>
                                <?php if ($emp['staffRole'] !== NULL) : ?>
                                    <option value="<?= $emp['User_Id'] ?>" <?= $emp['User_Id'] == $selectedEmpId ? 'selected' : '' ?>>
                                        <?= $emp['E_Name'] . '-' . $emp['staffRole']?>
                                    </option>
                                <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

			<div class="input-group" id="sBid">
				<label for="newSBid">Bid Status:</label>
				<select id="newSBid" name="newSBid">
					<option value="3">Rejected</option>
					<option value="2">Approved</option>
				</select>
			</div>

			<button type="submit" name="updateWS" id="con">Confirm</button>
		</form>

		<div class="buttons-container">
			<form method="post" name="logout">  
				<button class="logOutButton" name="logout">Logout</button>
			</form>
			<button class="go-back-button" onclick="location.href='../manager.php'">Go Back</button>
		</div>
	</body>
</html>