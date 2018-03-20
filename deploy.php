<?php
if ($_GET['key'] != "faxgrser0GHi2Nx2isI") {
    exit;
}

echo "<pre>";

$branch = "master";
if($_GET['branch']){
    $branch = $_GET['branch'];
}
passthru("git pull --stat --all");
passthru("git checkout $branch");
echo "</pre>";
echo "deploy success!";

?>
