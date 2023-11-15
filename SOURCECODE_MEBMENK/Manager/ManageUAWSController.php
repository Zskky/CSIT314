<?php
session_start();
include("../WorkSlot.php");

class ManageUAWSController
{
    private $uWs;

    public function __construct()
    {
        //$this->bWs = new UniversalProfile ();
        $this->uWs = new WorkSlot ();
    }

    //Return Unassigned WorkSLot
    public function displayWSList()
    {
        return $this->uWs->getWorkSlots();
    }

    public function getUnassignedWSId()
    {
        return $this->uWs->getSelectedWSId();
    }

    public function getUnassignedBidInfo($selectedWSId)
    {
        return $this->uWs->getSelectedWSInfo($selectedWSId);
    }

    //Return Employee with Roles
    public function displayEmp() 
    {
        return $this->uWs->getEmpNames();
    }

    public function getEmpId()
    {
        return $this->uWs->getSelectedEmpId();
    }

    public function getEmpInfo($selectedEmpId)
    {
        return $this->uWs->getSelectedEmpInfo($selectedEmpId);
    }

    public function handleUpdate()
    {
        if (isset($_POST["updateWS"])) 
        {
            $wsIdUp = $_POST["wsDropdown"];

            // Use the selected values from getBidData
            $bidData = $this->uWs->getBidData($wsIdUp);

            // Check if $bidData is not empty and has the required keys
            if (!empty($bidData) && isset($bidData['wsId'], $bidData['bidderId'], $bidData['E_Name'], $bidData['workName'])) 
            {
                $newSBid = $_POST["newSBid"];

                // Update the bid status without checking for changes
                $updateSuccess = $this->uWs->insertBid($bidData['wsId'], $bidData['bidderId'], $newSBid, $bidData['E_Name'], $bidData['workName']);

                if ($updateSuccess) 
                {
                    echo '<script> alert ("Bid updated successfully.");</script>';
                    echo '<script> window.location.href = "ManageUnassignedWorkslot.php"; </script>';
                } 
                else 
                {
                    echo '<script> alert ("Bid cannot be updated.");</script>';
                }
            } 
            else 
            {
                // Handle the case when the required keys are not present in $bidData
                echo '<script> alert ("Error in retrieving bid data.");</script>';
            }
        }
    }
}
?>
