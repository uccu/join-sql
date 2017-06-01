<?php
namespace uccu\JoinSql\Base;

interface Server{

    CONST FETCH_ARRAY = 1;
    CONST FETCH_OBJECT = 0;

    # 得到Server的类型
    public function serverName();

    # 设置配置
    public function initConfig(array $obj);

    # 获取prefix
    public function getPrefix();

    # 连接/重连数据库
    public function connect();

    # 执行sql语句
    public function query(String $sql);

    # 开始一个事务
    public function start();

    # 回滚一个事务
    public function rollback();

    # 提交一个事务
    public function commit();

    # 获取最后插入行的ID或序列值
	public function insertId();

    # 遍历数据，返回单条数据
    public function fetch(int $fetchType);

    # 返回所有数据
    public function result(int $fetchType);

    # 获取sql影响的行数
	function rows();

}