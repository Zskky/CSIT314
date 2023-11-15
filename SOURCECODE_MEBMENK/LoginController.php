<?php
session_start();
include("UniversalProfile.php");


class LoginController 
{
    private $conn;
    private $userProf;

    public function __construct() 
    {
        $this->userProf = new UniversalProfile();
    }

    public function handleLogin() 
    {
        if (isset ($_POST["loginBut"])) 
        {
            $E_Name = $_POST["E_Name"];
            $Pass = $_POST["Pass"];
            $uniRole = $_POST["CafeID"];

            $this->userProf->login($E_Name, $Pass, $uniRole);
        }
    }
}

$LoginController = new LoginController();
$LoginController->handleLogin();
?>
