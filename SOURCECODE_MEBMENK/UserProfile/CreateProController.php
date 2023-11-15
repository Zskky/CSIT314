<?php
    include("../UniversalProfile.php");

    class CreateProController
    {
        private $cProfile;
        private $staffName;
        private $staffId;
        private $createSuccess;

        public function __construct() 
	    {
            $this->cProfile = new UniversalProfile ();
        }
        
        public function displayStaffName() 
        {
           return $this->cProfile->getStaffName();
        }

        public function keepStaffId()
        {
           return $this->cProfile->getStaffID();
        }

        public function createProAcct($User_Id, $E_Name, $Pass, $uniRole, $staffRole)
        {
            $this->cProfile->addUserProfile($User_Id, $E_Name, $Pass, $uniRole, $staffRole);
        }
    }

    $createProController = new CreateProController ();
    $staffName = $createProController->displayStaffName();
    $staffId = $createProController->keepStaffId();

    if (isset($_POST["createProf"])) 
    {
        $E_Name = $_POST["empName"];
        $uniRole = $_POST["uniRole"];
        $staffRole = isset($_POST["staffRole"]) ? $_POST["staffRole"] : null;
        $Pass = $_POST["Password"];
            
        //Check if User_Id and E_Name matches in DB
        $selectedEName = $E_Name;
        $selectedId = array_search($selectedEName, $staffName);
            
        if($selectedId !== false)
        {
            $User_Id = $staffId[$selectedId];
            $createSuccess = $createProController->createProAcct($User_Id, $E_Name, $Pass, $uniRole, $staffRole);       
        }
    }
?>