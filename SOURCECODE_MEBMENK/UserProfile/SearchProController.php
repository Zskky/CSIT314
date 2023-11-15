<?php
include("../UniversalProfile.php");

class SearchProController 
{
    private $sProfile;

    public function __construct() 
    {
        $this->sProfile = new UniversalProfile();
    }

    public function displaySearch() 
    {
        $searchResults = [];

        if (isset($_POST["search"])) 
        {
            $E_Name = $_POST["E_Name"];
            $searchResults = $this->sProfile->searchPro($E_Name);
        }
        return $searchResults;
    }
}
?>
