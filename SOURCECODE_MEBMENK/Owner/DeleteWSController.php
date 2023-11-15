<?php
include('../WorkSlot.php');

    class DeleteWSController 
    {
        private $delWS;

        public function __construct() 
        {
            $this->delWS = new WorkSlot();
        }

        public function handleDelWS() 
        {
            $success = false;

            if (isset($_POST["delWS"])) 
            {
                $selectedWorkName = $_POST["wNdropdown"];
                $success = $this->delWS ->deleteWorkSlot($selectedWorkName);
            }
        }

        public function displayWorkNames() {
            return $this->delWS->getWorkNames();
        }
}
?>
