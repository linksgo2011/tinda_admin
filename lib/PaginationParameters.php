<?php
/**
 * Created by IntelliJ IDEA.
 * User: nlin
 * Date: 2018/11/7
 * Time: 10:51 AM
 */

class PaginationParameters
{
    private static $pageSize = 10;

    public static function getParameters($count, $currentPage)
    {
        $pageSum = ceil($count / self::$pageSize);
        return [
            "limitString" => [($currentPage - 1) * self::$pageSize, self::$pageSize],
            "pagination" => [
                "pageSum" => $pageSum,
                "currentPage" => $currentPage,
                "count" => $count,
                "prePage" => ($currentPage - 1 > 0) ? ($currentPage - 1) : null,
                "nextPage" => (($currentPage + 1) <= $pageSum) ? ($currentPage + 1) : null
            ]
        ];
    }
}