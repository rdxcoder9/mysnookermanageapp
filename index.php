
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

  $UserQuery = "SELECT * FROM `usersdata`";
  $UserDataresult = mysqli_query($conn, $UserQuery);



  $boardM1query = "SELECT * FROM `boarddata` WHERE status = 0";
  $boardM1result = mysqli_query($conn, $boardM1query);
  $BoardStatus = mysqli_num_rows($boardM1result);

  //M1 Details
  $M1StartTime = "";
  $M1CloseTime = "";
  $M1CloseUser = "";
  $M1_Status = 0;
  $M1_Sno = "";

  //M2 Details
  $M2StartTime = "";
  $M2CloseTime = "";
  $M2CloseUser = "";
  $M2_Status = 0;
  $M2_Sno = "";

  //S1 Details
  $S1StartTime = "";
  $S1CloseTime = "";
  $S1CloseUser = "";
  $S1_Status = 0;
  $S1_Sno = "";

  //S2 Details
  $S2StartTime = "";
  $S2CloseTime = "";
  $S2CloseUser = "";
  $S2_Status = 0;
  $S2_Sno = "";

  //P1 Details
  $P1StartTime = "";
  $P1CloseTime = "";
  $P1CloseUser = "";
  $P1_Status = 0;
  $P1_Sno = "";

  //P2 Details
  $P2StartTime = "";
  $P2CloseTime = "";
  $P2CloseUser = "";
  $P2_Status = 0;
  $P2_Sno = "";


  if ($BoardStatus >= 1) {
    while ($M1row = mysqli_fetch_assoc($boardM1result)) {
      if ($M1row['boardNo'] == 1) {
        $M1StartTime = $M1row['start'];
        $M1_Status = $M1_Status + 1;
        $M1_Sno = $M1row['bsno'];
      }
      if ($M1row['boardNo'] == 2) {
        $M2StartTime = $M1row['start'];
        $M2_Status = $M2_Status + 1;
        $M2_Sno = $M1row['bsno'];
      }
      if ($M1row['boardNo'] == 3) {
        $S1StartTime = $M1row['start'];
        $S1_Status = $S1_Status + 1;
        $S1_Sno = $M1row['bsno'];
      }
      if ($M1row['boardNo'] == 4) {
        $S2StartTime = $M1row['start'];
        $S2_Status = $S2_Status + 1;
        $S2_Sno = $M1row['bsno'];
      }

      if ($M1row['boardNo'] == 5) {
        $P1StartTime = $M1row['start'];
        $P1_Status = $P1_Status + 1;
        $P1_Sno = $M1row['bsno'];
      }
      if ($M1row['boardNo'] == 6) {
        $P2StartTime = $M1row['start'];
        $P2_Status = $P2_Status + 1;
        $P2_Sno = $M1row['bsno'];
      }
    }
  }
  if ($M1_Status == 0) {
    $boardM1query = "SELECT * FROM `boarddata` WHERE status = 1 AND boardNo= 1";
    $boardM1result = mysqli_query($conn, $boardM1query);
    while ($M1row = mysqli_fetch_assoc($boardM1result)) {
      $M1StartTime = $M1row['start'];
      $M1CloseTime = $M1row['close'];
      $M1CloseUser = $M1row['userName'];
    }
  }

  if ($M2_Status == 0) {
    $boardM1query = "SELECT * FROM `boarddata` WHERE status = 1 AND boardNo= 2";
    $boardM1result = mysqli_query($conn, $boardM1query);
    while ($M1row = mysqli_fetch_assoc($boardM1result)) {
      $M2StartTime = $M1row['start'];
      $M2CloseTime = $M1row['close'];
      $M2CloseUser = $M1row['userName'];
    }
  }

  if ($S1_Status == 0) {
    $boardM1query = "SELECT * FROM `boarddata` WHERE status = 1 AND boardNo= 3";
    $boardM1result = mysqli_query($conn, $boardM1query);
    while ($M1row = mysqli_fetch_assoc($boardM1result)) {
      $S1StartTime = $M1row['start'];
      $S1CloseTime = $M1row['close'];
      $S1CloseUser = $M1row['userName'];
    }
  }

  if ($S2_Status == 0) {
    $boardM1query = "SELECT * FROM `boarddata` WHERE status = 1 AND boardNo= 4";
    $boardM1result = mysqli_query($conn, $boardM1query);
    while ($M1row = mysqli_fetch_assoc($boardM1result)) {
      $S2StartTime = $M1row['start'];
      $S2CloseTime = $M1row['close'];
      $S2CloseUser = $M1row['userName'];
    }
  }

  if ($P1_Status == 0) {
    $boardM1query = "SELECT * FROM `boarddata` WHERE status = 1 AND boardNo= 5";
    $boardM1result = mysqli_query($conn, $boardM1query);
    while ($M1row = mysqli_fetch_assoc($boardM1result)) {
      $P1StartTime = $M1row['start'];
      $P1CloseTime = $M1row['close'];
      $$P1CloseUser = $M1row['userName'];
    }
  }

  if ($P2_Status == 0) {
    $boardM1query = "SELECT * FROM `boarddata` WHERE status = 1 AND boardNo= 6";
    $boardM1result = mysqli_query($conn, $boardM1query);
    while ($M1row = mysqli_fetch_assoc($boardM1result)) {
      $P2StartTime = $M1row['start'];
      $P2CloseTime = $M1row['close'];
      $P2CloseUser = $M1row['userName'];
    }
  }
  ?>

  <?php include './nav.php'; ?>











  <div class="container-fluid">
    <!-- Master Boards  -->
    <div class="card-deck">
      <div class="card">
        <!-- Master Board - 1-->
        <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
          <center>
            <h6 class="card-title">Master Board - 1</h6>
          </center>
          <hr>
          <div>
            <div class="row">
              <div class="col-6">
                <form action="./getData.php" method="POST">
                  <div class="form-group">
                    <label>Start Time</label>
                    <input type="text" class="form-control" value="<?php echo ($M1StartTime); ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label>Close Time</label>
                    <input type="text" class="form-control" value="<?php echo ($M1CloseTime); ?>" disabled>
                  </div>
                  <div style="display:none;">
                    <input type="text" value="1" name="board_num">
                  </div>
                  <div class="row">

                    <?php
                    if ($M1_Status == 0) {
                    ?>
                      <div class="col-6"><button type="submit" class="btn btn-primary">Start</button></div>
                    <?php } else { ?>
                      <div class="col-6"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Master1Close">Stop</button></div>
                      <div class="col-6"><a class="btn btn-warning" href="./reset_board.php?board_sno=<?php echo ($M1_Sno); ?>">Reset</a></div>
                    <?php } ?>
                  </div>
                </form>
              </div>
              <div class="col-6">
                <form action="./boardxpadd.php" method="POST">
                  <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="product_name" <?php if ($M1_Status == 0) {
                                                                                  echo ("disabled");
                                                                                } else {
                                                                                  echo ("required");
                                                                                } ?>>
                  </div>
                  <div class="form-group">
                    <label>Amount</label>
                    <input type="number" class="form-control" name="product_amount" <?php if ($M1_Status == 0) {
                                                                                      echo ("disabled");
                                                                                    } else {
                                                                                      echo ("required");
                                                                                    } ?>>
                  </div>
                  <div style="display:none;">
                    <input type="text" value="1" name="board_num">
                  </div>
                  <?php if ($M1_Status != 0) { ?>
                    <div class="row">
                      <div class="col-6"><button type="submit" class="btn btn-primary ">Add</button></div>
                      <div class="col-6"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#Master1ADD">Edit</button></div>
                    </div>
                  <?php } ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>




      <div class="card">
        <!-- Master Board - 2-->
        <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
          <center>
            <h6 class="card-title">Master Board - 2</h6>
          </center>
          <hr>
          <div>
            <div class="row">
              <div class="col-6">
                <form action="./getData.php" method="POST">
                  <div class="form-group">
                    <label>Start Time</label>
                    <input type="text" class="form-control" value="<?php echo ($M2StartTime); ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label>Close Time</label>
                    <input type="text" class="form-control" value="<?php echo ($M2CloseTime); ?>" disabled>
                  </div>
                  <div style="display:none;">
                    <input type="text" value="2" name="board_num">
                  </div>
                  <?php
                  if ($M2_Status == 0) {
                  ?>
                    <button type="submit" class="btn btn-primary">Start</button>
                  <?php } else { ?>
                    <div class="row">
                      <div class="col-6"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Master2Close">Stop</button></div>
                      <div class="col-6"><button type="button" class="btn btn-warning"><a href="./reset_board.php?board_sno=<?php echo ($M2_Sno); ?>">Reset</a></button></div>
                    </div>
                  <?php } ?>
                </form>
              </div>
              <div class="col-6">
                <form action="./boardxpadd.php" method="POST">
                  <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="product_name" <?php if ($M2_Status == 0) {
                                                                                  echo ("disabled");
                                                                                } else {
                                                                                  echo ("required");
                                                                                } ?>>
                  </div>
                  <div class="form-group">
                    <label>Amount</label>
                    <input type="number" class="form-control" name="product_amount" <?php if ($M2_Status == 0) {
                                                                                      echo ("disabled");
                                                                                    } else {
                                                                                      echo ("required");
                                                                                    } ?>>
                  </div>
                  <div style="display:none;">
                    <input type="text" value="2" name="board_num">
                  </div>
                  <div class="row">
                    <?php
                    if ($M2_Status != 0) {
                    ?>
                      <div class="col-6"><button type="submit" class="btn btn-primary">Add</button></div>
                      <div class="col-6"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#Mater2ADD">Edit</button></div>
                    <?php } ?>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <!-- Snooker Board - 1-->
        <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
          <center>
            <h6 class="card-title">Snooker Board - 1</h6>
          </center>
          <hr>
          <div>
            <div class="row">
              <div class="col-6">
                <form action="./getData.php" method="POST">
                  <div class="form-group">
                    <label>Start Time</label>
                    <input type="text" class="form-control" value="<?php echo ($S1StartTime); ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label>Close Time</label>
                    <input type="text" class="form-control" value="<?php echo ($S1CloseTime); ?>" disabled>
                  </div>
                  <div style="display:none;">
                    <input type="text" value="3" name="board_num">
                  </div>
                  <?php
                  if ($S1_Status == 0) {
                  ?>
                    <div class="row">
                      <div class="col-6"><button type="submit" class="btn btn-primary">Start</button></div>
                    </div>
                  <?php } else { ?>
                    <div class="row">
                      <div class="col-6"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Snooker1Close">Stop</button></div>
                      <div class="col-6"><button type="button" class="btn btn-warning"><a href="./reset_board.php?board_sno=<?php echo ($S1_Sno); ?>">Reset</a></button></div>
                    </div>
                    <!--  -->
                  <?php } ?>
                </form>
              </div>
              <div class="col-6">
                <form action="./boardxpadd.php" method="POST">
                  <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="product_name" <?php if ($S1_Status == 0) {
                                                                                  echo ("disabled");
                                                                                } else {
                                                                                  echo ("required");
                                                                                } ?>>
                  </div>
                  <div class="form-group">
                    <label>Amount</label>
                    <input type="number" class="form-control" name="product_amount" <?php if ($S1_Status == 0) {
                                                                                      echo ("disabled");
                                                                                    } else {
                                                                                      echo ("required");
                                                                                    } ?>>
                  </div>
                  <div style="display:none;">
                    <input type="text" value="3" name="board_num">
                  </div>
                  <div class="row">
                    <?php if ($S1_Status != 0) {
                    ?>
                      <div class="col-6"><button type="submit" class="btn btn-primary">Add</button></div>
                      <div class="col-6"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#Snooker1ADD">
                          Edit
                        </button></div>
                    <?php
                    } ?>

                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="container-fluid">
    <!-- Snooker Boards   - 2 -->
    <div class="card-deck">
      <div class="card">
        <!-- Snooker Board - 2 -->
        <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
          <center>
            <h6 class="card-title">Snooker Board - 2</h6>
          </center>
          <hr>
          <div>
            <div class="row">
              <div class="col-6">
                <form action="./getData.php" method="POST">
                  <div class="form-group">
                    <label>Start Time</label>
                    <input type="text" class="form-control" value="<?php echo ($S2StartTime); ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label>Close Time</label>
                    <input type="text" class="form-control" value="<?php echo ($S2CloseTime); ?>" disabled>
                  </div>
                  <div style="display:none;">
                    <input type="text" value="4" name="board_num">
                  </div>
                  <?php
                  if ($S2_Status == 0) {
                  ?>
                    <div class="row">
                      <div class="col-6"><button type="submit" class="btn btn-primary">Start</button></div>
                    </div>
                  <?php } else { ?>
                    <div class="row">
                      <div class="col-6"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Snooker2Close">Stop</button></div>
                      <div class="col-6"><button type="button" class="btn btn-warning"><a href="./reset_board.php?board_sno=<?php echo ($S2_Sno); ?>">Reset</a></button></div>
                    </div>

                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Snooker2ADD">
                      Edit
                    </button> -->

                  <?php } ?>
                </form>
              </div>
              <div class="col-6">
                <form action="./boardxpadd.php" method="POST">
                  <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="product_name" <?php if ($S2_Status == 0) {
                                                                                  echo ("disabled");
                                                                                } else {
                                                                                  echo ("required");
                                                                                } ?>>
                  </div>
                  <div class="form-group">
                    <label>Amount</label>
                    <input type="number" class="form-control" name="product_amount" <?php if ($S2_Status == 0) {
                                                                                      echo ("disabled");
                                                                                    } else {
                                                                                      echo ("required");
                                                                                    } ?>>
                  </div>
                  <div style="display:none;">
                    <input type="text" value="4" name="board_num">
                  </div>
                  <div class="row">
                    <?php if ($S2_Status != 0) {
                    ?>
                      <div class="col-6"><button type="submit" class="btn btn-primary">Add</button></div>
                      <div class="col-6"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#Snooker2ADD">
                          Edit
                        </button></div>
                    <?php
                    } ?>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <!-- 8 Ball Board - 1-->
        <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
          <center>
            <h6 class="card-title">8 Ball Board - 1</h6>
          </center>
          <hr>
          <div>
            <div class="row">
              <div class="col-6">
                <form action="./getData.php" method="POST">
                  <div class="form-group">
                    <label>Start Time</label>
                    <input type="text" class="form-control" value="<?php echo ($P1StartTime); ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label>Close Time</label>
                    <input type="text" class="form-control" value="<?php echo ($P1CloseTime); ?>" disabled>
                  </div>
                  <div style="display:none;">
                    <input type="text" value="5" name="board_num">
                  </div>
                  <?php
                  if ($P1_Status == 0) {
                  ?>
                    <div class="row">
                      <div class="col-6"><button type="submit" class="btn btn-primary">Start</button></div>
                    </div>

                  <?php } else { ?>
                    <div class="row">
                      <div class="col-6"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Pool1Close">Stop</button></div>
                      <div class="col-6"><button type="button" class="btn btn-warning"><a href="./reset_board.php?board_sno=<?php echo ($P1_Sno); ?>">Reset</a></button></div>
                    </div>

                  <?php } ?>
                </form>
              </div>
              <div class="col-6">
                <form action="./boardxpadd.php" method="POST">
                  <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="product_name" <?php if ($P1_Status == 0) {
                                                                                  echo ("disabled");
                                                                                } else {
                                                                                  echo ("required");
                                                                                } ?>>
                  </div>
                  <div class="form-group">
                    <label>Amount</label>
                    <input type="text" class="form-control" name="product_amount" <?php if ($P1_Status == 0) {
                                                                                    echo ("disabled");
                                                                                  } else {
                                                                                    echo ("required");
                                                                                  } ?>>
                  </div>
                  <div style="display:none;">
                    <input type="text" value="5" name="board_num">

                  </div>
                  <div class="row">
                    <?php if ($P1_Status != 0) {
                    ?>
                      <div class="col-6"><button type="submit" class="btn btn-primary">Add</button></div>
                      <div class="col-6"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#Pool1ADD">
                          Edit
                        </button></div>
                    <?php
                    } ?>

                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <!-- 8 Ball Board - 2-->
        <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
          <center>
            <h6 class="card-title">8 Ball Board - 2</h6>
          </center>
          <hr>
          <div>
            <div class="row">
              <div class="col-6">
                <form action="./getData.php" method="POST">
                  <div class="form-group">
                    <label>Start Time</label>
                    <input type="text" class="form-control" value="<?php echo ($P2StartTime); ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label>Close Time</label>
                    <input type="text" class="form-control" value="<?php echo ($P2CloseTime); ?>" disabled>
                  </div>
                  <div style="display:none;">
                    <input type="text" value="6" name="board_num">
                  </div>
                  <?php
                  if ($P2_Status == 0) {
                  ?>
                    <div class="row">
                      <div class="col-6"><button type="submit" class="btn btn-primary">Start</button></div>
                    </div>

                  <?php } else { ?>
                    <div class="row">
                      <div class="col-6"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Pool2Close">Stop</button></div>
                      <div class="col-6"><button type="button" class="btn btn-warning"><a href="./reset_board.php?board_sno=<?php echo ($P2_Sno); ?>">Reset</a></button></div>
                    </div>

                  <?php } ?>
                </form>
              </div>
              <div class="col-6">
                <form action="./boardxpadd.php" method="POST">
                  <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="product_name" <?php if ($P2_Status == 0) {
                                                                                  echo ("disabled");
                                                                                } else {
                                                                                  echo ("required");
                                                                                } ?>>
                  </div>
                  <div class="form-group">
                    <label>Amount</label>
                    <input type="text" class="form-control" name="product_amount" <?php if ($P2_Status == 0) {
                                                                                    echo ("disabled");
                                                                                  } else {
                                                                                    echo ("required");
                                                                                  } ?>>
                  </div>
                  <div style="display:none;">
                    <input type="text" value="6" name="board_num">

                  </div>
                  <?php if ($P2_Status != 0) {
                  ?>
                    <div class="row">
                      <div class="col-6"><button type="submit" class="btn btn-primary">Add</button></div>
                      <div class="col-6"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#Pool2ADD">
                          Edit
                        </button></div>
                    <?php
                  } ?>

                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <!-- Modal For M1 Board Additional Product on Board -->
  <!-- The Modal -->
  <div class="modal" id="Master1ADD">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">On Board M1</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <!-- <form action="./boardxpadd.php" method="POST">
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" name="product_name" required>
            </div>
            <div class="form-group">
              <label>Amount</label>
              <input type="text" class="form-control" name="product_amount" required>
            </div>

            <div style="display:none;">
              <input type="text" value="1" name="board_num">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
            <br>
            <br>
          </form>
          -->

          <?php
          if ($M1_Sno != "") {
            $query_productm1 = "SELECT * FROM `extraboard` WHERE boardSno='{$M1_Sno}'";
            $product_result1 = mysqli_query($conn, $query_productm1);
            while ($productrow1 = mysqli_fetch_assoc($product_result1)) {
          ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo ($productrow1['product']); ?></strong> Amount = Rs. <?php echo ($productrow1['amount']); ?>
                <button type="button" class="close" aria-label="Close">
                  <span aria-hidden="true"><a href="./deletexpadd.php?product_id=<?php echo ($productrow1['bxsno']); ?>">&times;</a></span>
                </button>
              </div>
          <?php
            }
          }

          ?>

        </div>
      </div>
    </div>
  </div>

  <!-- Modal For M2 Board Additional Product on Board -->
  <!-- The Modal -->
  <div class="modal" id="Mater2ADD">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">On Board M2</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <!-- <form action="./boardxpadd.php" method="POST">
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" name="product_name">
            </div>
            <div class="form-group">
              <label>Amount</label>
              <input type="text" class="form-control" name="product_amount">
            </div>

            <div style="display:none;">
              <input type="text" value="2" name="board_num">

            </div>
            <button type="submit" class="btn btn-primary">Add</button>
            </form>
            <br>
            <br> -->

          <?php
          if ($M2_Sno != "") {
            $query_productm2 = "SELECT * FROM `extraboard` WHERE boardSno='{$M2_Sno}'";
            $product_result2 = mysqli_query($conn, $query_productm2);
            while ($productrow2 = mysqli_fetch_assoc($product_result2)) {
          ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo ($productrow2['product']); ?></strong> Amount = Rs. <?php echo ($productrow2['amount']); ?>
                <button type="button" class="close" aria-label="Close">
                  <span aria-hidden="true"><a href="./deletexpadd.php?product_id=<?php echo ($productrow2['bxsno']); ?>">&times;</a></span>
                </button>
              </div>
          <?php
            }
          }

          ?>

        </div>
      </div>
    </div>
  </div>

  <!-- Modal For S1 Board Additional Product on Board -->
  <!-- The Modal -->
  <div class="modal" id="Snooker1ADD">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">On Board S1</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <!-- <form action="./boardxpadd.php" method="POST">
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" name="product_name">
            </div>
            <div class="form-group">
              <label>Amount</label>
              <input type="text" class="form-control" name="product_amount">
            </div>
            <div style="display:none;">
              <input type="text" value="3" name="board_num">

            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </form>
          <br>
          <br> -->
          <?php
          if ($S1_Sno != "") {
            $query_productm2 = "SELECT * FROM `extraboard` WHERE boardSno='{$S1_Sno}'";
            $product_result2 = mysqli_query($conn, $query_productm2);
            while ($productrow2 = mysqli_fetch_assoc($product_result2)) {
          ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo ($productrow2['product']); ?></strong> Amount = Rs. <?php echo ($productrow2['amount']); ?>
                <button type="button" class="close" aria-label="Close">
                  <span aria-hidden="true"><a href="./deletexpadd.php?product_id=<?php echo ($productrow2['bxsno']); ?>">&times;</a></span>
                </button>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal For S2 Board Additional Product on Board -->
  <!-- The Modal -->
  <div class="modal" id="Snooker2ADD">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">On Board S2</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <!-- <form action="./boardxpadd.php" method="POST">
            <div class="form-group">
              <label>Product Name</label>
              <input type="text" class="form-control" name="product_name">
            </div>
            <div class="form-group">
              <label>Amount</label>
              <input type="text" class="form-control" name="product_amount">
            </div>
            <div style="display:none;">
              <input type="text" value="4" name="board_num">

            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </form> 
          <br>
          <br>-->
          <?php
          if ($S2_Sno != "") {
            $query_productm2 = "SELECT * FROM `extraboard` WHERE boardSno='{$S2_Sno}'";
            $product_result2 = mysqli_query($conn, $query_productm2);
            while ($productrow2 = mysqli_fetch_assoc($product_result2)) {
          ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo ($productrow2['product']); ?></strong> Amount = Rs. <?php echo ($productrow2['amount']); ?>
                <button type="button" class="close" aria-label="Close">
                  <span aria-hidden="true"><a href="./deletexpadd.php?product_id=<?php echo ($productrow2['bxsno']); ?>">&times;</a></span>
                </button>
              </div>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal For P1 Board Additional Product on Board -->
  <!-- The Modal -->
  <div class="modal" id="Pool1ADD">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">On Board P1</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">


          <?php
          if ($P1_Sno != "") {
            $query_productm2 = "SELECT * FROM `extraboard` WHERE boardSno='{$P1_Sno}'";
            $product_result2 = mysqli_query($conn, $query_productm2);
            while ($productrow2 = mysqli_fetch_assoc($product_result2)) {
          ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo ($productrow2['product']); ?></strong> Amount = Rs. <?php echo ($productrow2['amount']); ?>
                <button type="button" class="close" aria-label="Close">
                  <span aria-hidden="true"><a href="./deletexpadd.php?product_id=<?php echo ($productrow2['bxsno']); ?>">&times;</a></span>
                </button>
              </div>
          <?php
            }
          }

          ?>

        </div>
      </div>
    </div>
  </div>

  <!-- Modal For P2 Board Additional Product on Board -->
  <!-- The Modal -->
  <div class="modal" id="Pool2ADD">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">On Board P2</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <?php
          if ($P2_Sno != "") {
            $query_productm2 = "SELECT * FROM `extraboard` WHERE boardSno='{$P2_Sno}'";
            $product_result2 = mysqli_query($conn, $query_productm2);
            while ($productrow2 = mysqli_fetch_assoc($product_result2)) {
          ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><?php echo ($productrow2['product']); ?></strong> Amount = Rs. <?php echo ($productrow2['amount']); ?>
                <button type="button" class="close" aria-label="Close">
                  <span aria-hidden="true"><a href="./deletexpadd.php?product_id=<?php echo ($productrow2['bxsno']); ?>">&times;</a></span>
                </button>
              </div>
          <?php
            }
          }

          ?>

        </div>
      </div>
    </div>
  </div>




  <!-- -------------------------------------------------------------------------------->

  <!-- Modal For M1 Board Close -->
  <!-- The Modal -->
  <div class="modal" id="Master1Close">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Close Board M1</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="./getData.php" method="POST">
            <div class="form-row">
              <div class="form-group col-12">
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
            </div>

            <div style="display:none;">
              <input type="text" value="1" name="board_num">
            </div>
            <button type="submit" class="btn btn-danger">Stop</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal For M2 Board Close -->
  <!-- The Modal -->
  <div class="modal" id="Master2Close">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Close Board M2</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="./getData.php" method="POST">
            <div class="form-row">
              <div class="form-group col-12">
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
            </div>

            <div style="display:none;">
              <input type="text" value="2" name="board_num">
            </div>
            <button type="submit" class="btn btn-danger">Stop</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal For S1 Board Close -->
  <!-- The Modal -->
  <div class="modal" id="Snooker1Close">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Close Board S1</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="./getData.php" method="POST">
            <div class="form-row">
              <div class="form-group col-12">
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
            </div>

            <div style="display:none;">
              <input type="text" value="3" name="board_num">
            </div>
            <button type="submit" class="btn btn-danger">Stop</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal For S1 Board Close -->
  <!-- The Modal -->
  <div class="modal" id="Snooker2Close">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Close Board S2</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="./getData.php" method="POST">
            <div class="form-row">
              <div class="form-group col-12">
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
            </div>

            <div style="display:none;">
              <input type="text" value="4" name="board_num">
            </div>
            <button type="submit" class="btn btn-danger">Stop</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal For P1 Board Close -->
  <!-- The Modal -->
  <div class="modal" id="Pool1Close">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Close Board P1</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="./getData.php" method="POST">
            <div class="form-row">
              <div class="form-group col-12">
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
            </div>

            <div style="display:none;">
              <input type="text" value="5" name="board_num">
            </div>
            <button type="submit" class="btn btn-danger">Stop</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal For P2 Board Close -->
  <!-- The Modal -->
  <div class="modal" id="Pool2Close">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Close Board P2</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form action="./getData.php" method="POST">
            <div class="form-row">
              <div class="form-group col-12">
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
            </div>

            <div style="display:none;">
              <input type="text" value="6" name="board_num">
            </div>
            <button type="submit" class="btn btn-danger">Stop</button>
          </form>
        </div>
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