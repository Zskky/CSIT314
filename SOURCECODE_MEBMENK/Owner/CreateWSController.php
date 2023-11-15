<?php
include('../WorkSlot.php');

class CreateWSController 
{
    private $cWorkSlot;

    public function __construct() {
        $this->cWorkSlot = new WorkSlot();
    }

    public function createWorkSlot() 
    {
        $creationSuccess = false; 

        if (isset ($_POST["cWorkslot"])) 
        {
            $startTime = $_POST["startTime"];
            $endTime = $_POST["endTime"];
            $uniRole = $_POST["uniRole"];
            $staffRole = null;
            $sBid = $_POST["sBid"];

            if ($uniRole === "staff")
            {
                $staffRole = $_POST["staffRole"];
            }

            if ($sBid === "No Bids")
            {
                $sBid = 0;
            }

            $workDate = $_POST["workDate"];

            list($year, $month, $day) = explode("-", $workDate);
            if (checkdate($month, $day, $year))
            {
                if ($this->isValidTimeFormat($startTime) && $this->isValidTimeFormat($endTime))
                {
                    if ($this->isWithinValidRange ($startTime,$endTime))
                    {
                        $creationSuccess = $this->cWorkSlot->setWorkSlot($startTime, 
                            $endTime, $uniRole, $staffRole, $workDate, $sBid);

                        echo '<script> alert ("Workslot created successfully."); </script>';

                        echo '<script>setTimeout(function(){window.location.href = "CreateWorkSlot.php";});</script>';
                    }
                    else
                    {
                        echo '<script> alert ("Error: Work slot should be within the range 00:00:00 to 23:59:59."); </script>';
                    }
                }
                else
                {
                    echo '<script> alert ("Error: Invalid time."); </script>';
                }
            }
            else
            {
                echo '<script> alert ("Error: Invalid date."); </script>';
            }
        }
        return $creationSuccess;
    }

        // Helper function to validate the time format (HH:MM:SS)
    private function isValidTimeFormat($time) 
    {
        return preg_match('/^([01]\d|2[0-3]):([0-5]\d):([0-5]\d)$/', $time);
    }

    //Helper function to compare two times
    private function compareTimes($time1, $time2) 
    {
        return (strtotime($time1) < strtotime($time2));
    }

    // Helper function to check if the time is within the valid range (00:00:00 to 23:59:59)
    private function isWithinValidRange($startTime, $endTime) 
    {
        return ($this->compareTimes($startTime, "23:59:59") && $this->compareTimes("00:00:00",$endTime));
    } 
}

