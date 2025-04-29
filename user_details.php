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
    <div class="container-fluid">
        <div class="card-deck">
            <div class="card">
                <div class="card-body">
                    <?php
                    include './connect.php';
                    $user_Name = $_REQUEST['userName'];
                    $query_for_user_details = "SELECT * FROM `usersdata` WHERE userName = '{$user_Name}'";
                    $result_details = mysqli_query($conn, $query_for_user_details);
                    $Name = "";
                    $Mob = "";
                    $Add = "";
                    while ($row = mysqli_fetch_assoc($result_details)) {
                        $Name = $row['Name'];
                        $Mob = $row['Mobile'];
                        $Add = $row['Address'];
                    }
                    ?>
                    <h5 class="card-title">Name :- <?php echo ($Name); ?></h5>
                    <h5 class="card-title">Mobile :- <?php echo ($Mob); ?></h5>
                    <h5 class="card-title">Address :- <?php echo ($Add); ?></h5>
                    <!-- Query For Total Due Amount -->
                    <?php

                    //Code for Extra Item Data
                    $query_for_extra_item1 = "SELECT * FROM `userextra` WHERE userName='{$user_Name}' ORDER BY uxsno DESC";
                    $result_extra_item1 = mysqli_query($conn, $query_for_extra_item1);
                    $extotalamount = 0;
                    while ($extotalrow1 = mysqli_fetch_assoc($result_extra_item1)) {
                        $extotalamount = $extotalamount + $extotalrow1['uxamount'];
                    }
                    //Query For Total Board Payments
                    $queryForBoardAmount = "SELECT * FROM `boarddata` WHERE userName='{$user_Name}'";
                    $resultForBoardAmount = mysqli_query($conn, $queryForBoardAmount);
                    $totalBoardAmount = 0;
                    while ($rowBoard = mysqli_fetch_assoc($resultForBoardAmount)) {
                        $totalBoardAmount = $totalBoardAmount + $rowBoard['total_bill'];
                    }
                    $totalBoardAmount = $totalBoardAmount + $extotalamount;

                    //Query For Paid Amount Calculation
                    $query_paid_amount = "SELECT * FROM `paidamount` WHERE userName='{$user_Name}'";
                    $result_paid_amount = mysqli_query($conn, $query_paid_amount);
                    $total_paid_amount = 0;
                    while ($paidrow = mysqli_fetch_assoc($result_paid_amount)) {
                        $total_paid_amount = $total_paid_amount + $paidrow['amount'];
                    }
                    $total_due_amount = $totalBoardAmount - $total_paid_amount;
                    ?>
                    <h5 class="card-title text-danger">Due Amount :- <?php echo ($total_due_amount); ?></h5>
                    <!-- Paid Amount Form -->
                    <form action="./process.php" method="POST">
                        <div class="form-group">
                            <label>Paid Amount</label>
                            <input type="text" class="form-control" name="paid_amount" required>
                        </div>
                        <div style="display: none;">
                            <input type="text" value="<?php echo ($user_Name); ?>" name="userName">
                            <input type="text" value="5" name="code">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recent 5 Payments</h5>
                    <hr>
                    <div>
                    <table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
  <tbody class="text-center">
    <tr style="border-collapse: collapse; border: 1px solid black;">
    <th style="border-collapse: collapse; border: 1px solid black;">Sno</th>
    <th style="border-collapse: collapse; border: 1px solid black;">Amount</th>
    <th style="border-collapse: collapse; border: 1px solid black;">Date</th>
    <th style="border-collapse: collapse; border: 1px solid black;">Time</th>
</tr>
<?php $query_for_paid_amount="SELECT * FROM `paidamount` WHERE userName='{$user_Name}' ORDER BY paidsno DESC";
    $result_obj = mysqli_query($conn,$query_for_paid_amount);
    $paid_sno = 1;
    while($row_paid=mysqli_fetch_assoc($result_obj)){
?>
<tr style="border-collapse: collapse; border: 1px solid black;">
<td style="border-collapse: collapse; border: 1px solid black;"><?php echo($paid_sno); ?></td>
<td style="border-collapse: collapse; border: 1px solid black;"><?php echo($row_paid['amount']." Rs"); ?></td>
<td style="border-collapse: collapse; border: 1px solid black;"><?php echo($row_paid['paiddate']); ?></td>
<td style="border-collapse: collapse; border: 1px solid black;"><?php echo($row_paid['paidtime']); ?></td>
</tr>
<?php
if($paid_sno==5){
break;
}
$paid_sno = $paid_sno + 1;
} ?>


    
  </tbody>
</table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">Extra Item Recent 10</h5>
                    <hr> -->
                </div>
            </div>
            <!-- Recent 10 Borard Details -->
            <?php
            ?>
        </div>
    </div>

    <br>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6 ">
                        <h5>Recent 20 Board List</h5>
                    </div>
                    <div class="col-3 mx-auto">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewAllModel">
                            View All
                        </button>
                    </div>
                    <div class="col-3 mx-auto"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewExtraItem">
                            Extra Items
                        </button></div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Board No.</th>
                            <th scope="col">Start</th>
                            <th scope="col">Stop</th>
                            <th scope="col">Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $queryForBoardAmount1 = "SELECT * FROM `boarddata` WHERE userName='{$user_Name}' ORDER BY bsno DESC";
                        $resultForBoardAmount1 = mysqli_query($conn, $queryForBoardAmount1);
                        $board_row_count = 1;
                        while ($rowBoard1 = mysqli_fetch_assoc($resultForBoardAmount1)) { ?>
                            <tr>
                                <th scope="row"><?php echo ($board_row_count); ?></th>
                                <td><?php echo ($rowBoard1['boardNo']); ?></td>
                                <td><?php echo ($rowBoard1['start']); ?></td>
                                <td><?php echo ($rowBoard1['close']); ?></td>
                                <td><?php echo ($rowBoard1['date']); ?></td>
                                <td><?php echo ($rowBoard1['total_bill']." Rs"); ?></td>
                                <td><a href="./view_board_details.php?board_sno=<?php echo ($rowBoard1['bsno']); ?>" class="btn btn-info">View / Edit</a></td>
                            </tr>
                        <?php if ($board_row_count == 20) {
                                break;
                            }
                            $board_row_count = $board_row_count + 1;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>








    <!-- Modal -->
    <div class="modal fade" id="viewAllModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">All Board Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body table-responsive">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Board No.</th>
                                    <th scope="col">Start</th>
                                    <th scope="col">Stop</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $queryForBoardAmount1 = "SELECT * FROM `boarddata` WHERE userName='{$user_Name}' ORDER BY bsno DESC";
                                $resultForBoardAmount1 = mysqli_query($conn, $queryForBoardAmount1);
                                $board_row_count = 1;
                                while ($rowBoard1 = mysqli_fetch_assoc($resultForBoardAmount1)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo ($board_row_count); ?></th>
                                        <td><?php echo ($rowBoard1['boardNo']); ?></td>
                                        <td><?php echo ($rowBoard1['start']); ?></td>
                                        <td><?php echo ($rowBoard1['close']); ?></td>
                                        <td><?php echo ($rowBoard1['date']); ?></td>
                                        <td><?php echo ($rowBoard1['total_bill'] . " Rs"); ?></td>
                                        <td><a href="./view_board_details.php?board_sno=<?php echo ($rowBoard1['bsno']); ?>" class="btn btn-info">View / Edit</a></td>
                                    </tr>
                                <?php
                                    $board_row_count = $board_row_count + 1;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="viewExtraItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Extra Items List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body table-responsive">
                        <?php
                        $query_for_extra_item = "SELECT * FROM `userextra` WHERE userName='{$user_Name}' ORDER BY uxsno DESC";
                        $result_extra_item = mysqli_query($conn, $query_for_extra_item);
                        $extraItemSno = 1;
                        while ($extraItemRow = mysqli_fetch_assoc($result_extra_item)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <div>
                                    <!-- <strong>Extra Item <?php //echo ($extraItemSno); 
                                                            ?></strong> -->
                                    <div class="row">
                                        <div class="col-4">Rs. = <?php echo ($extraItemRow['uxamount']); ?></div>
                                        <div class="col-4">Date = <?php echo ($extraItemRow['uxdate']); ?></div>
                                        <div class="col-4">Time = <?php echo ($extraItemRow['uxtime']); ?></div>
                                    </div>
                                    <a href="./process.php?code=6&extraItemSno=<?php echo ($extraItemRow['uxsno']); ?>&user_Name=<?php echo ($user_Name); ?>" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            </div>
                        <?php if ($extraItemSno == 20) {
                                break;
                            }
                            $extraItemSno = $extraItemSno + 1;
                        } ?>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>





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