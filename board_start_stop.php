<?php
date_default_timezone_set('Asia/Kolkata');
include 'connect.php';
$num = $_POST['board_num'];

    if($num != ""){

    $boardquery = "SELECT * FROM `boarddata` WHERE status = 0 AND boardNo= '{$num}'";
    $boardresult = mysqli_query($conn, $boardquery);
    $board_Status = mysqli_num_rows($boardresult);
    


    if($board_Status >= 1){
        $userName = $_POST['closeUserName'];
        while($M1row = mysqli_fetch_assoc($boardresult)){
            $M1Sno = $M1row['bsno'];
            $M1StartTime = $M1row['start'];
        }
        $boardM1extra = "SELECT * FROM `extraboard` WHERE boardSno='{$M1Sno}'";
        $boardM1extraAmount = mysqli_query($conn,$boardM1extra);
        $totalBoardExtraAmount = 0;
        while($boardM1extraAmountRow = mysqli_fetch_assoc($boardM1extraAmount)){
            $totalBoardExtraAmount = $totalBoardExtraAmount + $boardM1extraAmountRow['amount'];
        }
        
        //Stop Board Code Here
        $userName = $_POST['closeUserName'];
        $closeTime = date("H:i");//Closing Time
        $date = date("d-m-Y");

        //echo($closeTime);
        //Split Start Time
        $StartTimeArray = str_split($M1StartTime);
        $hourStart= $StartTimeArray[0]."".$StartTimeArray[1];
        $minuteStart = $StartTimeArray[3]."".$StartTimeArray[4];
        
        //Split Close time
        $StopTimeArray = str_split($closeTime);
        $hourStop= $StopTimeArray[0]."".$StopTimeArray[1];
        $minuteStop = $StopTimeArray[3]."".$StopTimeArray[4];

        $THours = ($hourStop-$hourStart)*60;
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

        //Board Payment Calculation For S1 or S2
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
        
        //Board Payment Calculation For P1 or P2
        if($num == 5 || $num == 6){
            if($Tminute <= 15){
                $boardM1Time = $Tminute;
                $totalBoardAmount = 30;
            }
            else{
                $boardM1Time = $Tminute;
                $totalBoardAmount = round($Tminute*1);
            }
        }

        




        $StopQueryM1 = "UPDATE `boarddata` SET `close`='{$closeTime}',`userName`='{$userName}',`status`=1,`bxamount`='{$totalBoardExtraAmount}',`boardamount`='{$totalBoardAmount}',`boardtime`='{$boardM1Time}' WHERE bsno='{$M1Sno}'";
        
        if(mysqli_query($conn,$StopQueryM1))
        {
            ?>
            <script>
                alert("Board Stop Successfully");
                location.href='./';
            </script>
            <?php
        }
        else{
            echo("Error: ".$startM1Boardquery ."<br>".mysqli_error($conn));
        }

        //echo($boardM1Time."<br>".$totalBoardAmount);
        //echo("<br>".$totalBoardExtraAmount);

    }
    else{
        $startTime = date("H:i");//Closing Time
        $date = date("d-m-Y");
        $startM1Boardquery = "INSERT INTO `boarddata`(`boardNo`, `start`,`status`, `date`) VALUES ('{$num}','{$startTime}',0,'{$date}')";
        if(mysqli_query($conn,$startM1Boardquery))
        {
            ?>
            <script>
                alert("Board Start Successfully");
                location.href='./';
            </script>
            <?php
        }
        else{
            echo("Error: ".$startM1Boardquery ."<br>".mysqli_error($conn));
        }
        
    }
}
else
{
    ?>
    <script>
        alert("Invalid Request!!!");
        location.href='./';
    </script>
    <?php
}



?>