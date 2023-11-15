<?php
    include("../UniversalProfile.php");

    class ViewProController
    {
        private $vProfile;

        public function __construct() 
        {
            $this->vProfile = new UniversalProfile();
        }

        public function displayProfile() 
        {
            return $this->vProfile->getUserProfile();
        }
    }
?>
