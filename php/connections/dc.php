<?php
ob_start(); 
$conn->close();
ob_end_clean();
ob_end_flush();
header("Location: home");
echo "<script>window.location.href='./home';</script>";
die;
exit;
?>