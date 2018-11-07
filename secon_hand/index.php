<?php

require_once("../lib/Db.php");
require_once("../lib/View.php");
require_once("./info_base.php");

$db = Db::getInstance();
$products = $db->select("info_product", "*", [
    "status[=]" => "1",
    "ORDER" => ["created_at" => "DESC"],
    "LIMIT" => 6
]);

foreach($products as &$product){
    $product['picture'] = $db->get('info_product_picture',["image_path"],[
        "product_id[=]"=> $product['id']
    ]);
}

View::render($templateDir . "/index.php", array(
    "title" => "二手交易信息",
    "staticRootPath" => $templateDir,
    "products" => $products
));