<?php
require_once("../lib/Db.php");
require_once("../lib/View.php");
require_once("./info_base.php");
require_once("../lib/PaginationParameters.php");

$db = Db::getInstance();
$where = [
    "user_id[=]" => $userId,
    "status[=]" => "1",
    "ORDER" => ["created_at" => "DESC"]
];

$currentPage = @$_GET['page'] ? $_GET['page'] : 1;
$count = $db->count("info_product", $where);
$pagination = PaginationParameters::getParameters($count, $currentPage);
$where['LIMIT'] = $pagination['limitString'];
$products = $db->select("info_product", "*", $where);


foreach ($products as &$product) {
    $product['picture'] = $db->get('info_product_picture', ["image_path"], [
        "product_id[=]" => $product['id'],
        "status[=]" => "0",
    ]);
}

View::render($templateDir . "/my_info.php", array(
    "title" => "二手交易信息",
    "staticRootPath" => $templateDir,
    "products" => $products,
    "pagination" => $pagination['pagination']
));