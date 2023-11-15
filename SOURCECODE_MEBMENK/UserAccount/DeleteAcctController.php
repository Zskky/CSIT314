<?php
include("../UserAccount.php");

class DeleteAcctController 
{
    private $dAcct;

    public function __construct() 
    {
        $this->dAcct = new UserAccount();
    }

    public function displayAcctList() 
    {
        return $this->dAcct->getUserAcct();
    }

    public function deleteHandle() 
    {
        $deleteSuccess = false;

        if (isset($_POST["deleteButton"])) 
        {
            {
                $userIdToDelete = $_POST["delete_user"];
                $deleteSuccess = $this->dAcct->delUser($userIdToDelete);
            }
        }
    }
}
?>
