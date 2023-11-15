<?php
    include("../WorkSlot.php");

    class ViewMUAWSController {
        private $bWorkS;

        public function __construct() {
            $this->bWorkS = new WorkSlot();
        }

        public function displayWS() {
            return $this->bWorkS->getUnassignSlot();
        }
}
?>
