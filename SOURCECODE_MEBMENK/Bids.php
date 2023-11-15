<?php
class Bids
{
    private $conn;

    public function __construct() 
    {
        include("dbconnect.php");

        $this->conn = $conn;
    }

    // Retrive Workslots from a list
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
    
    // BIDDING Workslot
    public function bidWorkSlot($wsIdUp, $bidderId, $E_Name, $newBidStatus)
    {
        //Get workName from workslot database
        $workName = $this->getWorkName($wsIdUp);

        if ($workName) 
        {
            $sql = "INSERT INTO bids (wsId, bidderId, bidStatus, E_Name, workName) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($this->conn, $sql);

            if ($stmt) 
            {
                mysqli_stmt_bind_param($stmt, "iiiss", $wsIdUp, $bidderId, $newBidStatus, $E_Name, $workName);
                mysqli_stmt_execute($stmt);

                if (mysqli_stmt_affected_rows($stmt) > 0) 
                {
                    echo "Bid inserted successfully.";
                } 
                else 
                {
                    echo "Error: " . mysqli_error($this->conn);
                }
                mysqli_stmt_close($stmt);
            } 
            else 
            {
                echo "Error: " . mysqli_error($this->conn);
            }
        } 
        else 
        {
            echo "Error: WorkName not found for wsIdUp " . $wsIdUp;
        }
    }

    // VIEW PENDING Workslot
    public function getBidStatus($eName) 
    {
        $sql = "SELECT E_Name, workName, bidStatus FROM bids WHERE E_Name = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("s", $eName);
            $stmt->execute();
            $result = $stmt->get_result();
            $workSlots = [];
    
            while ($row = $result->fetch_assoc()) {
                $workSlots[] = $row;
            }
    
            $stmt->close();
            return $workSlots;
        } else {
            die('Error: ' . $this->conn->error);
        }
    }

    // Approve or Reject for Workslot (Owmer / Manager)
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
            $selectedWSInfo = [
                'wsId' => $selectedWSId,
                'pendingBids' => $this->getPendingBids($selectedWSId),
            ];
        }

        return $selectedWSInfo;
    }

    public function getSelectedBidInfo($selectedWSId)
    {
        $selectedBidInfo = null;

        if ($selectedWSId !== null) 
        {
            $selectedBidInfo = [
                'wsId' => $selectedWSId,
                'bidApproval' => $this->getApprovedBids($selectedWSId),
            ];
        }

        return $selectedBidInfo;
    }

    public function getPendingBids($wsId)
    {
        $sql = "SELECT E_Name, workName FROM bids WHERE wsId = ? AND bidStatus = 1";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $wsId);
        mysqli_stmt_execute($stmt);

        // Bind variables to the result set
        mysqli_stmt_bind_result($stmt, $eName, $workName);

        $pendingBids = [];

        while (mysqli_stmt_fetch($stmt)) {
            $pendingBids[] = [
                'E_Name' => $eName,
                'workName' => $workName,
            ];
        }
        return $pendingBids;
    }

    public function getApprovedBids($wsId)
    {
        $sql = "SELECT E_Name, workName, bidStatus FROM bids WHERE wsId = ? AND (bidStatus = 2 OR bidStatus = 3)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $wsId);
        mysqli_stmt_execute($stmt);

        // Bind variables to the result set
        mysqli_stmt_bind_result($stmt, $eName, $workName, $bidStatus);

        $bidApproval = [];

        while (mysqli_stmt_fetch($stmt)) {
            $bidApproval[] = [
                'E_Name' => $eName,
                'workName' => $workName,
                'bidStatus' => $bidStatus,
            ];
        }

        return $bidApproval;
    }


    public function getBidderNamesForWS($wsId)
    {
        $sql = "SELECT DISTINCT E_Name FROM bids WHERE wsId = ? AND bidStatus IN (2, 3)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $wsId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $bidderName);

        $bidderNames = [];

        while (mysqli_stmt_fetch($stmt)) {
            $bidderNames[] = $bidderName;
        }

        mysqli_stmt_close($stmt);

        return $bidderNames;
    }

    public function updateBidSlot($wsIdUp, $bidStatus)
    {
        $success = true;

        //Track the number of bids approved
        $approvedCount = 0;

        //Loop through each selected bid and update its status
        foreach ($bidStatus as $eName => $newBidStatus) 
        {
            // Only update bids with bidStatus = 1
            if ($newBidStatus == 2) 
            {
                $sqlUpdateSelected = "UPDATE bids SET bidStatus = ? WHERE wsId = ? AND E_Name = ? AND bidStatus = 1";
                $stmtUpdateSelected = mysqli_prepare($this->conn, $sqlUpdateSelected);

                if ($stmtUpdateSelected) 
                {
                    mysqli_stmt_bind_param($stmtUpdateSelected, "iss", $newBidStatus, $wsIdUp, $eName);
                    mysqli_stmt_execute($stmtUpdateSelected);
                    $rowsUpdated = mysqli_stmt_affected_rows($stmtUpdateSelected);

                    if ($rowsUpdated > 0) 
                    {
                        $approvedCount++;

                        //Update sBid in workslot table to 1
                        $this->updateSBidInWorkSlot($wsIdUp);
                    }

                    mysqli_stmt_close($stmtUpdateSelected);
                } 
                else 
                {
                    echo "Error in preparing statement: " . mysqli_error($this->conn);
                    $success = false;
                }
            }
        }

        //Check if more than one bid is approved
        if ($approvedCount > 1) 
        {
            echo '<script> alert ("Error: Only one bid can be approved.");</script>';
            $success = false;
        } 
        else 
        {
            //If any bid is approved, automatically reject other pending bids for the same work slot
            if ($approvedCount > 0) 
            {
                $this->autoRejectOtherBids($wsIdUp);
            }
        }

        return $success;
    }

    public function autoRejectOtherBids($wsId)
    {
        //Update the bidStatus for other bids (reject)
        $sqlRejectOthers = "UPDATE bids SET bidStatus = 3 WHERE wsId = ? AND bidStatus = 1";
        $stmtRejectOthers = mysqli_prepare($this->conn, $sqlRejectOthers);
        mysqli_stmt_bind_param($stmtRejectOthers, "i", $wsId);
        mysqli_stmt_execute($stmtRejectOthers);
        mysqli_stmt_close($stmtRejectOthers);
    }

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

    public function workSlotWithSBid1() 
    {
        $sql = "SELECT wsId, startTime, endTime, workDate, uniRole, 
            staffRole, workName, sBid FROM workslot WHERE sBid = 1";
        $result = $this->conn->query($sql);
        $workSlots = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bidStatus = $this->getBidStatusForBStatus2Or3($row['wsId']);

                $workSlots[] = $row;
            }
        }

        return $workSlots;
    }

    private function getBidStatusForBStatus2Or3($wsId)
    {
        $sql = "SELECT bidStatus FROM bids WHERE wsId = ? AND (bidStatus = 2 OR bidStatus = 3)";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $wsId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $numRows = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_close($stmt);

        return $numRows > 0 ? $numRows : 0;
    }

    // Update Rejection or Approve of Schedule
    public function updateCfmSlot($wsIdUp, $E_Name, $newSBid)
    {
        // Check if the new bid status is different from the existing bid status
        if ($newSBid != $this->getBidStatusForWS($wsIdUp, $E_Name)) 
        {
            // Check if there is already a bid with bidStatus 2 for the same wsId
            if ($newSBid == 2 && $this->hasBidStatusTwoForWS($wsIdUp)) 
            {
                echo '<span style="color: red;">Error: Cannot have two bids with approved status for the same work slot.</span>';
                return false;
            }

            $sql = "UPDATE bids SET bidStatus = ? WHERE wsId = ? AND E_Name = ?";
            $stmt = mysqli_prepare($this->conn, $sql);

            mysqli_stmt_bind_param($stmt, "iss", $newSBid, $wsIdUp, $E_Name);
            mysqli_stmt_execute($stmt);

            return mysqli_stmt_affected_rows($stmt) > 0;
        } 
        else 
        {
            return false; // New bid status is the same as the existing bid status
        }
    }

    public function getBidStatusForWS($wsId, $E_Name)
    {
        $sql = "SELECT bidStatus FROM bids WHERE wsId = ? AND E_Name = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "is", $wsId, $E_Name);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $bidStatus);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        return $bidStatus;
    }

    // Check if there is already a bid with bidStatus 2 for the same wsId
    private function hasBidStatusTwoForWS($wsId)
    {
        $sql = "SELECT COUNT(*) FROM bids WHERE wsId = ? AND bidStatus = 2";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $wsId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        return $count > 0;
    }

    //Check for unassigned slots
    public function getUnassignedSlots()
    {
        $sql = "SELECT workName, bidStatus, wsId FROM workslot";
        $result = $this->conn->query($sql);
        $cfmSlots = [];

        if ($result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                if ($row['bidStatus'] == 2) 
                {
                    $row['bidStatus'] = "Approve";
                } 
                elseif ($row['bidStatus'] == 3) 
                {
                    $row['bidStatus'] = "Rejected";
                } 
                else
                {
                    $row['bidStatus'] = "Pending Approval";
                }
                $cfmSlots[] = $row; 
            }      
        return $cfmSlots;
        }
    }

    // View All Workslots Allocated to each staff
    public function getCfmBids()
    {
        $sql = "SELECT A.E_Name, B.workName, A.bidStatus, B.wsId FROM workslot B LEFT OUTER JOIN bids A
            ON A.wsId = B.wsId";
        $result = $this->conn->query($sql);
        
        $cfmSlots = [];

        if ($result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc()) 
            {
                if (empty($row['E_Name']))
                {
                    // Handle empty E_Name
                    $row['E_Name'] = "No Employee Assigned";
                }
    
                if ($row['bidStatus'] == 2) 
                {
                    $row['bidStatus'] = "Approved";
                } 
                elseif ($row['bidStatus'] == 3) 
                {
                    $row['bidStatus'] = "Rejected";
                } 
                else if ($row['bidStatus'] == 1) 
                {
                    $row['bidStatus'] = "Pending Approval";
                }
                else
                {
                    $row['bidStatus'] = "Unassigned";
                }

                $cfmSlots[] = $row; 
            }      
        return $cfmSlots;
        }
    }
}
?>
