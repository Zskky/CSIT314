<?php
    session_start();
    include("../Bids.php");

    class ViewWSController {
        private $bWorkS;

        public function __construct() {
            $this->bWorkS = new Bids();
        }

        public function displayWS() {
            return $this->bWorkS->getCfmBids();
        }
}
?>
