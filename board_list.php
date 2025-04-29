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
  
  $allRecordList = "SELECT * FROM `boarddata` ORDER BY bsno DESC";
  $resultAllRecordList = mysqli_query($conn,$allRecordList);  
  ?>

<?php include './nav.php'; ?>

<div class="container-fluid mb-3">
    <div class="row">
        <div class="col-12 m-auto"><h4>Board List with Details</h1></div>
        <!-- <div class="col-6 ml-auto"><button type="button" class="btn btn-primary">Download Report</button></div> -->
    </div>
    
</div>

<div class="container-fluid table-responsive">
<table class="table table-bordered">
  <caption>Aman's Capital</caption>
  <thead class="thead-dark">
    <tr>
      <th scope="col">SNo.</th>
      <th scope="col">Board No.</th>
      <th scope="col">Date</th>
      <th scope="col">Start</th>
      <th scope="col">End</th>
      <th scope="col">Total Time</th>
      <th scope="col">Onboard Rs.</th>
      <th scope="col">Board Rs.</th>
      <th scope="col">Total Rs.</th>
      <th scope="col">User</th>
    </tr>
  </thead>
  <tbody>
    <?php $allSno=1; while ($row = mysqli_fetch_assoc($resultAllRecordList)) { ?>
    <tr>
      <th scope="row"><?php echo($allSno); ?></th>
      <td><?php echo($row['boardNo']); ?></td>
      <td><?php echo($row['date']); ?></td>
      <td><?php echo($row['start']); ?></td>
      <td><?php echo($row['close']); ?></td>
      <td><?php echo($row['boardtime']." min"); ?></td>
      
      <td><?php echo($row['bxamount']." RS"); ?></td>
      <td><?php echo($row['boardamount']." Rs"); ?></td>
      
      <td><?php echo($row['total_bill']." RS"); ?></td>
      <td><?php echo($row['userName']); ?></td>
    </tr>
    <?php $allSno=$allSno+1; } ?>
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


</body>

</html>
