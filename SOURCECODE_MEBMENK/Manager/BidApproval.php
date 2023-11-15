<?php
    include("../Manager/BidApprovalController.php");
	include("LogoutController.php");


    $bidApprovalController = new BidApprovalController();

	// Run Retrival of information
    $wsList = $bidApprovalController->displayWSList();
	$selectedWSId = $bidApprovalController->getSelectedWSId();
	$selectedWSInfo = $bidApprovalController->getSelectedWSInfo($selectedWSId);

    // Handle form submission
    $bidApprovalController->handleUpdate();

	// Run Logout
    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Update WorkSlot</title>
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
				margin-bottom: 20px;
			}

			.bidA
			{
				padding: 50px;
				border: 1px solid black;
				background-color: white;
				margin-left: auto;
				margin-right: auto;
				margin-top: 50px;
				border-radius: 10px;
			}

			.input-group
			{
				margin-bottom: 20px;
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
				border-radius: 5px;
				font-size: 16px;
				border: none;
				cursor: pointer;
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

			#sub
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
		<div class="bidA">
			<h2>Update Work Slot</h2>

			<form method="post" class="updateForm">
				<div class="input-group">
					<label for="wsDropdown">Select slot:</label>
					<select name="wsDropdown" id="wsDropdown" onchange="this.form.submit()">
						<option value="">Please select a slot</option>
						<?php foreach ($wsList as $workslot) : ?>
							<option value="<?= $workslot['wsId'] ?>" <?= $workslot['wsId'] == $selectedWSId ? 'selected' : '' ?>>
								<?= $workslot['workName'] ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<?php if ($selectedWSInfo && isset($selectedWSInfo['pendingBids'])) : ?>
					<div class="input-group" id="pendingBids">
						<label for="pendingBids">Pending Bids:</label>
						<ul>
							<?php foreach ($selectedWSInfo['pendingBids'] as $bid) : ?>
								<li>
									<?= $bid['E_Name'] ?> - <?= $bid['workName'] ?>
									<select name="bidStatus[<?= $bid['E_Name'] ?>]">
										<option value="2">Approved</option>
										<option value="3">Rejected</option>
									</select>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php else : ?>
					<div class="input-group" id="pendingBids">
						<label for="pendingBids">Pending Bids:</label>
						<ul>
							<li>No pending bids for the selected work slot.</li>
						</ul>
					</div>
				<?php endif; ?>

				<button type="submit" name="updateWS" id="sub">Confirm</button>
			</form>
			</div>

			<div class="buttons-container">
				<form method="post" name="logout">
					<button class="logOutButton" name="logout">Logout</button>
				</form>
				<button class="go-back-button" onclick="location.href='../manager.php'">Go Back</button>
			</div>
		
	</body>
</html>