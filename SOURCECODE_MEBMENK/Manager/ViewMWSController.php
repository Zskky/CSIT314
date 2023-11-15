<?php
    session_start();
    include("../Bids.php");

    class ViewMWSController {
        private $bWorkS;

        public function __construct() {
            $this->bWorkS = new Bids();
        }

        public function displayWS() {
            return $this->bWorkS->getCfmBids();
        }
}
?>
