<?php

require_once("../lib/Db.php");
require_once("../lib/View.php");
require_once("../lib/Validator.php");
require_once("./info_base.php");

$db = Db::getInstance();

$productId = $_GET['id'];
if (!$productId) {
    echo "参数错误!";
    exit;
}

$product = $db->get("info_product", ["[>]feedbackinfo" => ["user_id" => "id"]], [
    "info_product.id",
    "info_product.title",
    "info_product.phone",
    "info_product.price",
    "info_product.description",
    "info_product.created_at",
    "user" => [
        "feedbackinfo.title"
    ]
],
    [
        "info_product.id[=]" => $productId,
        "info_product.status[=]" => "1"
    ]);

if (!$product) {
    echo "页面找不到!";
    exit;
}
$error = null;
if ($_POST) {
    $result = $db->insert("info_product_comment", [
        "user_id" => $userId,
        "product_id" => $productId,
        "comment" => $_POST['comment']
    ]);
    $savedId = $db->id();

    if (!$savedId) {
        $error = "评论失败!";
    }

}

$product['pictures'] = $db->select('info_product_picture', ["image_path"], [
    "product_id[=]" => $product['id']
]);

$product['comments'] = $db->select('info_product_comment', ["[>]feedbackinfo" => ["user_id" => "id"]], [
    "info_product_comment.comment",
    "info_product_comment.created_at",
    "user" => [
        "feedbackinfo.title"
    ]
], [
    "product_id[=]" => $product['id']
]);

View::render($templateDir . "/detail.php", array(
    "title" => "查看详情",
    "staticRootPath" => $templateDir,
    "product" => $product,
    "error" => $error
));