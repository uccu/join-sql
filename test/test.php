<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once 'CacheModel.php';

use uccu\JoinSql\Sql\Handle;
use uccu\JoinSql\Sql\Model;
$config = [
    'host'=>'127.0.0.1',
    'user'=>'root',
    'password'=>'123',
    'database'=>'test',
    'prefix'=>'s_',
    'errMode'=>2
];

$server = Handle::getSingleInstance();
$server->setServer('PdoMysql',$config);
$server->connect();


// $server->query('select id from cache');

// $data = $server->getData('id');

// var_dump($data);

// echo $server->getRows();

$model = CacheModel::getSingleInstance();

$model->select('id','des')->group('id')->order('id')->page(2,2)->get();
echo $model->lastSql;