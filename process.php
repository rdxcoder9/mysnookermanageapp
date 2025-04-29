<?php
date_default_timezone_set('Asia/Kolkata');
include './connect.php';
// Get the code from the request
$code = $_REQUEST['code'];

//Function call

//Check User Function Call
if ($code == 1) {
    checkUser($_POST['user_name'], $conn);
} else if ($code == 2) {
    // Add a new User
    addUser($conn, $_POST['userName'], $_POST['name'], $_POST['mobile'], $_POST['address']);
} else if ($code == 3) {
    // Check if the user can login
    checkLogin($conn, $_POST['userName'], $_POST['password']);
} else if ($code == 4) {
    // Add an extra item
    addExtraItem($conn, $_POST['closeUserName'], " ", $_POST['product_amount']);
} else if ($code == 5) {
    // Add a payment to a user
    addpaidamount($conn,$_POST['paid_amount'],$_POST['userName']);
} else if ($code == 6) {
    // Delete an extra item
    deleteExtraItem($_REQUEST['extraItemSno'], $conn, $_REQUEST['user_Name']);
} else if ($code == 7) {
    // Delete an extra item from a closed board
    deleteExtraItemFromCloseBoard($_REQUEST['product_id'], $conn, $_REQUEST['board_sno'], $_REQUEST['board_bill']);
} else if ($code == 8) {
    // Update the board details
    update_board_details($conn,$_REQUEST['board_Sno'],$_REQUEST['board_start'],$_REQUEST['board_close'],$_REQUEST['userName']);
}
else if($code == 9){
    // Reset the admin password
    reset_admin_password($conn,$_POST['userName'],$_POST['old_password'],$_POST['new_password']);
} else {
    // If code is wrong redirect to the index
?>
    <script>
        location.href = "./";
    </script>
    <?php
}
//---------------------
//---------------------
//---------------------

//Function List

//Reset Admin Password
function reset_admin_password($conn,$userName,$old_password,$new_password){
    mysqli_autocommit($conn, FALSE);
    //sanitize inputs
    $userName = mysqli_real_escape_string($conn, $userName);
    $old_password = mysqli_real_escape_string($conn, $old_password);
    $new_password = mysqli_real_escape_string($conn, $new_password);
    $query_for_old_password = "SELECT * FROM `admindata` WHERE userName='{$userName}' AND password='{$old_password}'";
    $result = mysqli_query($conn,$query_for_old_password);
    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }
    $num = mysqli_num_rows($result);

    if($num >= 1){// If password is correct
        // Hash the new password before saving it
        $new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE `admindata` SET `password`='{$new_password}' WHERE userName='{$userName}'";
        if(mysqli_query($conn,$query)){
            mysqli_commit($conn);
            if (!$query) {
                die("Error in query: " . mysqli_error($conn));
            }

            mysqli_close($conn);
            ?>
                <script>
                    alert("Password Changed..........");
                    location.href="./profile.php";
                </script>
            <?php
        }
        else{
            mysqli_rollback($conn);
            ?>
                <script>
                    alert("Server Error Please Try Again!!!!");
                    location.href="./profile.php";
                </script>
            <?php

        }

    }// If password is not correct
    else{
        ?>
        <script>
            alert("Wrong Password !!!");
            location.href="./profile.php";
        </script>
        <?php
    }
}

// Add a paid amount to a user
function addpaidamount($conn,$paid_amount,$userName){
    //sanitize inputs
    $paid_amount = mysqli_real_escape_string($conn, $paid_amount);
    $userName = mysqli_real_escape_string($conn, $userName);

    $time = date("H:i");//Closing Time
    $date = date("d-m-Y");
    mysqli_autocommit($conn, FALSE);
    // Validate that the paid amount is a number
    if (!is_numeric($paid_amount)) {
        ?>
        <script>
            alert("Error: Paid amount must be a number.");
        </script>
        <?php
    }
    $query_for_add_amount = "INSERT INTO `paidamount`(`amount`,`userName`,`paiddate`,`paidtime`) VALUES ('{$paid_amount}','{$userName}','{$date}','{$time}')";

    if(mysqli_query($conn,$query_for_add_amount))
        {
            mysqli_commit($conn);
            mysqli_close($conn);
            ?>
            <script>
                alert("Paymet Added.....");
                location.href='./user_details.php?userName=<?php echo($userName);?>';
            </script>
            <?php
        }
        else{
            mysqli_rollback($conn);
        mysqli_close($conn);
            ?>
            <script>
                alert("Server Error Please Try Again!!!!");
                location.href='./user_details.php?userName=<?php echo($userName);?>';
            </script>
            <?php
        }

}

// Update the board details
function update_board_details($conn,$board_sno,$board_start,$board_close,$userName){

    //sanitize inputs
    $board_sno = mysqli_real_escape_string($conn, $board_sno);
    $board_start = mysqli_real_escape_string($conn, $board_start);
    $board_close = mysqli_real_escape_string($conn, $board_close);
    $userName = mysqli_real_escape_string($conn, $userName);
    mysqli_autocommit($conn, FALSE);

    // Search for the old data of the board
    $query_for_old_board_data = "SELECT * FROM `boarddata` WHERE bsno='{$board_sno}'";
    $result_data = mysqli_query($conn,$query_for_old_board_data);
    $row_data_old = mysqli_fetch_assoc($result_data);

    //echo($board_start."<br>".$board_close."<br>".$board_sno);

    $totalBoardExtraAmount = $row_data_old['bxamount'];

    //Board Number For Calculation
    $num = $row_data_old['boardNo'];

    //Stop Board Code Here
    // Split Start Time
    $StartTimeArray = str_split($board_start);
    $hourStart= $StartTimeArray[0]."".$StartTimeArray[1];
    $minuteStart = $StartTimeArray[3]."".$StartTimeArray[4];
    
    //Split Close time
    $StopTimeArray = str_split($board_close);
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
    if (!$result_data) {
        die("Error in query: " . mysqli_error($conn));
    }
    //Total Bill Variable
    $totalAmount = $totalBoardAmount + $totalBoardExtraAmount;

    $StopQueryM1 = "UPDATE `boarddata` SET `close`='{$board_close}',start='{$board_start}',`userName`='{$userName}',`status`=1,`bxamount`='{$totalBoardExtraAmount}',`boardamount`='{$totalBoardAmount}',`boardtime`='{$boardM1Time}',total_bill='{$totalAmount}' WHERE bsno='{$board_sno}'";
    
    // If the query is correct, commit the changes
    if(mysqli_query($conn,$StopQueryM1))
        {
            mysqli_commit($conn);
            mysqli_close($conn);
            ?>
            <script>
                alert("Board Update Successfully");
                location.href='./view_board_details.php?board_sno=<?php echo($board_sno);  ?>';
            </script>
            <?php
        }
        else{
            // else, rollback the changes and show an error
            if (!$StopQueryM1) die("Error in query: " . mysqli_error($conn));
            mysqli_rollback($conn);
        mysqli_close($conn);
            ?>
            <script>
                alert("Server Error Please Try Again!!!!");
                location.href='./view_board_details.php?board_sno=<?php echo($board_sno);  ?>';
            </script>
            <?php
        }
        
}

// Delete an Extra Item From a Close Board
function deleteExtraItemFromCloseBoard($extraItemSno, $conn, $board_sno, $board_bill)
{
    //sanitize inputs
    $extraItemSno = mysqli_real_escape_string($conn, $extraItemSno);
    $board_sno = mysqli_real_escape_string($conn, $board_sno);
    $board_bill = mysqli_real_escape_string($conn, $board_bill);
    mysqli_autocommit($conn, FALSE);
    // Query to delete the extra item
    $query_for_delete_extra_item = "DELETE FROM `extraboard` WHERE bxsno='{$extraItemSno}'";
    $query_for_update_extra_item_amount = "SELECT * FROM `extraboard` WHERE boardSno='{$board_sno}'";

    // If the item is deleted
    if (mysqli_query($conn, $query_for_delete_extra_item)) {
        $result_extra_Item = mysqli_query($conn, $query_for_update_extra_item_amount);
        $total_amount = 0;
        while ($row_total_extra = mysqli_fetch_assoc($result_extra_Item)) {
            $total_amount = $total_amount + $row_total_extra['amount'];
        }
        $total_bill = $board_bill + $total_amount;
        // Query to update the board information
        $queryforupdateexamount = "UPDATE `boarddata` SET `bxamount`='{$total_amount}',total_bill='{$total_bill}' WHERE bsno='{$board_sno}'";

        // If the update is correct commit it
        if (mysqli_query($conn, $queryforupdateexamount)) {
            mysqli_commit($conn);
            mysqli_close($conn);
    ?>
            <script>
                alert("Extra Item Deleted..........");
                location.href = './view_board_details.php?board_sno=<?php echo ($board_sno); ?>';
            </script>
        <?php
        // If there is an error in the query
        } else {
            mysqli_rollback($conn);
            mysqli_close($conn);
        ?>
            <script>
                alert("Server Error Please Try Again !!!!");
                location.href = './view_board_details.php?board_sno=<?php echo ($board_sno); ?>';
            </script>
        <?php
        }
    // If there is an error in the first query
    } else {
        mysqli_rollback($conn);
        mysqli_close($conn);
        ?>
        <script>
            alert("Server Error Please Try Again !!!!");
            location.href = './view_board_details.php?board_sno=<?php echo ($board_sno); ?>';
        </script>
    <?php
    }
}

// Delete an Extra Item
function deleteExtraItem($extraItemSno, $conn, $userName)
{
    //sanitize inputs
    $extraItemSno = mysqli_real_escape_string($conn, $extraItemSno);
    mysqli_autocommit($conn, FALSE);
    $query_for_delete_extra_item = "DELETE FROM `userextra` WHERE uxsno='{$extraItemSno}'";
    // If the item is deleted
    if (mysqli_query($conn, $query_for_delete_extra_item)) {
        mysqli_commit($conn);
        mysqli_close($conn);
    ?>
        <script>
            alert("Extra Item Deleted..........");
            location.href = './user_details.php?userName=<?php echo ($userName); ?>';
        </script>
    <?php
    // If there is an error in the query
    } else {
        mysqli_rollback($conn);
        mysqli_close($conn);
    ?>
        <script>
            alert("Server Error Please Try Again !!!!");
            location.href = './user_details.php?userName=<?php echo ($userName); ?>';
        </script>
    <?php
    }
}

// Check if a user is duplicated
function checkUser($userName, $conn)
{
    //sanitize inputs
    $userName = mysqli_real_escape_string($conn, $userName);
    $queryforusercheck = "SELECT * FROM `usersdata` WHERE userName='{$userName}'";
    $checkResult = mysqli_query($conn, $queryforusercheck);
    if (!$checkResult) die("Error in query: " . mysqli_error($conn));
    
    $count_user = mysqli_num_rows($checkResult);
    mysqli_close($conn);
    if ($count_user > 0) {
        echo ("1");
    } else {
        echo ("0");
    }
}

// Add a New User
function addUser($conn, $userName, $Name, $Mobile, $Address)
{
    //sanitize inputs
    $userName = mysqli_real_escape_string($conn, $userName);
    $Name = mysqli_real_escape_string($conn, $Name);
    $Mobile = mysqli_real_escape_string($conn, $Mobile);
    $Address = mysqli_real_escape_string($conn, $Address);
    mysqli_autocommit($conn, FALSE);
    $queryForAddUser = "INSERT INTO `usersdata`(`userName`, `Name`, `Mobile`, `Address`) VALUES ('{$userName}','{$Name}','{$Mobile}','{$Address}')";
    // If the user is added correct
    if (mysqli_query($conn, $queryForAddUser)) {
        mysqli_commit($conn);
        mysqli_close($conn); //Close Data Base
    ?>
        <script>
            alert("User Added....");
            location.href = './user_list.php';
        </script>
    <?php
    // If the user is not added correct
    } else {
        mysqli_rollback($conn);
        mysqli_close($conn); //Close Data Base
    ?>
        <script>
            alert("Server Error Please Try Again !!!!");
            location.href = './user_list.php';
        </script>
    <?php
    }
}

// Check if the Admin can login
function checkLogin($conn, $userName, $password)
{
    //sanitize inputs
    $userName = mysqli_real_escape_string($conn, $userName);
    $password = mysqli_real_escape_string($conn, $password);
    $queryforchecklogin = "SELECT * FROM admindata WHERE userName='{$userName}'";
    $result = mysqli_query($conn, $queryforchecklogin);
    if (!$result) die("Error in query: " . mysqli_error($conn));

    $num = mysqli_num_rows($result);

    // If user exist
    if ($num == 1) {
        $row_data = mysqli_fetch_assoc($result);
        //verify password
        if(password_verify($password,$row_data['password'])){
            session_start();
            $_SESSION["token"] = $userName;
            mysqli_close($conn);
            ?>
                <script>
                    location.href="./";
                </script>
            <?php
        }else{
            mysqli_close($conn);
            ?>
            <script>
                alert("Wrong Password Please Try Again!!!!");
                location.href="./login.php";
            </script>
            <?php
        }
        
    } else {
    ?>
        <script>
            alert("Invalid User !!!");
            location.href = "./login.php";
        </script>
    <?php
    }
}

// Add an extra item
function addExtraItem($conn, $userName, $product_name, $product_amount)
{
    //sanitize inputs
    $userName = mysqli_real_escape_string($conn, $userName);
    $product_name = mysqli_real_escape_string($conn, $product_name);
    $product_amount = mysqli_real_escape_string($conn, $product_amount);
    mysqli_autocommit($conn, FALSE);
    $Time = date("H:i"); //Closing Time
    $date = date("d-m-Y");
    $query = "INSERT INTO `userextra`(`uxproduct`, `uxamount`, `uxdate`, `uxtime`, `userName`) VALUES ('{$product_name}','{$product_amount}','{$date}','{$Time}','{$userName}')";
    if (mysqli_query($conn, $query)) {
        mysqli_commit($conn);
        mysqli_close($conn);
    ?>
        <script>
            alert("Extra Item Added....");
            location.href = './user_list.php';
        </script>
    <?php
    } else {
        mysqli_rollback($conn);
        mysqli_close($conn);
    ?>
        <script>
            alert("Server Error Please Try Again !!!!");
            location.href = './user_list.php';
        </script>
<?php
    }
}
?>