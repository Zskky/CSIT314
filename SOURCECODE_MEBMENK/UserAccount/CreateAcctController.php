<?php
	include("../UserAccount.php"); // Include the entity

	class CreateAcctController // Controller Class
	{
		private $uAcct;

		public function __construct() 
		{
            // Calling the UserAccount to read back
			$this->uAcct = new UserAccount();
		}

		public function createUserAcct($E_Name, $D_O_B, $PhoneNo, $Email) 
		{
            // Call the entity method
			$this->uAcct->setUserAcct($E_Name, $D_O_B, $PhoneNo, $Email);
		}
	}

    $CreateAcctController = new CreateAcctController(new UserAccount());

    //Check the declaration
	if (isset($_POST["createAcct"])) 
	{
		$E_Name = $_POST["E_Name"];
		$D_O_B = $_POST["dob"];
		$PhoneNo = $_POST["phoneNo"];
		$Email = $_POST["email"];

		$CreateAcctController->createUserAcct($E_Name, $D_O_B, $PhoneNo, $Email);
	}

?>

