<?php
include ("../UserAccount.php");

    class UpdateAcctController 
    {
        private $uAcct;

        public function __construct() 
        {
            $this->uAcct = new UserAccount ();
        }

        public function getAcctInfo() 
        {
            $selectedUserId = null;
            $selectedUserInfo = null;

            if (isset($_POST["acctDropdown"])) 
            {
                $selectedUserId = $_POST["acctDropdown"];
                $selectedUserInfo = $this->uAcct->getAcctInfo($selectedUserId);
            } 

            return $selectedUserInfo;
        }
        
        public function displayAcctList() 
        {
            return $this->uAcct->getUserAcct();
        }
        
        public function handleUpdate() 
        {
            if (isset($_POST["acctUpdate"])) 
            {
                $userIdToUpdate = $_POST["acctDropdown"];
                $newDOB = $_POST["new_date_of_birth"];
                $newPNo = $_POST["new_phone_no"];
                $newEmail = $_POST["new_user_email"];

                $updateSuccess =$this->uAcct->updateAcct($userIdToUpdate, 
                    $newDOB, $newPNo, $newEmail);

                    if ($updateSuccess = true)
                    {
                        echo '<script> alert ("User Account updated successfully.");</script>';
                        echo '<script> window.location.href = "UpdateAccount.php"; </script>';

                    }
                    else
                    {
                        echo '<script> alert ("User account cannot be updated.");</script>';
                    }
            }
        }
    }
?>
