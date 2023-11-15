<?php
    session_start();
    include("../WorkSlot.php");
    include("../Bids.php");
    include("../UniversalProfile.php");

    class ViewAWController 
    {
        private $vWorkS;
        private $bWorkS;
        private $pWorks; 

        public function __construct() {
            $this->vWorkS = new WorkSlot();
            $this->bWorkS = new Bids();
            $this->pWorks = new UniversalProfile();

        }

        public function displayAWS() 
        {
            $bidderId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
            $staffRole = isset($_SESSION['staffRole']) ? $_SESSION['staffRole'] : null;
        
            if ($bidderId !== null && $staffRole !== null) 
            {
                $workSlots = $this->vWorkS->getAWorkSlotsForBidderAndRole($bidderId, $staffRole);
                return $workSlots;
            } 
            else 
            {
                echo '<script> alert ("User not logged in.");</script>';
                echo '<script> window.location.href = "ViewAvailableSlots.php"; </script>';
            }
        }

        public function wsInfo() 
        {
            $selectedWSId = null;
            $selectedWSInfo = null;
        
            if (isset($_POST["wsDropdown"])) 
            {
                $selectedWSID = $_POST["wsDropdown"];
                $selectedWSInfo = $this->vWorkS->getWSInfo($selectedWSID);
            }
        }

        public function bidUpdate()
        {
            if (isset($_POST["bidWS"])) {
                $wsIdUp = $_POST["wsDropdown"];

                $bidderId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
                $E_Name = isset($_SESSION['e_name']) ? $_SESSION['e_name'] : null;
                $newBidStatus = 1;

                if ($bidderId !== null && $E_Name !== null) {
                    $updateSuccess = $this->bWorkS->bidWorkSlot($wsIdUp, $bidderId, $E_Name, $newBidStatus);

                    if ($updateSuccess) 
                    {
                        echo '<script> alert ("Unable to Bid");</script>';
                    } 
                    else 
                    {
                        echo '<script> alert ("Bid sucessful");</script>';
                        echo '<script> window.location.href = "ViewAvailableSlots.php"; </script>';
                    }
                } 
                else
                {
                    echo '<script> alert ("User not logged in.");</script>';
                    echo '<script> window.location.href = "ViewAvailableSlots.php"; </script>';
                }
            }
        }
}
?>
