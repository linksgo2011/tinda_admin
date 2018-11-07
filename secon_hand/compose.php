<?php

require_once("../lib/Db.php");
require_once("../lib/View.php");
require_once("../lib/Validator.php");
require_once("./info_base.php");

$db = Db::getInstance();

if ($_GET['id']) {
    $product = $db->get("info_product", "*", [
        "status[=]" => "1",
        "id" => @$_GET['id']
    ]);
    if ($product['user_id'] != $userId) {
        echo "没有访问权限!";
        exit;
    }
} else {
    $product = $db->get("info_product", "*", [
        "user_id[=]" => $userId,
        "status[=]" => "0"
    ]);
}

if (!$product) {
    $productId = $db->insert("info_product", [
        'user_id' => $userId
    ]);

    $product = $db->get("info_product", "*", [
        "user_id[=]" => $userId,
        "status[=]" => "0"
    ]);
}

$pictures = $db->select("info_product_picture", "*", [
    "product_id[=]" => $product['id'],
    "status[=]"=>"0"
]);

if(@$_GET['action'] == "del"){
    $saved = $db->update("info_product",['status'=>"-1"], ["id[=]" => $product['id']]);
    header('Location: my_info.php');
    exit;
}

$error;
if (!empty($_POST)) {
    $data = $_POST;
    $validated = Validator::is_valid($data, [
        'title' => 'required|max_len,255',
        'phone' => 'required|phone_number',
        'price' => 'required|float'
    ]);

    if ($validated !== true) {
        $error = "输入有误，请输入正确的价格、电话和标题!";
        View::render($templateDir . "/compose.php", array(
            "title" => "发布二手信息",
            "staticRootPath" => $templateDir,
            "product" => $product,
            "error" => $error
        ));
        exit;
    }
    $data['status'] = 1;
    $data['modified_at'] = date("Y-m-d H:i:s");
    $saved = $db->update("info_product", $data, ["id[=]" => $product['id']]);
    if ($saved->rowCount()) {

        header('Location: my_info.php');
        exit;
    } else {
        $error = "保存失败!";
    }
}

View::render($templateDir . "/compose.php", array(
    "title" => "发布二手信息",
    "staticRootPath" => $templateDir,
    "product" => $product,
    "pictures" => $pictures
));