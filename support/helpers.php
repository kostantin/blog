<?php

function dump($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function print_arr($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function dd($data)
{
    dump($data);
    die;
}

function redirect($url = '')
{
    $redirect = empty($url) ? PATH : $url;
    header("Location: {$redirect}");
    die;
}

function db()
{
    $db_config = require CONFIG . '/db.php';

    return (classes\Db::getInstance())->getConnection($db_config);
}

function isAuth()
{
    return isset($_SESSION['user']);
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}