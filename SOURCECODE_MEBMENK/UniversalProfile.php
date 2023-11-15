<?php

class UniversalProfile
{
    private $conn;
    private $staffName;
    private $staffId;

    public function __construct() 
	{
        include("dbconnect.php");

        $this->conn = $conn;
    }

    public function login($E_Name, $Pass, $uniRole) 
    {
        $sql = "SELECT User_Id, E_Name, staffRole FROM `uniProfile` WHERE `E_Name` = ? AND `Pass` = ? AND `uniRole` = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $E_Name, $Pass, $uniRole);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) 
        {
            // Store User_Id, E_Name, and staffRole for further use
            $user_id = $row['User_Id'];
            $e_name = $row['E_Name'];
            $staffRole = $row['staffRole'];

            //$user_id, $e_name, and $staffRole can be used as needed.
            $_SESSION['user_id'] = $user_id;
            $_SESSION['e_name'] = $e_name;
            $_SESSION['staffRole'] = $staffRole;

            $this->redirectToPage($uniRole);
        } 
        else 
        {
            echo '<script> alert ("Invalid Login Details.");</script>';
            echo '<script> window.location.href = "LoginPage.html"; </script>';
        }
    }


    private function redirectToPage($uniRole) 
    {
        switch ($uniRole) 
        {
            case 'sysAdmin':
                header("Location: admin.php"); // Redirect to sysAdmin page
                exit();
            case 'owner':
                header("Location: owner.php"); // Redirect to owner page
                exit();
            case 'staff':
                header("Location: staff.php"); // Redirect to staff page
                exit();
            case 'manager':
                header("Location: manager.php"); // Redirect to manager page
                exit();
            default:
                echo '<div style="color: red;">Invalid role.</div>';
        }
    }

    //Start of functions
    public function getStaffName() 
	{
        $query = "SELECT E_Name FROM useracct WHERE E_Name NOT IN
		(SELECT E_Name FROM uniProfile)";
		
        $result = mysqli_query($this->conn, $query);
        $staffName = [];

        if ($result) 
		{
            while ($row = mysqli_fetch_assoc($result)) 
			{
                $staffName[] = $row['E_Name'];
            }
        }

        return $staffName;
    }

    public function getStaffID()
    {
        $query = "SELECT User_Id FROM useracct WHERE User_Id NOT IN
		(SELECT User_Id FROM uniProfile)";

        $result = mysqli_query($this->conn, $query);
        $staffId = [];

        if($result)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $staffId[] = $row['User_Id'];
            }
        }

        return $staffId;
    }


	public function addUserProfile($User_Id, $E_Name, $Pass, $uniRole, $staffRole) 
    {
        $cProfile = "";

        if ($uniRole === 'owner' || $uniRole === 'manager') 
        {
            $cProfile = "INSERT INTO  uniprofile (User_Id, E_Name, Pass, uniRole) 
                VALUES (?, ?, ?, ?)";
        } 
        else if ($uniRole === 'staff') 
        {
            if ($staffRole === 'chef' || $staffRole === 'waiter' || $staffRole === 'cashier') 
            {
                $cProfile = "INSERT INTO uniProfile (User_Id, E_Name, Pass, uniRole, staffRole) VALUES (?, ?, ?, ?, ?)";
            }
        }
        else if (empty($cProfile)) 
        {
            return false;
        }

        $stmt = mysqli_prepare($this->conn, $cProfile);

        if ($uniRole === 'staff') 
        {
            mysqli_stmt_bind_param($stmt, "sssss", $User_Id, $E_Name, $Pass, $uniRole, $staffRole);
        } 
        else 
        {
            mysqli_stmt_bind_param($stmt, "ssss", $User_Id, $E_Name, $Pass, $uniRole);
        } 
        
        (mysqli_stmt_execute($stmt));
        if (mysqli_stmt_affected_rows($stmt) > 0) 
        {
            echo '<script> alert ("User Profile created successfully.");</script>';
            echo '<script>setTimeout(function(){ 
                window.location.href = "../UserProfile/CreateProfile.php";});</script>';
        } 
        else
        {
            echo '<script> alert ("User Profile cannot be created.");</script>';
            echo '<script>setTimeout(function(){ 
                    window.location.href = "../UserProfile/CreateProfile.php";});</script>';
        }
        
    }

    //View
    public function getUserProfile() 
    {
        $proList = [];

        // Retrieve user data from the database
        $sql = "SELECT User_Id, E_Name, uniRole, staffRole FROM UniProfile";
        $result = mysqli_query($this->conn, $sql);

        if ($result) 
        {
            while ($row = mysqli_fetch_assoc($result)) 
            {
                $proList[] = $row;
            }
        }

        return $proList;
    }

    //Update
    public function getProfileInfo($userId) 
    {
        $sql = "SELECT Pass, uniRole, staffRole FROM uniprofile WHERE User_Id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $pass, $uniRole, $staffRole);
        mysqli_stmt_fetch($stmt);

        return 
        [
            'Pass' => $pass,
            'uniRole' => $uniRole,
            'staffRole' => $staffRole,
        ];
    }

    public function updateProfile($userId, $newPass, $newUR, $newSR)
    {
        $sql = "UPDATE uniprofile SET Pass = ?, uniRole = ?, staffRole = ? WHERE User_Id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);

        //Check owner/manager and set staffrole to null is owner/manager is selected
        if ($newUR === "owner" || $newUR === "manager") 
        {
            $newSR = null; // Set staff role to null
        }

        mysqli_stmt_bind_param($stmt, "ssss", $newPass, $newUR, $newSR, $userId);
        mysqli_stmt_execute($stmt);
		return mysqli_stmt_affected_rows($stmt) > 0;
    }

    //Search Profile
    public function searchPro($E_Name) 
    {
        $searchResults = [];

        // Prepare the SQL query
        $sql = "SELECT User_Id, E_Name, Pass, uniRole, staffRole 
            FROM uniprofile WHERE E_Name LIKE ?";
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

    //Delete Profile
    public function deletePro($userId) 
    {
        $sql = "DELETE FROM uniprofile WHERE User_Id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        if (mysqli_stmt_affected_rows($stmt) > 0)
        {
            echo '<script> alert ("User Profile deleted successfully.");</script>';
            echo '<script>window.location.reload(true);</script>';
        }
    }

}

?>