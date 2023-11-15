<?php
	include("../UniversalProfile.php");

	class UpdateProController
	{
		private $uProfile;

		public function __construct() 
		{
			$this->uProfile = new UniversalProfile();
		}

		public function displayProList() 
		{
			return $this->uProfile->getUserProfile();
		}

        public function acctInfo() 
        {
            $selectedUserId = null;
            $selectedUserInfo = null;
        
            if (isset($_POST["acctDropdown"])) 
            {
            $selectedUserId = $_POST["acctDropdown"];
            $selectedUserInfo = $this->uProfile->getProfileInfo($selectedUserId);
            }
        }

        public function handleUpdate()
        {
            if (isset($_POST["updateProfile"])) 
            {
                $userIdToUpdate = $_POST["acctDropdown"];
                $newPass = $_POST["newPass"];
                $newUR = $_POST["newUniRole"];
                $newSR = $_POST["newStaffRole"];

                $updateSuccess =$this->uProfile->updateProfile($userIdToUpdate, $newPass, $newUR, $newSR);

                if ($updateSuccess = true)
                {
                    echo '<script> alert ("User Profile updated successfully.");</script>';
                    echo '<script> window.location.href = "UpdateProfile.php"; </script>';

                }
                else
                {
                    echo '<script> alert ("User profile cannot be updated.");</script>';
                }
            }
        }
	}
?>