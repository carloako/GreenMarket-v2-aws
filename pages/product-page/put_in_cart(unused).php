<?php
    // session_id("1");
    session_start();
    header("Location: /pages/shopping-cart-page/shopping-cart.php");
?>
<!DOCTYPE html>
<html>
<body>
    <?php
    echo session_id();
    print_r($_SESSION);
        $productID = $_POST["productID"];
        $quantity = $_POST["quantity"];
        $_SESSION["$productID"] = $quantity;
        
    print_r($_SESSION);
        echo "done";
    ?>
</body>
</html>