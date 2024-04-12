<?php
    session_start();
    header("Location: /pages/shopping-cart-page/shopping-cart.php");
?>
<!DOCTYPE html>
<html>
<body>
    <?php
        $xml = simplexml_load_file('../private/database.xml');
        $newcart = $xml->addChild("cart");
        $products = $xml->product;
        $keys = array_keys($_SESSION);
        $session = session_id();
        $newcart->addChild("session",$session);
        foreach($keys as $key){
            $productname;
            foreach($products as $product){
                if ($key == $product->product_number){
                    $productname = $product->name;
                    break;
                }
            }
            $newcart->addChild(strtolower($productname),$_SESSION["$key"]);
        }
        $xml->asXML('../private/database.xml');
    ?>
</body>
</html>