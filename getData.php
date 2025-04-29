<?php
// Set the default timezone to Asia/Kolkata
date_default_timezone_set('Asia/Kolkata');

// Include the database connection file
include 'connect.php';
// Set autocommit to FALSE to manage transactions manually
mysqli_autocommit($conn, FALSE);

// Sanitize the board number input
$num = mysqli_real_escape_string($conn, $_POST['board_num']);

// Check if a board number is provided
if ($num != "") {

    // Sanitize the input for board number
    $num = mysqli_real_escape_string($conn, $num);
    // Validate if the board number is a number
    if (!is_numeric($num)) {
        die("Error: Invalid board number format.");
    }
    // Query to select all data from table boarddata where status is 0 and the board number is the same as the one received
    $boardquery = "SELECT * FROM `boarddata` WHERE status = 0 AND boardNo= '{$num}'";
    $boardresult = mysqli_query($conn, $boardquery);
    // check if query fail
    if(!$boardresult){die("Error: ".mysqli_error($conn));}
    $board_Status = mysqli_num_rows($boardresult);


    if ($board_Status >= 1) {
        // Sanitize the username input
        $userName = mysqli_real_escape_string($conn, $_POST['closeUserName']);
        // loop over all the board data
        while ($M1row = mysqli_fetch_assoc($boardresult)) {
            $M1Sno = $M1row['bsno'];
            $M1StartTime = $M1row['start'];
        }
        // get all extra data from extraboard table with the board sno
        $boardM1extra = "SELECT * FROM `extraboard` WHERE boardSno='{$M1Sno}'";
        $boardM1extraAmount = mysqli_query($conn, $boardM1extra);
        // check if query fail
        if(!$boardM1extraAmount){die("Error: ".mysqli_error($conn));}
        $totalBoardExtraAmount = 0;
        while($boardM1extraAmountRow = mysqli_fetch_assoc($boardM1extraAmount)){
            $totalBoardExtraAmount = $totalBoardExtraAmount + $boardM1extraAmountRow['amount'];
        }
        
        //Stop Board Code Here
        $userName = $_POST['closeUserName'];
        $closeTime = date("H:i"); //Closing Time
        $date = date("d-m-Y"); // actual date
        $totalAmount = 0;

        //echo($closeTime);
        //Split Start Time
        $StartTimeArray = str_split($M1StartTime);
        $hourStart= $StartTimeArray[0]."".$StartTimeArray[1];
        $minuteStart = $StartTimeArray[3]."".$StartTimeArray[4];
        
        //Split Close time
        $StopTimeArray = str_split($closeTime);
        $hourStop= $StopTimeArray[0]."".$StopTimeArray[1];
        $minuteStop = $StopTimeArray[3]."".$StopTimeArray[4];

        $THours = ($hourStop - $hourStart) * 60;
        $Tminute = ($minuteStop-$minuteStart)+$THours;

        //Board Payment Calculation For M1 or M2
        if($num == 1 || $num == 2){
            if($Tminute <= 20){
                $boardM1Time = $Tminute;
                $totalBoardAmount = 50;
            }
            else{
                $boardM1Time = $Tminute;
                $totalBoardAmount = round($Tminute*2.5);
            }
        }

        //Board Payment Calculation For S1 or S2(Snooker Board)
        if($num == 3 || $num == 4){
            if($Tminute <= 15){
                $boardM1Time = $Tminute;
                $totalBoardAmount = 30;
            }
            else{
                $boardM1Time = $Tminute;
                $totalBoardAmount = round($Tminute*2);
            }
        }
        
        //Board Payment Calculation For P1 or P2(Pool Board)
        if($num == 5 || $num == 6){
            if($Tminute <= 15){
                $boardM1Time = $Tminute;
                $totalBoardAmount = 20;
            }
            else{
                $boardM1Time = $Tminute;
                $totalBoardAmount = round($Tminute*1);
            }
        }


        //Total Bill Variable(Total Bill = Board amount + Extra amount)
        $totalAmount = $totalBoardAmount + $totalBoardExtraAmount;

        //update the table boarddata with the info of the board, also set status to 1 to know the board is stoped.
        $StopQueryM1 = "UPDATE `boarddata` SET `close`='{$closeTime}',`userName`='{$userName}',`status`=1,`bxamount`='{$totalBoardExtraAmount}',`boardamount`='{$totalBoardAmount}',`boardtime`='{$boardM1Time}',total_bill='{$totalAmount}' WHERE bsno='{$M1Sno}'";
        // run the query to stop the board
        if (mysqli_query($conn, $StopQueryM1)) {
            // commit the changes
            mysqli_commit($conn);
            ?>
            <script>
                alert("Board Stop Successfully");
                location.href='./';
            </script>
        <?php
        } else {
            // rollback the changes
            mysqli_rollback($conn);
            ?>
             <script>
                alert("Server Error Please Try Again !!!!");
                location.href='./';
            </script>
            <?php
        } // end of if StopQueryM1
    } // end of if board status
    else {
        // set the start time to the actual time
        $startTime = date("H:i"); //Closing Time
        $date = date("d-m-Y"); // actual date
        //insert into table board data a new row, setting boardNo, start time, and status 0
        $startM1Boardquery = "INSERT INTO `boarddata`(`boardNo`, `start`,`status`, `date`) VALUES ('{$num}','{$startTime}',0,'{$date}')";

        // run the query to start the board
        if (mysqli_query($conn, $startM1Boardquery)) {
            // commit the changes
            mysqli_commit($conn);
            ?>
            <script>
                alert("Board Start Successfully");
                location.href='./';
            </script>
        <?php
        } else {
            // rollback the changes
            mysqli_rollback($conn);
            ?>
            <script>
                alert("Server Error Please Try Again !!!!");
                location.href='./';
            </script>
            <?php
        }
        
    }
} // end of if board number not empty
else {
    ?>
    <script> 
        alert("Invalid Request Please Try Again!!!"); 
        location.href='./';
    </script>
    <?php
}



} // end of if board number empty
?>