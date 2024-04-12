<?php
echo 'number of elements in POST: ' . count($_POST) . " \n";
if (isset($_POST)) echo "post  set \n";
foreach($_GET as $key => $value)
{
    echo "$key: $value \n";
}
?>