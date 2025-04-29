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
  <!-- Board Status Check Code -->
  <?php //Board Status Check PHP Code
  include 'connect.php';

  $allRecordList = "SELECT * FROM `usersdata` ORDER BY userName ASC";
  $resultAllRecordList = mysqli_query($conn, $allRecordList);
  ?>

  <?php include './nav.php'; ?>

  <div class="container-fluid mb-3">
    <div class="row">
      <div class="col-6">
        <h4>User List with Due Amount</h1>
      </div>
      <!-- Button trigger modal -->
      <div class="col-3"><button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">Add User</button></div>
      <div class="col-3"><button class="btn btn-primary" data-toggle="modal" data-target="#extraItemModal">Extra Item</button></div>

      <!-- Modal -->
      <div class="modal fade" id="extraItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Extra Items</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="./process.php" method="POST">
                <!-- <div class="form-group">
                  <label>Product Name</label>
                  <input type="text" class="form-control" name="product_name" required>
                </div> -->
                <div class="form-group">
                  <label for="exampleInputPassword1">Amount</label>
                  <input type="text" class="form-control" name="product_amount" required>
                </div>
                <div class="form-group">
                  <label for="inputUser">User Name</label>
                  <select id="inputUser" class="form-control" name="closeUserName" required>
                    <option value="" selected>Choose...</option>

                    <?php
                    $UserQuery1 = "SELECT * FROM `usersdata`";
                    $UserDataresult1 = mysqli_query($conn, $UserQuery1);
                    while ($Usrrow1 = mysqli_fetch_assoc($UserDataresult1)) {
                    ?>
                      <option><?php echo ($Usrrow1['userName']); ?></option>
                    <?php
                    } ?>

                  </select>
                </div>
                <div style="display:none ;">
                  <input type="text" name="code" value="4">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Add User  -->
      <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="./process.php" method="POST">
                <div class="form-group">
                  <label for="userNameq">User Name</label>
                  <input type="text" class="form-control" id="userNameq" name="userName" required>
                  <div id="uaealert" style="display: none;">
                    <small class="form-text text-danger">User Already Exist !!</small>
                  </div>
                </div>
                <div class="form-group">
                  <label for="Nameq">Name</label>
                  <input type="text" class="form-control" id="Nameq" name="name" required>
                </div>
                <div class="form-group">
                  <label for="mobileq">Mobile +91</label>
                  <input type="number" class="form-control" id="mobileq" name="mobile" minlength="10" maxlength="10" required>
                </div>
                <div class="form-group">
                  <label for="Addressq">Address</label>
                  <input type="text" class="form-control" id="Addressq" name="address" required>
                </div>
                <div style="display:none ;">
                  <input type="text" class="form-control" name="code" value="2">
                </div>
                <button type="submit" class="btn btn-primary" id="addUserSubmitBtn">Submit</button>
              </form>
            </div>
            <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="container-fluid table-responsive">
    <table class="table table-bordered">
      <caption>Aman's Capital</caption>
      <thead class="thead-dark">
        <tr>
          <th class="text-center" scope="col">SNo.</th>
          <th class="text-center" scope="col">User Name</th>
          <th class="text-center" scope="col">Name</th>
          <th class="text-center" scope="col">Mobile</th>
          <th class="text-center" scope="col">Due</th>
          <th class="text-center" scope="col">View Details</th>
        </tr>
      </thead>
      <tbody>
        <?php $allSno = 1;
        $user_name = "";
        while ($row = mysqli_fetch_assoc($resultAllRecordList)) {
          $user_name = $row['userName'];
          ?>
          <tr>
            <th class="text-center" scope="row"><?php echo ($allSno); ?></th>
            <td class="text-center"><?php echo ($row['userName']); ?></td>
            <td class="text-center"><?php echo ($row['Name']); ?></td>
            <td class="text-center"><?php echo ($row['Mobile']); ?></td>
            <?php
            //Code for Extra Item Data
            $query_for_extra_item1 = "SELECT * FROM `userextra` WHERE userName='{$user_name}' ORDER BY uxsno DESC";
            $result_extra_item1 = mysqli_query($conn, $query_for_extra_item1);
            $extotalamount = 0;
            while ($extotalrow1 = mysqli_fetch_assoc($result_extra_item1)) {
              $extotalamount = $extotalamount + $extotalrow1['uxamount'];
            }

            //Query For Total Board Payments
            $queryForBoardAmount = "SELECT * FROM `boarddata` WHERE userName='{$user_name}'";
            $resultForBoardAmount = mysqli_query($conn, $queryForBoardAmount);
            $totalBoardAmount = 0;
            while ($rowBoard = mysqli_fetch_assoc($resultForBoardAmount)) {
              $totalBoardAmount = $totalBoardAmount + $rowBoard['total_bill'];
            }
            $totalBoardAmount = $totalBoardAmount + $extotalamount;

            //Query For Paid Amount Calculation
            $query_paid_amount = "SELECT * FROM `paidamount` WHERE userName='{$user_name}'";
            $result_paid_amount = mysqli_query($conn,$query_paid_amount);
            $total_paid_amount = 0;
            while($paidrow = mysqli_fetch_assoc($result_paid_amount)){
                $total_paid_amount = $total_paid_amount + $paidrow['amount'];
            }
            $total_due_amount = $totalBoardAmount - $total_paid_amount;
            
            ?>
            <td class="text-center text-danger"><b><?php echo($total_due_amount); ?></b></td>
            <td class="text-center"><a href="./user_details.php?userName=<?php echo($user_name); ?>" class="btn btn-info">View</button></td>
          </tr>
        <?php $allSno = $allSno + 1;
        } ?>
      </tbody>
    </table>
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
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      $("#userNameq").on("keyup", function() {
        var userName = $("#userNameq").val();
        var newString = $.trim(userName);
        $("#userNameq").val(newString);
      });




      //Check User Name Exist or Not
      $("#userNameq").on("blur", function() {
        if ($("#userNameq").val() != "") {
          var userName = $("#userNameq").val();

          $.post("./process.php", {
              user_name: userName,
              code: "1"
            },
            function(data, status) {
              if (data == 0) {
                $("#uaealert").css("display", "none");
                $("#addUserSubmitBtn").css("display", "block");
                $("#userNameq").css("border", "");
                userNameq
              } else {
                $("#uaealert").css("display", "block");
                $("#addUserSubmitBtn").css("display", "none");
                $("#userNameq").css("border", "solid red");
              }
            });
        }
      });
    });
  </script>


</body>

</html>