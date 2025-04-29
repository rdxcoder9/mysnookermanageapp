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
    if (isset($_REQUEST['board_sno'])) {
        include './connect.php';
        $board_sno = $_REQUEST['board_sno'];
        $query_for_board_details = "SELECT * FROM `boarddata` WHERE bsno='{$board_sno}'";
        $result = mysqli_query($conn, $query_for_board_details);
        $row = mysqli_fetch_assoc($result);
    ?>

        <div class="container">
            <h5 class="text-center"><?php echo ($board_sno . ". "); ?>Board Details View / Edit</h5>
            <hr>
            <form action="./process.php" method="POST">
                <div style="display:none;">
            <input type="text" value='<?php echo($board_sno); ?>' name='board_Sno'>
            <input type="text" value="8" name='code'>
            </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>Start</label>
                        <input type="text" class="form-control" value="<?php echo ($row['start']); ?>" name="board_start" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Stop</label>
                        <input type="text" class="form-control" value="<?php echo ($row['close']); ?>" name="board_close" required>
                    </div>
                    <?php
                    $query_for_users = 'SELECT * FROM `usersdata`';
                    $result_user = mysqli_query($conn, $query_for_users);
                    ?>
                    <div class="form-group col-md-4">
                        <label><b>User Name</b></label>
                        <select class="form-control" name="userName" required>
                            <option value="">Choose...</option>
                            <?php
                            while ($row_user = mysqli_fetch_assoc($result_user)) {
                                if ($row_user['userName'] == $row['userName']) {
                            ?>
                                    <option value='<?php echo ($row_user['userName']); ?>' selected><?php echo ($row_user['userName']); ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value='<?php echo ($row_user['userName']); ?>'><?php echo ($row_user['userName']); ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Date</label>
                        <input type="text" class="form-control" value="<?php echo ($row['date'] . ""); ?>" disabled>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Extra Item Total</label>
                        <input type="text" class="form-control" value="<?php echo ($row['bxamount'] . " Rs"); ?>" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Total Time</label>
                        <input type="text" class="form-control" value="<?php echo ($row['boardtime'] . " Min"); ?>" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Board Total</label>
                        <input type="text" class="form-control" value="<?php echo ($row['boardamount'] . " Rs"); ?>" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Total Bill</label>
                        <input type="text" class="form-control" value="<?php echo ($row['total_bill'] . " Rs"); ?>" disabled>
                    </div>
                </div>
                <hr>
                <br>
                <div class="row">
                    <div class="col-12 text-center"><button type="submit" class="btn btn-info btn-lg">Update</button></div>
                </div>

            </form>
        </div>
        <br>
        <hr>
        <div class="container">
            <h5 class="text-center">Extra Item on Board</h5>
            <hr>
            <div class="row">
                <div class="col-12">
                <?php
            $query_productm2 = "SELECT * FROM `extraboard` WHERE boardSno='{$board_sno}'";
            $product_result2 = mysqli_query($conn, $query_productm2);
            while ($productrow2 = mysqli_fetch_assoc($product_result2)) {
          ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo ($productrow2['product']); ?></strong> Amount = Rs. <?php echo ($productrow2['amount']); ?>
                <button type="button" class="close" aria-label="Close">
                  <span aria-hidden="true"><a class="text-danger" href="./process.php?product_id=<?php echo ($productrow2['bxsno']); ?>&board_sno=<?php echo($board_sno); ?>&code=7&board_bill=<?php echo($row['boardamount']); ?>">&times;</a></span>
                </button>
              </div>
          <?php
            }
          ?>
                </div>
            </div>
        </div>
    <?php  } ?>







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
