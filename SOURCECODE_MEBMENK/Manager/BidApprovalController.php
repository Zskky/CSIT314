<?php
session_start();
include("../WorkSlot.php");
include("../Bids.php");

class BidApprovalController
{
    private $uWs;
    private $bWs;

    public function __construct()
    {
        $this->uWs = new WorkSlot ();
        $this->bWs = new Bids ();
    }

    public function displayWSList()
    {
        return $this->uWs->getWorkSlots();
    }

    public function getSelectedWSId()
    {
        return $this->bWs->getSelectedWSId();
    }

    public function getSelectedWSInfo($selectedWSId)
    {
        return $this->bWs->getSelectedWSInfo($selectedWSId);
    }

    public function handleUpdate()
    {
        if (isset($_POST["updateWS"])) 
        {
            $wsIdUp = $_POST["wsDropdown"];
            $bidStatus = $_POST["bidStatus"];

            // Check if more than one bid is approved
            $approvedCount = count(array_filter($bidStatus, function ($status) { return $status == 2; }));

            if ($approvedCount > 1) 
            {
                echo '<script> alert ("Error: Only one bid can be approved.");</script>';
            } 
            else 
            {
                $updateSuccess = $this->bWs->updateBidSlot($wsIdUp, $bidStatus);

                if ($updateSuccess) 
                {
                    echo '<script> alert ("Bid Approved");</script>';
                    echo '<script> window.location.href = "BidApproval.php"; </script>';
                } 
                else 
                {
                    echo '<script> alert ("Error updating bids.");</script>';
                }
            }
        }
    }
}
?>
