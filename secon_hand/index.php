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

$meta = $db->get("meta","*",[
    'key[=]'=>"secondHandBanner"
]);

foreach($products as &$product){
    $product['picture'] = $db->get('info_product_picture',["image_path"],[
        "product_id[=]"=> $product['id'],
        "status[=]" => "0",
    ]);
}

$output = array(
    "title" => "二手交易信息",
    "staticRootPath" => $templateDir,
    "products" => $products,
    "banner"=>$meta['value']
);

View::render($templateDir . "/index.php", $output);