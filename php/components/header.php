<?php
$directory = getcwd();
$temp = explode('/', $directory);
$lastIndex = count($temp) - 1;
$currentFolder = $temp[$lastIndex];

$rootFolder = "GreenMarket-v2";
$aisleFolder = "aisle-page";
$productTypeFolders = array("beverages-page", "fruits-page", "meals-page", "snacks-page");
$loginFolder = "login-page";
$shoppingCartFolder = "shopping-cart-page";
$profileFolder = "profile";

$ac = "";

$bannerImagePath = "/images/index-images/green_market-logo.png";
$homepage = "/home";
$aislePage = "/aisle";
$shoppingCartPage = "/shopping-cart";
$loginPage = "/login";
$profilePage = "/profile/";
$backendPage = "/backend";

$isRoot = (strcmp($currentFolder, $rootFolder) == 0) ? true : false;
$isProductType = in_array($currentFolder, $productTypeFolders);
$isAisle = (strcmp($currentFolder, $aisleFolder) == 0) ? true : false;
$isProfile = (strcmp($currentFolder, $profileFolder) == 0) ? true: false;
$isLogin = (strcmp($currentFolder, $loginFolder) == 0) ? true: false;

$homepageActive = $isRoot ? "active" : '';
$aislePageActive = $isProductType || $isAisle ? "active" : '';
$profilePageActive = $isProfile ? "active" : '';
$loginPageActive = $isLogin ? "active" : '';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $profilePage .= $username;
}


echo '<header>';
echo '    <div class="bg-success banner-container-custom"';
echo '    <div class="container">';
echo "        <a href=\"$homepage\" class=\"\"><img src=\"$bannerImagePath\" id=\"banner-img-custom\"></a>";
echo '    </div>';
echo '    </div>';
echo '<div class="bg-danger warning">
<h1>TEST WEBSITE</h1>
</div>';
echo '    <!-- menu bars -->';
// echo '    <div class="nav" id="nav-theme">';
echo '    <div class="container">';
echo '        <nav class="navbar navbar-expand-lg">';
echo '            <div class="container-fluid">';
echo '                <a class="navbar-brand" href="#"></a>';
echo '                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
echo '                    <span class="navbar-toggler-icon"></span>';
echo '                </button>';
echo '                <div class="collapse navbar-collapse" id="navbarSupportedContent">';
echo '                    <ul class="navbar-nav me-auto mt-2 mb-2 mb-lg-0 fs-1">';
echo '                        <li class="nav-item">';
echo "                            <a class=\"nav-link $homepageActive px-4\" href=\"$homepage\">Home</a>";
echo '                        </li>';
echo '                        <li class="nav-item">';
echo "                            <a class=\"nav-link $aislePageActive px-4\" href=\"$aislePage\">Aisles</a>";
echo '                        </li>';
echo '                        <li class="nav-item">';
echo '                            <a class="nav-link disabled px-4" href="">Deals</a>';
echo '                        </li>';
echo '                        <li class="nav-item">';
echo '                            <a class="nav-link disabled px-4" href="">Services</a>';
echo '                        </li>';
echo '                    </ul>';
echo '                    <ul class="navbar-nav mt-2 ms-auto mb-2 mb-lg-0 fs-1">';
if (isset($username)) {
    $isAdmin = strcmp($username, "admin") == 0 ? true : false;
    if ($isAdmin) {
        echo '                <li class="nav-item">';
        echo "                    <a href=\"$backendPage\" class=\"fa-solid fa-box px-4\"></a>";
        echo '                </li>';
    }
}
echo '                        <li class="nav-item">';
echo "                            <a href=\"$shoppingCartPage\" class=\"fa-solid fa-shopping-cart px-4\"></a>";
echo '                        </li>';
if (isset($username)) {
    echo '                    <li class="nav-item">';
    echo "                        <a href=\"$profilePage\" class=\"$profilePageActive nav-link px-4\">$username</a> ";
    echo '                    </li>';
    echo '                    <li class="nav-item">';
    echo "                        <a href='/pages/login-page/logout.php' class='nav-link px-4'>Logout</a>";
    echo '                    </li>';
} else {
    echo '                    <li class="nav-item">';
    echo "                        <a href=\"$loginPage\" class=\"$loginPageActive nav-link fas fa-user px-4\"></a>";
    echo '                    </li>';
}
echo '                    </ul>';
echo '                    <form class="d-flex px-4 mb-2 mt-2" role="search">';
echo '                           <input class="form-control me-2 disabled" type="search" placeholder="Search" aria-label="Search" disabled>';
echo '                           <button class="btn btn-outline-success disabled" type="submit" disabled>Search</button>';
echo '                    </form>';
echo '                </div>';
echo '            </div>';
echo '        </nav>';
echo '    </div>';
echo '</header>';
?>
