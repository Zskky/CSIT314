<?php
include("../UserAccount.php");

class SearchAcctController 
{
    private $sAcct;
    private $E_Name;

    public function __construct() 
    {
        $this->sAcct = new UserAccount();
    }

    public function handleSearch()
    {
        $searchResults = [];

        if (isset($_POST["search"])) 
        {
            $E_Name = $_POST["E_Name"];
            $searchResults = $this->sAcct->sAcct($E_Name);
        }
        return $searchResults;
    }   
}
?>
