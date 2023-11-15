<?php
	//Entity Classes for all of admin user rights
	class UserAccount //
	{
		private $conn;

		public function __construct() 
		{
            include("dbconnect.php");

			$this->conn = $conn;
		}

		//Entity codes for Account Creation
		public function setUserAcct($E_Name, $D_O_B, $PhoneNo, $Email) 
		{
			$sqlUser = "INSERT INTO `useracct` (`E_Name`,  `D_O_B`, `PhoneNo`, `Email`) 
						VALUES (?, ?, ?, ?)";

			$stmtUser = mysqli_prepare($this->conn, $sqlUser);
			mysqli_stmt_bind_param($stmtUser, "ssss", $E_Name, $D_O_B, $PhoneNo, $Email);
			mysqli_stmt_execute($stmtUser);

			if (mysqli_stmt_affected_rows($stmtUser) > 0) 
			{
				echo '<script> alert ("User account created successfully.");</script>';
                echo '<script> window.location.href = "../UserAccount/CreateUserAccount.php"; </script>';
			} 
		}

		//Entity for View Account
		public function getUserAcct() 
		{
			$acctList = [];

			$sql = "SELECT User_Id, E_Name, PhoneNo FROM useracct";
			$result = mysqli_query($this->conn, $sql);

			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$acctList[] = $row;
				}
			}

			return $acctList;
		}

		//Entity for Update Account
		public function displayAcctList() //Used for displayAcct and DeleteAcct
		{
			$userList = [];

			// Retrieve user data from the database
			$sql = "SELECT User_Id, E_Name, D_O_B, PhoneNo, Email FROM useracct";
			$result = mysqli_query($this->conn, $sql);

			if ($result) 
			{
				while ($row = mysqli_fetch_assoc($result)) 
				{
					$acctList[] = $row;
				}
			}

			return $acctList;
		}

		public function updateAcct($userId, $newDOB, $newPNo, $newEmail) 
		{
			$sql = "UPDATE useracct SET D_O_B = ?, PhoneNo = ?, Email = ? WHERE User_Id = ?";
			$stmt = mysqli_prepare($this->conn, $sql);
			mysqli_stmt_bind_param($stmt, "sssi", $newDOB, $newPNo, $newEmail, $userId);
			mysqli_stmt_execute($stmt);
			return mysqli_stmt_affected_rows($stmt) > 0;	
		}

		public function getAcctInfo($userId) 
		{
			$sql = "SELECT D_O_B, PhoneNo, Email FROM useracct WHERE User_id = ?";
			$stmt = mysqli_prepare($this->conn, $sql);
			mysqli_stmt_bind_param($stmt, "i", $userId);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $D_O_B, $phoneNo, $Email);
			mysqli_stmt_fetch($stmt);

			return 
			[
				'D_O_B' => $D_O_B,
				'PhoneNo' => $phoneNo,
				'Email' => $Email,
			];
		}

		//Entity Functions for Search Acct
		public function sAcct($E_Name) 
		{
			$searchResults = [];

			// Prepare the SQL query
			$sql = "SELECT User_Id, E_Name, D_O_B, PhoneNo, Email 
				FROM useracct WHERE E_Name LIKE ?";
			$stmt = mysqli_prepare($this->conn, $sql);
			$param = '%' . $E_Name . '%';
			mysqli_stmt_bind_param($stmt, "s", $param);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			// Fetch and store the search results
			if ($result) 
			{
				while ($row = mysqli_fetch_assoc($result)) 
				{
					$searchResults[] = $row;
				}
			}
			return $searchResults;

		}

		//Entity Functions for Delete Acct
		public function delUser($userId) 
		{
			$sql = "DELETE FROM useracct WHERE User_Id = ?";
			$stmt = mysqli_prepare($this->conn, $sql);
			mysqli_stmt_bind_param($stmt, "i", $userId);
			mysqli_stmt_execute($stmt);
			if (mysqli_stmt_affected_rows($stmt) > 0)
			{
				echo '<script> alert ("User Account deleted successfully.");</script>';
				echo '<script>window.location.reload(true);</script>';
			}
			
		}
	}
?>
