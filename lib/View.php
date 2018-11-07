<?php
/**
 * Created by IntelliJ IDEA.
 * User: nlin
 * Date: 2018/11/6
 * Time: 3:52 PM
 */

class View
{
    public static function render($view, $data = array())
    {
        ob_start();
        extract($data);
        include $view;
        ob_end_flush();
    }
}