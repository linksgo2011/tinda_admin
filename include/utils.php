<?php
// collects about util

/**
 * Log error info
 * @param $content
 */
function logError($content){
    $file = __DIR__."/../log/error.txt";
    file_put_contents($file,$content,FILE_APPEND);
}

function setUserToVIP($userId){
    $sql = "update feedbackinfo set vip=1 where `id`='$userId'";
    if(!mysql_query($sql)){
        logError('sql '.$sql);
    }
}

function out($status,$data,$message){
    echo json_encode(
        array(
            'status'=>$status,
            'data'=>$data,
            'message'=>$message
        )
    );
    exit;
}

/**
 * 判断是否都是中文
 * @param $str
 * @return int
 */
function isAllChinese($str)
{
    $len = preg_match('/^[\x{4e00}-\x{9fa5}]+$/u',$str);
    if ($len)
    {
        return true;
    }
    return false;
}