<?php
include 'connect.php';
$product_id = $_REQUEST['product_id'];
$deleteproductsql = "DELETE FROM extraboard WHERE bxsno='{$product_id}'";
if(mysqli_query($conn, $deleteproductsql)){
    ?>
    <script>
        alert("Product Deleted!!");
        location.href='./';
    </script>
    <?php
}
else{
    ?>
    <script>
        alert("Server Error Please Try Again!!");
        location.href='./';
    </script>
    <?php
}

?>