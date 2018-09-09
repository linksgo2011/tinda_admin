
<?php



require __DIR__."/../test/test.php";
require_once("global.php");
require_once("points.php");

//assertTrue(getPriceOfPoints() == 10);


try{
    payWithPoint("13333333333");
}catch(Exception $e){
    echo $e->getMessage();
    exit;
}