<?php

require_once __DIR__.'/../vendor/autoload.php';


use uccu\JoinSql\Sql\Handle;

$config = [
    'host'=>'127.0.0.1',
    'user'=>'root',
    'password'=>'123',
    'database'=>'test'
];

$server = Handle::getSingleInstance();
$server->setServer('PdoMysql',$config);
$server->connect();


$server->query('select count(*),1 from cache');

$data = $server->groupData('id');

var_dump($data);

echo $server->getRows();