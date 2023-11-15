<?php
session_start();
include("../Bids.php");

class ManageWSController
{
    private $bWs;

    public function __construct()
    {
        $this->bWs = new Bids ();
    }

    public function displayWSList()
    {
        return $this->bWs->workSlotWithSBid1();
    }

    public function getSelectedWSId()
    {
        return $this->bWs->getSelectedWSId();
    }

    public function getSelectedBidInfo($selectedWSId)
    {
        return $this->bWs->getSelectedBidInfo($selectedWSId);
    }

    public function handleUpdate()
    {
        if (isset($_POST["updateWS"])) 
        {
            $wsIdUp = $_POST["wsDropdown"];
            $E_Name = $_POST["uStaff"];
            $newSBid = $_POST["newSBid"];

            // Update the bid status without checking for changes
            $updateSuccess = $this->bWs->updateCfmSlot($wsIdUp, $E_Name, $newSBid);

            if ($updateSuccess) 
            {
                echo '<script> alert ("Bid updated successfully.");</script>';
                echo '<script> window.location.href = "ManageWorkSlot.php"; </script>';
            } 
            else 
            {
                echo '<script> alert ("Bid cannot be updated.");</script>';
            }
        }
    }
}
?>
