<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Aman's Capital</title>
</head>

<body>

    <?php include './nav.php'; ?>
    <?php
    if (isset($_REQUEST['board_no'])) {
        include './connect.php';
        $board_number = $_REQUEST['board_no'];
        $query_for_board_data = "SELECT * FROM `boarddata` WHERE boardNo='{$board_number}' ORDER BY bsno DESC";
        $result = mysqli_query($conn,$query_for_board_data);
    ?>
        <div class="container-fluid">
            <h4 class="text-center">Board No. <?php echo ($board_number); ?></h4>
            <hr>
        </div>
        <div class="container table-responsive ">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Date</th>
                        <!-- <th scope="col" class="text-center">Start / Close</th> -->
                        <th scope="col" class="text-center">Time</th>
                        <!-- <th scope="col" class="text-center">Board Amount</th>
                        <th scope="col" class="text-center">Extra Item</th>-->
                        <th scope="col" class="text-center">Total</th> 
                        <th scope="col" class="text-center">Close On</th>
                        <th scope="col" class="text-center">View / Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sno = 1; while($row_result = mysqli_fetch_assoc($result)){?>
                    <tr>
                        <th scope="row" class="text-center"><?php echo($sno); ?></th>
                        <td class="text-center"><?php echo($row_result['date']); ?></td>
                        <!-- <td class="text-center"><?php //echo($row_result['start']." - ".$row_result['close']); ?></td> -->
                        <td class="text-center"><?php echo($row_result['boardtime']." Min"); ?></td>
                        <!-- <td class="text-center"><?php //echo($row_result['boardamount']." Rs"); ?></td>
                        <td class="text-center"><?php //echo($row_result['bxamount']." Rs"); ?></td> -->
                        <td class="text-center"><?php echo($row_result['total_bill']." Rs"); ?></td>
                        <td class="text-center"><?php echo($row_result['userName']); ?></td>
                        <td class="text-center"><a href="./view_board_details.php?board_sno=<?php echo($row_result['bsno']); ?>" class="btn btn-primary">View</button></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php
    } else {
        echo ("Hello");
    ?>
    <?php
    }
    ?>








    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

    
    -->


</body>

</html>
