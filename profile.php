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

    <div class="container">
        <div class="row">
            <div class="col-md-6">


            </div>
            <div class="col-md-12">
                <div class="text-center">
                    <h5>Profile</h5>
                    <hr>
                </div>
                <div class="row text-center">
                    <div class="col-12"><b>Name : </b><?php echo ("Name"); ?></div>
                    <div class="col-12"><b>Username : </b><?php echo ("userName"); ?></div>
                </div>
                <br>
                <br>
                <div class="text-left">
                    <h6>Reset Password</h6>
                    <hr>
                </div>
                <form action="./process.php" method="POST">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6"><label>Old Password</label>
                                <input type="password" class="form-control" name="old_password" required>
                            </div>
                            <div class="col-md-6"><label>New Password</label>
                                <input type="password" class="form-control" name="new_password" required>
                            </div>
                            <!-- <div class="col-md-4"><label>Confirm New Password</label>
                                <input type="password" class="form-control" name="confirm_password" required>
                            </div> -->
                            <div style="display: none;">
                                <input type="text" value="9" name="code" required>
                                <input type="text" value="admin" name="userName" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="text-center"><button type="submit" class="btn btn-primary">Reset</button></div>
                </form>
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