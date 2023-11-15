<?php
class WorkSlot 
{
    private $conn;

    public function __construct() 
    {
        include("dbconnect.php");

        $this->conn = $conn;
    }

    // Create Workslot
    public function setWorkSlot($startTime, $endTime, $uniRole, $staffRole, $workDate, $sBid) 
    {
      
        $success = false;

        $workName = $workDate . ', ' . $startTime . ' to ' . $endTime . ', ' . $uniRole;
        if ($staffRole) 
        {
            $workName .= ', ' . $staffRole;
        }

        $wSlot = "INSERT INTO workslot (startTime, endTime, uniRole, staffRole, workDate, workName, sBid) 
                VALUES ('$startTime', '$endTime', '$uniRole', '$staffRole', '$workDate', '$workName', '$sBid')";

        if (mysqli_query($this->conn, $wSlot)) 
        {
            $success = true;
        } else 
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }

        return $success;
    }

    public function getWorkSlots() 
    {
        $sql = "SELECT wsId, startTime, endTime, workDate, uniRole, 
            staffRole, workName, sBid FROM workslot WHERE sBid = 0";
        $result = $this->conn->query($sql);
        $workSlots = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['sBid'] == 0) {
                    // If sBid is 0, set a custom message
                    $row['sBid'] = "No Bids";
                } else {
                    // If sBid is not 0, check bidStatus
                    $bidStatus = $this->getBidStatus($row['wsId']);
                    if ($bidStatus == 1) {
                        $row['sBid'] = "Pending Approval";
                    } else {
                        // Exclude work slots with bid status 2 (approved) or 3 (rejected)
                        continue;
                    }
                }

                $workSlots[] = $row;
            }
        }

        return $workSlots;
    }

    private function getBidStatus($wsId)
    {
        $sql = "SELECT bidStatus FROM bids WHERE wsId = ? AND bidStatus = 1";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $wsId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $numRows = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_close($stmt);

        return $numRows > 0 ? 1 : 0;
    }

    // VIEW AVAILABE Workslot
    public function getAWorkSlots() 
    {
        $sql = "SELECT wsId, startTime, endTime, workDate, 
            uniRole, staffRole, workName, sBid FROM workslot WHERE sBid = 0";
        $result = $this->conn->query($sql);
        $workSlots = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) 
            {
                $row['status'] = "No Bids";
                $workSlots[] = $row;
            }
        }

        return $workSlots;
    }

    public function getAWorkSlotsForBidderAndRole($bidderId, $staffRole) 
    {
        $sql = "SELECT wsId, startTime, endTime, workDate, 
                uniRole, staffRole, workName, sBid 
                FROM workslot 
                WHERE sBid = 0 
                AND staffRole = ?
                AND wsId NOT IN (SELECT wsId FROM bids WHERE bidderId = ?)";

        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $staffRole, $bidderId);
        mysqli_stmt_execute($stmt);
        $workSlots = [];

        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) 
        {
            $row['status'] = "No Bids";
            $workSlots[] = $row;
        }

        mysqli_stmt_close($stmt);

        return $workSlots;
    }

    // Retrieve workslot data points
    public function getWorkNames() //Delete & View
    {
        $sql = "SELECT workName FROM workslot";
        $result = $this->conn->query($sql);

        $workNames = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) 
            {
                $workNames[] = $row["workName"];
            }
        }

        return $workNames;
    }

    // Deleting the workslots
    public function deleteWorkSlot($workname) 
    {
        $sql = "DELETE FROM workslot WHERE workName = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $workname);
        mysqli_stmt_execute($stmt);
        if (mysqli_stmt_affected_rows($stmt) > 0)
        {
            echo '<script> alert ("Workslot deleted successfully.");</script>';
            echo '<script>window.location.reload(true);</script>';
        }
    }

    //Update
    public function getWSInfo($wsId) 
    {
        $sql = "SELECT startTime, endTime, sBid FROM workslot WHERE wsId = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $wsId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $startTime, $endTime, $sBid);
        mysqli_stmt_fetch($stmt);

        return 
        [
            'startTime' => $startTime,
            'endTime' => $endTime,
            'sBid' => $sBid,
        ];
    }

    //get workName from workslot database
    private function getWorkName($wsIdUp)
    {
        $sql = "SELECT workName FROM workslot WHERE wsId = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $wsIdUp);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $workName);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        return $workName;
    }

    // VIEW AVAILABE Workslot
    public function getUnassignSlot() 
    {
        $sql = "SELECT  workName, sBid FROM workslot 
            WHERE workName NOT IN (SELECT workName FROM bids)";

        $result = $this->conn->query($sql);
        $workSlots = [];

        if ($result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                $row ['sBid'] = 'No Bid';
                $workSlots[] = $row;
            }
        }

        return $workSlots;
    }

    // Direct assign workslot
    public function getSelectedWSId() 
    {
        $selectedWSId = null;

        if (isset($_POST["wsDropdown"])) 
        {
            $selectedWSId = $_POST["wsDropdown"];
        }

        return $selectedWSId;
    }

    public function getSelectedWSInfo($selectedWSId)
    {
        $selectedWSInfo = null;

        if ($selectedWSId !== null) 
        {
            $unAssignedBids = $this->getUnassignedBids($selectedWSId);

            // Check if 'workName' key exists in the first bid
            $workName = isset($unAssignedBids[0]['workName']) ? $unAssignedBids[0]['workName'] : '';

            // Include the necessary keys in the selectedWSInfo array
            $selectedWSInfo = [
                'wsId' => $selectedWSId,
                'unAssignedBids' => $unAssignedBids,
                'User_Id' => $this->getSelectedEmpId(),
                'workName' => $workName,
            ];
        }

        return $selectedWSInfo;
    }

    public function getUnassignedBids($wsId)
    {
        $sql = "SELECT workName, staffRole , sBid FROM workslot WHERE wsId = ? AND sBid = 0";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $wsId);
        mysqli_stmt_execute($stmt);

        // Bind variables to the result set
        mysqli_stmt_bind_result($stmt, $staffRole, $workName, $sBid);

        $unassignBids = [];

        while (mysqli_stmt_fetch($stmt)) {
            $unassignBids[] = [
                'sBid' => $sBid,
                'workName' => $workName,
                'staffRole'=> $staffRole,
            ];
        }
        return $unassignBids;
    }


    // Retrieve Profile Names
    public function getEmpNames()
    {
        $sql = "SELECT E_Name, User_Id, staffRole FROM uniProfile";
        $result = $this->conn->query($sql);

        $empNames = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) 
            {
                $empNames[] = $row;
            }
        }

        return $empNames;
    }

    public function getSelectedEmpId()
    {
        $selectedEmpId = null;

        if (isset($_POST["uStaff"])) 
        {
            $selectedEmpId = $_POST["uStaff"];
        }

        return $selectedEmpId;
    }

    public function getSelectedEmpInfo($selectedEmpId)
    {
        $selectedEmpInfo = null;

        if ($selectedEmpId !== null) 
        {
            $userInfo = $this->getEmpDeets($selectedEmpId);

            if (!empty($userInfo)) 
            {
                $selectedEmpInfo = [
                    'User_Id' => $selectedEmpId,
                    'userInfo' => $userInfo,
                    'E_Name' => isset($userInfo['E_Name']) ? $userInfo['E_Name'] : null,
                ];
            }
        }

        return $selectedEmpInfo;
    }

    public function getEmpDeets($selectedEmpId)
    {
        $sql = "SELECT E_Name, staffRole FROM uniprofile WHERE User_Id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $selectedEmpId);
        mysqli_stmt_execute($stmt);

        // Bind variables to the result set
        mysqli_stmt_bind_result($stmt, $eName, $staffRole);

        $empDeets = [];

        while (mysqli_stmt_fetch($stmt)) {
            // Check if $eName is not null
            if ($eName !== null) {
                $empDeets = [
                    'E_Name' => $eName,
                ];
            }
        }

        return $empDeets;
    }

    public function insertBid($wsId, $bidderId, $newSBid, $E_Name, $workName)
    {
        // Extract the employee name without the staff role
        $employeeName = $this->getEmployeeNameWithoutRole($E_Name);

        // Insert the bid data into the database
        // Use prepared statements for security
        $sql = "INSERT INTO bids (wsId, bidderId, bidStatus, E_Name, workName) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt) 
        {
            mysqli_stmt_bind_param($stmt, "iiiss", $wsId, $bidderId, $newSBid, $employeeName, $workName);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) 
            {
                // Update sBid in WorkSlot after successful bid insertion
                $this->updateSBidInWorkSlot($wsId);
                mysqli_stmt_close($stmt);
                return true;
            } 
            else 
            {
                mysqli_stmt_close($stmt);
                return false;
            }
        } 
        else 
        {
            return false;
        }
    }

    // Add a new method to get employee name without role
    private function getEmployeeNameWithoutRole($E_Name)
    {
        // Split the name by '-' and get the first part
        $nameParts = explode('-', $E_Name);
        return trim($nameParts[0]); // Trim to remove any leading/trailing whitespaces
    }

    //Update Workslot Bid when Approved
    private function updateSBidInWorkSlot($wsIdUp)
    {
        $sqlUpdateSBid = "UPDATE workslot SET sBid = 1 WHERE wsId = ?";
        $stmtUpdateSBid = mysqli_prepare($this->conn, $sqlUpdateSBid);

        if ($stmtUpdateSBid) 
        {
            mysqli_stmt_bind_param($stmtUpdateSBid, "i", $wsIdUp);
            mysqli_stmt_execute($stmtUpdateSBid);
            mysqli_stmt_close($stmtUpdateSBid);
        } 
        else 
        {
            echo "Error in preparing statement to update sBid: " . mysqli_error($this->conn);
        }
    }

    public function getBidData($wsId)
    {
        // Fetch the data you need based on the $wsId
        $workSlotInfo = $this->getSelectedWSInfo($wsId);
        $selectedEmpId = $workSlotInfo['User_Id'];
        $selectedEmpInfo = $this->getSelectedEmpInfo($selectedEmpId);

        $staffRole = $workSlotInfo['unAssignedBids'][0]['staffRole'];
        $workDate = $workSlotInfo['unAssignedBids'][0]['workName'];
        $bidderId = $selectedEmpInfo['User_Id'];
        $E_Name = $selectedEmpInfo['E_Name'];

        // Combine the necessary information to create the "workName"
        $workName = "$staffRole";

        return [
            'wsId' => $wsId,
            'bidderId' => $bidderId,
            'E_Name' => $E_Name,
            'workName' => $workName,
        ];
    }
}
?>