<?php 
$currentFolder = getcwd();
$posOfSlash = strpos($currentFolder, '/') + 1;
$currentFolder = substr($currentFolder, $posOfSlash);
$posOfSlash = strpos($currentFolder, '/');
while($posOfSlash){
	$posOfSlash += 1;
	$currentFolder = substr($currentFolder, $posOfSlash);
	$posOfSlash = strpos($currentFolder, '/');
}

$rootFolder = "GreenMarket-v2";
$aisleFolder = "aisle-page";
$productTypeFolder = array("beverages-page", "fruits-page", "meals-page", "snacks-page");
$loginFolder = "login-page";
$shoppingCartFolder = "shopping-cart-page";

$homepage = "home";

$isRoot = (strcmp($currentFolder, $rootFolder) == 0)? true: false;
$isProductType = in_array($currentFolder, $productTypeFolders);
if ($isRoot) {

} else if ($isProductType) {
	$homepage = "../../" . $homepage;
} else {
    $homepage = "../" . $homepage;
}

echo '<div class="footer">';
echo '    <hr>';
echo '    <div class="box-container">';
echo '        <div class="box">';
echo '            <p class="footer-title">Quick links</p>';
echo "            <p><a href=\"$homepage\" class=\"footer-link\">Home</a></p>";
echo '            <p><a href="/pages/extra/about.html" class="footer-link">About us</a></p>';
echo '            <p><a href="/pages/extra/contact.html" class="footer-link">Contact</a></p>';
echo '        </div>';
echo '        <div class="box">';
echo '            <p class="title-footer">Follow us:</p>';
echo '            <p><a class="fab fa-facebook footer-link" href="https://facebook.com"> Facebook</a></p>';
echo '            <p><a class="fab fa-instagram footer-link" href="https://instagram.com"> Instagram</a></p>';
echo '        </div>';
echo '    </div>';
echo '    <footer class="copyright">';
echo '        <p>Concordia University, SOEN 287 Project © Team Green, 2021</p>';
echo '    </footer>';
echo '</div>';
?>