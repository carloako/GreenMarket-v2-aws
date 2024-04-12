<?php
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqlconnect.php';
if (!$conn) {
    header("Location: /error.php?error=database connection error");
} else {
    // echo '<h1>-' . basename($_SERVER['PHP_SELF'], '.php') . '-</h1>';
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
    if (strcmp($currentPage, 'index') === 0) {
        $sql = "SELECT name, price, onsale_price, id FROM Products WHERE onsale = ?";
        $sqlVar = TRUE;
        $sqlVarType = "i";
    } else {
        $sql = "SELECT name, price, onsale_price, id FROM Products WHERE product_type = ?";
        $sqlVar = $currentPage;
        $sqlVarType = "s";
    }

    $title = strcmp($currentPage, 'index') === 0 ? 'ON SALE THIS WEEK' : strtoupper($currentPage); 
    echo "
    <div style=\"display:block;\">
        <h1 class=\"hr-text\">$title</h1>
    </div>";

    echo '
    <div class="container-fluid my-4">
        <div class="row">';

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, $sqlVarType, $sqlVar);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $image_path = "/images/product-images/" . strtolower($name) . ".jpg";
            $price = $row['price'];
            $onsaleprice = $row['onsale_price'];
            $productid = $row['id'];
            echo '<div class="col-12 col-sm-3 px-3 py-3">';
            echo "<a href=\"/product/$productid\">";
            echo '  <div class="card text-center my-sm-0 shadow">';
            echo "      <img src=\"$image_path\" class=\"card-img-top\" alt=\"$name\">";
            echo '      <div class="card-body">';
            echo "          <h2 class=\"card-title\">$name</h2>";
            echo "          <p class=\card-text\">$price</p>";
            echo "          <p class=\"card-text\">Price: $onsaleprice$</p>";
            echo '      </div>';
            echo '  </div>';
            echo '</a>';
            echo '</div>';
        }
    // }
    echo '</div>
    </div>';
}
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqlconnect.php';
?>