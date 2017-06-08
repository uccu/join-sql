<?php

require_once __DIR__.'/../vendor/autoload.php';


use uccu\JoinSql\Sql\Handle;
use uccu\JoinSql\Sql\Model;
$config = [
    'host'=>'127.0.0.1',
    'user'=>'root',
    'password'=>'123',
    'database'=>'test',
    'errMode'=>2
];

$server = Handle::getSingleInstance();
$server->setServer('PdoMysql',$config);
$server->connect();


// $server->query('select id from cache');

// $data = $server->getData('id');

// var_dump($data);

// echo $server->getRows();

$model = new Model('user');

$model->get();
echo $model->lastSql;