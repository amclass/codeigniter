<?php
defined('BASEPATH') or exit('No direct script access allowed');

// 메시지 출력 후 이동
function alert($msg = "이동합ㅎ니다.", $url = '')
{
    $CI = & get_instance();
    echo "<meta http-equiv='Content-Type' content='text/html' charset=" . $CI->config->item('charset') . ">";
    echo "<script>";
    echo "alert('" . $msg . "');";
    echo "location.href='" . $url . "'";
    echo "</script>";
    exit();
}

function alert_close($msg)
{
    $CI = & get_instance();
    echo "<meta http-equiv='Content-Type' content='text/html' charset=" . $CI->config->item('charset') . ">";
    echo "<script>";
    echo "alert('" . $msg . "');";
    echo "window.close();";
    echo "</script>";
    exit();
}

function alert_only($msg, $exit = true)
{
    $CI = & get_instance();
    echo "<meta http-equiv='Content-Type' content='text/html' charset=" . $CI->config->item('charset') . ">";
    echo "<script>";
    echo "alert('" . $msg . "');";
    echo "</script>";
    if ($exit) {
        exit();
    }
}

function replace($url = '/')
{
    $CI = & get_instance();
    echo "<meta http-equiv='Content-Type' content='text/html' charset=" . $CI->config->item('charset') . ">";
    echo "<script>";
    if ($url) {
        echo "window.location.replace('" . $url . "')";
    }
    echo "</script>";
    exit();
}

?>