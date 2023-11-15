<?php
include("../UniversalProfile.php");

class DeleteProController 
{
    private $dProfile;

    public function __construct() 
    {
        $this->dProfile = new UniversalProfile();
    }

    public function displayProList() 
    {
        return $this->dProfile->getUserProfile();
    }

    public function deleteHandle() 
    {
        $deleteSuccess = false;

        if (isset($_POST["deleteButton"])) 
        {
            {
                $userIdToDelete = $_POST["delete_pro"];
                $deleteSuccess = $this->dProfile->deletePro($userIdToDelete);
            }
        }
    }
}
?>
