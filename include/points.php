
<?php

/**
 * collects about points
 */

function getPriceOfPoints(){
    $sql = "select * from hchi_pscxsz";
    $rs = mysql_query($sql);
    $row = mysql_fetch_assoc($rs);
    return $row['points'];
}

function payWithPoint($username){
    $price = getPriceOfPoints();

    $userSql = "select * from feedbackinfo where title='$username'";
    $rs = mysql_query($userSql);
    $user = mysql_fetch_assoc($rs);


    $balance = $user['point'];
    if($balance < $price){
        throw new Exception("积分不足");
    }

    $remainBalance = $balance-$price;
    $userId = $user['id'];
    $updateUserSql = "update feedbackinfo set point=$remainBalance where id=$userId";
    if(!mysql_query($updateUserSql)){
        throw new Exception("用户更新失败");
    }
}