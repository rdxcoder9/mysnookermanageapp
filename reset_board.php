<?php
include './connect.php';
mysqli_autocommit($conn,FALSE);
$boardSno = $_REQUEST['board_sno'];

//Query for Delete Board Entry
$boardDeleteQuery = "DELETE FROM `boarddata` WHERE bsno='{$boardSno}'";
$boardXDataQuery = "DELETE FROM `extraboard` WHERE boardSno='{$boardSno}'"; 

if(mysqli_query($conn,$boardDeleteQuery)){
    if(mysqli_query($conn,$boardXDataQuery)){
        mysqli_commit($conn);
        ?>
            <script>
            alert("Board Deleted...");
            location.href='./';
        </script>
        <?php
    }
    else{
        mysqli_rollback($conn);
        ?>
        <script>
            alert("Server Error Please Try Again!!");
            location.href='./';
        </script>
        <?php
    }
}
else{
    mysqli_rollback($conn);
    ?>
    <script>
        alert("Server Error Please Try Again!!");
        location.href='./';
    </script>
    <?php
}
?>