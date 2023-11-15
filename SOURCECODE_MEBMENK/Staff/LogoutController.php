<?php
class LogoutController 
{
    public function handleLogout() 
    {
        if (isset($_POST["logout"])) 
        {
            // Unset all session variables
            session_unset();

            // Destroy the session (optional, depends on your requirements)
            session_destroy();

            // Redirect to the login page or any other page after logout
            header("Location: ../LoginPage.html");
            exit();
        }
    }
}

?>
