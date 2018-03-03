<?php
  require_once("include/global.php");
$results = mysql_query("select * from  app");
$record = mysql_fetch_assoc($results);
echo $record["bb"];
		?>