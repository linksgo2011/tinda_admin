<?php
if ($_GET['key'] != "faxgrser0GHi2Nx2isI") {
    exit;
}

echo "<pre>";
passthru("git pull");

echo "</pre>"
echo "deploy success!";
?>
