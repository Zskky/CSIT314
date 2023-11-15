<?php
    include("../UserAccount.php");

    class ViewAcctController 
    {
        private $vUser;

        public function __construct() 
        {
            $this->vUser = new UserAccount ();
        }

        public function getUserAccount() 
        {
            return $this->vUser->getUserAcct();
        }
    }
?>
