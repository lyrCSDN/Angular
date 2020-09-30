<?php
    header('Content-Type: text/html;charset=utf-8');
    header('Access-Control-Allow-Origin:*'); // *代表允许任何网址请求
    header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE'); // 允许请求的类型
    header('Access-Control-Allow-Credentials: true'); // 设置是否允许发送 cookies
    header('Access-Control-Allow-Headers: Content-Type,Content-Length,Accept-Encoding,X-Requested-with, Origin'); 
    error_reporting(E_ALL^E_WARNING);
    error_reporting(E_ALL^E_NOTICE);
    require __DIR__.'/User.php';
    
   
    $pdo=require __DIR__.'/db.php';
    
    $datapost=file_get_contents('php://input');
    $user=new User($pdo);
    $datapost=json_decode($datapost);
    $zhanghao=$datapost->zhanghao;
    $password=$datapost->password;
    
    $user->login($zhanghao,$password);
    
?>
