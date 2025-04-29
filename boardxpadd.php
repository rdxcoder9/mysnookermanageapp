<?php
date_default_timezone_set('Asia/Kolkata');
include 'connect.php';
$num = $_POST['board_num'];
$productName = $_POST['product_name'];
$productAmount = $_POST['product_amount'];
$time = date("H:i");
$date = date("d-m-Y");


    $boardquery = "SELECT * FROM `boarddata` WHERE status = 0 AND boardNo= '{$num}'";
    $boardresult = mysqli_query($conn, $boardquery);
    $boardStatus = mysqli_num_rows($boardresult);
    if($boardStatus >= 1){
        while($boardrow = mysqli_fetch_assoc($boardresult)){
            $BoardSno = $boardrow['bsno'];
        }
    
        $productaddquery="INSERT INTO `extraboard`(`product`, `amount`, `boardSno`) VALUES ('{$productName}','{$productAmount}','{$BoardSno}')";

        if(mysqli_query($conn,$productaddquery)){
            ?>
                <script>
                    alert("Product Add Successfully");
                    location.href='./';
                </script>
                <?php
        }
        else
        {
            echo("Error: ".$productaddquery ."<br>".mysqli_error($conn));
        }

    }
    else{
        ?>
                <script>
                    alert("Product Not Added...");
                    location.href='./';
                </script>
        <?php
    }
    



?>