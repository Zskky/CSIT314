<?php
    include("LogoutController.php");

    // Run Logout
    $logO = new LogoutController();
    $logO->handleLogout();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <!--Boundary class -->
		<title>Create User Account</title>
		<style>
            /* Styles for form and buttons */
            body 
            {
              font-family: Arial, sans-serif;
              display: flex;
              flex-direction: column;
              align-items: center;
              justify-content: center;
              height: 100vh;
              margin: 0;
            }
  
            /* Add the button styles for the "Logout" and "Go Back" buttons */
            .button-container 
            {
              margin-top: 20px;
              display: flex;
              flex-direction: row;
            }
  
            .button-container button 
            {
              padding: 10px 20px;
              font-size: 16px;
              border: none;
              cursor: pointer;
              margin: 0 10px;
              border-radius: 5px;
            }
  
            .button-container .logOutButton
            {
              background-color: red; /* Adjust to match the styling of Account Features */
              color: white;
            }
  
            .button-container .go-back-button 
            {
              background-color: #3498db;
              color: white;
            }
  
            /* Add some spacing for the form elements */
            .form-group 
            {
              margin-bottom: 20px;
            }
  
            /* Style labels and inputs */
            .form-group label 
            {
              display: block;
              margin-bottom: 5px;
            }
  
            .form-group input 
            {
              padding: 10px;
              width: 300px; /* Adjust width as needed */
            }
  
            .date-input 
            {
              width: 300px; /* Adjust width for date inputs */
            }

            #sub
            {
              justify-content: center;
              padding: 10px 20px;
              font-size: 16px;
              border: none;
              cursor: pointer;
              margin: 0 117px;
              border-radius: 5px;
            }
          </style>
	</head>
	<body>

		<h2>Create User Account</h2>

		<form method="post" action="../UserAccount/CreateAcctController.php">
		  <div class="form-group">
			<label>Employee Name:</label>
			<input type="text" name="E_Name" required>
		  </div>

		  <div class="form-group">
			<label>Date of Birth (yyyy-mm-dd):</label>
			<input type="text" name="dob" class="date-input" placeholder="yyyy-mm-dd" required>
		  </div>

		  <div class="form-group">
			<label>Phone Number:</label>
			<input type="text" name="phoneNo" required>
		  </div>

		  <div class="form-group">
			<label>Email:</label>
			<input type="email" name="email" required>
		  </div>

      <button type="submit" name="createAcct" id="sub">Create</button>
		</form>

		<div class="button-container">
      <form method="post" name="logout">
				<button class="logOutButton" name="logout">Logout</button>
			</form>
		  <button class="go-back-button" onclick="goBack()">Back</button>
		</div>

		<script>
			function goBack() 
			{
				 window.location.href = "AccountFeatures.php";
			}
		</script>

	</body>
</html>
