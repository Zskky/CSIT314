<?php
    session_start();
    include("../Bids.php");

    class ViewBSController {
        private $vWorkS;
        private $eName;

        public function __construct() {
            $this->vWorkS = new Bids();
        }

        public function displayBidStatus() {
            $eName = $_SESSION['e_name'];
            return $this->vWorkS->getBidStatus($eName);
        }
}
?>
