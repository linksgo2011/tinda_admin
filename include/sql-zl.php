<?php
$_POST = sql_injection($_POST); 
$_GET = sql_injection($_GET); 

function sql_injection($content) 
{ 
if (!get_magic_quotes_gpc()) { 
if (is_array($content)) { 
foreach ($content as $key=>$value) { 
$content[$key] = addslashes($value); 
} 
} else { 
addslashes($content); 
} 
}  
return $content; 
} 
?>