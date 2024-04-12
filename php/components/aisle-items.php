<?php
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqlconnect.php';
if (!$conn) {
    header("Location: /index.php");
} else {
    $sql = "SELECT DISTINCT product_type FROM Products;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="row">';
        while ($row = mysqli_fetch_assoc($result)) {
            $producttype = $row['product_type'];
            $name = ucfirst($producttype);
            $image_path = "/images/aisle-images/$producttype.jpg";
            $hrefPath = '/aisle/'.$producttype;
            echo '<div class="col-12 col-sm-3">';
            echo "<a href=\"$hrefPath\">";
            echo '  <div class="card text-center mx-3 my-3 my-sm-0 shadow">';
            echo "      <img src=\"$image_path\" class=\"card-img-top\" alt=\"$producttype\">";
            echo '      <div class="card-body">';
            echo "          <h2>$name</h2>";
            echo '      </div>';
            echo '  </div>';
            echo '</a>';
            echo '</div>';
        }
        echo '</div>';
    }
}
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqldisconnect.php';
?>