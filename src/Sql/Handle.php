<?php
namespace uccu\JoinSql\Sql;

use uccu\JoinSql\Server;
use uccu\JoinSql\Traits;

use Exception;

class Handle {

    use Traits\InstanceTrait;

    private $_server;
    private $_linked = false;

    public $lastSql;
    public $prefix = '';

    # 设置数据库服务类型与参数
    public function setServer(String $serverName,array $config){

        $serverClass = 'uccu\JoinSql\Server\\'.$serverName;
        $this->_server = new $serverClass;
        $this->_server->initConfig($config);
        $this->defaultPrefix = $this->_server->prefix;
        $this->defalutDatabase = $this->_server->database;
        return $this;
    }

    # 连接数据库
    public function connect(){

        $this->_server->connect();
        $this->_link = true;
        return $this;

    }

    # 事务
    public function start(){

        $this->_server->start();
        return $this;
    }
    public function rollback(){

        $this->_server->rollback();
        return $this;
    }
    public function commit(){

        $this->_server->commit();
        return $this;
    }

    # 执行sql
    public function query(String $sql){

        $this->lastSql = $sql;
        $this->_server->query($sql);
        return $this;
    }

    # 获取数据
    public function getData(String $key = null){

        $data = [];
        while($row = $this->_server->fetch()){
            if(!$key || !isset($row->$key))$data[] = $row;
            else $data[$row->$key] = $row;
        }
        return $data;
    }

    # 分组获取数据
    public function groupData(String $key){

        $data = [];
        while($row = $this->_server->fetch())
            isset($row->$key) && $data[$row->$key][] = $row;
        return $data;
    }

    # 获取update影响数量或者select获得的数量
    public function getRows(){

        return $this->_server->rows();
    }

    # 获得最近一次插入的ID
    public function getInsertId(){

        return $this->_server->insertId();
    }


    public static function quoteField($field){
		
		if(!is_string($field))throw new Exception('Undefined Field\'s Name');
        $fields = explode('.',$field);
        foreach($fields as &$v)$v  = '`' . str_replace('`', '', $v) . '`';
        $field = implode('.',$fields);
		return $field;

	}








}