<?php
if ($_GET['key'] != "faxgrser0GHi2Nx2isI") {
    exit;
}

echo "<pre>";
passthru("git pull --stat");
echo "</pre>";
echo "deploy success!";

?>
