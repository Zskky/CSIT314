<?php
    include("../Owner/ManageWSController.php");
	include("LogoutController.php");

    $mWSc = new ManageWSController();

	// Run Retrival of information
    $cmList = $mWSc->displayWSList();
	$selectedCWSId = $mWSc -> getSelectedWSId();
	$selectedCWSInfo = $mWSc->getSelectedBidInfo($selectedCWSId);

    // Handle form submission
    $mWSc->handleUpdate();

    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Manage WorkSlot</title>
		<style>
			body 
			{
				font-family: Arial, sans-serif;
				background-color: #f0f0f0;
				margin: 0;
				padding: 0;
				height: 100vh;
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
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

			table 
			{
				border-collapse: collapse;
				width: 100%;
				border: 1px solid #ddd;
				background-color: white;
				margin-left: auto;
				margin-right: auto;
				margin-bottom: 20px;
        	}	

			th, td 
			{
				text-align: left;
				padding: 8px;
				border: 1px solid #ddd;
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
		<h2>Update Work Slot</h2>

		<form method="post" class="updateForm">
			<div class="input-group">
				<label for="wsDropdown">Select slot:</label>
				<select name="wsDropdown" id="wsDropdown" onchange="this.form.submit()">
					<option value="">Please select a slot</option>
					<?php foreach ($cmList as $bid) : ?>
						<option value="<?= $bid['wsId'] ?>" <?= $bid['wsId'] == $selectedCWSId ? 'selected' : '' ?>>
							<?= $bid['workName'] ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>

			<?php if ($selectedCWSInfo && isset($selectedCWSInfo['bidApproval'])) : ?>
				<table>
					<tr>
						<th>Staff Name</th>
						<th>Work Details</th>
						<th>Status</th>
					</tr>
					<div class="input-group" id="bidApproval">
						<label for="bidApproval">Approved/Rejected Bids:</label>
						<ul>
							<?php foreach ($selectedCWSInfo['bidApproval'] as $bid) : ?>
								<tr>
									<td><?= $bid["E_Name"] ?></td>
									<td><?= $bid["workName"] ?></td>
									<td><?= isset($bid["bidStatus"]) ? ($bid["bidStatus"] == 2 ? 'Approved' : 'Rejected') : 'N/A' ?></td>
								</tr>
							<?php endforeach; ?>
						</ul>
					</div>
				</table>
			<?php else : ?>
				<div class="input-group" id="bidApproval">
					<label for="bidApproval">Approved/Rejected Bids:</label>
					<ul>
						<li>No Approved/Rejected for the selected work slot.</li>
					</ul>
				</div>
			<?php endif; ?>

			<div class="input-group" id="sBid">
				<label for="uStaff">Staff Name:</label>
				<select id="uStaff" name="uStaff">
					<option value="">Please select a staff</option>
					<?php if ($selectedCWSInfo && isset($selectedCWSInfo['bidApproval'])) : ?>
						<?php foreach ($selectedCWSInfo['bidApproval'] as $bid) : ?>
							<option value="<?= $bid['E_Name'] ?>">
								<?= $bid['E_Name'] ?>
							</option>
						<?php endforeach; ?>
					<?php endif; ?>
				</select>
			</div>

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
			<button class="go-back-button" onclick="location.href='../owner.php'">Go Back</button>
		</div>
	</body>
</html>