<?php
// Set the default timezone to Asia/Kolkata
date_default_timezone_set('Asia/Kolkata');
// Include the database connection file
include 'connect.php';

// Sanitize inputs to prevent SQL injection
$num = mysqli_real_escape_string($conn, $_POST['board_num']);
$productName = mysqli_real_escape_string($conn, $_POST['product_name']);
$productAmount = mysqli_real_escape_string($conn, $_POST['product_amount']);

// Get the current time and date
$time = date("H:i");
$date = date("d-m-Y");


// Check if the product amount is a number
if (!is_numeric($productAmount)) {
    die("Error: Product amount must be a number.");
}

// Query to find boards that are not started and have a specific board number
$boardquery = "SELECT * FROM `boarddata` WHERE status = 0 AND boardNo= '{$num}'";
$boardresult = mysqli_query($conn, $boardquery);

// Check if there was an error with the query
if (!$boardresult) {
    die("Error fetching board data: " . mysqli_error($conn));
}

// Count the number of rows returned by the query
$boardStatus = mysqli_num_rows($boardresult);

// If there is at least one board that meets the criteria
if ($boardStatus >= 1) {
    // Fetch the first row as an associative array
    while ($boardrow = mysqli_fetch_assoc($boardresult)) {
        // Get the board serial number
        $BoardSno = $boardrow['bsno'];
    }

    // Query to add a product to the extraboard table
    $productaddquery = "INSERT INTO `extraboard`(`product`, `amount`, `boardSno`) VALUES ('{$productName}','{$productAmount}','{$BoardSno}')";
    // Execute the product addition query and check if it was successful
    if (mysqli_query($conn, $productaddquery)) {
        ?>
        <script>
            alert("Product Add Successfully");
            // Redirect to the main page
            location.href = './';
        </script>
        <?php
    } else {
        // If there is an error, display an error message
        echo("Error: " . $productaddquery . "<br>" . mysqli_error($conn));
    }
} else {
    // If there is no board that meets the criteria
    ?>
    <script>
        // Show an alert and redirect to the main page
        alert("Product Not Added...");
        location.href = './';
    </script>
    <?php
}

?>
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