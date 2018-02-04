<?php
if($_GET['key'] != "faxgrser0GHi2Nx2isI"){
 exit;
}
	passthru("git pull");
	echo "deploy success!";
?>
